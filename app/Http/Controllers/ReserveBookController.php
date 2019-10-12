<?php

namespace App\Http\Controllers;

use App\Books;
use App\Funds;
use App\ReserveBook;
use App\Settings;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Crypt;

class ReserveBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // function to reserve the book by user
    public function reserve($id)
    {
        $id = Crypt::decryptString($id);

        $user = Auth::user()->id;
        $reserved_books_amount = ReserveBook::select('user_id')
            ->where('user_id', $user)
            ->where('in_entry', '!=', 1)
            ->count();
        $books_allowed = Settings::select('books')
            ->where('id', 1)
            ->get();
        $books_allowed = $books_allowed[0]->books;

        if ($reserved_books_amount >= $books_allowed) {
            // return redirect()->route('mybooks');
            echo "you are trying to reserve more than allowed amount of books <= this must be shown in an alert box";
        } else {
            $reserve = new ReserveBook;
            $reserve->user_id = $user;
            $reserve->book_id = $id;
            $reserve->is_reserved = 1;
            $reserve->out_entry = 0;
            $reserve->in_entry = 0;
            $reserve->fine = 0;
            $reserve->save();
            DB::table('books')->where('id', $id)->update(['issued' => 1]);
            return redirect()->route('mybooks');
        }
    }

    // function passes array of all reserved books and borrowed books by user on the mybooks page
    public function mybooks()
    {
        $user = Auth::user()->id;

        $reserved = DB::table('reserve_books')->where('user_id', $user)->get();
        $book_ids = [];
        $count = count($reserved);

        for ($i = 0; $i < $count; $i++) {
            $book_ids[] = $reserved[$i]->book_id;
        }

        $books = DB::table('reserve_books')
            ->join('books', 'books.id', '=', 'reserve_books.book_id')
            ->select('reserve_books.out_entry as out', 'reserve_books.is_reserved as res', 'reserve_books.in_entry as in', 'books.*')
            ->whereIn('book_id', $book_ids)
            ->where('reserve_books.in_entry', '!=', 1)
            ->get();
        // print_r($books);die;
        $settings = Settings::select('books', 'days', 'bkamount')
            ->where('id', 1)
            ->get();

        return view('mybooks', [
            'resbooks' => $books,
            'settings' => $settings,
        ]);

    }

    // function to cancel the reserve by user or admin
    public function rescancel($id)
    {
        $id = Crypt::decryptString($id);
        DB::table('reserve_books')->where('book_id', $id)->delete();
        DB::table('books')->where('id', $id)->update(['issued' => 0]);
        return redirect()->route('mybooks');
    }

    // function passes array of all reserved books to be authorized by admin on authorize page
    public function autho()
    {
        $authorize_books = DB::table('reserve_books')
            ->join('books', 'books.id', '=', 'reserve_books.book_id')
            ->join('users', 'users.id', '=', 'reserve_books.user_id')
            ->select('reserve_books.id as reserve_books_id', 'books.id as book_id', 'users.name',
                'books.image', 'users.id as user_id', 'name', 'title', 'phone', //'users.email as email',
                'reserve_books.updated_at as creation')
            ->where('reserve_books.is_reserved', '=', '1')
            ->get();

        return view('autho', [
            'authobooks' => $authorize_books,
        ]);
    }

    // function to authorize the book borrowing on reserved book by the admin
    public function accept($id)
    {
        $id = Crypt::decryptString($id);
        $updated = date('Y-m-d h:i:s');
        DB::table('reserve_books')->where('id', $id)->update(['is_reserved' => 0, 'out_entry' => 1, 'created_at' => $updated, 'updated_at' => $updated]);
        return redirect()->route('autho');
    }

    // function to decline the book borrowing on reserved book by the user or admin
    public function decline($id)
    {
        $id = Crypt::decryptString($id);
        DB::table('reserve_books')->where('book_id', $id)->delete();
        DB::table('books')->where('id', $id)->update(['issued' => 0]);
        return redirect()->route('autho');
    }

    // function passes array of all lent books to be recieved by admin on lent page
    public function lent()
    {
        $lent_books = DB::table('reserve_books')
            ->join('books', 'books.id', '=', 'reserve_books.book_id')
            ->join('users', 'users.id', '=', 'reserve_books.user_id')
            ->select('reserve_books.id as reserve_books_id', 'books.id as book_id', 'users.name',
                'books.image', 'users.id as user_id', 'name', 'title', 'phone',
                'reserve_books.created_at as creation')
            ->where('reserve_books.out_entry', '=', '1')
            ->where('reserve_books.in_entry', '=', '0')
            ->get();

        return view('lent', [
            'lentbooks' => $lent_books,
        ]);
    }

    // function to recive the book back after being borrowed by user for a period of time, done by the admin
    public function recieve($id)
    {
        $id = Crypt::decryptString($id);
        $updated = date('Y-m-d h:i:s');
        DB::table('reserve_books')
            ->where('id', $id)
            ->update(['out_entry' => 0, 'in_entry' => 1, 'updated_at' => $updated]);

        $books_data = Books::join('reserve_books', 'reserve_books.book_id', '=', 'books.id')
            ->where('reserve_books.id', $id)
            ->update([
                'books.issued' => 0,
            ]);

        $this->finecal($id);

        return redirect()->route('fines');
    }

    // calcluates the fines to put on user for keeping the books after alloted period
    public function finecal($id)
    {
        // this is fine calcluate formula area
        $period = Settings::select('days')->get();
        $amount = Settings::select('bkamount')->get();
        $dates = ReserveBook::select('created_at', 'updated_at')
            ->where('id', $id)
            ->get();

        $lentdate = $dates[0]->created_at;
        $retdate = $dates[0]->updated_at;
        $period = $period[0]->days;
        $amount = $amount[0]->bkamount;

        $database_date = strtotime($lentdate);
        $now = strtotime($retdate);
        $kept_days = floor(($now - $database_date) / (60 * 60 * 24));

        if ($kept_days <= $period) {
            DB::table('reserve_books')
                ->where('id', $id)
                ->update(['fine' => 0]);
        } else {
            $fineamount = (($kept_days - $period) * $amount);
            DB::table('reserve_books')
                ->where('id', $id)
                ->update(['fine' => $fineamount]);
        }
        // fine cal formula area ending

    }

    // function passes array of all fines on users to be collected by admin on fines page
    public function fines()
    {
        $fines = User::join('reserve_books', 'reserve_books.user_id', '=', 'users.id')
            ->join('books', 'books.id', '=', 'reserve_books.book_id')
            ->select('reserve_books.id as reserve_books_id', 'books.id as book_id',
                'users.id as user_id', 'users.name',
                'name', 'title', 'phone', 'fine',
                'reserve_books.created_at as creation', 'reserve_books.updated_at as returned')
            ->where('fine', '!=', 0)->get();

        return view('fines', [
            'fines' => $fines,
        ]);
    }

    public function collect($id)
    {
        $id = Crypt::decryptString($id);
        $user_fine_amount = ReserveBook::where('id', $id)
            ->select('fine', 'user_id')
            ->get();
        $updated = date('Y-m-d h:i:s');
        $fine_payable = $user_fine_amount[0]->fine;
        $fined_user = $user_fine_amount[0]->user_id;
        $desc = "Fine amount Rs.$fine_payable is paid by the user.";

        $fine_transfer = Funds::insert(['amount' => $fine_payable, 'user_id' => $fined_user,
            'descripton' => $desc, 'created_at' => $updated, 'updated_at' => $updated]);

        $collect = ReserveBook::where('id', $id)
            ->update(['fine' => 0]);
        return redirect()->route('fines');
    }
}

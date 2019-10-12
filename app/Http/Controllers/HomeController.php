<?php

namespace App\Http\Controllers;

use App\ReserveBook;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $act = ReserveBook::join('books', 'books.id', '=', 'reserve_books.book_id')
            ->select('is_reserved', 'title', 'reserve_books.created_at as reserve_time')
            ->where('user_id', $id)
            ->where('is_reserved', 1)
            ->get();
        $res_1 = $act[0];
        $res_2 = $act[1];

        $condition_1 = $res_1->is_reserved;
        $condition_2 = $res_2->is_reserved;

        return view('profile', [
            'act' => $act,
            'res_1' => $res_1,
            'res_2' => $res_2,
            'condition_1' => $condition_1,
            'condition_2' => $condition_2,
        ]);

    }

    public function users()
    {
        $users = User::get();

        return view('users', [
            'users' => $users,
        ]);
    }

    public function userpage($id)
    {
        $id = Crypt::decryptString($id);
        $users = User::where('id', $id)->first();

        return view('users.userpage', [
            'users' => $users,
        ]);
    }

    public function settings()
    {
        return view('settings');
    }

    public function editprofile(Request $request, $id)
    {
        $id = Crypt::decryptString($id);

        $request->validate([
            'name' => 'required|min:5',
            'address' => 'required',
            'phone' => 'required',
            'job' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            'about' => 'required|max:500',
        ]);

        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $job = $request->input('job');
        $dob = $request->input('dob');
        $about = $request->input('about');
        $image = $request->file('image');

        // echo $name;
        // echo $address;
        // echo $phone;
        // echo $job;
        // echo $dob;
        // echo $about;
        // echo $image;
        // die;

        $imageName = $image->getClientOriginalName();
        $imageExtension = $image->getClientOriginalExtension();

        if ($imageExtension == 'jpeg' || $imageExtension == 'jpg' ||
            $imageExtension == 'png' || $imageExtension == 'jfif') {

            $valid = User::select('name')->where('name', '=', $name)->get();

            if (ctype_alpha(str_replace(' ', '', $name)) === false) {
                $error = 1;
                $msg = "Name must be in Letters and must not be empty";

            } else if ($name === null) {
                $error = 1;
                $msg = "Please Type a Name";

            } else if (empty($valid[0]['name'])) {
                $profupdate = User::where('id', $id)
                    ->update([
                        'name' => $name,
                        'dob' => $dob,
                        'phone' => $phone,
                        'job' => $job,
                        'address' => $address,
                        'about' => $about,
                        'job' => $job,
                    ]);
                $getLastId = User::orderBy('id', 'DESC')->get();

                $lastId = $getLastId[0]['id'];

                $destination = 'asset/dist/img/users';
                $newImageName = $lastId . "." . $imageExtension;
                $path = $destination . "/" . $newImageName;
                $image->move($destination, $newImageName);

                $imageupdate = User::where('id', '=', $lastId)
                    ->update([
                        'image' => $path,
                    ]);

            } else {
                $error = 1;
                $msg = "this name is already exists";
            }
        } else {
            $error = 1;
            $msg = "Upload file must be image";
        }

        // return response()->json([
        //     'error' => $error,
        //     'msg' => $msg,
        // ]);

        // return response()->json(['success' => true]);
        return redirect()->route('profile');
    }

    public function edituser($id)
    {
        $id = Crypt::decryptString($id);
        $edituser = User::where('id', $id)->first();
        return view('users.edituser', [
            'edituser' => $edituser,
        ]);
    }

    public function userupdate(Request $request, $id)
    {
        $id = Crypt::decryptString($id);

        $request->validate([
            'name' => 'required|min:5',
            'address' => 'required',
            'phone' => 'required',
            'job' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            'about' => 'required|max:500',
        ]);

        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $job = $request->input('job');
        $dob = $request->input('dob');
        $about = $request->input('about');
        $image = $request->file('image');

        $imageName = $image->getClientOriginalName();
        $imageExtension = $image->getClientOriginalExtension();

        if ($imageExtension == 'jpeg' || $imageExtension == 'jpg' ||
            $imageExtension == 'png' || $imageExtension == 'jfif') {

            $valid = User::select('name')->where('name', '=', $name)->get();

            if (ctype_alpha(str_replace(' ', '', $name)) === false) {
                $error = 1;
                $msg = "Name must be in Letters and must not be empty";

            } else if ($name === null) {
                $error = 1;
                $msg = "Please Type a Name";

            } else if (empty($valid[0]['name'])) {
                $profupdate = User::where('id', $id)
                    ->update([
                        'name' => $name,
                        'dob' => $dob,
                        'phone' => $phone,
                        'job' => $job,
                        'address' => $address,
                        'about' => $about,
                        'job' => $job,
                    ]);
                $getLastId = User::orderBy('id', 'DESC')->get();

                $lastId = $getLastId[0]['id'];

                $destination = 'asset/dist/img/users';
                $newImageName = $lastId . "." . $imageExtension;
                $path = $destination . "/" . $newImageName;
                $image->move($destination, $newImageName);

                $imageupdate = User::where('id', '=', $lastId)
                    ->update([
                        'image' => $path,
                    ]);

            } else {
                $error = 1;
                $msg = "this name is already exists";
            }
        } else {
            $error = 1;
            $msg = "Upload file must be image";
        }

        // return response()->json([
        //     'error' => $error,
        //     'msg' => $msg,
        // ]);

        // return response()->json(['success' => true]);
        return redirect()->route('users');
    }

    public function deleteuser($id)
    {
        $id = Crypt::decryptString($id);
        DB::table('users')
            ->where('id', $id)
            ->delete();
        return redirect()
            ->route('home');
    }

    public function promote($id)
    {
        $id = Crypt::decryptString($id);
        DB::table('users')
            ->where('id', $id)
            ->update(['position' => 2]);
        return redirect()
            ->route('home');
    }
}

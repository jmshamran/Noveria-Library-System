<?php

namespace App\Http\Controllers;

use App\Books;
use App\Genre;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Storage;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $books = Books::get();
        $books = Books::join('genres', 'genres.id', '=', 'books.genre')
            ->select('books.*', 'genres.genre as genre_name')
            ->get();

        return view('books', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addbook()
    {
        $genres = Genre::get();
        return view('books.addbook', [
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'language' => 'required',
            'reldate' => 'required|date_format:Y-m-d',
            'genre' => 'required',
        ]);

        $title = $request->title;
        $isbn = $request->isbn;
        $author = $request->author;
        $language = $request->language;
        $publisher = $request->publisher;
        $genre = $request->genre;
        $price = $request->price;
        $reldate = $request->reldate;
        $issued = 0;
        $image = $request->file('image');

        $error = 1;
        $msg = "";

        $imageName = $image->getClientOriginalName();
        $imageExtension = $image->getClientOriginalExtension();

        if ($imageExtension == 'jpeg' || $imageExtension == 'jpg' ||
            $imageExtension == 'png' || $imageExtension == 'jfif') {

            $valid = Books::select('title')->where('title', '=', $title)->get();

            if (ctype_alpha(str_replace(' ', '', $title)) === false) {
                $error = 1;
                $msg = "Name must be in Latters and must not be empty";

            } else if ($title === null) {
                $error = 1;
                $msg = "Please Type Name";
            } else if (empty($valid[0]['book_name'])) {
                $createBook = Books::create([
                    'title' => $title,
                    'isbn' => $isbn,
                    'author' => $author,
                    'language' => $language,
                    'publisher' => $publisher,
                    'genre' => $genre,
                    'price' => $price,
                    'reldate' => $reldate,
                    'issued' => $issued,

                ]);
                $getLastId = Books::orderBy('id', 'DESC')->get();
                $lastId = $getLastId[0]['id'];

                $destination = 'asset/dist/img/books';
                $newImageName = $lastId . "." . $imageExtension;
                $path = $destination . "/" . $newImageName;
                $image->move($destination, $newImageName);

                Books::where('id', '=', $lastId)
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
        return redirect()->route('books');
    }

    public function bookpage($id)
    {
        $id = Crypt::decryptString($id);

        $books = Books::join('genres', 'genres.id', '=', 'books.genre')
            ->select('books.*', 'genres.genre as genre_name')
            ->where('books.id', $id)
            ->first();

        return view('books.bookpage', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editbook($id)
    {
        $id = Crypt::decryptString($id);
        $editbk = Books::where('id', $id)->first();
        return view('books.editbook', [
            'editbk' => $editbk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookupdate(Request $request, $id)
    {
        $id = Crypt::decryptString($id);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'language' => 'required',
            'reldate' => 'required|date_format:Y-m-d',
            'genre' => 'required',
        ]);

        $title = $request->title;
        $isbn = $request->isbn;
        $author = $request->author;
        $language = $request->language;
        $publisher = $request->publisher;
        $genre = $request->genre;
        $price = $request->price;
        $reldate = $request->reldate;
        $issued = 0;
        $image = $request->file('image');

        $error = 1;
        $msg = "";

        $imageName = $image->getClientOriginalName();
        $imageExtension = $image->getClientOriginalExtension();

        if ($imageExtension == 'jpeg' || $imageExtension == 'jpg' ||
            $imageExtension == 'png' || $imageExtension == 'jfif') {

            $valid = Books::select('title')->where('title', '=', $title)->get();

            if (ctype_alpha(str_replace(' ', '', $title)) === false) {
                $error = 1;
                $msg = "Name should be in Letters and must not be empty";

            } else if ($title === null) {
                $error = 1;
                $msg = "Please Type Name";
            } else if (empty($valid[0]['book_name'])) {
                $createBook = Books::where('id', $id)
                    ->update([
                        'title' => $title,
                        'isbn' => $isbn,
                        'author' => $author,
                        'language' => $language,
                        'publisher' => $publisher,
                        'genre' => $genre,
                        'price' => $price,
                        'reldate' => $reldate,
                        'issued' => $issued,

                    ]);
                $getLastId = Books::orderBy('id', 'DESC')->get();
                $lastId = $getLastId[0]['id'];

                $destination = 'asset/dist/img/books';
                $newImageName = $lastId . "." . $imageExtension;
                $path = $destination . "/" . $newImageName;
                $image->move($destination, $newImageName);

                Books::where('id', '=', $lastId)
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
        return redirect()->route('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletebook($id)
    {
        $id = Crypt::decryptString($id);
        DB::table('books')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('books');
    }
}

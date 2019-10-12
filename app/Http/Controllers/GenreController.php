<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Crypt;

class GenreController extends Controller
{
    public function addBookGenre(Request $request)
    {
        // $request = Crypt::decryptString($request);
        $genre_name = $request->genre;
        $updated = date('Y-m-d h:i:s');
        $add_genre = Genre::insert(['genre' => $genre_name, 'created_at' => $updated, 'updated_at' => $updated]);
        return redirect()->route('settings');
    }

    public function removeBookGenre(Request $request)
    {
        // $request = Crypt::decryptString($request);
        $genre_name = $request->genre;

        $add_genre = Genre::where('id', $genre_name)
            ->delete();
        return redirect()->route('settings');
    }
}

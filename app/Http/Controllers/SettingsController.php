<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $genres = Genre::get();
        return view('settings', [
            'genres' => $genres,
        ]);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{

    protected $table = 'books';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'title', 'isbn', 'author', 'language', 'publisher', 'genre', 'price', 'reldate', 'image', 'issued',
    ];

}

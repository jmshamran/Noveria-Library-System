<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'genre',
    ];
}

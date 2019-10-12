<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReserveBook extends Model
{
    protected $table = 'reserve_books';
    public $primaryKey = 'id';
    public $timestamps = true;
}

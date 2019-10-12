<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'books', 'days', 'bkamount',
    ];
}

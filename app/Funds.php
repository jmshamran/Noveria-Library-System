<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    protected $table = 'funds';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'amount', 'description',
    ];
}

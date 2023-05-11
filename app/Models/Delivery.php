<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'delivery';

    protected $fillable = [
        'PK_TRXNO',
        'Terms',
        'docno',
        'remarks',
        'curramt'
    ];

    public $timestamps = TRUE;
}

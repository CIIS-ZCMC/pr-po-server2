<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuance extends Model
{
    use HasFactory;

    protected $table = 'issuance';

    protected $fillable = [
        'req_date',
        'qty',
        'exp_date',
        'conversion',
        'inv_balance',
        'price',
        'netcost'
    ];

    public $timestamps = TRUE;
}

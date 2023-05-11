<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuanceItem extends Model
{
    use HasFactory;

    protected $table = 'issuance_item';

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

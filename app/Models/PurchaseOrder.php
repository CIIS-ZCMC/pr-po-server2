<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';

    public $fillable = [
        'po_no',
        'po_trxno',
        'po_date',
        'series_number',
        'purpose',
        'caf_number',
        'terms',
        'procurement',
        'total',
    ];

    public $timestamps = TRUE;
}

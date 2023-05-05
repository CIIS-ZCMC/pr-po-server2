<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $table = 'purchase_request';

    public $fillable = [
        'pr_no',
        'proc_pr_no',
        'pr_date',
        'funds',
        'rcc',
        'pr_Prxno',
        'purpose',
        'proc_mode',
        'rfq_no',
        'proc_date',
        'posting_date',
        'opening_date',
        'deleted'
    ];

    public $timestamps = TRUE;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRRelation extends Model
{
    use HasFactory;

    protected $table = 'pr_relation';

    public $fillable = [
        'mms_approval',
        'procurement_approval',
        'budget_approval',
        'accounting_approval',
        'finance_approval',
        'bidding_status',
        'po_status',
        'estimated_grand',
        'final_grand',
        'deleted'
    ];

    public $timestamps = TRUE;
}

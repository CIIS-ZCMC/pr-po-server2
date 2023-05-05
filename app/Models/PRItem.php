<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRItem extends Model
{
    use HasFactory;

    protected $table = 'pr_items';

    public $fillable = [
        'quantity',
        'unit',
        'unit_cost',
        'initial_cost',
        'final_cost',
        'status',
        'deleted'
    ];

    public $timestamps = TRUE;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POItem extends Model
{
    use HasFactory;

    protected $table = 'po_item';
    
    public $fillable = [
        'quantity',
        'price',
        'total_price',
        'itemSpec',
    ];

    public $timestamps = TRUE;
}

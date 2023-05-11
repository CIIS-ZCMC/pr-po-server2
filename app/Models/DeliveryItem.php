<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    use HasFactory;

    protected $table = 'delivery_item';

    protected $fillable = [
        'qty',
        'unit',
        'conversion',
        'vat',
        'landcost',
        'landamt',
        'netamt'
    ];

    public $timestamps = TRUE;
}

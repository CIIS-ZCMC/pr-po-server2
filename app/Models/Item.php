<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'id';

    public $fillable = [
        'item_no',
        'barcodeid',
        'description',
        'abbreviation',
        'price',
        'common_office_material',
        'deleted'
    ];

    public $timestamps = TRUE;
}

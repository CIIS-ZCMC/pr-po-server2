<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRFiles extends Model
{
    use HasFactory;

    protected $table = 'files';

    public $fillable = [
        'name',
        'deleted'
    ];

    public $timestamps = TRUE;
}

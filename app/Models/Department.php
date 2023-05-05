<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    public $fillable = [
        'dept_PK_msc_wareghouse',
        'dept_name',
        'dept_shortname',
        'deleted'
    ];

    public $timestamps = TRUE;
}

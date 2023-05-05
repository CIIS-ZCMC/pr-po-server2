<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRRecords extends Model
{
    use HasFactory;

    protected $table = 'pr_records';

    public $fillable = [
        'proc_mode',
        'deleted'
    ];

    public $timestamps = TRUE;
}
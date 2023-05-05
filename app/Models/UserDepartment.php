<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;

    protected $table = 'user_department';

    protected $fillable = [
        'FK_user_ID',
        'FK_department_ID',
        'deleted'
    ];

    public $timestamps = TRUE;
}

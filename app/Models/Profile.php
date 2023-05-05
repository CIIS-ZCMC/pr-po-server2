<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'FK_address_ID',
        'FK_user_ID',
        'fname',
        'mname',
        'lname',
        'ext_name',
        'contact',
        'deleted'
    ];

    public $timestamps = TRUE;
}

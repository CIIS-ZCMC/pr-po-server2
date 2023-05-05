<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try{
            return 'test';
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()], 500);
        }
    }
}

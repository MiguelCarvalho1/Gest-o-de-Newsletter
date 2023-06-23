<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index ()
    {
        return view ('welcome');
    }

public function store (Request $request)
    {
        $email= $request->email;
        $message= $request->email;
        dd($email.$message);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinetController extends Controller
{
    public function about()
    {
        return view('client.about');
    }
}

<?php

namespace App\Http\Controllers;

//abstract class Controller
//{
    //
//}

// app/Http/Controllers/Controller.php

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}



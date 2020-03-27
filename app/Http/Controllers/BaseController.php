<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
  public function __construct()
  {

    //its just a dummy data object.
    $user	=	['name' => 'Quoc Nam', 'age' => '20'];

    // Sharing is caring
    View::share('user', $user);
  }
}
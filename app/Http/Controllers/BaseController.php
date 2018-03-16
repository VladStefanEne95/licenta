<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
  public function __construct()
  {
    $user = User::all();

    // Sharing is caring
    
  }
}

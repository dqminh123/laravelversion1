<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct()
    {
        
    }
    public function index(){
        return view('backend.dashboard.home.index');
    }

    public function error403(){
        return view('backend.dashboard.home.error403');
    }
}

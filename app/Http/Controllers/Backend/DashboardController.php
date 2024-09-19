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
        $tem = 'backend.dashboard.home.index';
        return view('backend.dashboard.layout',compact('tem'));
    }

    public function error403(){
        $tem = 'backend.dashboard.home.error403';
        return view('backend.dashboard.layout',compact('tem'));
    }
}

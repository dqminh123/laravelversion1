<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BaseService implements BaseServiceInterface
{

    

    public function __construct(){

    }
    public function currentLanguage(){
        return 2;
    }
}

<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

use App\Repositories\Interfaces\WardRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Ward;

class WardRepository implements WardRepositoryInterface
{
   public function all()  // Returns all provinces
   {
       return Ward::all();  // Gets all records from Province model
   }
}


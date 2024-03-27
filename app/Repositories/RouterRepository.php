<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

use App\Repositories\Interfaces\RouterRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Router;

class RouterRepository extends BaseRepository implements RouterRepositoryInterface
{
    protected $model ; 

   public function __construct(Router $model)
   {
     $this ->model = $model;
   }
}

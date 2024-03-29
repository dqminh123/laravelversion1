<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCataloguePermission extends Model
{
    use HasFactory;

    protected $table = 'user_catalogue_permission';

    public function permissions(){
        return  $this->belongsToMany(Permission::class, 'permission_id');
    }

    public function user_catalogues(){
        return  $this->belongsToMany(UserCatalogue::class,'user_catalogue_id');
    }
}

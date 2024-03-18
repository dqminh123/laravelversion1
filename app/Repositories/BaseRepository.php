<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $payload = [])
    {
       $model = $this->model->create($payload);
       return $model->fresh();
    }

    public function update(int $id =0 , array $payload = [])
    {
       $model = $this->findById($id);
       return $model->update($payload);
    }

    public function updateByWhereIn(string $WhereInField = '', array $WhereIn = [], array $payload= []){
       return $this->model->whereIn($WhereInField,$WhereIn)->update($payload);
    }

    public function delete(int $id = 0){
        return $this->findById($id)->delete();
    }

    public function forceDelete(int $id = 0){
        return $this->findById($id)->forceDelete();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    ){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function createLanguagePivot($model, array $payload=[]){
        return $model->languages()->attach($model->id, $payload);
    }

    public function pagination(
        array $column = ['*'], 
        array $condition = [],
        int $perPage = 1,
        array $orderBy = ['id','DESC'],
        array $extend = [],
        array $join = [],
        array $relations = [],
       
        
    ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name','LIKE', '%'.$condition['keyword'].'%');
            }

            if(isset($condition['publish']) && $condition['publish'] !=0){
                $query->where('publish','=', $condition['publish']);
            }
            if(isset($condition['where'])&& count($condition['where'])){
                foreach($condition['where'] as $key =>$val){
                    $query->where($val[0], $val[1], $val[2]);
                }
            }
            return $query;
        });
        if(isset($relations) && !empty($relation)){
            foreach($relations as $relation){
                $query->withCount($relation);
            }
        }

        if(isset($join) && is_array($join) && count($join)){
            foreach($join as $key =>$val){
                $query->Join($val[0],$val[1],$val[2],$val[3]);
            }
        }
        
        if(isset($orderBy) && !empty($orderBy)){
                $query->orderBy($orderBy[0],$orderBy[1]);
        }

        return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);

        
       
    }
}

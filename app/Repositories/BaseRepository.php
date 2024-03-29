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

    public function updateByWhere($condition = [], $payload = []){
        $query = $this->model->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0],$val[1],$val[2]);
        }
        return $query->update( $payload );
    }

    public function updateByWhereIn(string $WhereInField = '', array $WhereIn = [], array $payload= []){
       return $this->model->whereIn($WhereInField,$WhereIn)->update($payload);
    }
    //xóa mềm là không xóa trong database và cơ sở dữ liệu
    public function delete(int $id = 0){
        return $this->findById($id)->delete();
    }
    // xóa trong  database và cơ sở dữ liệu
    public function forceDelete(int $id = 0){
        return $this->findById($id)->forceDelete();
    }

    public function all(array $relation = [])
    {
        return $this->model->with($relation)->get();
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    ){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function findByCondition($condition = []){
        $query = $this->model->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1], $val[2]);
        }
        return $query->first();
    }

    public function createPivot($model, array $payload=[], string $relation = ''){
        return $model->{$relation}()->attach($model->id, $payload);
    }
    

    public function pagination(
        array $column = ['*'], 
        array $condition = [],
        int $perPage = 1,
        array $orderBy = ['id','DESC'],
        array $extend = [],
        array $join = [],
        array $relations = [],
        array $rawQuery = [],
       
        
    ){
        $query = $this->model->select($column);
        return $query  
                ->keyword($condition['keyword'] ?? null)
                ->publish($condition['publish'] ?? null)
                ->relationCount($relations ?? null)
                ->CustomWhere($condition['where'] ?? null)
                ->customWhereRaw($rawQuery['whereRaw'] ?? null)
                ->customJoin($join ?? null)
                ->customGroupBy($extend['groupBy'] ?? null)
                ->customOrderBy($orderBy ?? null)
                ->paginate($perPage)
                ->withQueryString()->withPath(env('APP_URL').$extend['path']);
        //tim kiem 
        // $query = $this->model->select($column)->where(function($query) use ($condition){
        //     if(isset($condition['keyword']) && !empty($condition['keyword'])){
        //         $query->where('name','LIKE', '%'.$condition['keyword'].'%');
        //     }

        //     if(isset($condition['publish']) && $condition['publish'] !=0){
        //         $query->where('publish','=', $condition['publish']);
        //     }
        //     if(isset($condition['where'])&& count($condition['where'])){
        //         foreach($condition['where'] as $key =>$val){
        //             $query->where($val[0], $val[1], $val[2]);
        //         }
        //     }
        //     return $query;
        // });
        // tồn tại whereraw và là mảng thì nó sẽ foreach , val[0] tương đương câu truy vấn, val[1] tham số
        // if(isset($rawQuery['whereRaw']) && count($rawQuery['whereRaw'])){
        //     foreach($rawQuery['whereRaw'] as $key => $val){
        //         $query->whereRaw($val[0],$val[1]);
        //     }
        // }

        // if(isset($relations) && !empty($relation)){
        //     foreach($relations as $relation){
        //         $query->withCount($relation);
        //     }
        // }

        // if(isset($join) && is_array($join) && count($join)){
        //     foreach($join as $key =>$val){
        //         $query->Join($val[0],$val[1],$val[2],$val[3]);
        //     }
        // }

        // if(isset($extend['groupBy']) && !empty($extend['groupBy'])){
        //     $query->groupBy($extend['groupBy']);
        // }
        
        // if(isset($orderBy) && !empty($orderBy)){
        //         $query->orderBy($orderBy[0],$orderBy[1]);
        // }

        // return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);

        
       
    }
}

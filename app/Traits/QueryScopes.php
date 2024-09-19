<?php

namespace App\Traits;
// Traits cơ chế để tạo ra các phương thức mà trong đó class khác nhau có thể sử dụng được để giải quyết
// vấn đề hạn chế của php nó ko làm được ko có đa kế thừa
trait QueryScopes
{
    public function scopeKeyword($query, $keyword){
        if(!empty($keyword)){
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }

    public function scopePublish($query, $publish){
        if(!empty($publish) ){
            $query->where('publish', '=', $publish);
        }
        return $query;
    }

    public function scopeCustomWhere($query, $where = []){
        if(!empty($where)){
            foreach($where as $key => $val){
                $query->where($val[0], $val[1], $val[2]);
            }
        }
        return $query;
    }

    public function scopeCustomWhereRaw($query , $rawQuery){
        if(is_array($rawQuery) && !empty($rawQuery)){
            foreach($rawQuery as $key => $val){
                $query->whereRaw($val[0], $val[1]);
            }
        }
        return $query;
    }

    public function scopeRelationCount($query, $relation){

        if(!empty($relation) && !is_null($relation)){
            foreach($relation as $item){
                $query->withCount($item);
            }
        }
        return $query;
    }

    public function scopeRelation($query, $relations){
      
        if(!empty($relations)){
            foreach($relations as $relation){
                $query->with($relation);
            }
        }
        return $query;
    }

    public function scopeCustomJoin($query, $join){
        if(!empty($join)){
            foreach($join as $key => $val){
                $query->join($val[0], $val[1], $val[2], $val[3]);
            }
        }
        return $query;
    }

    public function scopeCustomGroupBy($query, $groupBy){
        if(!empty($groupBy)){
            $query->groupBy($groupBy);
        }
        return $query;
    }

    public function scopeCustomOrderBy($query, $orderBy){
        if(isset($orderBy) && !empty($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        return $query;
    }

}

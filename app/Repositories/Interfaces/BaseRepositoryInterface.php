<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $int);
    public function create(array $payload);
    public function update(int $id=0,array $payload = []);
    public function delete(int $id =0);
    public function updateByWhereIn(string $WhereInField = '',array $WhereIn = [], array $payload= []);
    public function createLanguagePivot($model, array $payload=[]);
    public function pagination(
        array $column = ['*'], 
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 1,
        array $relations = [],
        array $orderBy = [],
        
    );
        
    
}
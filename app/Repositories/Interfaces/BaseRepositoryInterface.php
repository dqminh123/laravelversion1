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
}
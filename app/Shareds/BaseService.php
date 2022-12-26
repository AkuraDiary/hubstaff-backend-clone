<?php

namespace App\Shareds;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function __construct(public Model $model)
    {
    }

    public function findById(int $id): Model
    {
        return $this->model->with($this->with)->findOrFail($id);
    }

    public function findAll(): Collection
    {
        return $this->model->with($this->with)->get();
    }

    public function create(Model $model): void
    {
        $model->saveOrFail();
    }

    public function update(Model $model): void
    {
        $model->updateOrFail();
    }

    public function delete(int $id): void
    {
        $model = $this->model->findOrFail($id);
        $model->deleteOrFail();
    }

}

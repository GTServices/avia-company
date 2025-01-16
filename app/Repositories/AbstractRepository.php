<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records with optional ordering, relationships, and pagination.
     *
     * @param string $orderColumn
     * @param string $orderProperty
     * @param array $with
     * @param int $paginate
     * @return mixed
     */
    public function all($orderColumn = 'id', $orderProperty = 'asc', $with = [], $paginate = 9)
    {
        $query = $this->model->with($with)->orderBy($orderColumn, $orderProperty);

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }
}

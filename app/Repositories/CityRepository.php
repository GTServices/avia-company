<?php

namespace App\Repositories;


use App\Models\City;
use App\Models\Tour;

class CityRepository extends AbstractRepository
{
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function search($query = null, $orderColumn = 'id', $orderProperty = 'asc', $with = [], $paginate = 9)
    {
        $tours = $this->model->with($with)->orderBy($orderColumn, $orderProperty);

        if ($query) {
            $tours->where('name', 'LIKE', "%{$query}%");
        }

        if ($paginate) {
            return $tours->paginate($paginate);
        }

        return $tours->get();
    }
}

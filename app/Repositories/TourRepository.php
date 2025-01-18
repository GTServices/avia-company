<?php

namespace App\Repositories;


use App\Models\Tour;

class TourRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Tour $model)
    {
        $this->model = $model;
    }

    public function search($query = null, $orderColumn = 'id', $orderProperty = 'asc', $with = [], $paginate = 9)
    {
        $tours = $this->model->with($with)->orderBy($orderColumn, $orderProperty);

        if ($query) {
            $tours->where('title', 'LIKE', "%{$query}%")
                ->orWhere('desc', 'LIKE', "%{$query}%")
                ->orWhere('price', 'LIKE', "%{$query}%");
        }

        if ($paginate) {
            return $tours->paginate($paginate);
        }

        return $tours->get();
    }
}

<?php

namespace App\Repositories;


use App\Models\City;
use App\Models\Tour;
use App\Models\Transfer;

class TransferRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Transfer $model)
    {
        $this->model = $model;
    }

    public function search($query = null, $orderColumn = 'id', $orderProperty = 'asc', $with = [], $paginate = 9)
    {
        $tours = $this->model->with($with)->orderBy($orderColumn, $orderProperty);

        if ($query) {
            $tours->where('title', 'LIKE', "%{$query}%")
                ->orWhere('desc', 'LIKE', "%{$query}%");
        }

        if ($paginate) {
            return $tours->paginate($paginate);
        }

        return $tours->get();
    }
}

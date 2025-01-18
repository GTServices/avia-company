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
}

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

    public function all($orderColumn = 'id', $orderProperty = 'asc', $filters = [], $paginate = 9)
    {
        $tours = $this->model->orderBy($orderColumn, $orderProperty);

        // Apply search filter
        if (isset($filters['search']) && $filters['search']) {
            $search = $filters['search'];
            $tours->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('desc', 'LIKE', "%{$search}%")
                      ->orWhere('card_description', 'LIKE', "%{$search}%");
            });
        }

        // Apply date range filter
        if (isset($filters['date_from']) && isset($filters['date_to'])) {
            $tours->whereBetween('datetime', [$filters['date_from'], $filters['date_to']]);
        }

        if ($paginate) {
            return $tours->paginate($paginate);
        }

        return $tours->get();
    }
}

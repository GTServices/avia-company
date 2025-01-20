<?php
namespace App\Services\Admin;

use App\Models\Airport;
use App\Models\City;

class AirportService
{
    public function getFilteredAirports(array $filters)
    {
        $query = Airport::query();

        if (!empty($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->with('city')->get();
    }

    public function getAllCities()
    {
        return City::all();
    }

    public function createAirport(array $data)
    {
        Airport::create($data);
    }

    public function getAirportById($id)
    {
        return Airport::findOrFail($id);
    }

    public function updateAirport($id, array $data)
    {
        $airport = Airport::findOrFail($id);
        $airport->update($data);
    }

    public function deleteAirport($id)
    {
        Airport::findOrFail($id)->delete();
    }

    public function deleteSelectedCities(array $ids)
    {
        City::whereIn('id', $ids)->delete();
    }
}

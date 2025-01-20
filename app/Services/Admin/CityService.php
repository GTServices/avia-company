<?php

namespace App\Services\Admin;

use App\Models\City;
use App\Repositories\CityRepository;
use App\Repositories\LanguageRepository;

class CityService
{
    public function __construct(private LanguageRepository $languageRepository, private CityRepository $cityRepository)
    {
    }

    public function getAllCities($search = null)
    {
        $query = City::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    public function getLanguages()
    {
        return $this->languageRepository->all('order');
    }

    public function createCity(array $data)
    {
        $city = new City();
        $city->name = $data['name'];
        $city->save();
    }

    public function getCityForEdit($id)
    {
        $city = City::findOrFail($id);
        $languages = $this->getLanguages();

        return [$city, $languages];
    }

    public function updateCity($id, array $data)
    {
        $city = City::findOrFail($id);
        $city->name = $data['name'];
        $city->save();
    }

    public function deleteCity($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
    }

    public function deleteSelectedCities(array $ids)
    {
        City::whereIn('id', $ids)->delete();
    }
}

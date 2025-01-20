<?php

namespace App\Services\Admin;

use App\Models\Transfer;
use App\Models\Airport;
use App\Services\ImageService;

class TransferService
{
    public function getAllTransfers($search = null, $orderBy = 'datetime', $direction = 'asc', $relations = [])
    {
        $query = Transfer::query();

        if ($search) {
            $query->where('title->ru', 'like', "%{$search}%");
        }

        if ($relations) {
            $query->with($relations);
        }

        return $query->orderBy($orderBy, $direction)->get();
    }

    public function getAirports()
    {
        return Airport::all();
    }

    public function createTransfer(array $data, $imageService)
    {
        if (isset($data['image']) && is_file($data['image'])) {
            $data['image'] = $imageService->optimizeAndStore($data['image'], 'transfers');
        }

        return Transfer::create($data);
    }

    public function updateTransfer(Transfer $transfer, array $data, $imageService)
    {
        if (isset($data['image']) && is_file($data['image'])) {
            $data['image'] = $imageService->optimizeAndStore($data['image'], 'transfers');
        }

        $transfer->update($data);
        return $transfer;
    }

    public function deleteTransfer(Transfer $transfer)
    {
        $transfer->delete();
    }

    public function deleteSelectedTransfers(array $ids)
    {
        Transfer::whereIn('id', $ids)->delete();
    }


}

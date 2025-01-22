<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Repositories\TransferRepository;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function __construct(private TransferRepository $transferRepository)
    {

    }
    public function index()
    {
        $transfers = $this->transferRepository->all('datetime', 'asc', [], 9);
        return view('view.pages.transfers.index', compact('transfers'));
    }


    public function view($id, $slug)
    {
        $tour = $this->transferRepository->getById($id);
        return view('view.pages.transfers.view');
    }
}

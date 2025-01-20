<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Repositories\LanguageRepository;
use App\Services\Admin\TransferService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function __construct(private TransferService $transferService, public LanguageRepository $languageRepository, private ImageService $imageService) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $transfers = $this->transferService->getAllTransfers($search, 'datetime', 'asc', ['departureAirport', 'arrivalAirport']);
        return view('admin.pages.transfers.index', compact('transfers'));
    }

    public function create()
    {
        $languages = $this->languageRepository->all('order', 'asc');
        $airports = $this->transferService->getAirports();
        return view('admin.pages.transfers.create', compact('airports', 'languages'));
    }

    public function store(Request $request, ImageService $imageService)
    {
        $data = $request->all();
        $this->transferService->createTransfer($data, $imageService);

        return redirect()->route('admin.transfers.index')->with('success', 'Трансфер успешно добавлен.');
    }

    public function edit(Transfer $transfer)
    {
        $languages = $this->languageRepository->all('order', 'asc');
        $airports = $this->transferService->getAirports();
        return view('admin.pages.transfers.edit', compact('transfer', 'airports', 'languages'));
    }

    public function update(Request $request, Transfer $transfer, ImageService $imageService)
    {
        $data = $request->all();
        $this->transferService->updateTransfer($transfer, $data, $imageService);

        return redirect()->route('admin.transfers.index')->with('success', 'Трансфер успешно обновлён.');
    }

    public function destroy(Transfer $transfer)
    {
        $this->transferService->deleteTransfer($transfer);

        return redirect()->route('admin.transfers.index')->with('success', 'Трансфер успешно удалён.');
    }

    public function delete_selected(Request $request)
    {
        $ids = $request->input('selected_ids');

        if (!$ids || !is_array($ids)) {
            return response()->json(['success' => false, 'message' => 'Не выбраны трансферы для удаления.']);
        }

        $this->transferService->deleteSelectedTransfers($ids);

        return response()->json(['success' => true, 'message' => 'Выбранные трансферы успешно удалены.']);
    }
}

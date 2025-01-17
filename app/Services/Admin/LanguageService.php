<?php
namespace App\Services\Admin;

use App\Models\Language;

class LanguageService
{
    protected $model;

    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    public function add($request)
    {
        $this->model::create($request->validated());
    }

    public function update($language, $request)
    {
        $language->update($request->validated());
    }

    public function destroy($id)
    {
        $language = $this->model->findOrFail($id);

        if ($language->is_main) {
            $this->handleIsMain($id);
        }

        $language->delete();
    }

    public function bulkDestroy(array $ids)
    {
        foreach ($ids as $id) {
            $language = $this->model->find($id);

            if ($language && $language->is_main) {
                $this->handleIsMain($id);
            }

            if ($language) {
                $language->delete();
            }
        }
    }

    private function handleIsMain($excludedId)
    {
        // Check if there are other languages
        $otherLanguage = $this->model->where('id', '!=', $excludedId)->first();

        if ($otherLanguage) {
            $otherLanguage->update(['is_main' => true]);
        }
    }
}

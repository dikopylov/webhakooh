<?php

namespace App\Http\Models\Platen;


class PlatenRepository
{
    public function getAll()
    {
        return Platen::where('is_delete', false)->get();
    }

    public function create(array $data)
    {
        return Platen::create([
            'title' => $data['title'],
            'capacity' => $data['capacity'],
            'is_delete' => false,
        ]);
    }

    public function findOrFail($id)
    {
        return Platen::findOrFail($id);
    }


}
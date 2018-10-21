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
            'capacity' => $data['platen_capacity'],
            'is_delete' => false,
        ]);
    }

    public function find($id)
    {
        return Platen::find($id);
    }

    public function update($id, $title, $capacity)
    {
        $platen = $this->find($id);
        $platen->title = $title;
        $platen->capacity = $capacity;
        $platen->save();
    }

    public function delete($id)
    {
        $platen = $this->find($id);
        $platen->is_delete = true;
        $platen->save();
    }
}
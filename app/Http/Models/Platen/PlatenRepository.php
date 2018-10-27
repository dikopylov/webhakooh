<?php

namespace App\Http\Models\Platen;


class PlatenRepository
{
    public function getAll()
    {
        return Platen::all();
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
        return Platen::destroy($id);
    }
}
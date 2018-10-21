<?php


namespace App\Http\Models\ActivityLog\Platen;


class PlatenActivityRepository
{
    public function create(array $data)
    {
        return PlatenActivity::create(array(
            'title' => $data['title'],
            'capacity' => $data['platen_capacity'],
            'is_delete' => false,
        ));
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
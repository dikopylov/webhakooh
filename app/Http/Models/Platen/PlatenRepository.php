<?php

namespace App\Http\Models\Platen;


class PlatenRepository
{
    const MAX_ITEMS_ON_ACTIVITY_LOG_PAGE = 5;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Platen::paginate(self::MAX_ITEMS_ON_ACTIVITY_LOG_PAGE);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Platen::create([
            'title' => $data['title'],
            'capacity' => $data['platen_capacity'],
            'is_delete' => false,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Platen::find($id);
    }

    /**
     * @param $id
     * @param $title
     * @param $capacity
     */
    public function update($id, $title, $capacity)
    {
        $platen = $this->find($id);
        $platen->title = $title;
        $platen->capacity = $capacity;
        $platen->save();
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return Platen::destroy($id);
    }
}
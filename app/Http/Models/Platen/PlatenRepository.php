<?php

namespace App\Http\Models\Platen;


use App\Http\Frontend\Platen\PlatenPagination;

class PlatenRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Platen::paginate(PlatenPagination::$maxItemsOnPage);
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
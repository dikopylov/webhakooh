<?php

namespace App\Http\Models\Platen;


use App\Http\Frontend\Platen\PlatenPagination;
use Illuminate\Database\Eloquent\Model;

class PlatenRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Platen::all();
    }

    public function getWithPagination()
    {
        return Platen::paginate(PlatenPagination::$maxItemsOnPage);
    }

    /**
     * @param int $capacity
     * @return mixed
     */
    public function getByCapacity(int $capacity)
    {
        return Platen::where('capacity', '>=', $capacity);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): Model
    {
        return Platen::find($id);
    }

    /**
     * @param Platen $platen
     * @return bool
     */
    public function save(Platen $platen): bool
    {
        return $platen->save();
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
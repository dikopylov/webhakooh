<?php


namespace App\Http\Models\ActivityLog;


class ActivityLogRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Activity::all();
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return Activity::all()->last();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Activity::where('id', $id)->get();
    }

}
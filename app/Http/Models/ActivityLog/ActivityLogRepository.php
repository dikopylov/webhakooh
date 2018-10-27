<?php


namespace App\Http\Models\ActivityLog;


class ActivityLogRepository
{
    public function getAll()
    {
        return Activity::all();
    }

    public function last()
    {
        return Activity::all()->last();
    }

    public function findById($id)
    {
        return Activity::where('id', $id)->get();
    }

}
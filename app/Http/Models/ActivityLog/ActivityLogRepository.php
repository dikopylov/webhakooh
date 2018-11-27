<?php


namespace App\Http\Models\ActivityLog;


class ActivityLogRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Activity::orderByDesc('created_at')->paginate(7);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findById($id)
    {
        return Activity::where('id', $id)->get()->sortByDesc('created_at');
    }

}
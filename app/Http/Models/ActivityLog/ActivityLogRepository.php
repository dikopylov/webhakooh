<?php


namespace App\Http\Models\ActivityLog;


class ActivityLogRepository
{
    const MAX_ITEMS_ON_ACTIVITY_LOG_PAGE = 7;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Activity::orderByDesc('created_at')->paginate(self::MAX_ITEMS_ON_ACTIVITY_LOG_PAGE);
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
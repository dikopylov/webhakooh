<?php

namespace App\Http\Models\ActivityLog;

use App\Http\Frontend\ActivityLog\ActivityLogPagination;

class ActivityLogRepository
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Activity::orderByDesc('created_at')->paginate(ActivityLogPagination::$maxItemsOnPage);
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
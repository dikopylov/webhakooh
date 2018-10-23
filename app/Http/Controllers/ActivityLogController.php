<?php


namespace App\Http\Controllers;

use App\Http\Models\ActivityLog\ActivityLogRepository;
use App\Http\Models\User\UserRepository;

class ActivityLogController extends Controller
{
    /**
     * @var ActivityLogRepository
     */
    private $activityLogRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
        $this->middleware(['auth', 'check.admin']);
    }

    public function index()
    {
        $logs = $this->activityLogRepository->getAll();

        $last = $this->activityLogRepository->last();
        dd($last->user);
        dd($logs->user);
        return view('activity-log.index')->with('logs', $logs);
    }
}
<?php


namespace App\Http\Controllers;

use App\Http\Models\ActivityLog\ActivityLogRepository;
use App\Http\Models\User\User;
use App\Http\Models\User\UserRepository;
use Spatie\Activitylog\Traits\CausesActivity;

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

    public function __construct(ActivityLogRepository $activityLogRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->activityLogRepository = $activityLogRepository;
        $this->middleware(['auth', 'check.admin']);
    }

    public function index()
    {
        $logs = $this->activityLogRepository->getAll();
        return view('activity-log.index')->with('logs', $logs);
    }

    public function showChanges($id)
    {
        $log = $this->activityLogRepository->findById($id);
        return view('activity-log.changes')->with('changes', $log[0]->changes);
    }

    public function showChangesByUser($id)
    {
        $user = $this->userRepository->findOrFail($id);

        return view('activity-log.changes-by-user')->with('user', $user);
    }

}
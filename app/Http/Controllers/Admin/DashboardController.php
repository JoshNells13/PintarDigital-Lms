<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Contracts\Repositories\CourseRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Services\ModerationService;

class DashboardController extends Controller
{
    protected $courseRepository;
    protected $userRepository;
    protected $moderationService;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        UserRepositoryInterface $userRepository,
        ModerationService $moderationService
    ) {
        $this->courseRepository = $courseRepository;
        $this->userRepository = $userRepository;
        $this->moderationService = $moderationService;
    }

    public function index()
    {
        return view('admin.dashboard', [
            'pendingCourses'         => $this->courseRepository->getPendingApproval(),
            'totalUsers'             => $this->userRepository->countAll(),
            'totalStudents'          => $this->userRepository->countByRole('student'),
            'totalInstructors'       => $this->userRepository->countByRole('instructor'),
            'totalCourses'           => $this->courseRepository->countAll(),
            'totalApprovedCourses'  => $this->courseRepository->countApproved(),
        ]);
    }

    public function approve(Course $course)
    {
        $this->moderationService->approve($course);
        return back()->with('success', 'Course approved and published.');
    }

    public function reject(Course $course)
    {
        $this->moderationService->reject($course);
        return back()->with('success', 'Course rejected and removed from system.');
    }
}

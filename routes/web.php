<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Instructor\DashboardController as InstructorDashboard;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [CourseController::class, 'home'])->name('home');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll')->middleware('auth');
Route::get('/mentors', [\App\Http\Controllers\MentorController::class, 'index'])->name('mentors.index');
Route::get('/learning-paths', function () { return view('learning-paths'); })->name('learning-paths');
Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/courses/{course}/like', [CourseController::class, 'like'])->name('courses.like');
    Route::post('/courses/{course}/comments', [\App\Http\Controllers\CourseCommentController::class, 'store'])->name('courses.comments.store');
    Route::post('/comments/{comment}/like', [\App\Http\Controllers\CourseCommentController::class, 'likeComment'])->name('comments.like');
    Route::get('/courses/{course}/certificate', [CourseController::class, 'certificate'])->name('courses.certificate');

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::post('/courses/{course}/approve', [AdminDashboard::class, 'approve'])->name('courses.approve');
        Route::post('/courses/{course}/reject', [AdminDashboard::class, 'reject'])->name('courses.reject');
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });

    // Instructor Routes
    Route::middleware('role:instructor')->prefix('owner')->name('instructor.')->group(function () {
        Route::get('/dashboard', [InstructorDashboard::class, 'index'])->name('dashboard');
        Route::get('/courses', [CourseController::class, 'instructorIndex'])->name('courses.index');
        Route::resource('courses', CourseController::class)->except(['index', 'show']);

        // Curriculum management
        Route::post('/courses/{course}/chapters', [CourseController::class, 'addChapter'])->name('courses.chapters.store');
        Route::post('/chapters/{chapter}/sub-chapters', [CourseController::class, 'addSubChapter'])->name('chapters.sub-chapters.store');

        // Material editor
        Route::get('/sub-chapters/{subChapter}/material', [CourseController::class, 'editMaterial'])->name('sub-chapters.material.edit');
        Route::post('/sub-chapters/{subChapter}/material', [CourseController::class, 'updateMaterial'])->name('sub-chapters.material.update');

        // Quiz Builder
        Route::get('/sub-chapters/{subChapter}/quiz', [\App\Http\Controllers\Instructor\QuizController::class, 'edit'])->name('sub-chapters.quiz.edit');
        Route::post('/quizzes/{quiz}/questions', [\App\Http\Controllers\Instructor\QuizController::class, 'addQuestion'])->name('quizzes.questions.store');
        Route::delete('/questions/{question}', [\App\Http\Controllers\Instructor\QuizController::class, 'removeQuestion'])->name('questions.destroy');
        Route::post('/questions/{question}/choices', [\App\Http\Controllers\Instructor\QuizController::class, 'addChoice'])->name('questions.choices.store');
        Route::delete('/choices/{choice}', [\App\Http\Controllers\Instructor\QuizController::class, 'removeChoice'])->name('choices.destroy');

        // Student management
        Route::get('/students', [\App\Http\Controllers\Instructor\StudentController::class, 'index'])->name('students.index');
    });

    // Student Routes
    Route::middleware('role:student')->group(function () {
        Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('student.dashboard');

        Route::prefix('student')->name('student.')->group(function () {
            Route::get('/learning/{course_slug}/{subChapterId?}', [CourseController::class, 'learn'])->name('learning');
            Route::post('/learning/sub-chapter/{subChapter}/complete', [CourseController::class, 'markComplete'])->name('learning.complete');
            Route::post('/quizzes/{quiz}/submit', [\App\Http\Controllers\QuizAttemptController::class, 'submit'])->name('quizzes.submit');
        });
    });

    // Settings & Notifications (Available to all roles)
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\SettingsController::class, 'edit'])->name('edit');
        Route::put('/profile', [\App\Http\Controllers\SettingsController::class, 'update'])->name('profile.update');
        Route::put('/password', [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('password.update');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('read-all');
        Route::delete('/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('destroy');
    });
});

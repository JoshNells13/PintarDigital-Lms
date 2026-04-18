<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\ProgressRepositoryInterface;
use App\Models\Progress;

class EloquentProgressRepository implements ProgressRepositoryInterface
{
    public function getCompletedCount(int $userId, array $subChapterIds)
    {
        return Progress::where('user_id', $userId)
            ->whereIn('sub_chapter_id', $subChapterIds)
            ->where('is_completed', true)
            ->count();
    }

    public function markAsCompleted(int $userId, int $subChapterId)
    {
        return Progress::updateOrCreate(
            [
                'user_id' => $userId,
                'sub_chapter_id' => $subChapterId
            ],
            [
                'is_completed' => true,
                'completed_at' => now()
            ]
        );
    }

    public function isCompleted(int $userId, int $subChapterId)
    {
        return Progress::where('user_id', $userId)
            ->where('sub_chapter_id', $subChapterId)
            ->where('is_completed', true)
            ->exists();
    }
}

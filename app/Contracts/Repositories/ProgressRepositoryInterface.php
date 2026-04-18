<?php

namespace App\Contracts\Repositories;

interface ProgressRepositoryInterface
{
    public function getCompletedCount(int $userId, array $subChapterIds);
    public function markAsCompleted(int $userId, int $subChapterId);
    public function isCompleted(int $userId, int $subChapterId);
}

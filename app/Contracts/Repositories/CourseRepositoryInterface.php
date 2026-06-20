<?php

namespace App\Contracts\Repositories;

use App\Models\Course;

interface CourseRepositoryInterface
{
    public function getAllApproved($categorySlug = null);
    public function findBySlug($slug);
    public function findOrFail($id);
    public function getPendingApproval();
    public function countAll();
    public function countApproved();
    public function create(array $data);
    public function update(Course $course, array $data);
    public function delete(Course $course);
    public function addChapter(Course $course, array $data);
    public function addSubChapter(int $chapterId, array $data);
    public function updateMaterial(int $subChapterId, array $data);
}

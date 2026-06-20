<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['course_id', 'title', 'order'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subChapters()
    {
        return $this->hasMany(SubChapter::class)->orderBy('order');
    }

    public function getCompletedUsersCount()
    {
        $subChapterIds = $this->subChapters->pluck('id')->toArray();
        if (empty($subChapterIds)) return 0;
        
        return \App\Models\Progress::whereIn('sub_chapter_id', $subChapterIds)
            ->where('is_completed', true)
            ->select('user_id')
            ->groupBy('user_id')
            ->havingRaw('COUNT(DISTINCT sub_chapter_id) = ?', [count($subChapterIds)])
            ->get()
            ->count();
    }
}

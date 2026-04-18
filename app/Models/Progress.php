<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = ['user_id', 'sub_chapter_id', 'is_completed', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subChapter()
    {
        return $this->belongsTo(SubChapter::class);
    }
}

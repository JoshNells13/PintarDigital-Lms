<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubChapter extends Model
{
    protected $fillable = ['chapter_id', 'title', 'order'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}

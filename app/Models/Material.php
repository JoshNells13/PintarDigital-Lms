<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use League\CommonMark\CommonMarkConverter;

class Material extends Model
{
    protected $fillable = ['sub_chapter_id', 'title', 'content', 'type'];

    public function subChapter()
    {
        return $this->belongsTo(SubChapter::class);
    }

    public function getHtmlContentAttribute()
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convert($this->content);
    }
}

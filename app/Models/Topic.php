<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Article;

class Topic extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(
            Article::class,
            'article_topic',
            'topic_id',
            'article_id'
        )->withTimestamps();
    }
}

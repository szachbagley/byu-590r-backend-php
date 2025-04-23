<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Topic;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Relations\Relation;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'image_url',
        'link',
        'updated_at',
        'created_at',
    ];

    public function publication(): HasOne {
        return $this->hasOne(Publication::class, 'id', 'publication_id');
    }

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(
            Topic::class,
            'article_topic',
            'article_id',
            'topic_id'
        )->withTimestamps();
    }

    // public function topics(): HasMany {
    //     return $this->hasMany(Topic::class, 'id', 'topic_id');
    // }
}
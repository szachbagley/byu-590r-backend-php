<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'name',
        'link',
    ];

    public function articles()
    {
        return $this->belongsTo(Article::class);
    }
}

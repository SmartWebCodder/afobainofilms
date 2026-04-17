<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'category',
    'description',
    'cover_image',
    'gallery',
    'youtube_url',
    'tags',
    'is_featured',
    'is_published',
    'sort_order',
])]
class Project extends Model
{
    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'tags' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}

<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ArticleAuthor extends Model
{
    use Sluggable;

    protected $table = 'article_authors';

    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'image',
        'date_birth',
        'biography',
        'slug'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->second_name . ' ' . $this->last_name;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['first_name', 'second_name', 'last_name']
            ]
        ];
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder, $this->table);
    }
}

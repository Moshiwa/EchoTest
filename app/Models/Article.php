<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    use Sluggable;

    protected $table = 'articles';

    protected $fillable = [
        'name',
        'image',
        'announcement',
        'text',
        'slug',
    ];

    public function author()
    {
        return $this->hasOne(ArticleAuthor::class, 'id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'category_article', 'article_id', 'category_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder, $this->table);
    }
}

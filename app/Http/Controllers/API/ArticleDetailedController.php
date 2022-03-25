<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\Article\AuthorResource;
use App\Http\Resources\Article\CategoryResource;
use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;

class ArticleDetailedController extends Controller
{
    /**
     * @param $slug
     * @return ArticleResource
     */
    public function article($slug)
    {
        if (is_numeric($slug)) {
            $article = Article::query()->find($slug)->first();
        } else {
            $article = Article::query()->where('slug', $slug)->first();
        }

        return new ArticleResource($article);
    }

    /**
     * @param $slug
     * @return AuthorResource
     */
    public function author($slug)
    {
        if (is_numeric($slug)) {
            $author = ArticleAuthor::query()->find($slug)->first();
        } else {
            $author = ArticleAuthor::query()->where('slug', $slug)->first();
        }

        return new AuthorResource($author);
    }

    /**
     * @param $slug
     * @return CategoryResource
     */
    public function category($slug)
    {
        if (is_numeric($slug)) {
            $category = ArticleCategory::query()->find($slug)->first();
        } else {
            $category = ArticleCategory::query()->where('slug', $slug)->first();
        }

        return new CategoryResource($category);
    }

}

<?php

namespace App\Http\Controllers\API;

use App\Filters\ArticleFilter;
use App\Filters\AuthorFilter;
use App\Filters\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\Article\AuthorResource;
use App\Http\Resources\Article\CategoryResource;
use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;

class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAuthorsList(AuthorFilter $filter)
    {
        $authors = ArticleAuthor::filter($filter)->paginate();

        return AuthorResource::collection($authors);
    }

    /**
     * @return AuthorResource
     */
    public function getAuthor()
    {
        $author = ArticleAuthor::query()
            ->where('last_name', request('last_name'))
            ->first();

        return new AuthorResource($author);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCategories(CategoryFilter $filter)
    {
        $categories = ArticleCategory::filter($filter)->paginate();

        return CategoryResource::collection($categories);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getArticles(ArticleFilter $filter)
    {
        $articles = Article::filter($filter)->paginate();

        return ArticleResource::collection($articles);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getArticleByName()
    {
        $articles = Article::query()
            ->where('name', request('name'))
            ->paginate();

        return ArticleResource::collection($articles);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getArticleByCategory()
    {
        $category = request('category');

        $articles = Article::query()->whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        })->paginate();

        return ArticleResource::collection($articles);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getArticleByAuthor()
    {
        $lastName = request('last_name');

        $articles = Article::query()->whereHas('author', function ($query) use ($lastName) {
            $query->where('last_name', $lastName);
        })->paginate();

        return ArticleResource::collection($articles);
    }
}

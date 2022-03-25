<?php

use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ArticleAuthor::class, 10000)->create();
        factory(ArticleCategory::class, 10000)->create();
        factory(Article::class, 10000)->create()->each(function ($article) {
            $articleId = $article->id;
            $categoryId = $article->category_id;

            \Illuminate\Support\Facades\DB::table('category_article')->insert([
                'article_id' => $articleId,
                'category_id' => $categoryId
            ]);
        });

    }
}

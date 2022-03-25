<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $author = ArticleAuthor::query()->select('id')->inRandomOrder()->first();
    $category = ArticleCategory::query()->select('id')->inRandomOrder()->first();

    return [
        'name' => $faker->title,
        'image' => $faker->imageUrl,
        'announcement' => $faker->text,
        'text' => $faker->text,
        'author_id' => $author,
        'category_id' => $category
    ];
});

$factory->define(ArticleCategory::class, function (Faker $faker) {
   return [
       'name' => $faker->title,
       'image' => $faker->imageUrl,
       'description' => $faker->text(),
   ];
});

$factory->define(ArticleAuthor::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'second_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'image' => $faker->imageUrl,
        'date_birth' => $faker->dateTimeBetween('-50 years', '-20 years'),
        'biography' => $faker->text,
    ];
});

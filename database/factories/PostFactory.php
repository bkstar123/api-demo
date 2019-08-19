<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'title' => $title,
        'slug' => str_slug($title, '-').'-'.time().'-'.mt_rand(0, 100),
        'published' => $faker->boolean(50),
        'content' => $faker->paragraph,
    ];
});

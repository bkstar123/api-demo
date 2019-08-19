<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::get('posts', 'PostController@getAllPosts')->name('posts.index')->middleware('client');
    Route::get('posts/{post}', 'PostController@getPost')->name('posts.show')->middleware('client');
    Route::get('posts/{post}/tags', 'PostController@getPostTags')->name('post.tags.index')->middleware('client');
    Route::get('posts/{post}/users', 'PostController@getPostOwner')->name('post.owner.show')->middleware('client');
    Route::post('posts', 'PostController@createPost')
            ->name('posts.create')
            ->middleware('auth:api')
            ->middleware('scope:create-post');
    Route::put('posts/{post}', 'PostController@updatePost')
            ->name('posts.update')
            ->middleware('auth:api')
            ->middleware('scope:update-post')
            ->middleware('mode.demo');
    Route::delete('posts/{post}', 'PostController@deletePost')
            ->name('posts.destroy')
            ->middleware('auth:api')
            ->middleware('mode.demo');

    Route::get('tags', 'TagController@getAllTags')->name('tages.index')->middleware('client');
    Route::get('tags/{tag}', 'TagController@getTag')->name('tags.show')->middleware('client');
    Route::get('tags/{tag}/posts', 'TagController@getTagPosts')->name('tag.posts.index')->middleware('client');
    Route::post('tags', 'TagController@createTag')
            ->name('tags.create')
            ->middleware('auth:api')
            ->middleware('scope:create-tag');
    Route::put('tags/{tag}', 'TagController@updateTag')
            ->name('tags.update')
            ->middleware('auth:api')
            ->middleware('scope:update-post')
            ->middleware('mode.demo');
    Route::delete('tags/{tag}', 'TagController@deleteTag')
            ->name('tags.destroy')
            ->middleware('auth:api')
            ->middleware('mode.demo');

    Route::get('users', 'UserController@getAllUsers')->name('users.index')->middleware('client');
    Route::get('users/{user}', 'UserController@getUser')->name('users.show')->middleware('client');
    Route::get('users/{user}/posts', 'UserController@getUserPosts')->name('user.posts.index')->middleware('client');
});

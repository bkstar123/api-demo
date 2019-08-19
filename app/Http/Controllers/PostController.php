<?php
/**
 * PostController API controller
 */
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Transformers\TagTransformer;
use App\Transformers\PostTransformer;
use Bkstar123\ApiBuddy\Http\Controllers\ApiController as Controller;

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('apibuddy.transform:'. PostTransformer::class)->only('createPost', 'updatePost');
    }

    public function getAllPosts()
    {
        return $this->apiResponser->showCollection(Post::getQuery(), PostResource::class, PostTransformer::class);
    }

    public function getPost(Post $post)
    {
        if (empty($post)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        return $this->apiResponser->showInstance($post, PostResource::class);
    }

    public function getPostTags(Post $post)
    {
        if (empty($post)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        return $this->apiResponser->showCollection($post->tags()->getQuery(), TagResource::class, TagTransformer::class);
    }

    public function getPostOwner(Post $post)
    {
        if (empty($post)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        return $this->apiResponser->showInstance($post->user()->first(), UserResource::class);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:255',
        ]);

        $postData = request()->all();
        $postData['user_id'] = $request->user()->id;
        $postData['slug'] = str_slug($postData['title'], '-').'-'.time().'-'.mt_rand(0, 100);
        $post = Post::create($postData);
        return $this->apiResponser->showInstance($post->fresh(), PostResource::class, 201);
    }

    public function updatePost(Request $request, Post $post)
    {
        if (empty($post)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        $request->validate([
            'title' => 'min:5|max:255',
            'content' => 'min:5|max:255',
        ]);
        if (empty($request->title) && empty($request->content)) {
            return $this->apiResponser->successResponse('Nothing to change', 200);
        }
        if ($post->update($request->all())) {
            return $this->apiResponser->showInstance($post->fresh(), PostResource::class, 200);
        } else {
            return $this->apiResponser->errorResponse('Unknown error occurred');
        }
    }

    public function deletePost(Request $request, Post $post)
    {
        if (empty($post)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        if ($request->user()->tokenCan('delete-post')) {
            $post->tags()->detach();
            if ($post->delete()) {
                return $this->apiResponser->successResponse('The resource of the given identificator has been permanently destroyed', 200);
            }
            return $this->apiResponser->errorResponse('Unknown error occurred');
        }
        return $this->apiResponser->errorResponse('Unauthorized to destroy the given post', 403);
    }
}

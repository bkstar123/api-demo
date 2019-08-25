<?php
/**
 * UserController API controller
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Transformers\PostTransformer;
use App\Transformers\UserTransformer;
use Bkstar123\ApiBuddy\Http\Controllers\ApiController as Controller;

class UserController extends Controller
{
    public function getAllUsers()
    {
        return $this->apiResponser->showCollection(User::query(), UserResource::class, UserTransformer::class);
    }

    public function getUser(User $user)
    {
        if (empty($user)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        return $this->apiResponser->showInstance($user, UserResource::class, UserTransformer::class);
    }

    public function getUserPosts(User $user)
    {
        if (empty($user)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        return $this->apiResponser->showCollection($user->posts()->getQuery(), PostResource::class, PostTransformer::class);
    }
}

<?php
/**
 * TagController API controller
 */
namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Resources\PostResource;
use App\Transformers\TagTransformer;
use App\Transformers\PostTransformer;
use Bkstar123\ApiBuddy\Http\Controllers\ApiController as Controller;

class TagController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('apibuddy.transform:'. TagTransformer::class)->only('createTag', 'updateTag');
    }

    public function getAllTags()
    {
        return $this->apiResponser->showCollection(Tag::query(), TagResource::class, TagTransformer::class);
    }

    public function getTag(Tag $tag)
    {
        if (empty($tag)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        return $this->apiResponser->showInstance($tag, TagResource::class, TagTransformer::class);
    }

    public function getTagPosts(Tag $tag)
    {
        if (empty($tag)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        return $this->apiResponser->showCollection($tag->posts()->getQuery(), PostResource::class, PostTransformer::class);
    }

    public function createTag(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
        ]);

        $tagData = request()->all();
        $tagData['slug'] = str_slug($tagData['name'], '-').'-'.time().'-'.mt_rand(0, 100);
        $tag = Tag::create($tagData);
        return $this->apiResponser->showInstance($tag->fresh(), TagResource::class, TagTransformer::class, 201);
    }

    public function updateTag(Request $request, Tag $tag)
    {
        if (empty($tag)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        $request->validate([
            'name' => 'min:5|max:255',
            'description' => 'min:5|max:255',
        ]);
        if (empty($request->name) && empty($request->description)) {
            return $this->apiResponser->successResponse('Nothing to change', 200);
        }
        if ($tag->update($request->all())) {
            return $this->apiResponser->showInstance($tag->fresh(), TagResource::class, TagTransformer::class, 200);
        } else {
            return $this->apiResponser->errorResponse('Unknown error occurred');
        }
    }

    public function deleteTag(Request $request, Tag $tag)
    {
        if (empty($tag)) {
            return $this->apiResponser->errorResponse('There is no resource of the given identificator', 404);
        }
        if ($request->user()->tokenCan('delete-tag')) {
            $tag->posts()->detach();
            if ($tag->delete()) {
                return $this->apiResponser->successResponse('The resource of the given identificator has been permanently destroyed', 200);
            }
            return $this->apiResponser->errorResponse('Unknown error occurred');
        }
        return $this->apiResponser->errorResponse('Unauthorized to destroy the given tag', 403);
    }
}

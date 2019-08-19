<?php
/**
 * PostResource resource
 */
namespace App\Http\Resources;

use Bkstar123\ApiBuddy\Http\Resources\AppResource;

class PostResource extends AppResource
{
    /**
     * Specify the resource mapping
     *
     * @return array
     */
    protected function resourceMapping()
    {
        return [
            'title' => $this->title,
            'body' => $this->content,
            'postSlug' => $this->slug,
            'visible' => $this->published,
            'created' => (string) $this->created_at,
            'updated' => (string) $this->updated_at,
        ];
    }

    protected function afterFilter($mapping)
    {
        if (!empty($this->slug)) {
            $mapping = array_merge($mapping, [
                'links' => [
                    [
                        'rel' => 'self',
                        'href' => route('posts.show', $this->slug),
                    ],
                    [
                        'rel' => 'tags',
                        'href' => route('post.tags.index', $this->slug),
                    ],
                    [
                        'rel' => 'owner',
                        'href' => route('post.owner.show', $this->slug),
                    ],
                ],
            ]);
        }

        return $mapping;
    }
}

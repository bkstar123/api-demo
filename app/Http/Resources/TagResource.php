<?php
/**
 * TagResource resource
 */
namespace App\Http\Resources;

use Bkstar123\ApiBuddy\Http\Resources\AppResource;

class TagResource extends AppResource
{
    /**
     * Specify the resource mapping
     *
     * @return array
     */
    protected function resourceMapping()
    {
        return [
            'tag' => $this->name,
            'description' => $this->description,
            'tagSlug' => $this->slug,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }

    protected function afterFilter($mapping)
    {
        if (!empty($this->slug)) {
            $mapping = array_merge($mapping, [
                'links' => [
                    [
                        'rel' => 'self',
                        'href' => route('tags.show', $this->slug),
                    ],
                    [
                        'rel' => 'posts',
                        'href' => route('tag.posts.index', $this->slug),
                    ],
                ],
            ]);
        }

        return $mapping;
    }
}

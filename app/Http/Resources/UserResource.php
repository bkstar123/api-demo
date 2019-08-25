<?php
/**
 * UserResource resource
 */
namespace App\Http\Resources;

use Bkstar123\ApiBuddy\Http\Resources\AppResource;

class UserResource extends AppResource
{
    /**
     * Specify the resource mapping
     *
     * @return array
     */
    protected function resourceMapping()
    {
        return [
            'user' => $this->name,
            'mailaddress' => $this->email,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }

    protected function afterFilter($mapping)
    {
        if (!empty($this->email)) {
            $mapping = array_merge($mapping, [
                'links' => [
                    [
                        'rel' => 'self',
                        'href' => route('users.show', $this->email),
                    ],
                    [
                        'rel' => 'posts',
                        'href' => route('user.posts.index', $this->email),
                    ],
                ],
            ]);
        }

        return $mapping;
    }
}

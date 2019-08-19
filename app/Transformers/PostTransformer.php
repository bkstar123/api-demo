<?php
/**
 * PostTransformer transformer
 */
namespace App\Transformers;

use Bkstar123\ApiBuddy\Transformers\AppTransformer;

class PostTransformer extends AppTransformer
{
    /**
     * Transformed keys -> Original keys mapping
     *
     * @var array
     */
    protected static $transformedKeys = [
        'title' => 'title',
        'body' => 'content',
        'postSlug' => 'slug',
        'visible' => 'published',
        'created' => 'created_at',
        'updated' => 'updated_at',
        'owner' => 'user_id',
    ];
}

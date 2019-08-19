<?php
/**
 * TagTransformer transformer
 */
namespace App\Transformers;

use Bkstar123\ApiBuddy\Transformers\AppTransformer;

class TagTransformer extends AppTransformer
{
    /**
     * Transformed keys -> Original keys mapping
     *
     * @var array
     */
    protected static $transformedKeys = [
        'tag' => 'name',
        'description' => 'description',
        'tagSlug' => 'slug',
        'created' => 'created_at',
        'updated' => 'updated_at'
    ];
}

<?php
/**
 * UserTransformer transformer
 */
namespace App\Transformers;

use Bkstar123\ApiBuddy\Transformers\AppTransformer;

class UserTransformer extends AppTransformer
{
    /**
     * Transformed keys -> Original keys mapping
     *
     * @var array
     */
    protected static $transformedKeys = [
        'user' => 'name',
        'mailaddress' => 'email',
        'password' => 'password',
        'created' => 'created_at',
        'updated' => 'updated_at'
    ];
}

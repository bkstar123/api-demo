<?php
/**
 * bkstar123_apibuddy config
 *
 * @author: tuanha
 * @last-mod: 11-July-2019
 */

return [
    // max per_page that user can specify
    'max_per_page' => env('API_BUDDY_MAX_PER_PAGE', 1000),

    // default per_page if not specified
    'default_per_page' => env('API_BUDDY_DEFAULT_PER_PAGE', 10),

    // Use package exception handler (recommended)
    'replace_exceptionhandler' => true,

    /**
     * Use transformation (highly recommended for the best security protection)
     * Since PDO does not support binding column names, See https://laravel.com/docs/5.8/queries
     * Always use transformation whenever you allow user input to dictate the column names referenced by your queries
     */
    'useTransform' => true,
];

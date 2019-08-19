<?php

namespace App\Http\Middleware;

use Closure;
use Bkstar123\ApiBuddy\Contracts\ApiResponsible;

class CheckForDemoMode
{
    /**
     * @var \Bkstar123\ApiBuddy\Contracts\ApiResponsible
     */
    protected $apiResponser;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->apiResponser = app(ApiResponsible::class);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('DEMO_MODE', true)) {
            return $this->apiResponser->errorResponse("This action is not allowed in the demo mode", 403);
        }
        return $next($request);
    }
}

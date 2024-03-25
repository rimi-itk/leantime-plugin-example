<?php

namespace Leantime\Plugins\Example\Middleware;

use Closure;
use Leantime\Core\IncomingRequest;
use Leantime\Plugins\Example\Services\Example;
use Symfony\Component\HttpFoundation\Response;

/**
 * Install middleware.
 */
final class Install
{
    /**
     * Constructor.
     */
    public function __construct(
        private readonly Example $service,
    ) {
    }

    /**
     * Install the custom fields plugin DB if necessary.
     *
     * @return Response
     **/
    public function handle(IncomingRequest $request, Closure $next): Response
    {
        if (! $this->service->install()) {
            throw new \LogicException('Failed to install the example plugin.');
        }

        return $next($request);
    }
}

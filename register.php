<?php

/**
 * WARNING: Bootstraps the plugin. Don't remove.
 */

namespace Leantime\Plugins\Example;

use Leantime\Core\Events;
use Leantime\Plugins\Example\Middleware\GetLanguageAssets;
use Leantime\Plugins\Example\Middleware\Install;

if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    throw new \RuntimeException(sprintf('Please run "composer install" in the %s directory.', __DIR__));
}

require $composer;

Events::add_filter_listener(
    'leantime.core.httpkernel.handle.plugins_middleware',
    static fn (array $middleware) => array_merge($middleware, [Install::class, GetLanguageAssets::class]),
);

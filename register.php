<?php

/**
 * WARNING: Bootstraps the plugin. Don't remove.
 */

namespace Leantime\Plugins\Example;

use Illuminate\Support\Str;
use Leantime\Core\Events;
use Leantime\Domain\Api\Contracts\StaticAssetType;
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

Events::add_filter_listener(
    'leantime.core.support.mix.__construct.mix_manifest_directories',
    static fn (array $directories) => array_merge($directories, [__DIR__ . '/dist'])
);

Events::add_event_listener(
    'leantime.core.template.tpl.*.afterLinkTags',
    static fn () => collect(mix()->getManifest()[__DIR__ . '/dist'])
        ->filter(function ($file) {
            $constant = Str::of(pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION))
                ->upper()
                ->prepend(StaticAssetType::class . '::');

            if (
                ! defined($constant)
                || constant($constant) !== StaticAssetType::CSS
            ) {
                return false;
            }

            return true;
        })
        ->each(fn ($file) => printf('<link rel="stylesheet" href="%s" />%s', $file, PHP_EOL))
);

Events::add_event_listener(
    'leantime.core.template.tpl.*.beforeBodyClose',
    static fn () => collect(mix()->getManifest()[__DIR__ . '/dist'])
        ->filter(function ($file) {
            $constant = Str::of(pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION))
                ->upper()
                ->prepend(StaticAssetType::class . '::');

            if (
                ! defined($constant)
                || constant($constant) !== StaticAssetType::JS
            ) {
                return false;
            }

            return true;
        })
        ->each(fn ($file) => printf('<script src="%s"></script>%s', $file, PHP_EOL))
);

Events::add_event_listener(
    'leantime.domain.menu.repositories.menu.getMenuStructure.menuStructures.default',
    function (array $context) {
        if (($_SESSION['userdata']['id']) && 'timesheets.showAll' === ($context['current_route'] ?? null)) {
            echo '<script src="/dist/js/plugin-Dataexport.js"></script>';
        }
    },
    5
);

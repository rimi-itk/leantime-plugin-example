<?php

namespace Leantime\Plugins\Example\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Leantime\Core\Environment;
use Leantime\Core\IncomingRequest;
use Symfony\Component\HttpFoundation\Response;
use Leantime\Core\Language;

/**
 * Get language assets middleware.
 */
final class GetLanguageAssets
{
    /**
     * Constructor.
     */
    public function __construct(
        private Language $language,
        private Environment $config,
    ) {
    }

    /**
     * Load translations if necessary.
     *
     * @return Response
     */
    public function handle(IncomingRequest $request, Closure $next): Response
    {
        $cacheKey = 'example.languageArray';
        $languageArray = Cache::get($cacheKey, []);

        if (!empty($languageArray)) {
            $this->language->ini_array = array_merge($this->language->ini_array, $languageArray);
            return $next($request);
        }

        $store = Cache::store('installation');
        if (!$store->has('example.language.en-US')) {
            $languageArray += parse_ini_file(__DIR__ . '/../Language/en-US.ini', true);
        }

        if (($language = $_SESSION['usersettings.language'] ?? $this->config->language) !== 'en-US') {
            $languageCacheKey = 'example.language.' . $language;
            $iniFilename = __DIR__ . '/../Language/' . $language . '.ini';
            if (file_exists($iniFilename)) {
                if (!$store->has($languageCacheKey)) {
                    $store->put($languageCacheKey, parse_ini_file($iniFilename, true));
                }
            }

            $languageArray = array_merge($languageArray, $store->get($languageCacheKey) ?: []);
        }

        Cache::put($cacheKey, $languageArray);

        $this->language->ini_array = array_merge($this->language->ini_array, $languageArray);

        return $next($request);
    }
}

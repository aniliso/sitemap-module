<?php

namespace Modules\Sitemap\Http\Controllers;

use Illuminate\Routing\Controller;
use Roumen\Sitemap\Sitemap;

class BaseSitemapController extends Controller
{
    /**
     * @var Sitemap
     */
    protected $sitemap;
    protected $sitemapCachePeriod = 3600;
    protected $defaultLocale;
    protected $cacheKey;

    public function __construct()
    {
        $this->sitemap = app(Sitemap::class);
        $this->cacheKey = config('APP_NAME').'.sitemap.'.$this->getModuleName();
        $this->sitemap->setCache($this->cacheKey, $this->sitemapCachePeriod);
    }

    private function getModuleName()
    {
        $class = static::class;
        if(strpos($class, "\\")) {
            $class = explode("\\", $class);
            $class = array_first(array_slice($class, 1, 1));
            if(\Module::active($class)) {
                return $class;
            }
        }
        return $class;
    }
}

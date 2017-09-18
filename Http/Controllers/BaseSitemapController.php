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

    public function __construct()
    {
        $this->sitemap = app(Sitemap::class);
        $module = $this->getModuleName();
        $this->sitemap->setCache($module, $this->sitemapCachePeriod);
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

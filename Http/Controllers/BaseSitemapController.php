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
        $this->sitemap->setCache('laravel.sitemap.index', $this->sitemapCachePeriod);
    }
}

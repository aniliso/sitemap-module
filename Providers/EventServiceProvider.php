<?php

namespace Modules\Sitemap\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Sitemap\Events\Handlers\PingGoogleSitemap;
use Modules\Sitemap\Events\Handlers\SitemapCacheClear;
use Modules\Page\Events\PageWasCreated;
use Modules\Page\Events\PageWasDeleted;
use Modules\Page\Events\PageWasUpdated;
use Modules\Blog\Events\PostWasCreated as BlogWasCreated;
use Modules\Blog\Events\PostWasDeleted as BlogWasDeleted;
use Modules\Blog\Events\PostWasUpdated as BlogWasUpdated;
use Modules\News\Events\PostWasCreated as NewsWasCreated;
use Modules\News\Events\PostWasUpdated as NewsWasUpdated;
use Modules\News\Events\PostWasDeleted as NewsWasDeleted;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PageWasCreated::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        PageWasUpdated::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        PageWasDeleted::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        BlogWasCreated::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        BlogWasUpdated::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        BlogWasDeleted::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        NewsWasCreated::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        NewsWasUpdated::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ],
        NewsWasDeleted::class => [
            SitemapCacheClear::class,
            PingGoogleSitemap::class
        ]
    ];
}

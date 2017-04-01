<?php namespace Modules\Sitemap\Composers;

use Illuminate\Contracts\View\View;
use Modules\Sitemap\Entities\Helpers\SitemapPriority;

class SitemapPriorityComposer
{
    private $priority;

    public function __construct(SitemapPriority $priority)
    {
        $this->priority = $priority;
    }

    public function compose(View $view)
    {
        return $view->with('sitemapPriorities', $this->priority->lists());
    }
}
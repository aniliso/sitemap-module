<?php namespace Modules\Sitemap\Composers;

use Illuminate\Contracts\View\View;
use Modules\Sitemap\Entities\Helpers\SitemapFrequency;

class SitemapFrequencyComposer
{
    private $frequency;

    public function __construct(SitemapFrequency $frequency)
    {
        $this->frequency = $frequency;
    }

    public function compose(View $view)
    {
        return $view->with('sitemapFrequencies', $this->frequency->lists());
    }
}
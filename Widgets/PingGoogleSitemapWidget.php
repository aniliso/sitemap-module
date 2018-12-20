<?php namespace Modules\Sitemap\Widgets;

use Modules\Dashboard\Foundation\Widgets\BaseWidget;

class PingGoogleSitemapWidget extends BaseWidget
{
    protected function name()
    {
        return "PingGoogleSitemapWidget";
    }

    protected function options()
    {
        return [
            'width' => '2',
            'height' => '2',
            'x' => '8'
        ];
    }

    protected function view()
    {
        return "sitemap::admin.widgets.ping-sitemap";
    }

    protected function data()
    {
        // TODO: Implement data() method.
    }

}
<?php

namespace Modules\Sitemap\Events\Handlers;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SitemapCacheClear implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {

    }

    public function handle($event)
    {
        try {
            $class = $this->getModuleName($event);
            \Cache::forget(config('app.name').'.sitemap.'.$class);
        }
        catch (\Exception $exception) {
            \Cache::flush();
        }
    }

    private function getModuleName($class)
    {
        $class = get_class($class);
        if(strpos($class, "\\")) {
            $class = explode("\\", $class);
            $class = array_first(array_slice($class, 1, 1));
            if(\Module::active($class)) {
                return $class;
            }
        }
        throw new \Exception('Cache not found');
    }
}

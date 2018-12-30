<?php namespace Modules\Sitemap\Providers;

use Illuminate\Routing\Router;
use Modules\Core\Providers\RoutingServiceProvider as CoreRoutingServiceProvider;
use File;

abstract class SitemapRouteServiceProvider extends CoreRoutingServiceProvider
{
    public function map(Router $router)
    {
        $modules = app('modules');
        $router->group(['namespace' => $this->namespace], function (Router $router) use ($modules) {
            require $this->getFrontendRoute();
            $defaultLocale = config('app.locale');
            $prefix        = config('laravellocalization.hideDefaultLocaleInURL') === true ? '' : $defaultLocale;
            foreach ($modules->getOrdered('asc') as $module) {
                if($modules->active($module->getName())) {
                    $sitemapPath = $module->getPath().'/Http/Controllers/SitemapController.php';
                    if(File::exists($sitemapPath)) {
                        $router->group(['prefix'=>$prefix, 'middleware'=>['web']], function(Router $router) use ($module) {
                            $router->get(strtolower($module->getName()).'/sitemap.xml',[
                                'uses' => "\Modules\\{$module->getName()}\\Http\Controllers\SitemapController@index",
                                'as' => strtolower($module->getName()).'.sitemap'
                            ]);
                        });
                    }

                }
            }

        });
    }
}
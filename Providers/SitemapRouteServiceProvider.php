<?php namespace Modules\Sitemap\Providers;

use Illuminate\Routing\Router;
use Modules\Core\Providers\RoutingServiceProvider as CoreRoutingServiceProvider;

abstract class SitemapRouteServiceProvider extends CoreRoutingServiceProvider
{
    public function map(Router $router)
    {
        $modules = $this->app['modules']->getOrdered('asc');
        $defaultLocale = array_first(array_keys(\LaravelLocalization::getSupportedLocales()));
        $router->group(['namespace' => $this->namespace], function (Router $router) use ($modules, $defaultLocale) {
            require $this->getFrontendRoute();
            foreach ($modules as $module) {
                if(\Module::active($module->getName())) {
                    $sitemapPath = $module->getPath().'/Http/Controllers/SitemapController.php';
                    if(\File::exists($sitemapPath)) {
                        $router->group(['prefix'=>$defaultLocale, 'middleware'=>['web']], function(Router $router) use ($module) {
                            $router->get(strtolower($module->getName()).'/sitemap.xml',[
                                'uses' => '\Modules\\'.$module->getName().'\\Http\Controllers\SitemapController@index',
                                'as' => strtolower($module->getName()).'.sitemap'
                            ]);
                        });
                    }
                }
            }
        });
    }
}
<?php

namespace Modules\Sitemap\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Module;
use Robots;

class PublicController extends BaseSitemapController
{
    /**
     * @var Module
     */
    private $module;

    public function __construct()
    {
        parent::__construct();
        $this->module = app('modules');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sitemap = $this->sitemap;
        foreach ($this->module->getOrdered('desc') as $module) {
            if(Module::active($module->getName())){
                $sitemapPath = $module->getPath().'/Http/Controllers/SitemapController.php';
                if(\File::exists($sitemapPath)) {
                    switch ($module->getName())
                    {
                        case 'Faq':
                            $faq = app('Modules\Faq\Repositories\FaqRepository')->all()->sortBy('updated_at')->first();
                            $updated_at = isset($faq->updated_at) ? $faq->updated_at : Carbon::now();
                            break;
                        case 'Employee':
                            $employee = app('Modules\Employee\Repositories\EmployeeRepository')->all()->sortBy('updated_at')->first();
                            $updated_at = isset($employee->updated_at) ? $employee->updated_at : Carbon::now();
                            break;
                        case 'Store':
                            $product = app('Modules\Store\Repositories\ProductRepository')->all()->sortBy('updated_at')->first();
                            $updated_at = isset($product->updated_at) ? $product->updated_at : Carbon::now();
                            break;
                        case 'Page':
                            $page = app('Modules\Page\Repositories\PageRepository')->all()->sortBy('updated_at')->first();
                            $updated_at = isset($page->updated_at) ? $page->updated_at : Carbon::now();
                            break;
                        case 'Blog':
                            $blog = app('Modules\Blog\Repositories\PostRepository')->latest(1)->first();
                            $updated_at = isset($blog->updated_at) ? $blog->updated_at : Carbon::now();
                            break;
                        case 'News':
                            $news = app('Modules\News\Repositories\PostRepository')->latest(1)->first();
                            $updated_at = isset($news->updated_at) ? $news->updated_at : Carbon::now();
                            break;
                        default:
                            $updated_at = \Carbon\Carbon::now();
                    }
                    $sitemap->addSitemap(route(strtolower($module->getName()).'.sitemap'), $updated_at);
                }
            }
        }
        return $sitemap->render('sitemapindex');
    }

    public function robots()
    {
        if (app()->environment() == 'production') {
            // If on the live server, serve a nice, welcoming robots.txt.
            Robots::addUserAgent('*');
            Robots::addSitemap(url('sitemap.xml'));
        } else {
            // If you're on any other server, tell everyone to go away.
            Robots::addDisallow('*');
        }
        return response()->make(Robots::generate(), 200, ['Content-Type' => 'text/plain']);
    }

    public function pingSitemap()
    {
        try
        {
            $client = new \GuzzleHttp\Client();
            $url = 'https://www.google.com/webmasters/sitemaps/ping?sitemap='.route('sitemap.index');

            $response = $client->request('GET', $url);

            if($response->getStatusCode() != 200) {
                throw new \Exception('Sitemap not ping');
            }
            return \response()->json([
                'success' => true
            ]);
        }
        catch (\Exception $exception)
        {
            return \response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}

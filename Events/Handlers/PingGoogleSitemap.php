<?php

namespace Modules\Sitemap\Events\Handlers;

use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PingGoogleSitemap implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var Client
     */
    private $client;
    private $url = 'https://www.google.com/webmasters/sitemaps/ping?sitemap=';

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = $this->url . route('sitemap.index');
    }

    public function handle($event)
    {
        try {
            $this->client->request($this->url);
        }
        catch (\Exception $exception) {
            \Log::alert('Sitemap not updated');
        }
    }
}

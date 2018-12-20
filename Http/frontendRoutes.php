<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => ''], function (Router $router) {
    $router->get('sitemap.xml', [
        'uses' => 'PublicController@index',
        'as'   => 'sitemap.index'
    ]);
    $router->get('ping-sitemap',[
        'uses' => 'PublicController@pingSitemap',
        'as'   => 'sitemap.ping'
    ]);
    $router->get('robots.txt', [
        'uses' => 'PublicController@robots',
        'as'   => 'sitemap.robots'
    ]);
});
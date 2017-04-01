<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => ''], function (Router $router) {
    $router->get('sitemap.xml', [
        'uses' => 'PublicController@index',
        'as'   => 'sitemap.index'
    ]);
    $router->get('robots.txt', [
        'uses' => 'PublicController@robots',
        'as'   => 'robots'
    ]);
});
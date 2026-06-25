<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->resource('post', ['except' => ['create', 'update', 'delete']]);
$routes->post('post', 'Post::create', ['filter' => 'apiauth']);
$routes->put('post/(:segment)', 'Post::update/$1', ['filter' => 'apiauth']);
$routes->delete('post/(:segment)', 'Post::delete/$1', ['filter' => 'apiauth']);
$routes->post('api/login', 'Api\Auth::login');
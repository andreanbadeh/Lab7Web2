<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman utama
$routes->get('/', 'Home::index');

// Halaman lain
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/tos', 'Page::tos');

// Artikel publik
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:segment)', 'Artikel::view/$1');


// ==========================
// 🔥 ADMIN (PAKAI AUTH FILTER)
// ==========================
$routes->group('admin', ['filter' => 'auth'], function($routes) {

    $routes->get('artikel', 'Artikel::admin_index');

    $routes->get('artikel/add', 'Artikel::add');
    $routes->post('artikel/add', 'Artikel::add');

    $routes->get('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->post('artikel/edit/(:num)', 'Artikel::edit/$1');

    $routes->get('artikel/delete/(:num)', 'Artikel::delete/$1');
});


// ==========================
// 🔥 USER LOGIN
// ==========================
$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');

$routes->get('/user', 'User::index');

// 🔥 LOGOUT
$routes->get('/user/logout', 'User::logout');


// ==========================
// 🔥 API LOGIN VUEJS
// ==========================
$routes->options('api/login', 'Api\Auth::options');
$routes->post('api/login', 'Api\Auth::login');


// ==========================
// 🔥 TEST API
// ==========================
$routes->get('api/test', function () {
    return 'API OK';
});


// ==========================
// 🔥 REST API ARTIKEL + TOKEN SECURITY
// ==========================

// Preflight CORS
$routes->options('post', 'Post::options');
$routes->options('post/(:num)', 'Post::options');

// GET boleh tanpa token
$routes->get('post', 'Post::index');
$routes->get('post/(:num)', 'Post::show/$1');

// POST, PUT, DELETE wajib token
$routes->post('post', 'Post::create', ['filter' => 'apiauth']);
$routes->put('post/(:num)', 'Post::update/$1', ['filter' => 'apiauth']);
$routes->delete('post/(:num)', 'Post::delete/$1', ['filter' => 'apiauth']);
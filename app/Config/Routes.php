<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'HomeController::index');
$routes->get('/home', 'HomeController::index');

// Auth
$routes->get('/login', 'AuthController::login');
$routes->post('/do-login', 'AuthController::doLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/do-register', 'AuthController::doRegister');
$routes->get('/forgot-password', 'AuthController::forgotPassword');
$routes->get('/logout', 'AuthController::logout');

// User Profile
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/profile', 'ProfileController::index');
    $routes->post('/profile/update', 'ProfileController::update');
    $routes->post('/profile/change-password', 'ProfileController::changePassword');
    $routes->post('/profile/upload-photo', 'ProfileController::uploadPhoto');

    // Cart
    $routes->get('/cart', 'CartController::index');
    $routes->get('/cart/count', 'CartController::count');
    $routes->post('/cart/add/(:num)', 'CartController::add/$1');
    $routes->post('/cart/update', 'CartController::update');
    
    // Checkout/Order
    $routes->get('/checkout', 'CartController::order');
    $routes->post('/checkout/process', 'CartController::processOrder');
    $routes->get('/orders', 'CartController::orders');
    $routes->get('/orders/(:num)', 'CartController::orderDetail/$1');
   
});

// User Profile (jika perlu)
$routes->get('/profile', 'ProfileController::index', ['filter' => 'auth']);

// Frontend
$routes->get('/products', 'ProductController::index');
$routes->get('/products/(:num)', 'ProductController::show/$1');
$routes->get('/categories/(:any)', 'CategoryController::show/$1');
$routes->get('/articles', 'ArticleController::index');
$routes->get('/articles/(:any)', 'ArticleController::show/$1');
$routes->get('/cart', 'CartController::index', ['filter' => 'auth']);
$routes->post('/cart/add/(:num)', 'CartController::add/$1', ['filter' => 'auth']);
$routes->post('/cart/update', 'CartController::update', ['filter' => 'auth']);
$routes->get('/about', 'PageController::about');
$routes->get('/contact', 'PageController::contact');
$routes->post('/contact/send', 'PageController::sendContact');

// Order routes
$routes->post('/checkout/process', 'CartController::processOrder', ['filter' => 'auth']);
$routes->get('/orders', 'CartController::orders', ['filter' => 'auth']);
$routes->get('/orders/(:num)', 'CartController::orderDetail/$1', ['filter' => 'auth']);

// Admin Group 
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    
    // Products
    $routes->get('products', 'Admin\ProductController::index');
    $routes->get('products/create', 'Admin\ProductController::create');
    $routes->post('products/store', 'Admin\ProductController::store');
    $routes->get('products/(:num)', 'Admin\ProductController::show/$1');
    $routes->get('products/edit/(:num)', 'Admin\ProductController::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\ProductController::update/$1');
    $routes->delete('products/(:num)', 'Admin\ProductController::destroy/$1');
    
    // Categories
    $routes->get('categories', 'Admin\CategoryController::index');
    $routes->post('categories/store', 'Admin\CategoryController::store');
    $routes->put('categories/(:num)', 'Admin\CategoryController::update/$1');
    $routes->delete('categories/(:num)', 'Admin\CategoryController::destroy/$1');
    
    // Orders
    $routes->get('orders', 'Admin\OrderController::index');
    $routes->get('orders/(:num)', 'Admin\OrderController::show/$1');
    $routes->post('orders/status/(:num)', 'Admin\OrderController::updateStatus/$1');
    $routes->get('orders/invoice/(:num)', 'Admin\OrderController::invoice/$1');
    $routes->delete('orders/(:num)', 'Admin\OrderController::destroy/$1');
    
    // Export Orders
    $routes->get('orders/export/pdf', 'Admin\OrderController::exportPdf');
    $routes->get('orders/export/excel', 'Admin\OrderController::exportExcel');
    
    // Reports
    $routes->get('reports', 'Admin\ReportController::index');
    $routes->get('reports/export/pdf', 'Admin\ReportController::exportPdf');
    $routes->get('reports/export/excel', 'Admin\ReportController::exportExcel');
    $routes->get('reports/chart-data', 'Admin\ReportController::chartData');

     $routes->get('users', 'Admin\UserController::index');
    $routes->get('users/(:num)', 'Admin\UserController::show/$1');
    $routes->post('users/update-role/(:num)', 'Admin\UserController::updateRole/$1');
    $routes->delete('users/(:num)', 'Admin\UserController::destroy/$1');
    
    $routes->get('articles', 'Admin\ArticleController::index');
    $routes->get('articles/create', 'Admin\ArticleController::create');
    $routes->post('articles/store', 'Admin\ArticleController::store');
    $routes->get('articles/edit/(:num)', 'Admin\ArticleController::edit/$1');
    $routes->post('articles/update/(:num)', 'Admin\ArticleController::update/$1');
    $routes->delete('articles/(:num)', 'Admin\ArticleController::destroy/$1');
    
    $routes->get('settings', 'Admin\SettingController::index');
    $routes->post('settings/update', 'Admin\SettingController::update');
    
    $routes->get('menu', 'Admin\MenuController::index');
    $routes->post('menu/store', 'Admin\MenuController::store');
    $routes->post('menu/update/(:num)', 'Admin\MenuController::update/$1');
    $routes->delete('menu/(:num)', 'Admin\MenuController::destroy/$1');
    
    $routes->get('banner', 'Admin\BannerController::index');
    $routes->post('banner/store', 'Admin\BannerController::store');
    $routes->delete('banner/(:num)', 'Admin\BannerController::destroy/$1');
});

// Catch-all (404)
$routes->set404Override(function() {
    return view('errors/html/error_404');
});
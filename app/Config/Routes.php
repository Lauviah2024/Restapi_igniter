<?php
use App\Controllers\User;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection
 */
// $routes->get('/', 'Home::index');
$routes->resource('blog');
$routes->post('/user/login', 'User::login');
$routes->post('/user/register', 'User::register');
// $routes->get('get/users', 'User::getUser')

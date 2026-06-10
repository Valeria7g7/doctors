<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->group('doctor', function($routes){
    $routes->get('search', 'DoctorController::index');
    $routes->get('create', 'DoctorController::create');
    $routes->get('edit/(:num)', 'DoctorController::edit/$1');

    $routes->post('', 'DoctorController::store');
  $routes->post('update/(:num)', 'DoctorController::update/$1');
    $routes->delete('(:num)', 'DoctorController::delete/$1');
});

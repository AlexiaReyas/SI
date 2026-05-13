<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::login');

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attempt');
$routes->get('logout', 'AuthController::logout');

$routes->get('register-step1', 'RegisterController::step1');
$routes->post('register-step1', 'RegisterController::step1Save');
$routes->get('register-step2', 'RegisterController::step2');
$routes->post('register-step2', 'RegisterController::step2Save');

$routes->get('profile', 'ProfileController::index');
$routes->post('profile', 'ProfileController::save');

$routes->get('objectives', 'ObjectiveController::index');
$routes->post('objectives', 'ObjectiveController::save');

$routes->get('recommendations', 'RecommendationController::index');
$routes->get('recommendations/export_pdf', 'RecommendationController::exportPdf');

$routes->get('wallet', 'WalletController::index');
$routes->post('wallet', 'WalletController::applyCode');

$routes->get('gold', 'GoldController::index');
$routes->post('gold', 'GoldController::buy');

$routes->get('admin/login', 'AdminAuthController::login');
$routes->post('admin/login', 'AdminAuthController::attempt');
$routes->get('admin/logout', 'AdminAuthController::logout');

$routes->get('admin', 'AdminDashboardController::index');

$routes->get('admin/regimes', 'AdminRegimesController::index');
$routes->get('admin/regimes/create', 'AdminRegimesController::create');
$routes->post('admin/regimes', 'AdminRegimesController::store');
$routes->get('admin/regimes/(:num)/edit', 'AdminRegimesController::edit/$1');
$routes->post('admin/regimes/(:num)', 'AdminRegimesController::update/$1');
$routes->post('admin/regimes/(:num)/delete', 'AdminRegimesController::delete/$1');

$routes->get('admin/activities', 'AdminActivitiesController::index');
$routes->get('admin/activities/create', 'AdminActivitiesController::create');
$routes->post('admin/activities', 'AdminActivitiesController::store');
$routes->get('admin/activities/(:num)/edit', 'AdminActivitiesController::edit/$1');
$routes->post('admin/activities/(:num)', 'AdminActivitiesController::update/$1');
$routes->post('admin/activities/(:num)/delete', 'AdminActivitiesController::delete/$1');

$routes->get('admin/codes', 'AdminCodesController::index');
$routes->get('admin/codes/create', 'AdminCodesController::create');
$routes->post('admin/codes', 'AdminCodesController::store');
$routes->post('admin/codes/(:num)/toggle', 'AdminCodesController::toggle/$1');

$routes->get('admin/settings', 'AdminSettingsController::index');
$routes->post('admin/settings', 'AdminSettingsController::save');

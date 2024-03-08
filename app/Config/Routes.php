<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/transaksi.index', 'transaksiController::index');
$routes->get('/transaksi.create', 'transaksiController::create');
$routes->get('/transaksi.update', 'transaksiController::update');
$routes->get('/transaksi.delete', 'transaksiController::delete');




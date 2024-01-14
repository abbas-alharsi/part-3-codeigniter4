<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MyController::myView');
$routes->get('/upload', 'UploadController::uploadView');
$routes->post('/insert-data','MyController::insertData');
$routes->post('/delete-data', 'MyController::deleteData');
$routes->get('/getdata/(:any)', 'MyController::getData/$1');
$routes->post('/edit-data', 'MyController::updateData');
$routes->get('/image/(:any)','MyController::getImageFileName/$1');

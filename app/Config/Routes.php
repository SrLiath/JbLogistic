<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/rastreio', 'Home::rastreio');
$routes->get('/login', 'Home::login');
$routes->get('/painel', 'Home::painel');
$routes->get('/post', 'Home::post');
$routes->get('/entregador', 'Entregador::entregador');
$routes->get('/entregador/download/(:num)/mes/(:num)/ano/(:num)', 'Entregador::download/$1/$2/$3');

//admin
$routes->get('/admin/pdf/(:num)/id/(:num)/mes/(:num)/(:num)/download', 'Admin::download/$1/$2/$3/$4');
$routes->get('/admin', 'Admin::adminv');
$routes->post('/admins', 'Admin::admin');
//api
$routes->post('/econfirmentregadorapi', 'Entregador::confirmentregadorapi');
$routes->post('/confirmentregadorapi', 'Admin::confirmentregadorapi');
$routes->post('/apirastreio', 'Api::apirastreio');
$routes->post('/apilc', 'Api::apilc');
$routes->post('/apipainel', 'Api::apip');
$routes->post('/apipost', 'Api::apipost');
$routes->post('/apicon', 'Api::apicon');
$routes->post('/apicone', 'Admin::apicon');
$routes->post('/apientregador', 'Admin::entregador');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

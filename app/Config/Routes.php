<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
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
$routes->post('/declineentregadorapi', 'Entregador::declineentregadorapi');
$routes->post('/coletaconfirmapi', 'Entregador::coletaconfirmapi');
$routes->post('/confirmentregadorapi', 'Admin::confirmentregadorapi');
$routes->post('/apirastreio', 'Api::apirastreio');
$routes->post('/apilc', 'Api::apilc');
$routes->post('/apipainel', 'Api::apip');
$routes->post('/apipost', 'Api::apipost');
$routes->post('/apicon', 'Api::apicon');
$routes->post('/apicone', 'Admin::apicon');
$routes->post('/apientregador', 'Admin::entregador');
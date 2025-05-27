<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Profil::index');
$routes->get('/Matkul/Pemweb', 'Mata_Kuliah::pemweb');  // Ubah ke /Matkul/Pemweb
$routes->get('/Matkul/RPL', 'Mata_Kuliah::rpl');
$routes->get('/Matkul/SIM', 'Mata_Kuliah::sim');
$routes->get('/Matkul/MBD', 'Mata_Kuliah::mbd');
$routes->get('/About', 'Page::about');
$routes->get('/Contact', 'Page::contact');
$routes->get('/Faqs', 'Page::faqs');
$routes->get('/Tos', 'Page::tos');
$routes->get('/Biodata', 'Page::Biodata');

$routes->get('/books', 'Books::index');
$routes->get('/books/create', 'Books::create');  // ✅ Tambahkan ini
$routes->post('/books/save', 'Books::save');
$routes->get('/books/(:segment)', 'Books::detail/$1');
$routes->delete('/books/(:num)', 'Books::delete/$1');
$routes->get('/books/edit/(:segment)', 'Books::edit/$1');
$routes->post('/books/update/(:num)', 'Books::update/$1');

$routes->setAutoRoute(false);


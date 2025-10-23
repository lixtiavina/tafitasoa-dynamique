<?php

use App\Controllers\Admin\Devis;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Site::index');
$routes->post('site/envoyerDevis', 'Site::envoyerDevis');

$routes->group('sarl', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('check-login', 'Auth::checkLogin');
    $routes->get('logout', 'Auth::logout');
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'authGuard']);
    //Services--------------------
    $routes->get('services', 'Services::index');
    $routes->get('services/create', 'Services::create');
    $routes->post('services/store', 'Services::store');
    $routes->get('services/edit/(:num)', 'Services::edit/$1');
    $routes->post('services/update/(:num)', 'Services::update/$1');
    $routes->get('services/delete/(:num)', 'Services::delete/$1');
    //contacts----------------------
    $routes->get('contacts', 'Contacts::index');
    $routes->get('contacts/create', 'Contacts::create');
    $routes->post('contacts/store', 'Contacts::store');
    $routes->get('contacts/edit/(:num)', 'Contacts::edit/$1');
    $routes->post('contacts/update/(:num)', 'Contacts::update/$1');
    $routes->get('contacts/delete/(:num)', 'Contacts::delete/$1');
    //Medias---------------------------
    $routes->get('medias', 'Medias::index');
    $routes->post('medias/updateVideo', 'Admin\Medias::updateVideo');
    //devis----------------------------
    $routes->get('devis', 'Devis::index');
    $routes->get('devis/reply/(:num)', 'Devis::reply/$1');
    $routes->post('devis/sendReply', 'Devis::sendReply');
    $routes->post('devis/saveReply', 'Devis::saveReply');
    //props------------------------------
    $routes->get('propos', 'Propos::index');
    $routes->post('propos/update', 'Propos::update');
    //parametres---------------------------
    $routes->get('parametres', 'Parametres::index');
    $routes->post('parametres/save', 'Parametres::save');

    //register-----------------------------
    $routes->get('register', 'Register::index');
    $routes->post('register', 'Register::processAdminRegistration');
    $routes->get('register/list', 'Register::list');
    $routes->get('register/connected', 'Register::connectedAdmins');
    $routes->get('register/check-username', 'Register::checkUsername');
    $routes->get('register/check-email', 'Register::checkEmail');
    $routes->get('register/get-admins-status', 'Register::getAdminsStatus');
    $routes->get('register/update-activity', 'Register::updateActivity');
    $routes->get('register/delete/(:num)', 'Register::delete/$1');
});

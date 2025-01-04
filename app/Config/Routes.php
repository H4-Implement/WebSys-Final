<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/','Index::index');
$routes->get('/index','Index::index');
$routes->get('login','Index::Login');
$routes->get('index/index','Index::index');
$routes->get('home','Index::index');

$routes->get('users', 'Users::index');
$routes->get('users/add', 'Users::add');
$routes->post('users/add', 'Users::add');
$routes->get('users/register', 'Users::register');
$routes->post('users/register', 'Users::register');
$routes->get('users/view/(:num)', 'Users::view/$1');
$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->post('users/edit/(:num)', 'Users::edit/$1');
$routes->get('users/delete/(:num)', 'Users::delete/$1');

//For about
$routes->get('about', 'Index::about');
$routes->get('about/index', 'Index::about');

// For Login
$routes->get('index/login', 'Index::login');
$routes->post('index/login', 'Index::login');

// For Logout
$routes->get('logout', 'Index::logout');

// For Account Activation
$routes->get('users/activate/(:any)', 'Users::activate/$1');

// For Password Reset
$routes->get('login/reset', 'Users::reset');
$routes->post('login/reset', 'Users::reset');
$routes->get('login/reset_cancel', 'Index::Login');
$routes->post('login/reset_cancel', 'Index::Login');

// Deactivate User
$routes->get('users/deactivate/(:num)', 'Users::deactivate/$1');

// Reactivate User
$routes->get('users/reactivate/(:num)', 'Users::reactivate/$1');



//equipment view
$routes->get('item', 'EquipmentController::index');
$routes->post('item', 'EquipmentController::index');

//add equipment
$routes->get('item/add', 'EquipmentController::add');
$routes->post('item/add', 'EquipmentController::add');

//singleview equipment
$routes->get('item/view/(:alphanum)', 'EquipmentController::view/$1');
$routes->post('item/view/(:alphanum)', 'EquipmentController::view/$1');

//edit equipment
$routes->get('item/edit/(:alphanum)', 'EquipmentController::edit/$1');
$routes->post('item/edit/(:alphanum)', 'EquipmentController::edit/$1');

//delete equipment
$routes->get('item/delete/(:alphanum)', 'EquipmentController::delete/$1');
$routes->post('item/delete/(:alphanum)', 'EquipmentController::delete/$1');

//for Deactivation of Equipment
$routes->get('item/deactivate/(:alphanum)', 'EquipmentController::deactivate/$1');
$routes->post('item/deactivate/(:alphanum)', 'EquipmentController::deactivate/$1');

//for Activation of Equipment
$routes->get('item/activate/(:alphanum)', 'EquipmentController::activate/$1');
$routes->post('item/activate/(:alphanum)', 'EquipmentController::activate/$1');



//For Borrowing
$routes->get('borrow', 'BorrowController::index');
$routes->post('borrow', 'BorrowController::index');

//Borrow view
$routes->get('item/borrow/(:alphanum)', 'BorrowController::borrow/$1');
$routes->post('item/borrow/(:alphanum)', 'BorrowController::borrow/$1');

//Return item
$routes->get('item/return/(:alphanum)', 'BorrowController::return/$1');
$routes->post('item/return/(:alphanum)', 'BorrowController::return/$1');



//Reservation view
$routes->get('reserve', 'ReservationController::index');
$routes->post('reserve', 'ReservationController::index');

//Reservation singleview
$routes->get('item/reserve/(:alphanum)', 'ReservationController::reserve/$1');
$routes->post('item/reserve/(:alphanum)', 'ReservationController::reserve/$1');

//Reschedule
$routes->get('item/reschedule/(:alphanum)', 'ReservationController::reschedule/$1');
$routes->post('item/reschedule/(:alphanum)', 'ReservationController::reschedule/$1');

//CANCEL RESERVATION
$routes->get('item/cancel/(:alphanum)', 'ReservationController::cancel/$1');
$routes->post('item/cancel/(:alphanum)', 'ReservationController::cancel/$1');



//For Report
$routes->get('report', 'LogsController::index');
$routes->post('report', 'LogsController::index');



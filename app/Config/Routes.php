<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index');

// Custom routes
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// Auth & Dashboard
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attempt');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Home::dashboard');
// Registration
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');
$routes->get('/announcements', 'Announcement::index');
$routes->get('/announcements', 'Announcement::index');
$routes->get('/announcements', 'Announcement::index');
$routes->get('/teacher/dashboard', 'Teacher::dashboard');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->group('admin', ['filter' => 'roleauth'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::dashboard');
});

$routes->group('teacher', ['filter' => 'roleauth'], function($routes) {
    $routes->get('/', 'TeacherController::index');
    $routes->get('classes', 'TeacherController::classes');
});

$routes->group('student', ['filter' => 'roleauth'], function($routes) {
    $routes->get('/', 'StudentController::index');
    $routes->get('announcements', 'StudentController::announcements');
});

$routes->get('announcements', 'AnnouncementController::index');
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::index');

    // Admin & Staff Routes
    $routes->group('admin', ['filter' => 'auth:admin', 'namespace' => 'App\Controllers\Admin'], function ($routes) {
        $routes->get('user', 'UserController::index');
        $routes->get('user/add', 'UserController::add');
        $routes->post('user/save', 'UserController::save');
        $routes->get('user/delete/(:num)', 'UserController::delete/$1');

        $routes->get('penduduk', 'PendudukController::index');
        $routes->get('penduduk/add', 'PendudukController::add');
        $routes->post('penduduk/save', 'PendudukController::save');
        $routes->get('penduduk/edit/(:num)', 'PendudukController::edit/$1');
        $routes->post('penduduk/update', 'PendudukController::update');
        $routes->get('penduduk/delete/(:num)', 'PendudukController::delete/$1');
    });

    $routes->group('permohonan', ['filter' => 'auth:admin,jagabaya,ulu-ulu'], function ($routes) {
        $routes->get('persetujuan', 'PermohonanController::persetujuan');
        $routes->post('aksi-staff', 'PermohonanController::aksiStaff');
    });

    // Lurah Routes
    $routes->group('pengesahan', ['filter' => 'auth:admin,lurah'], function ($routes) {
        $routes->get('/', 'PermohonanController::pengesahan');
        $routes->get('add/(:num)', 'PermohonanController::pengesahanAdd/$1');
        $routes->post('aksi-lurah', 'PermohonanController::aksiLurah');
    });

    // Penduduk Routes
    $routes->group('pelayanan', ['filter' => 'auth:admin,penduduk'], function ($routes) {
        $routes->get('riwayat', 'PermohonanController::riwayat');
        $routes->get('tambah', 'PermohonanController::tambah');
        $routes->post('simpan', 'PermohonanController::simpan');
    });

    $routes->get('download-pdf/(:num)', 'LetterController::download/$1');
    $routes->get('arsip', 'PermohonanController::arsip');
});

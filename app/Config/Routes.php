<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/product/(:any)', 'Home::productdetail/$1');

$routes->post('/process', 'Home::setSession');
$routes->get('/checkout', 'Home::checkout');
$routes->post('/transaction', 'Home::transaction');
$routes->get('/cekpesanan', 'Home::cekpesanan');
$routes->put('/reject', 'Home::reject');

$routes->get('/cekpesanan/detail/(:any)', 'Home::detailpesanan/$1');

// Auth
$routes->match(['get', 'post'], 'resellerlogin', 'Auth\Reseller::index', ['filter' => 'noauthreseller']);
$routes->get('logoutreseller', 'Auth\Reseller::logoutReseller');
$routes->match(['get', 'post'], 'forgetpassword-reseller', 'Auth\Reseller::forgetPassword', ['filter' => 'noauthreseller']);
$routes->match(['get', 'post'], 'changepassword-reseller/(:alphanum)', 'Auth\Reseller::changePassword/$1', ['filter' => 'noauthreseller']);


$routes->match(['get', 'post'], 'adminlogin', 'Auth\Admin::index', ['filter' => 'noauthadmin']);
$routes->get('logoutadmin', 'Auth\Admin::logoutAdmin');
$routes->match(['get', 'post'], 'forgetpassword-admin', 'Auth\Admin::forgetPassword', ['filter' => 'noauthadmin']);
$routes->match(['get', 'post'], 'changepassword-admin/(:alphanum)', 'Auth\Admin::changePassword/$1', ['filter' => 'noauthadmin']);


// Admin
$routes->group('admin', ['filter' => 'authenadmin'], function ($routes) {
	$routes->get('/', 'Admin\Admin::index');

	$routes->group('user', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\User::index');
		$routes->post('register', 'Admin\User::register');
		$routes->put('setactive/(:num)', 'Admin\User::setActive/$1');
		$routes->delete('delete/(:num)', 'Admin\User::deleteAdmin/$1');
		$routes->get('detail/(:num)', 'Admin\User::detail/$1');
	});

	$routes->put('user/editprofile', 'Auth\Admin::editProfile');
	$routes->get('user/detailuser', 'Auth\Admin::detailUser');
	$routes->match(['get', 'put'], 'user/change-password', 'Auth\Admin::editPassword');

	$routes->group('brochure', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\Brochure::index');
		$routes->post('addbrochure', 'Admin\Brochure::save');
		$routes->get('detail/(:any)', 'Admin\Brochure::detail/$1');
		$routes->put('editbrochure/(:num)', 'Admin\Brochure::update/$1');
		$routes->delete('delete/(:num)', 'Admin\Brochure::delete/$1');
	});

	$routes->group('gamelist', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->add('/', 'Admin\Gamelist::index');
		$routes->post('addgame', 'Admin\Gamelist::save');
		$routes->get('detail/(:any)', 'Admin\Gamelist::detail/$1');
		$routes->put('editgame/(:num)', 'Admin\Gamelist::update/$1');
		$routes->delete('delete/(:num)', 'Admin\Gamelist::delete/$1');
	});

	$routes->group('payment', function ($routes) {
		$routes->add('/', 'Admin\Payment::index');
		$routes->add('content', 'Admin\Payment::content');
		$routes->get('detail/(:any)', 'Admin\Payment::detail/$1');
		$routes->put('process/(:num)', 'Admin\Payment::process/$1');
		$routes->put('reject/(:num)', 'Admin\Payment::reject/$1');
	});

	$routes->group('proses', function ($routes) {
		$routes->add('/', 'Admin\Proses::index');
		$routes->add('content', 'Admin\Proses::content');
		$routes->get('detail/(:any)', 'Admin\Proses::detail/$1');
		$routes->put('selesai/(:num)', 'Admin\Proses::selesai/$1');
		$routes->put('reject/(:num)', 'Admin\Proses::reject/$1');
	});

	$routes->group('paymentmethod', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\PaymentMethod::index');
		$routes->post('addpaymentmethod', 'Admin\PaymentMethod::save');
		$routes->get('detail/(:num)', 'Admin\PaymentMethod::detail/$1');
		$routes->put('editproduct/(:num)', 'Admin\PaymentMethod::update/$1');
		$routes->delete('delete/(:num)', 'Admin\PaymentMethod::delete/$1');
	});

	$routes->group('product', function ($routes) {
		$routes->get('/', 'Admin\Product::index');
		$routes->post('addproduct', 'Admin\Product::save');
		$routes->get('detail/(:num)', 'Admin\Product::detail/$1');
		$routes->put('update/(:num)', 'Admin\Product::update/$1');
		$routes->delete('delete/(:num)', 'Admin\Product::delete/$1');
	});

	$routes->group('report', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\Report::index');
		$routes->get('detail/(:num)', 'Admin\Report::detail/$1');
	});

	$routes->group('info', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\Info::index');
		$routes->post('addinfo', 'Admin\Info::save');
		$routes->get('detail/(:num)', 'Admin\Info::detail/$1');
		$routes->put('update/(:num)', 'Admin\Info::update/$1');
		$routes->delete('delete/(:num)', 'Admin\Info::delete/$1');
	});

	$routes->group('promo', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\Promo::index');
		$routes->post('addpromo', 'Admin\Promo::save');
		$routes->get('detail/(:num)', 'Admin\Promo::detail/$1');
		$routes->put('editproduct/(:num)', 'Admin\Promo::update/$1');
		$routes->delete('delete/(:num)', 'Admin\Promo::delete/$1');
	});

	$routes->group('reseller', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\Reseller::index');
		$routes->get('detail/(:num)', 'Admin\Reseller::detail/$1');
		$routes->put('setactive/(:num)', 'Admin\Reseller::setActive/$1');
		$routes->delete('delete/(:num)', 'Admin\Reseller::deleteReseller/$1');
		$routes->post('register', 'Admin\Reseller::register');
		$routes->get('payment', 'Admin\Reseller::payment');
		$routes->get('paymentdetail', 'Admin\Reseller::detail');
		$routes->put('setlunas/(:num)', 'Admin\Reseller::setLunas/$1');
	});



	$routes->group('about', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\About::index');
		$routes->get('detail', 'Admin\About::detail');
		$routes->put('edit', 'Admin\About::update');
	});

	$routes->group('syaratketentuan', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\SyaratKetentuan::index');
		$routes->get('detail', 'Admin\SyaratKetentuan::detail');
		$routes->put('edit', 'Admin\SyaratKetentuan::update');
	});

	$routes->group('social', ['filter' => 'ownerfilter'], function ($routes) {
		$routes->get('/', 'Admin\Social::index');
		$routes->post('addsocial', 'Admin\Social::save');
		$routes->get('detail/(:num)', 'Admin\Social::detail/$1');
		$routes->put('edit/(:num)', 'Admin\Social::update/$1');
		$routes->delete('delete/(:num)', 'Admin\Social::delete/$1');
	});
});

// Reseller
$routes->group('reseller', ['filter' => 'authenreseller'], function ($routes) {
	$routes->get('/', 'Reseller\Reseller::index');
	$routes->get('bill', 'Reseller\Reseller::bill');

	$routes->get('detailuser', 'Auth\Reseller::detailUser');
	$routes->put('editprofile', 'Auth\Reseller::editProfile');
	$routes->match(['get', 'put'], 'change-password', 'Auth\Reseller::editPassword');

	$routes->get('info', 'Reseller\Info::index');
	$routes->get('pesanan', 'Reseller\Pesanan::index');
	$routes->get('product', 'Reseller\Product::index');
	$routes->get('productdetail/(:any)', 'Reseller\Reseller::productdetail/$1');
	$routes->post('transaction', 'Reseller\Reseller::transaction');
	$routes->get('report', 'Reseller\Report::index');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

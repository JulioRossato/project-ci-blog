<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH.'Config/Routes.php')) {
    require SYSTEMPATH.'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/admin', 'Admin\HomeController::index');

$routes->group('admin',
    static function ($routes) {

        //LoginController
        $routes->group('login',
            static function ($routes) {
                $routes->get('/', 'Admin\LoginController::index');
                $routes->post('authenticate',
                    'Admin\LoginController::authenticate');
                $routes->get('logout', 'Admin\LoginController::logout');
            });

        //HomeController
        $routes->get('home', 'Admin\HomeController::index');

        //MediaController
        $routes->group('media',
            static function ($routes) {
                $routes->get('/', 'Admin\MediaController::index');
                $routes->get('dataresult', 'Admin\MediaController::dataResult');
                $routes->post('save', 'Admin\MediaController::save');
                $routes->post('delete', 'Admin\MediaController::delete');
            });

        //WebSettingController
        $routes->group('web-settings',
            static function ($routes) {
                $routes->get('/', 'Admin\WebSettingController::index');
                $routes->get('dataresult',
                    'Admin\WebSettingController::dataResult');
                $routes->post('save', 'Admin\WebSettingController::save');
            });

        //PostController
        $routes->group('post',
            static function ($routes) {
                $routes->get('/', 'Admin\PostController::index');
                $routes->get('dataresult', 'Admin\PostController::dataResult');
                $routes->get('add', 'Admin\PostController::add');
                $routes->get('edit/(:num)', 'Admin\PostController::edit/$1');
                $routes->post('save', 'Admin\PostController::save');
                $routes->post('delete', 'Admin\PostController::delete');
            });

        //CategoryController
        $routes->group('category',
            static function ($routes) {
                $routes->get('/', 'Admin\CategoryController::index');
                $routes->get('dataresult',
                    'Admin\CategoryController::dataResult');
                $routes->get('data-tree', 'Admin\CategoryController::dataTree');
                $routes->post('save-sortable',
                    'Admin\CategoryController::saveSortable');
                $routes->get('add', 'Admin\CategoryController::add');
                $routes->get('edit/(:num)', 'Admin\CategoryController::edit/$1');
                $routes->post('save', 'Admin\CategoryController::save');
                $routes->post('delete', 'Admin\CategoryController::delete');
            });

        //BannerController
        $routes->group('banner',
            static function ($routes) {
                $routes->get('/', 'Admin\BannerController::index');
                $routes->get('dataresult', 'Admin\BannerController::dataResult');
                $routes->get('data-tree', 'Admin\BannerController::dataTree');
                $routes->post('save-sortable',
                    'Admin\BannerController::saveSortable');
                $routes->get('add', 'Admin\BannerController::add');
                $routes->get('edit/(:num)', 'Admin\BannerController::edit/$1');
                $routes->post('save', 'Admin\BannerController::save');
                $routes->post('delete', 'Admin\BannerController::delete');
            });

        //PartnerController
        $routes->group('partner',
            static function ($routes) {
                $routes->get('/', 'Admin\PartnerController::index');
                $routes->get('dataresult', 'Admin\PartnerController::dataResult');
                $routes->get('data-tree', 'Admin\PartnerController::dataTree');
                $routes->post('save-sortable',
                    'Admin\PartnerController::saveSortable');
                $routes->get('add', 'Admin\PartnerController::add');
                $routes->get('edit/(:num)', 'Admin\PartnerController::edit/$1');
                $routes->post('save', 'Admin\PartnerController::save');
                $routes->post('delete', 'Admin\PartnerController::delete');
            });

        //PublicityController
        $routes->group('publicity',
            static function ($routes) {
                $routes->get('/', 'Admin\PublicityController::index');
                $routes->get('dataresult',
                    'Admin\PublicityController::dataResult');
                $routes->get('add', 'Admin\PublicityController::add');
                $routes->get('edit/(:num)', 'Admin\PublicityController::edit/$1');
                $routes->post('save', 'Admin\PublicityController::save');
                $routes->post('delete', 'Admin\PublicityController::delete');
            });

        //ContactController
        $routes->group('contact',
            static function ($routes) {
                $routes->get('/', 'Admin\ContactController::index');
                $routes->get('dataresult', 'Admin\ContactController::dataResult');
                $routes->get('view/(:num)', 'Admin\ContactController::view/$1');
                $routes->post('save', 'Admin\ContactController::save');
                $routes->post('delete', 'Admin\ContactController::delete');
            });

        //AttributeSetController
        $routes->group('attribute-set',
            static function ($routes) {
                $routes->get('/', 'Admin\AttributeSetController::index');
                $routes->get('dataresult',
                    'Admin\AttributeSetController::dataResult');
                $routes->get('add', 'Admin\AttributeSetController::add');
                $routes->get('edit/(:num)',
                    'Admin\AttributeSetController::edit/$1');
                $routes->post('save', 'Admin\AttributeSetController::save');
                $routes->post('delete', 'Admin\AttributeSetController::delete');
            });

        //AttributeController
        $routes->group('attribute',
            static function ($routes) {
                $routes->get('/', 'Admin\AttributeController::index');
                $routes->get('dataresult',
                    'Admin\AttributeController::dataResult');
                $routes->get('add', 'Admin\AttributeController::add');
                $routes->get('edit/(:num)', 'Admin\AttributeController::edit/$1');
                $routes->post('save', 'Admin\AttributeController::save');
                $routes->post('delete', 'Admin\AttributeController::delete');
            });

        //AttributeValueController
        $routes->group('attribute-value',
            static function ($routes) {
                $routes->get('/', 'Admin\AttributeValueController::index');
                $routes->get('dataresult',
                    'Admin\AttributeValueController::dataResult');
                $routes->get('add', 'Admin\AttributeValueController::add');
                $routes->get('edit/(:num)',
                    'Admin\AttributeValueController::edit/$1');
                $routes->post('save', 'Admin\AttributeValueController::save');
                $routes->post('delete', 'Admin\AttributeValueController::delete');
            });

        //ProductCategoryController
        $routes->group('product-category',
            static function ($routes) {
                $routes->get('/', 'Admin\ProductCategoryController::index');
                $routes->get('dataresult',
                    'Admin\ProductCategoryController::dataResult');
                $routes->get('data-tree',
                    'Admin\ProductCategoryController::dataTree');
                $routes->get('add', 'Admin\ProductCategoryController::add');
                $routes->get('edit/(:num)',
                    'Admin\ProductCategoryController::edit/$1');
                $routes->post('save', 'Admin\ProductCategoryController::save');
                $routes->post('delete',
                    'Admin\ProductCategoryController::delete');
            });

        //ProductController
        $routes->group('product',
            static function ($routes) {
                $routes->get('/', 'Admin\ProductController::index');
                $routes->get('dataresult', 'Admin\ProductController::dataResult');
                $routes->get('add', 'Admin\ProductController::add');
                $routes->get('edit/(:num)', 'Admin\ProductController::edit/$1');
                $routes->post('save', 'Admin\ProductController::save');
                $routes->post('delete', 'Admin\ProductController::delete');
                $routes->get('fetch_attribute_values_by_id',
                    'Admin\ProductController::fetchAttributeValuesById');
                $routes->get('fetch_attribute_values_by_id/(:any)',
                    'Admin\ProductController::fetchAttributeValuesById/$1');
                $routes->get('fetch_variants_values_by_pid',
                    'Admin\ProductController::fetchVriantsValuesByPid');
                $routes->get('get_variants_by_id',
                    'Admin\ProductController::getVariantsById');
            });
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
if (is_file(APPPATH.'Config/'.ENVIRONMENT.'/Routes.php')) {
    require APPPATH.'Config/'.ENVIRONMENT.'/Routes.php';
}

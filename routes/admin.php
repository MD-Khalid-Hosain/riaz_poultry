<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes Start
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Dashboard'], function () {
        Route::match(['get', 'post'], '/admin/login','AdminController@login');
        Route::match(['get', 'post'], '/admin/forgot/password', 'AdminController@forgetPassword')->name('admin-forgot-password');
        Route::group(['middleware'=>['admin']], function(){


                /*
                |--------------------------------------------------------------------------
                | Feed Product Controller Route Starts
                |--------------------------------------------------------------------------
                */
                Route::resource('feed-products','FeedProductController');
                Route::get('feed-products/delete/{id}','FeedProductController@productDelete')->name('feed-products.delete');

                /*
                |--------------------------------------------------------------------------
                | Feed Product Controller Route End
                |--------------------------------------------------------------------------
                */
            /*
             |--------------------------------------------------------------------------
             | Feed Product Controller Route Starts
             |--------------------------------------------------------------------------
             */
            Route::resource('product-purchase','ProductPurchaseController');

            /*
            |--------------------------------------------------------------------------
            | Feed Product Controller Route End
            |--------------------------------------------------------------------------
            */
            /*
            |--------------------------------------------------------------------------
            | Customer Controller Route Starts
            |--------------------------------------------------------------------------
            */
            Route::resource('customer','CustomerController');
            Route::get('customer/order/{id}','CustomerController@customerOrder')->name('customer.order');
            Route::post('customer/cart','CustomerController@customerCart')->name('add-to-customer-cart');
            Route::get('customer/cart/view/{id}','CustomerController@customerCartView')->name('view-customer-cart');
            Route::post('customer/cart/update','CustomerController@customerCartUpdate')->name('update-customer-cart');
            Route::get('customer/cart/delete/{id}','CustomerController@customerCartDelete')->name('cart-item-delete');
            Route::post('customer/order/checkout','CustomerController@customerCheckout')->name('customer-order-checkout');
            Route::get('customer/order/pdf/{id}','CustomerController@customerOrderPdf')->name('customer-pdfDownload-order');
            Route::get('customer/all/orders','CustomerController@customerOrderList')->name('customer-order-list');
            Route::get('customer/order/details/{id}','CustomerController@customerOrderView')->name('customer-order-details');
            Route::get('customer/money/collection','CustomerController@moneyCollection')->name('customer-money-collection');
            Route::post('get/customer/total/due','CustomerController@getCustomerDue');
            Route::post('customer/due/paid','CustomerController@customerDuePaid')->name('customer-due-paid');
            Route::get('customer/collection/slip/{id}','CustomerController@collectionSlip')->name('customer-collection-slip');

            /*
            |--------------------------------------------------------------------------
            | Customer Controller Route End
            |--------------------------------------------------------------------------
            */
            /*
            |--------------------------------------------------------------------------
            | Feed Product Controller Route Starts
            |--------------------------------------------------------------------------
           */
            Route::resource('vendors','VendorsController');
            Route::get('vendors/delete/{id}','VendorsController@productDelete')->name('feed-products.delete');

            /*
            |--------------------------------------------------------------------------
            | Feed Product Controller Route End
            |--------------------------------------------------------------------------
            */

            /*
            |--------------------------------------------------------------------------
            | Report Controller Start
            |--------------------------------------------------------------------------
            */

            Route::get('/search/order', 'ReportController@OrderSearch')->name('order.search');
            Route::post('/order/report', 'ReportController@orderReport')->name('order.report');
            Route::post('/download/report', 'ReportController@reportDownload')->name('download.report');

            Route::get('/search/due-collection', 'ReportController@dueCollectionSearch')->name('due-collection.search');
            Route::post('/due-collection/report', 'ReportController@dueCollectionReport')->name('due-collection.report');
            Route::post('/download/report/due-collection', 'ReportController@dueCollectionReportDownload')->name('due-collection-download.report');
            /*
            |--------------------------------------------------------------------------
            | Report Controller End
            |--------------------------------------------------------------------------
            */
                /*
                |--------------------------------------------------------------------------
                | Dashboard and Admin Controller Route Starts
                |--------------------------------------------------------------------------
                */

                Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');


                Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
                Route::get('admin/settings', 'AdminController@settings')->name('admin-settings');
                Route::post('/check-current-pwd', 'AdminController@checkCurrentPassword')->name('check-current-pwd');
                Route::post('/update-current-pwd', 'AdminController@updateCurrentPwd')->name('update-current-pwd');
                Route::match(['get', 'post'],'/admin/update-details', 'AdminController@updateAdminDetails');
                Route::post('/update-admin-status', 'AdminController@updateAdmintStatus')->name('update-admin-status');
                Route::post('/user/create', 'AdminController@createUser')->name('management.createUser');

                /*
                |--------------------------------------------------------------------------
                | Dashboard and Admin Controller Route End
                |--------------------------------------------------------------------------
                */
                /*
                |--------------------------------------------------------------------------
                | Role Controller Route Starts
                |--------------------------------------------------------------------------
                */

                    Route::get('/role/management', 'RoleController@index')->name('management.index');
                    Route::post('/role/management', 'RoleController@addRole')->name('management.index');
                    Route::get('/admin/delete-role/{id}', 'RoleController@deleteRole')->name('role.delete');
                    Route::get('/role/user', 'RoleController@userDetails')->name('management.user');
                    Route::post('/role/assign', 'RoleController@assignRole')->name('management.assig.role');
                    Route::get('/role/edit/{id}', 'RoleController@editRole')->name('management.edit');
                    Route::post('/role/change', 'RoleController@changePermission')->name('management.changePermission');
                    Route::get('/delete-user/{id}', 'RoleController@deleteUser')->name('management.deleteUser');

                /*
                |--------------------------------------------------------------------------
                | Role Controller Route End
                |--------------------------------------------------------------------------
                */

                Route::prefix('/admin')->group(function(){
                /*
                |--------------------------------------------------------------------------
                | Brand Controller Route Start
                |--------------------------------------------------------------------------
                */
                    Route::get('brands', 'BrandController@brands');
                    Route::get('/add-brand-form', 'BrandController@addBrandForm');
                    Route::post('/create-brand', 'BrandController@createBrand');
                    Route::get('/edit-brand/{id}', 'BrandController@editBrand');
                    Route::post('/update-brand', 'BrandController@updateBrand');
                    Route::post('/update-brand-status', 'BrandController@updateBrandStatus')->name('update-brand-status');
                    Route::get('delete-brand/{id}', 'BrandController@deleteBrand')->name('delete.brand');

                /*
                |--------------------------------------------------------------------------
                | Brand Controller Route End
                |--------------------------------------------------------------------------
                */

                });
            });
        });
});

/*
|--------------------------------------------------------------------------
| Frontend Routes End
|--------------------------------------------------------------------------
*/

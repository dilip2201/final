<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();





/******************************* Admin login part start **********************************************/
Route::group(['middleware' => ['check-permission:super_admin|user|operator','checkactivestatus']], function () {
    
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('cancleorder/{id}','OrderDetailController@cancleorder');
        /***************** Profile *************************/
        Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@index']);
        Route::post('updatecompnay', ['as' => 'updatecompnay', 'uses' => 'ProfileController@updatecompnay']);
        Route::get('storecompany', ['as' => 'storecompany', 'uses' => 'ProfileController@storecompany']);
         Route::post('getcompanymodal', ['as' => 'getcompanymodal', 'uses' => 'ProfileController@getcompanymodal']);

        /***************** Dashboard *************************/
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        Route::get('company', ['as' => 'company', 'uses' => 'DashboardController@company']);
        Route::post('filterdata', ['as' => 'filterdata', 'uses' => 'DashboardController@filterdata']);
        Route::post('loadimages', ['as' => 'loadimages', 'uses' => 'DashboardController@loadimages']);



        Route::group(['middleware' => 'check-permission:super_admin'], function () {
            /******************** User Dev : Dilip 15-06 ***********************/
            Route::resource('users', 'UserController');
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::post('getall', ['as' => 'getall', 'uses' => 'UserController@getall']);
                Route::post('getmodal', ['as' => 'getmodal', 'uses' => 'UserController@getmodal']);
                Route::post('changestatus', ['as' => 'changestatus', 'uses' => 'UserController@changestatus']);
            });
        });

        Route::group(['middleware' => 'check-permission:super_admin'], function () {
            /******************** User Dev : Dilip 15-06 ***********************/
            Route::resource('items', 'ItemController');
            Route::group(['prefix' => 'items', 'as' => 'items.'], function () {
                Route::post('getall', ['as' => 'getall', 'uses' => 'ItemController@getall']);
                Route::post('getmodal', ['as' => 'getmodal', 'uses' => 'ItemController@getmodal']);

              
            });
        });

        Route::group(['middleware' => 'check-permission:super_admin|user'], function () {
            /******************** User Dev : Dilip 15-06 ***********************/
            Route::resource('orders', 'OrderDetailController');
            Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
               Route::post('getall', ['as' => 'getall', 'uses' => 'OrderDetailController@getall']);
               Route::post('changestatus', ['as' => 'changestatus', 'uses' => 'OrderDetailController@changestatus']);
               Route::post('getprint', ['as' => 'getprint', 'uses' => 'OrderDetailController@getprint']);
               Route::get('purchase_index', ['as' => 'purchase_index', 'uses' => 'OrderDetailController@purchase_index']);
               Route::post('getpurchaseall', ['as' => 'getpurchaseall', 'uses' => 'OrderDetailController@getpurchaseall']);
               
                //Route::post('getmodal', ['as' => 'getmodal', 'uses' => 'OrderDetailController@getmodal']);
              
            });
        });

        Route::group(['middleware' => 'check-permission:super_admin|user'], function () {
            /******************** User Dev : Dilip 15-06 ***********************/
            Route::resource('purchaseorders', 'PurchaseOrderController');
            Route::group(['prefix' => 'purchaseorders', 'as' => 'purchaseorders.'], function () {
               Route::post('getall', ['as' => 'getall', 'uses' => 'PurchaseOrderController@getall']);
               Route::post('changestatus', ['as' => 'changestatus', 'uses' => 'PurchaseOrderController@changestatus']);
               Route::post('getprint', ['as' => 'getprint', 'uses' => 'PurchaseOrderController@getprint']);
               Route::get('purchase_index', ['as' => 'purchase_index', 'uses' => 'PurchaseOrderController@purchase_index']);
               Route::post('getpurchaseall', ['as' => 'getpurchaseall', 'uses' => 'PurchaseOrderController@getpurchaseall']);
               Route::post('getmodal', ['as' => 'getmodal', 'uses' => 'PurchaseOrderController@getmodal']);
               
                //Route::post('getmodal', ['as' => 'getmodal', 'uses' => 'OrderDetailController@getmodal']);
              
            });
        });
        

        
        Route::group(['middleware' => 'check-permission:super_admin|user'], function () {
            /******************** User Dev : Dilip 15-06 ***********************/
            Route::resource('pos', 'POSController');
            Route::group(['prefix' => 'pos', 'as' => 'pos.'], function () { 
                Route::post('saveinvoice', ['as' => 'saveinvoice', 'uses' => 'POSController@saveinvoice']);
            });
            Route::resource('pop', 'POPController');
            Route::group(['prefix' => 'pop', 'as' => 'pop.'], function () { 
                Route::post('saveinvoice', ['as' => 'saveinvoice', 'uses' => 'POPController@saveinvoice']);
            });
        });
        /*********************** In out past date setting*********************************/
        Route::get('setting', ['as' => 'setting', 'uses' => 'SettingController@index']);
        Route::post('setting', ['as' => 'setting.store', 'uses' => 'SettingController@store']);
        /***************************** users *****************************************/
        Route::group(['middleware' => 'check-permission:super_admin|user'], function () {
            Route::resource('reports', 'ReportController');
            Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () { 
                Route::post('loadpos', ['as' => 'loadpos', 'uses' => 'ReportController@loadpos']);
            });
        });

        Route::group(['middleware' => 'check-permission:super_admin|user'], function () {
            Route::resource('reports', 'ReportController');
            Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () { 
                Route::post('loadpos', ['as' => 'loadpos', 'uses' => 'ReportController@loadpos']);
            });
        });

        Route::group(['middleware' => 'check-permission:super_admin|user'], function () {
            Route::resource('monthlyreports', 'MonthlyReportController');
            Route::group(['prefix' => 'monthlyreports', 'as' => 'monthlyreports.'], function () { 
                Route::post('loadpos', ['as' => 'loadpos', 'uses' => 'MonthlyReportController@loadpos']);
            });
        });
    });


    /**************** employee login part***************/

});

/***************************** Company login part end **************************************************/


/********************** common *********************/

Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@index']);
Route::post('/profileupdate', ['as' => 'profileupdate', 'uses' => 'ProfileController@profileupdate']);
Route::post('/changepassword', ['as' => 'changepassword', 'uses' => 'ProfileController@changepassword']);
/********************** common *********************/



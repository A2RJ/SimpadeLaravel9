<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*
| Gunakan middleware auth untuk mengatur route yang dibutuhkan oleh user yang sudah login
| misal superadmin, admin, wp dan teknisi
*/

$router->get('/', function () use ($router) {
    return Response()->json([
        'status' => 'success',
        'message' => 'Welcome to Simpade Lumen API',
        'data' => [
            'version' => '1.0.0'
        ]
    ], 200);
});

$router->group(['middleware' => 'jwt', 'prefix' => 'auth'], function ($router) {
    $router->get('me', 'AuthController@me');
    $router->post('logout', 'AuthController@logout');
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
});

$router->group(['prefix' => 'wp'], function () use ($router) {
    $router->group(['prefix' => 'wp'], function () use ($router) {
        $router->get('/', 'WPMainController@index');
        $router->get('/count', 'WPMainController@count');
        $router->get('/countByDaerah', 'WPMainController@countByDaerah');
        $router->get('/getAllWpOutlet', 'WPMainController@getAllWpOutlet');
        $router->get('/{id}', 'WPMainController@show');
        $router->get('/getWpByKategori/{id}', 'WPMainController@getWpByKategori');
        $router->get('/getWpByOutlet/{id}', 'WPMainController@getWpByOutlet');
        $router->get('/getWpByAfe/{id}', 'WPMainController@getWpByAfe');
        $router->get('/getWpByKodePemda/{id}', 'WPMainController@getWpByKodePemda');
        $router->get('/countWpByDaerahId/{id}', 'WPMainController@countWpByDaerahId');
        $router->get('/getWpOutletByIdWp/{id}', 'WPMainController@getWpOutletByIdWp');
        $router->get('/getWpOutletByKategori/{id}', 'WPMainController@getWpOutletByKategori');
        $router->get('/getWpOutletByAfe/{id}', 'WPMainController@getWpOutletByAfe');
        $router->get('/getWpOutletByKodePemda/{id}', 'WPMainController@getWpOutletByKodePemda');
        $router->get('/{id}/delete', 'WPMainController@destroy');
        $router->post('/', 'WPMainController@store');
        $router->put('/{id}', 'WPMainController@update');
        $router->delete('/{id}', 'WPMainController@destroy');
    });

    $router->group(['prefix' => 'kategori'], function () use ($router) {
        $router->get('/', 'KategoriWPController@index');
        $router->get('/{id}', 'KategoriWPController@show');
        $router->get('/{id}/delete', 'KategoriWPController@destroy');
        $router->post('/', 'KategoriWPController@store');
        $router->put('/{id}', 'KategoriWPController@update');
        $router->delete('/{id}', 'KategoriWPController@destroy');
    });
});

$router->group(['prefix' => 'afe'], function () use ($router) {
    $router->group(['prefix' => 'AFEmain'], function () use ($router) {
        $router->get('/', 'AFEMainController@index');
        $router->get('/{id}', 'AFEMainController@show');
        $router->get('/{id}/delete', 'AFEMainController@destroy');
        $router->post('/', 'AFEMainController@store');
        $router->put('/{id}', 'AFEMainController@update');
        $router->delete('/{id}', 'AFEMainController@destroy');
    });

    $router->group(['prefix' => 'produkAFE'], function () use ($router) {
        $router->get('/', 'ProdukAFEController@index');
        $router->get('/{id}', 'ProdukAFEController@show');
        $router->get('/{id}/delete', 'ProdukAFEController@destroy');
        $router->post('/', 'ProdukAFEController@store');
        $router->put('/{id}', 'ProdukAFEController@update');
        $router->delete('/{id}', 'ProdukAFEController@destroy');
    });

    $router->group(['prefix' => 'kategoriAFE'], function () use ($router) {
        $router->get('/', 'KategoriAFEController@index');
        $router->get('/{id}', 'KategoriAFEController@show');
        $router->get('/{id}/delete', 'KategoriAFEController@destroy');
        $router->post('/', 'KategoriAFEController@store');
        $router->put('/{id}', 'KategoriAFEController@update');
        $router->delete('/{id}', 'KategoriAFEController@destroy');
    });

    $router->group(['prefix' => 'status'], function () use ($router) {
        $router->get('/', 'StatusController@index');
        $router->get('/{id}', 'StatusController@show');
        $router->get('/{id}/delete', 'StatusController@destroy');
        $router->post('/', 'StatusController@store');
        $router->put('/{id}', 'StatusController@update');
        $router->delete('/{id}', 'StatusController@destroy');
    });

    $router->group(['prefix' => 'statusAFE'], function () use ($router) {
        $router->get('/', 'StatusAFEController@index');
        $router->get('/{id}', 'StatusAFEController@show');
        $router->get('/{id}/delete', 'StatusAFEController@destroy');
        $router->post('/', 'StatusAFEController@store');
        $router->put('/{id}', 'StatusAFEController@update');
        $router->delete('/{id}', 'StatusAFEController@destroy');
    });
});

$router->group(['prefix' => 'outlet'], function () use ($router) {
    $router->group(['prefix' => 'outletMain'], function () use ($router) {
        $router->get('/', 'OutletMainController@index');
        $router->get('/count', 'OutletMainController@count');
        $router->get('/countAfe', 'OutletMainController@countAfe');
        $router->get('/getLangLotOutlet', 'OutletMainController@getLangLotOutlet');
        $router->get('/{id}', 'OutletMainController@show');
        $router->get('/getLangLotOutletById/{id}', 'OutletMainController@getLangLotOutletById');
        $router->get('/getOutletByWpMain/{id}', 'OutletMainController@getOutletByWpMain');
        $router->get('/countOutletByWp/{id}', 'OutletMainController@countOutletByWp');
        $router->get('/getOutletByKodePemda/{id}', 'OutletMainController@getOutletByKodePemda');
        $router->get('/countOutletByKodePemda/{id}', 'OutletMainController@countOutletByKodePemda');
        $router->get('/getOutletByJenisPajak/{id}', 'OutletMainController@getOutletByJenisPajak');
        $router->get('/countOutletByJenisPajak/{id}', 'OutletMainController@countOutletByJenisPajak');
        $router->get('/getOutletByStatus/{id}', 'OutletMainController@getOutletByStatus');
        $router->get('/countOutletByStatus/{id}', 'OutletMainController@countOutletByStatus');
        $router->get('/{id}/delete', 'OutletMainController@destroy');
        $router->post('/', 'OutletMainController@store');
        $router->put('/{id}', 'OutletMainController@update');
        $router->delete('/{id}', 'OutletMainController@destroy');
    });

    $router->group(['prefix' => 'jenisPajak'], function () use ($router) {
        $router->get('/', 'JenisPajakController@index');
        $router->get('/{id}', 'JenisPajakController@show');
        $router->get('/{id}/delete', 'JenisPajakController@destroy');
        $router->post('/', 'JenisPajakController@store');
        $router->put('/{id}', 'JenisPajakController@update');
        $router->delete('/{id}', 'JenisPajakController@destroy');
    });

    $router->group(['prefix' => 'statusOutlet'], function () use ($router) {
        $router->get('/', 'StatusOutletController@index');
        $router->get('/{id}', 'StatusOutletController@show');
        $router->get('/{id}/delete', 'StatusOutletController@destroy');
        $router->post('/', 'StatusOutletController@store');
        $router->put('/{id}', 'StatusOutletController@update');
        $router->delete('/{id}', 'StatusOutletController@destroy');
    });

    $router->group(['prefix' => 'AFEOutlet'], function () use ($router) {
        $router->get('/', 'AFEOutletController@index');
        $router->get('/{id}', 'AFEOutletController@show');
        $router->get('/getOutletMainByAFEOutletId/{id}', 'AFEOutletController@getOutletMainByAFEOutletId');
        $router->get('/{id}/delete', 'AFEOutletController@destroy');
        $router->post('/', 'AFEOutletController@store');
        $router->put('/{id}', 'AFEOutletController@update');
        $router->delete('/{id}', 'AFEOutletController@destroy');
    });

    $router->group(['prefix' => 'jenisAmount'], function () use ($router) {
        $router->get('/', 'JenisAmountController@index');
        $router->get('/{id}', 'JenisAmountController@show');
        $router->get('/{id}/delete', 'JenisAmountController@destroy');
        $router->post('/', 'JenisAmountController@store');
        $router->put('/{id}', 'JenisAmountController@update');
        $router->delete('/{id}', 'JenisAmountController@destroy');
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Models\KategoriWP;
use App\Http\Controllers\WPMainController;
use App\Http\Controllers\AFEMainController;
use App\Http\Controllers\AFEOutletController;
use App\Http\Controllers\JenisAmountController;
use App\Http\Controllers\JenisPajakController;
use App\Http\Controllers\KategoriAFEController;
use App\Http\Controllers\OutletMainController;
use App\Http\Controllers\ProdukAFEController;
use App\Http\Controllers\StatusAFEController;
use App\Http\Controllers\StatusOutletController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// csrf token
Route::post('/csrf-cookie', function (Request $request) {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the SIMPADE API'
    ]);
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register');
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/me', 'me');
        Route::get('/logout', 'logout');
    });
});

Route::prefix('wp')->middleware(['auth:sanctum'])->group(function () {
    Route::controller(WPMainController::class)->prefix('wp')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(KategoriWP::class)->prefix('kategori')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
});

Route::prefix('afe')->middleware(['auth:sanctum'])->group(function () {
    Route::controller(AFEMainController::class)->prefix('afe')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(ProdukAFEController::class)->prefix('produk')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(KategoriAFEController::class)->prefix('kategori')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(StatusAFEController::class)->prefix('status')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(StatusAFEController::class)->prefix('afestatus')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
});

Route::prefix('outlet')->middleware(['auth:sanctum'])->group(function () {
    Route::controller(OutletMainController::class)->prefix('outlet')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(JenisPajakController::class)->prefix('jenispajak')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(StatusOutletController::class)->prefix('status')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(AFEOutletController::class)->prefix('afe')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
    Route::controller(JenisAmountController::class)->prefix('jenisamount')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}/delete', 'destroy');
    });
});

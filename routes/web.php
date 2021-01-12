<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PhpCSController;
use App\Http\Controllers\RedisCSController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('subway.subwayIndex', ['name' => 'James']);
});

Route::get('/subwayIndex', function () {
    return view('subway.subwayIndex', ['name' => 'James']);
});

Route::get('/forKobe/{id}', function ($id) {
    return view('subway.forKobe', ['id' => $id]);
});

Route::group(['prefix' => '/offer/api'], function () {
    Route::get('foo', function () {
        return 'Hello World';
    });

    //laravel一个路由对应多个方法,可以不像下面一样复杂
    Route::post('/{action}', function(App\Http\Controllers\RedisCSController $index, $action){
        return $index->$action();
    });

    Route::group(['prefix' => '/database'], function () {
        Route::post('/mysqlCS', [OfferController::class, 'mysqlCS']);
        Route::post('/phpCS', [PhpCSController::class, 'PhpTest']);
        Route::get('/phpCS', [PhpCSController::class, 'PhpTest']);
        Route::post('/suanfa1', [PhpCSController::class, 'suanfa1']);
        Route::post('/suanfa2', [PhpCSController::class, 'suanfa2']);
        Route::post('/suanfa3', [PhpCSController::class, 'suanfa3']);
        Route::post('/suanfa4', [PhpCSController::class, 'suanfa4']);
        Route::post('/suanfa5', [PhpCSController::class, 'suanfa5']);
        Route::post('/suanfa6', [PhpCSController::class, 'suanfa6']);
        Route::post('/suanfa7', [PhpCSController::class, 'suanfa7']);
        Route::post('/suanfa8', [PhpCSController::class, 'suanfa8']);
        Route::post('/suanfa9', [PhpCSController::class, 'suanfa9']);
        Route::post('/subwayPay', [PhpCSController::class, 'subwayPay']);
        Route::post('/forKobe', [PhpCSController::class, 'forKobe']);
        Route::post('/suanfaCeshi', [PhpCSController::class, 'suanfaCeshi']);
    });

});



//Route::get('/user', [UserController::class, 'index']);
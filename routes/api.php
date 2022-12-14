<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/register',[AuthController::class,"register"]);

// Public Route (Without Authanticaiton)
// Bu kısmın swagger kısmıda şu şekilde artisan serve yaptıktan sonra /swagger kısmından swagger implementation kısmını nasıl yaptığımı görebilirsiniz.
// Bu routelardaki filterelemeler query params şeklinde çalışıyor bilginize...
Route::group(["namespace" => "App\\Http\\Controllers\\Api"], function (){
    Route::get("/get-all-data","SpacexApi@getAllData");

    Route::get("/get-data-by-status/","SpacexApi@getDataByStatus");

    Route::get("/get-data-by-capsule/","SpacexApi@getDataByCapsule");
});

// Bu kısımda postman üzerinden gerekli işlemler şöyle , register route unda giriş yapıyoruz burada parametreleri query params oalrak yolladım ,
// ordan dönen token ile alttaki route lara giriş yaparken bearer token yerine bu tokeni yazarak verilere erişebiliriz

Route::group(["namespace" => "App\\Http\\Controllers\\Api" , "middleware" => "auth:sanctum"], function (){
    Route::get("/get-all-data-with-auth","SpacexApi@getAllData");

    Route::get("/get-data-by-status-with-auth/","SpacexApi@getDataByStatus");

    Route::get("/get-data-by-capsule-with-auth/","SpacexApi@getDataByCapsule");
});




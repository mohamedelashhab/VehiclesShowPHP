<?php

use Illuminate\Http\Request;
use App\Http\Resources\FeatureCollection;
use App\Feature;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//    api/features
Route::get('/features', 'FeaturesController@Index');
Route::post('/features', 'FeaturesController@Create');
Route::put('/features/{feature}', 'FeaturesController@Update');
Route::delete('/features/{feature}', 'FeaturesController@Delete');
Route::get('/features/{feature}', 'FeaturesController@Get');

//        api/makes
Route::get('/makes', 'makesController@Index');
Route::post('/makes', 'makesController@Create');
Route::put('/makes/{make}', 'makesController@Update');
Route::delete('/makes/{make}', 'makesController@Delete');
Route::get('/makes/{make}', 'makesController@Get');


//        api/models
Route::get('/models', 'modelsController@Index');
Route::post('/models', 'modelsController@Create');
Route::put('/models/{model}', 'modelsController@Update');
Route::delete('/models/{model}', 'modelsController@Delete');
Route::get('/models/{mk_id}', 'modelsController@Get');

//        api/vehicles

Route::get('/vehicles', 'vehiclesController@Index');
Route::post('/vehicles', 'vehiclesController@Create');
Route::put('/vehicles/{vehicle}', 'vehiclesController@Update');
Route::delete('/vehicles/{vehicle}', 'vehiclesController@Delete');
Route::get('/vehicles/{vehicle}', 'vehiclesController@Get');
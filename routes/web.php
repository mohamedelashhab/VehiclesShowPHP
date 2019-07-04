<?php
use App\Http\Resources\FeatureCollection;
use App\Feature;


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
    return view('welcome');
});

Route::post('/features', 'FeaturesController@Create');
Route::put('/features/{feature}', 'FeaturesController@Create');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/vehicles', 'vehiclesController@CreateVehicle')->name('vehicle.form');
Route::post('/vehicles','vehiclesController@Create')->name('vehicle.create');
Route::put('/vehicles/{vehicle}','vehiclesController@Create')->name('vehicle.update');
Route::get('/vehicles/{vehicle}', 'vehiclesController@CreateVehicle');
Route::get('/models', 'modelsController@modelForm')->name('model.form');
Route::post('/models', 'modelsController@Create')->name('model.create');
Route::get('/features', 'featuresController@featureForm')->name('feature.form');
Route::post('/features', 'featuresController@Create')->name('feature.create');
Route::get('/makes', 'makesController@makeForm')->name('make.form');
Route::post('/makes', 'makesController@Create')->name('make.create');



Auth::routes();



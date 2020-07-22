<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {

	Route::namespace('Admin')->group(function () {
		Route::get('/modules/{ctrl}/{any?}', 'AdminController@index');
		Route::get('/{any?}', 'AdminController@index');
	});

	Route::namespace('\App\Modules')->group(function () {

		Route::post('/modules/{ctrl}/{method}/{any?}', function(Request $request, $ctrl, $method){
			$ctrl = Str::ucfirst($ctrl);
			$className = 'App\Modules\\' . $ctrl . '\\' . $ctrl . 'AdminController';
			if(!class_exists($className)) abort(404);
			$instance = app()->make($className);
			return $instance->callAction($method, [$request]);
		});

		Route::post('/modules/{ctrl}/{any?}', function(Request $request, $ctrl){
				$ctrl = Str::ucfirst($ctrl);
				$className = 'App\Modules\\' . $ctrl . '\\' . $ctrl . 'AdminController';
				if(!class_exists($className)) abort(404);
				$instance = app()->make($className);
				return $instance->callAction('index', [$request]);
		});
	});



});


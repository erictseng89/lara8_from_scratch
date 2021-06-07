<?php

use Illuminate\Support\Facades\Route;

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
	// This is actually:
	// return view('welcome.blade.php');
	// but the .blade.php is not required for this function.
});

/*
Episode 5 - How laravel loads a view
Can also return json objects

Route::get('/', function() {
	$json = ['foo' => 'bar'];
	return $json;
});
*/
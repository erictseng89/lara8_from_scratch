<?php

use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\fileExists;

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
	return view('posts');
});

Route::get('post/{post}', function ($slug) {
	if (!file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
		return redirect('/');
	}

	$post = cache()->remember(
		"post.{$slug}",
		now()->addHour(),
		fn () => file_get_contents($path)
	);

	return view('post', [
		'post' => $post
	]);
})->where('post', '[A-z_\-]+');

/* 
	Episode 9 - Wildcard constraints
	There are other helper functions in laravel
	->whereAlpha();
	->whereAlphanumeric();
	->whereNumber();
	These do not take the regex second parameter
*/

/*
	Episode 8 - Store blog posts as HTML files
	redirect literally redirects the page if the $path does not exist.

	abort(404);
	abort(404) returns an error screen with 404 not found

	ddd('file does not exist');
	ddd returns the laravel error screen with the inputted error message.
*/

/*
Episode 5 - How laravel loads a view
Can also return json objects

Route::get('/', function() {
	$json = ['foo' => 'bar'];
	return $json;
});
*/
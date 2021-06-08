<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
	// return view('posts', [
	// 	'posts' => Post::all()
	// ]);
	/* $document = YamlFrontMatter::parseFile(
		resource_path('posts/my-first-post.html')
	);

	ddd($document); */

	return view('posts', [
		'posts' => Post::all()
	]);
});

Route::get('/post/{post}', function ($slug) {
	// ddd(Post::find($slug));
	return view('post', [
		'post' => Post::find($slug)
	]);
});

/*
	Episode 12

	$post = array_map(function ($file) {

		$document = YamlFrontMatter::parseFile($file);

		return new Post(
			$document->title,
			$document->slug,
			$document->date,
			$document->excerpt,
			$document->body()
		);
	}, $files);
	
	foreach ($files as $file) {
		$document = YamlFrontMatter::parseFile($file);

		$post[] = new Post(
			$document->title,
			$document->slug,
			$document->date,
			$document->excerpt,
			$document->body()
		);
	} 
*/

/* 
	Episode 11
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
*/

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
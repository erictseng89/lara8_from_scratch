<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
	// We use the request method for finding the value of 'search'.
	// dd(request('search'));

	// Now we want to return the post collection filtered. So we first call the collection, then we can filter it. The get() method should be the final method of the query request and should not be used until the final statement. Original
	// $post = Post::latest()->get();

	$post = Post::latest();

	// The where() function means to use the "WHERE" operator in SQL.
	// The orWhere() function means either OR and.

	if (request('search')) {
		$post
			->where('title', 'like', '%' . request('search') . '%')
			->orWhere('body', 'like', '%' . request('search') . '%');
	}
	return view('posts', [
		'posts' => $post->get(),
		'categories' => Category::all()
	]);
})->name('home');

Route::get('/authors/{author:username}', function (User $author) {
	return view('posts', [
		'posts' => $author->posts,
		'categories' => Category::all()
	]);
})->name('author');

Route::get('/categories/{category:slug}', function (Category $category) {
	return view('posts', [
		'posts' => $category->posts,
		'currentCategory' => $category,
		'categories' => Category::all()
	]);
})->name('category');

Route::get('/post/{post:slug}', function (Post $post) {
	return view('post', [
		'post' => $post,
	]);
});

/* 
	Episode 26
	DB::listen(fn ($query) => logger($query->sql));
*/

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
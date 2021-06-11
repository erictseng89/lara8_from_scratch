<?php

use App\Http\Controllers\PostController;
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

/*
Episode 38
Once we create a controller, we can change really simplify the routing.
Original:
Route::get('/', function () {
Original return statement
})->name('home');
 */

/*
The get() method takes can action as the second parameter.
The action can either be a function, or in this case, an array.
The array's first index is the controller class, the second index is the name of the method called.
 */

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/authors/{author:username}', [PostController::class, 'authorPosts'])->name('author');

// After changing category to use scopeFilter, the route is no longer needed.
// Route::get('/category/{category:slug}', [PostController::class, 'categoryPosts'])->name('category');

Route::get('/post/{post:slug}', [PostController::class, 'show']);

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
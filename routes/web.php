<?php
namespace App;

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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

/**
 * The get() method takes can action as the second parameter.
 * The action can either be a function, or in this case, an array.
 * The array's first index is the controller class, the second index is the name of the method called.
 */
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post/{post:slug}', [PostController::class, 'show']);

/**
 * Registration Routing - Middleware
 *
 * We should not be able to route into the registration page once we are already
 * logged in.
 *
 * We can use laravel middleware to inspect and filter http requests. They are
 * located in the /app/http folders. There are global middleware that will run
 * automatically. These include several web request middleware.
 *
 * There any many route middleware that can be called for routes including:
 * auth, guest, password_confirm, verify and others.
 *
 * The 'guest' middleware can direct users to the registration/login screen or
 * proceed further into the application depending if they are logged in or not.
 *
 */
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

/**
 * SessionsController
 *
 * This is a controller that will control user authentication sessions. It be
 * responsible for the login and logout requests. This route will use the
 * middleware 'auth' to make sure that the user was logged in.
 */
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

// After changing category to use scopeFilter, the route is no longer needed.
// Route::get('/category/{category:slug}', [PostController::class,
// 'categoryPosts'])->name('category');

/*
Episode 38
Once we create a controller, we can change really simplify the routing.
Original:
Route::get('/', function () {
Original return statement
})->name('home');
 */

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
<?php
/*
We start using Controllers when the routes request starts to become complicated. We can extract the contents of the routes request to Controller for better organization. */

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
  public function index()
  {
    // Both of these statements return an array.
    $array1 = request(['search']);

    $array2 = request()->only('search');
    /**
     * It is common convention to name and place the view files of a view controller in its own
     * folder.
     */
    /** The 'filter()' method comes from scopeFilter() in the Post model and takes an array '$filter'.
     * where() returns a collection, where 1st param matches 2nd param.
     * The first param should be a column name, second param is a string
     * first() returns the first collection that matches, which in the case of unique values,
     * would be the only one.
     * firstWhere() combines the where() and first() method.
     */

    // 'currentCategory' => Category::where('slug', request('category'))->first(),

    /**
     * paginate() is a function that can easily add pages to the webpage.
     * If there is no parameter, then the default is 15 items per page.
     * If 1 param, it must be an integer and dictates how many items per page.
     *
     * It'll show number of results, and create numbered links using the
     * ->links() method
     *
     * simplePaginate() is a similar function, but it will only show Next/Previous buttons instead of numbered view.
     */
    return view('post.index', [
      'posts' => Post::latest()
        ->filter(request(['search', 'category', 'author']))
        ->Paginate(6),
    ]);
  }

  public function show(Post $post)
  {
    return view('post.show', [
      'post' => $post,
    ]);
  }

  protected function getPosts()
  {
    // Episode 38
    // Extrated query statement into own function, but an be made cleaner with query scopes.
    // The function is simple enough to inline.
    return Post::latest()->filter()->get();
  }
  /*
Original
// We use the request method for finding the value of 'search'.
// dd(request('search'));

// Now we want to return the post collection filtered. So we first call the collection, then we can filter it. The get() method should be the final method of the query request and should not be used until the final statement. Original
// $post = Post::latest()->get();
$post = Post::latest();

// The where() function means to use the "WHERE" operator in SQL.
// The orWhere() function means either OR and.

if (request('search')) {
return $post
->where('title', 'like', '%' . request('search') . '%')
->orWhere('body', 'like', '%' . request('search') . '%');
};
 */
}

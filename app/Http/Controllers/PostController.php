<?php
/* 
We start using Controllers when the routes request starts to become complicated. We can extract the contents of the routes request to Controller for better organization. */

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostController extends Controller
{
	public function index()
	{
		// Both of these statements return an array.
		$array1 = request(['search']);

		$array2 = request()->only('search');

		return view('posts', [
			// The 'filter()' method comes from scopeFilter() in the Post model and takes an array '$filter'.
			// Original we allowed the method to simply read "request('search')", but now that it has been changed to an array, we need to pass through the variable as an array.

			'posts' => Post::latest()->filter(request(['search']))->get(),
			'categories' => Category::all()
		]);
	}

	public function show(Post $post)
	{
		return view('post', [
			'post' => $post,
		]);
	}

	public function authorPosts(User $author)
	{
		return view('posts', [
			'posts' => $author->posts,
			'categories' => Category::all()
		]);
	}
	public function categoryPosts(Category $category)
	{
		return view('posts', [
			'posts' => $category->posts,
			'currentCategory' => $category,
			'categories' => Category::all()
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'slug',
    'excerpt',
    'body',
    'category_id',
    'user_id',
  ];

  protected $with = ['category', 'author'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Scope a query to filter results based on filter term
   *
   * @param  \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopefilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, fn($query, $search) =>
      $query->where(fn($query) => // This section adds "closure" to the SQL query.
        $query->where('title', 'like', '%' . $search . '%')
          ->orwhere('body', 'like', '%' . $search . '%')
      )
    );
    // This was the original without the closure.
    // This is resulted in queries that resulted in a OR capacity, rather than AND
    // $query->when($filters['search'] ?? false, fn($query, $search) =>
    //   $query
    //     ->where('title', 'like', '%' . $search . '%')
    //     ->orwhere('body', 'like', '%' . $search . '%'));

    $query->when($filters['category'] ?? false, fn($query, $category) =>
      $query->whereHas('category', fn($query) =>
        $query->where('slug', $category)
      )
    );

    $query->when($filters['author'] ?? false, fn($query, $author) =>
      $query->whereHas('author', fn($query) =>
        $query->where('username', $author)
      )
    );

    // Below is a very semantic method of
    // SELECT * FROM posts p
    // WHERE EXISTS
    // (SELECT * FROM categories c WHERE c.id = p.category_id AND c.slug = $category)
    //
    /*  $query->when($filters['category'] ?? false, fn($query, $category) => $query
  ->whereExists(fn($query) => $query
  ->from('categories')
  ->whereColumn('categories.id', 'posts.category_id')
  ->where('categories.slug', $category))
  ); */

  }

  /**
   * Scope a query to return search term if present, otherwise do nothing.
   *
   */
  public function scopefilterOld($query, array $filters)
  {
    if ($filters['search'] ?? false)
    {
      // The ?? is the php8 null safe operator which in this case means to not resolve if false. This if statement replaces: (request('search')). This makes the method much more versatile and not limited to just 1 request.
      $query
        ->where('title', 'like', '%' . request('search') . '%')
        ->orWhere('body', 'like', '%' . request('search') . '%');
    }
  }
}

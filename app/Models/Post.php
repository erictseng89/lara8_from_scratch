<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string|null $published
 * @property string $excerpt
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Category $category
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post filterOld(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
 */
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
      $query
        ->where('title', 'like', '%' . $search . '%')
        ->orWhere('body', 'like', '%' . $search . '%'));

    $query->when($filters['category'] ?? false, fn($query, $category) =>
      $query->whereHas('category', fn($query) =>
        $query->where('slug', $category)));

    $query->when($filters['author'] ?? false, fn($query, $author) =>
      $query->whereHas('author', fn($query) =>
        $query->where('username', $author)));

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

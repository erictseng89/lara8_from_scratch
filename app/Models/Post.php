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
		'user_id'
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
	public function scopefilter($query, array $filter)
	{
		$query->when(
			$filters['search'] ?? false,
			fn ($query, $search) => $query
				->where('title', 'like', '%' . $search . '%')
				->orWhere('body', 'like', '%' . $search . '%')
		);
	}


	/**
	 * Scope a query to return search term if present, otherwise do nothing.
	 *
	 */
	public function scopefilterOld($query, array $filters)
	{
		if ($filters['search'] ?? false) { // The ?? is the php8 null safe operator which in this case means to not resolve if false. This if statement replaces: (request('search')). This makes the method much more versatile and not limited to just 1 request.
			$query
				->where('title', 'like', '%' . request('search') . '%')
				->orWhere('body', 'like', '%' . request('search') . '%');
		}
	}
}

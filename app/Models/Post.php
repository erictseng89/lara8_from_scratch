<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
	public function __construct(public $title, public $slug, public $date, public $excerpt, public $body)
	{
	}
	/* 
	public static function find($slug)
	{
		if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
			throw new ModelNotFoundException();
		}

		return cache()->remember(
			"post.{$slug}",
			now()->addHour(),
			fn () => YamlFrontMatter::parseFile($path)
		);
	}
*/

	public static function find($slug)
	{
		$posts = static::all();
		return $posts->firstWhere('slug', $slug);
	}

	public static function all()
	{
		return collect($files = File::files(resource_path('posts/')))
			->map(fn ($file) => YamlFrontMatter::parseFile($file))
			->map(fn ($document) => new Post(
				$document->title,
				$document->slug,
				$document->date,
				$document->excerpt,
				$document->body()
			));
	}
}

<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{

		$user = User::factory()->create([
			'name' => 'JohnDoe'
		]);

		Post::factory(20)->create([
			'user_id' => $user->id
		]);
	}
}

/* 
	* We can first truncate(remove existing rows) the seeded tables to ensure no duplicates. This is only required if we are using the db:seed command. If we only seed when refreshing the database, truncating is not needed. 
	User::truncate();
	Category::truncate();
	Post::truncate();
*/

/* 		
	* Before episode 28 factory
	! This is using hardcoding and inefficient
	$user = User::factory()->create();

	// * This function will also add new categories:

	$personal = Category::create([
		'name' => 'Personal',
		'slug' => 'personal'
	]);

	$hobbies = Category::create([
		'name' => 'Hobbies',
		'slug' => 'hobbies'
	]);
	$work = Category::create([
		'name' => 'Work',
		'slug' => 'work'
	]);

	Post::create([
		'category_id' => $personal->id,
		'user_id' => $user->id,
		'title' => 'My Personal post',
		'slug' => 'my-personal-post',
		'excerpt' => 'personal excerpt',
		'body' => '<p>personal body</p>'
	]);
	Post::create([
		'category_id' => $hobbies->id,
		'user_id' => $user->id,
		'title' => 'My hobbies post',
		'slug' => 'my-hobbies-post',
		'excerpt' => 'hobbies excerpt',
		'body' => '<p>hobbies body</p>'
	]);
	Post::create([
		'category_id' => $work->id,
		'user_id' => $user->id,
		'title' => 'My work post',
		'slug' => 'my-work-post',
		'excerpt' => 'work excerpt',
		'body' => '<p>work body</p>'
	]); 
*/

/* 
	The default function seeds the database with 10 users
	User::factory(10)->create();
*/
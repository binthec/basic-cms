<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->truncate();
		DB::table('users')->insert([
			[
				'name' => 'admin',
				'password' => bcrypt('aaaaaaaa'),
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			]
		]);
	}

}

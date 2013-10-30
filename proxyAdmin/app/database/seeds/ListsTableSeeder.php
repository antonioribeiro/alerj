<?php

class ListsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		$table = 'dbo.lists';

		DB::unprepared("SET IDENTITY_INSERT $table ON");

		DB::table($table)->truncate();

		$id = 1;

		DB::table($table)->insert([
						'id' => $id++,
						'name' => 'facebook',
						'created_at' => new DateTime, 
						'updated_at' => new DateTime,			
					]);

		DB::table($table)->insert([
						'id' => $id++,
						'name' => 'youtube',
						'created_at' => new DateTime, 
						'updated_at' => new DateTime,			
					]);

		DB::table($table)->insert([
						'id' => $id++,
						'name' => 'tumblr',
						'created_at' => new DateTime, 
						'updated_at' => new DateTime,			
					]);

		DB::unprepared("SET IDENTITY_INSERT $table OFF");
	}

}

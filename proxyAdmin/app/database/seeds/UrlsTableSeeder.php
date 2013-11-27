<?php

class UrlsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		$table = 'dbo.urls';

		DB::unprepared("SET IDENTITY_INSERT $table ON");

		DB::table($table)->truncate();

		$id = 1;

		$urls = [
					['name' => 'facebook', 'url' => 'facebook.com'],
					['name' => 'facebook', 'url' => 'facebook.com.br'],
					['name' => 'facebook', 'url' => 'facebook.fr'],
					['name' => 'facebook', 'url' => 'pt-br.facebook.com'],
					['name' => 'facebook', 'url' => 'www.facebook.com'],
					['name' => 'facebook', 'url' => 'www.facebook.com.br'],
					['name' => 'facebook', 'url' => 'www.facebook.fr'],

					['name' => 'youtube' , 'url' => 'youtu.be'],
					['name' => 'youtube' , 'url' => 'youtube.com'],
					['name' => 'youtube' , 'url' => 'youtube.co'],
					['name' => 'youtube' , 'url' => 'googlevideo.com'],
					['name' => 'youtube' , 'url' => 'ytimg.com'],

					['name' => 'playboy' , 'url' => 'b.scorecardresearch.com'],
					['name' => 'playboy' , 'url' => 'pictures.playboy.com'],
					['name' => 'playboy' , 'url' => 'pixel.quantserve.com'],
					['name' => 'playboy' , 'url' => 'playboy.com'],
					['name' => 'playboy' , 'url' => 'static2.playboy.com'],
					['name' => 'playboy' , 'url' => 'playboy.abril.com.br'],
					['name' => 'playboy' , 'url' => 'playboy.com.br'],
					
				];

		foreach ($urls as $url)
		{
			DB::table($table)->insert([
							'id' => $id++,
							'list_id' => BlockingList::where('name', $url['name'])->first()->id,
							'url' => $url['url'],
							'created_at' => new DateTime, 
							'updated_at' => new DateTime,			
						]);
		}

		DB::unprepared("SET IDENTITY_INSERT $table OFF");
	}

}

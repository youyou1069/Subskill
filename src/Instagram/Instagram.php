<?php


namespace App\Instagram;


class Instagram
{


	public function index()
	{
		$access_token = '21699788093.18e7a59.c4f575ed545640b4ac4e3e35f7f5c022';
		$photo_count =5;
		$json_link = 'https://api.instagram.com/v1/users/self/media/recent/?';
		$json_link .="access_token={$access_token}&count={$photo_count}";
		$json = file_get_contents($json_link);


return json_decode( $json, true );
	}
}
<?php 
	/*
	 * Template Name: Zoom Callback Page
	 * * @link https://codex.wordpress.org/Template_Hierarchy
	 * @page FullyBossed
	 * @since FullyBossed 1.0
	 */
	
	get_header(); 
	include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/fullybossed/zoom-api/zoom-config.php';
	include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/fullybossed/zoom-api/class-db.php';
	include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/fullybossed/zoom-api/vendor/autoload.php';
	try {
		$client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
		
		$response = $client->request('POST', '/oauth/token', [
			"headers" => [
				"Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
			],
			'form_params' => [
				"grant_type" => "authorization_code",
				"code" => $_GET['code'],
				"redirect_uri" => REDIRECT_URI
			],
		]);
		
		$token = json_decode($response->getBody()->getContents(), true);
		
		
		if(is_table_empty() == false) {
			print_r($token);
			update_access_token(json_encode($token));
			echo "Access token inserted successfully.";
		} else {
			$is_table_empty = is_table_empty();
			print_r($is_table_empty);
		}
	} catch(Exception $e) {
		echo $e->getMessage();
	}
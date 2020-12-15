<?php

// RegEx pattern to check th URL
$pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

if (isset($_GET['url'])) {
	$url = $_GET['url'];

	// URL checker
	if (preg_match($pattern, $url)) {

		// add HTTP protocle if the url doesn't start with it, e.g: www.example.com => http://www.example.com
		$url = preg_match("/(?:http)/", $url) ? $url : 'http://'.$url;

		// open JSON file that is used as a database;
		$urls = file_get_contents('urls.json');
		$urls = json_decode($urls, true); // turning it into array


		// we check if the URL doesn't exist
		if (!isset($urls[$url])) {

			// well Am making a for loop to force the program to keep generating URLS till find available one
			for ($i = 0; $i < 1; $i++) {
				$shortURL = generateRandomString();

				// if the short url available
				if (!in_array($shortURL, $urls)) {
					$urls[$url] = $shortURL;

					$urls = json_encode($urls);
					file_put_contents('urls.json', $urls);

					// response
					echo json_encode(['message' => 'Your URL is ready!', 'url' => 'https://'.$_SERVER['HTTP_HOST'].'/'.$shortURL, 'icon' => 'success']);
				} else {
					// keep trying...
					$i--;
				}
			}
		} else {
			// response
			echo json_encode(['message' => 'Your URL is ready!', 'url' => 'https://'.$_SERVER['HTTP_HOST'].'/'.$urls[$url], 'icon' => 'success']);
		}
	} else {
		// response
		echo json_encode(['message' => 'You need to type or paste valid URL!', 'url' => '<b>'.$url.'</b>this isn\'t a URL', 'icon' => 'error']);
	}
}

// change the length as you want
function generateRandomString($length = 6 /* <<< */) {

	// the characters our short URL will be made of
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
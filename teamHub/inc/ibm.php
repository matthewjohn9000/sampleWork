<?php 

require_once "request-api.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['text'])) {
	
	if(isset($_POST['test'])) {
		
		$res = '{"document_tone":{"tone_categories":[{"tones":[{"score":0.343124,"tone_id":"anger","tone_name":"Anger"},{"score":0.282268,"tone_id":"disgust","tone_name":"Disgust"},{"score":0.070422,"tone_id":"fear","tone_name":"Fear"},{"score":0.187765,"tone_id":"joy","tone_name":"Joy"},{"score":0.148019,"tone_id":"sadness","tone_name":"Sadness"}],"category_id":"emotion_tone","category_name":"Emotion Tone"},{"tones":[{"score":0.0,"tone_id":"analytical","tone_name":"Analytical"},{"score":0.0,"tone_id":"confident","tone_name":"Confident"},{"score":0.0,"tone_id":"tentative","tone_name":"Tentative"}],"category_id":"language_tone","category_name":"Language Tone"},{"tones":[{"score":0.046379,"tone_id":"openness_big5","tone_name":"Openness"},{"score":0.290802,"tone_id":"conscientiousness_big5","tone_name":"Conscientiousness"},{"score":0.586801,"tone_id":"extraversion_big5","tone_name":"Extraversion"},{"score":0.616615,"tone_id":"agreeableness_big5","tone_name":"Agreeableness"},{"score":0.252497,"tone_id":"emotional_range_big5","tone_name":"Emotional Range"}],"category_id":"social_tone","category_name":"Social Tone"}]}}';
	
	} else {

		$username = '3614a6ab-fe7e-441d-9cf8-d6783545471f';
		$password = 'fdMMGYGgwG2l';

		$api = API_Connect("https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone?version=2016-5-19");

		$header = [
			'Content-Type:text/plain'
		];

		$data = "payload=" . json_encode([
				"text"	=> $_POST['text']
			]);
		$res = $api->request([], [
				CURLOPT_ENCODING		=> 'UTF-8',
				CURLOPT_CUSTOMREQUEST	=> 'POST',
				CURLOPT_POSTFIELDS		=> $data,
				CURLOPT_USERPWD			=> "$username:$password",
				CURLOPT_SSL_VERIFYPEER	=> false,
				CURLOPT_HTTPHEADER		=> $header
			]);
	}
	header('Content-Type: application/json');

	echo $res;
	
} else {
	header('HTTP/1.0 404 Not Found');
	die();
}


?>
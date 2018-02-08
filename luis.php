<?php
header('Content-Type: text/html; charset=utf-8');


	$message = "비행기 티켓 하나 사고 싶어염";
	$ch = curl_init();
	$url = 'https://westus.api.cognitive.microsoft.com/luis/v2.0/apps/93fdd300-dff6-44a9-b7ec-31c5399946e7';
	/*URL*/
	$queryParams = '?' . urlencode('subscription-key') . '=7d1f2afcc4974b0da3917c5b5417de53';
	/*Service Key*/
	$queryParams .= '&' . urlencode('q') . '=' . urlencode($message);
	/*주차장 코드*/
	curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$response = curl_exec($ch);
	curl_close($ch);
	
	print_r($response);

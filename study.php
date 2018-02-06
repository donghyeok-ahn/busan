<?php
date_default_timezone_set('Asia/Seoul');
header('Content-Type: text/html; charset=utf-8');
$data = json_decode(file_get_contents('php://input'), true);
$sender = $data['user_key'];
$receive_text = $data['content'];

$uri = explode('/', $_SERVER['REQUEST_URI']);

if($uri[1]=="keyboard"){
   $send_keyboard[type] = "buttons";
   $send_keyboard[buttons] = array("우와 트와이스");
   echo json_encode($send_keyboard);
}

if($uri[1]=="message"){
   if($receive_text=="안녕"){
      $send[message][text] = "안녕하세요";
      $send[message][photo][url] = "http://pds.joins.com/news/component/stardailynews/201605/27/97763_119354_614.jpg";
      $send[message][photo][width] = 640;
      $send[message][photo][height] = 480;	   
      $send[message][message_button][label] = "팬미팅 일정보기";		   
	  $send[message][message_button][url] = "http://naver.com";
      echo json_encode($send);
   }   
 elseif($receive_text=="반가워요"){
      $send[message][text] = "반갑습니다.\n\n어떤 정보를 원하세요?";
      $send[keyboard][type] = "buttons";
      $send[keyboard][buttons][] = "트와이스 팬미팅일정 알려줘";		
      echo json_encode($send);
   }else{
   	
	$send[message][text] = "잘 못알아들었어요";
	echo json_encode($send);
   }
   
   
}

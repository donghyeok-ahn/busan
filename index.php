<?php
date_default_timezone_set('Asia/Seoul');
header('Content-Type: text/html; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);

$sender = $data['user_key'];
$receive_text = $data['content'];

$uri = explode('/', $_SERVER['REQUEST_URI']);

if($uri[1]=="keyboard"){
   $send_keyboard[type] = "buttons";
   $send_keyboard[buttons] = array("라우팅 테스트");
   echo json_encode($send_keyboard);
}

if($uri[1]=="message"){
   if($receive_text=="바보"){
      $send[message][text] = $receive_text;
      $send[message][photo][url] = "http://img.yonhapnews.co.kr/etc/inner/KR/2017/12/22/AKR20171222032200005_01_i.jpg";
      $send[message][photo][width] = 640;
      $send[message][photo][height] = 640;
      $send[keyboard][type] = "buttons";
      $send[keyboard][buttons][] = "라우팅 테스트";

      echo json_encode($send);
   }else{
      $send[message][text] = $receive_text;
      $send[message][photo][url] = "http://img.yonhapnews.co.kr/etc/inner/KR/2017/12/22/AKR20171222032200005_01_i.jpg";
      $send[message][photo][width] = 640;
      $send[message][photo][height] = 640;
      $send[keyboard][type] = "buttons";
      $send[keyboard][buttons][] = "바보";

      echo json_encode($send);
   }
}

<?php
function face_check($image_url){
	$url = 'https://southeastasia.api.cognitive.microsoft.com/face/v1.0/detect?returnFaceId=true&returnFaceLandmarks=false&returnFaceAttributes=age,gender,smile';
	$api_key ='8e7718232e6a43b991d7984543dc9a48';
	//$image_url = 'https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-9/19247766_1347944135320230_6231590026415174757_n.jpg?oh=d88153eb6fd6f579aadf0045efd3a076&oe=59E761E4';
	
	$post_data = array(
	   "url" => "$image_url"
	);
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
	json_encode($post_data)
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	   'Content-Type: application/json',
	   'Ocp-Apim-Subscription-Key:'.$api_key
	));
	$image_json_string = curl_exec($ch);
	curl_close($ch);
	$image_string = json_decode($image_json_string);
	
	
	$smile = $image_string[0]->faceAttributes->smile;
	$age =  $image_string[0]->faceAttributes->age;
	$gender =  $image_string[0]->faceAttributes->gender;
	$moustache = $image_string[0]->faceAttributes->facialHair->moustache;
	$beard = $image_string[0]->faceAttributes->facialHair->beard;
	$sideburns = $image_string[0]->faceAttributes->facialHair->sideburns;
	$glasses =  $image_string[0]->faceAttributes->glasses;
	$anger = $image_string[0]->faceAttributes->emotion->anger;
	$contempt = $image_string[0]->faceAttributes->emotion->contempt;
	$disgust = $image_string[0]->faceAttributes->emotion->disgust;
	$fear = $image_string[0]->faceAttributes->emotion->fear;
	$happiness = $image_string[0]->faceAttributes->emotion->happiness;
	$neutral = $image_string[0]->faceAttributes->emotion->neutral;
	$sadness = $image_string[0]->faceAttributes->emotion->sadness;
	$surprise = $image_string[0]->faceAttributes->emotion->surprise;
	$neutral = $image_string[0]->faceAttributes->emotion->neutral;
	if(!$gender) $gender_string = "셀카 분석에 실패했어요 혹시 셀카사진이 아닌것 같은데용";
	if($gender =="male") $gender_string = "사진을 보내주신 분은 남성분이시네요.(하트뿅)\n";
	if($gender =="female") $gender_string = "사진을 보내주신 분은 여성분이시네요.(하트뿅)\n";
	if($smile >=0.5 AND $gender =="male") $smile_string = "웃는 모습이 멋지시네요.";
	if($smile >=0.5 AND $gender =="female") $smile_string = "웃는 모습이 예쁘시네요.";
	if($anger >= 0.5) $smile_string = "혹시 화나신거 아니시죠?(흑흑)";
	if($smile <0.5) $smile_string = "웃는 얼굴로 다시 한번 찍어보세요. 웃는 모습이 더욱 좋을 것 같애요";
	$string = "지금부터 셀카를 분석해 볼게요(하하)\n뚜둥 뚜둥(놀람)\n\n";
	$string .= $gender_string;
	$string .= "\n다음으로 얼굴 표정을 파악해볼게요. 잠시만 기다려주세요 \n\n";
	$string .= $smile_string;
	$string .= "\n이제 나이를 한번 추정해볼까요~ \n나이는" . $age ."로 결과가 나왔어요.\n동안이신가요? 노안이신가요? 그에 대한 판단은 제가 하진 않을거에요(흑흑)"; 
	
	return $string;
}

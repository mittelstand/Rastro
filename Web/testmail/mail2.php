<?php

$dir = $_SERVER["DOCUMENT_ROOT"];

include $dir.'/gmail/MAIL.php';
include $dir."/inc/header/inc.php";

$email = "sy0773@naver.com";
$code = get_random_string(6,'az').get_random_string(3,'09');

$m = new MAIL;
$m->From('siyeol0773@gmail.com',"백시열");
$m->AddTo($email);
$m->Subject('[dictail] 인증메일 입니다.');//http://rastro.kr/emailAc.php?code='.$code.'&mail='.$email.
$m->Html('<a href = "http://rastro.kr/emailAc.php?code='.$code.'&mail='.$email.'">인증하기</a>');
$c = $m->Connect('smtp.gmail.com', 465, 'siyeol0773@gmail.com', 'mailmail@', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));
$m->Send($c);
$m->Disconnect();

?>
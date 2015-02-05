<?php

$dir = $_SERVER["DOCUMENT_ROOT"];

include $dir.'/gmail/MAIL.php';

$email = "sy0773@naver.com";

$m = new MAIL;
$m->From('siyeol0773@gmail.com',"백시열");
$m->AddTo($email);
$m->Subject('[dictail] 인증메일 입니다.');
$m->Html('<a href = "http://rastro.kr/emailAc.php">인증하기</a>');
$c = $m->Connect('smtp.gmail.com', 465, 'siyeol0773@gmail.com', 'mailmail@', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));
$m->Send($c);
$m->Disconnect();

?>
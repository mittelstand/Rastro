<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir.'/gmail/MAIL.php';
$m = new MAIL;
$m->From('yusng00@naver.com',"������");
$m->AddTo("yusng00@naver.com");
$m->Subject('��Ʈ�� �������� �Դϴ�.');
$m->Html("<a href=\"http://www.nate.com\">��ũ</a>fff");
$c = $m->Connect('smtp.gmail.com', 465, 'ysmin0914@gmail.com', 'messagebox11', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));
$m->Send($c);
$m->Disconnect();

?>

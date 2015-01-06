<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
echo $_FILES['fil']['tmp_name']."<br/>";


preg_match_all("/\.[a-z]{3,}/", $_FILES['fil']['name'], $output);
echo "이 파일의 확장자는 ".$output[0][0]." 입니다.";
?>
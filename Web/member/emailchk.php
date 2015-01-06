<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$mail = HtmlToText($_POST['email'])."@".(($_POST['emailFooter2']) ? $_POST['emailFooter2'] : $_POST['emailFooter']);
$db = new Dbcon();
$db->table = "member";
$db->where="email='".$mail."'";
$row=$db->TotalCnt();

if($row>0){
	$i=1;
	?>
{"value":[{"email":"이메일이 중복 입니다.","i":"<?=$i?>"}]}

<?
}else{?>
{"value":[{"i":"<?=$i?>"}]}

<?
}
unset($db);
?>

<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

switch($_POST['title']){
	case "준회원":
		$num = 1;
		break;
	case "정회원":
		$num = 2;
		break;
}
$db = new Dbcon();
$db->table = "member";
$db->field = "authority = '".$num."'";
$db->where = "id = '".$_POST['id']."'";
$db->Update();


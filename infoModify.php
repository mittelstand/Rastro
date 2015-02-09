<?
	header("Content-type: text/html; charset=utf-8"); 
	$dir = $_SERVER["DOCUMENT_ROOT"];
	include $dir."/inc/header/inc.php";
	
	$db = new Dbcon();
	$db->table = "member";
	$birth = $_POST["birthYear"]."-".$_POST["birthMonth"]."-".$_POST["birthDay"];
	$uploadDir = $dir."/file/";

	echo $_FILES["picture"];
	echo $_POST["fbChange"];


?>

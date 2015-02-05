<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->field = "email";
$db->where = "idx=".$_SESSION['idx'];
$row = mysql_fetch_assoc($db->Select());

	if($row["email"] == $_POST["email"]){
		echo "{\"loginChk\":\"false\"}";
		unset($db);
	}else{
		$db->keyfield = "idx";
		$db->where = "email='".$_POST['email']."'";
		if($db->TotalCnt() > 0){
			echo "{\"loginChk\":\"true\"}";
		}else{
			echo "{\"loginChk\":\"false\"}";
		}
		unset($db);
	}
?>


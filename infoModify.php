<?
	header("Content-type: text/html; charset=utf-8"); 
	$dir = $_SERVER["DOCUMENT_ROOT"];
	include $dir."/inc/header/inc.php";
	
	$db = new Dbcon();
	$db->table = "member";
	$birth = $_POST["birthYear"]."-".$_POST["birthMonth"]."-".$_POST["birthDay"];
	$db->field = "email = '".$_POST["email"]."', name='".$_POST["name"]."', dob='".$birth."', sex='".$_POST["sex"]."'";
	$db->where = "idx=".$_SESSION['idx'];

	$db->Update();
?>
<script>
location.href = "/info.php";
</script>
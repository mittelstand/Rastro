<?
	header("Content-type: text/html; charset=utf-8"); 
	$dir = $_SERVER["DOCUMENT_ROOT"];
	include $dir."/inc/header/inc.php";
	
	$db = new Dbcon();
	$db->table = "member";
	$birth = $_POST["birthYear"]."-".$_POST["birthMonth"]."-".$_POST["birthDay"];
	$uploadDir = $dir."/file/";

	if($_FILES["picture"]){
		$exp = explode(".",$_FILES["picture"]["name"]);

		$newName = $uploadDir.time().$_SESSION["idx"].".".$exp[1];
		$db->field = "email = '".$_POST["email"]."', name='".$_POST["name"]."', dob='".$birth."', sex='".$_POST["sex"]."', Ps='".$newName."'";
		move_uploaded_file($_FILES['picture']['tmp_name'], $newName);
	}else{
		if($_POST["fbChange"] != ""){
			$db->field = "email = '".$_POST["email"]."', name='".$_POST["name"]."', dob='".$birth."', sex='".$_POST["sex"]."', Ps='".$_POST["fbChange"]."'";
		}else{
			$db->field = "email = '".$_POST["email"]."', name='".$_POST["name"]."', dob='".$birth."', sex='".$_POST["sex"]."'";
		}
	}
	
	$db->where = "idx=".$_SESSION['idx'];	
	$db->Update();
?>
<script>
location.href = "/info.php";
</script>
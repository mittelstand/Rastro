<?header("content-type:text/html; charset=utf-8");
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
	
	MsgBox("정말 삭제하시겠습니까?", "/index.php");
	
	$db = new DbCon();
	$db->table = "member";
	$db->where = "email = '".$_SESSION['id']."'";
	$rel = $db->Select();
	$row = mysql_fetch_assoc($rel);
	$db->Delete();
	
	$db->table = "member_trash";
	$db->field = "id, name, email, pwd, phone, sex, authority, mdate, cdate";
	$db->value = "'".$row['id']."','".$row['name']."','".$row['email']."','".$row['pwd']."','".$row['phone']."','".$row['sex']."','".$row['authority']."','".$row['mdate']."','".$row['cdate']."'";
	
	$db->Insert();

	unset($_SESSION['id']);
	unset($_SESSION['idx']);



?>


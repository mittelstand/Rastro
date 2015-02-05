<?header("content-type:text/html; charset=utf-8");
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
if(!$_POST){
	MsgBox("잘못된 접근입니다.","back");
	exit;
}
	$db = new DbCon();
	$db->table = "member";
	$db->where = "id = '".$_SESSION['id']."'";
	$row = mysql_fetch_assoc($rel);
	$db->Delete();
	$db->table = "member_trash";
	$db->field = "id, name, email, pwd, phone, sex, authority, mdate, cdate";
	$db->value = "'".$row['id']."','".$row['name']."','".$row['email']."','".$row['pwd']."','".$row['phone']."','".$row['sex']."','".$row['authority']."','".$row['mdate']."','".$row['cdate']."'";
	echo $db->value;
	$db->Insert();


?>

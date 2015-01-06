<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
?>
<?
	$db = new Dbcon();
	$db->table = "member";
	$db->field = "id, name,email,phone";
	$db->where = $_SESSION["id"];
	$sel = $db->Select();
	$row = mysql_fetch_assoc($sel);

	$db->table = "event_member";
	$db->field = "name, phone, email, id, sidx, belong, grp, cdate, mdate";
	$db->value = "'".$row["name"]."','".$_POST["dlfzpphone"]."','".$row["email"]."','".$row["id"]."','".$row["idx"]."','".$row["belong"]."','".$row["grp"]."', 'now()', 'now()'";
	
	$db->Insert();


?>	
<?
include $dir."/inc/footer/mainFooter.php";
?>

<script>
	location.href = "request.php";
</script>
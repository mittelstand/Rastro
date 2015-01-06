<?
header("content-type:text/html; charset=utf-8");
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$db = new Dbcon();
$db->table = "member";
$db->field = "pwd='".md5($_POST['pwd'])."'";
$db->where = "id='".$_SESSION['id']."'";
$db->Update();
unset($db);

?>
<script>
location.href = '/member/join.php';
</script>

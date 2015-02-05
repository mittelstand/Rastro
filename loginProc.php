<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->keyfield = "idx";
$db->field = "idx";
$db->where = "email='".$_POST['email']."' and pwd='".md5($_POST['pwd'])."'";
if($db->TotalCnt() > 0){
	$row = mysql_fetch_array($db->Select());
	$_SESSION['idx'] = $row['idx'];
?>
<script>
	location.href = "/info";
</script>
<?
}else{
	msgBox("아이디 또는 비밀번호를 다시 확인하세요.".md5($_POST['pwd']),"back");
}
unset($db);

?>


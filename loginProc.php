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
	msgBox("���̵� �Ǵ� ��й�ȣ�� �ٽ� Ȯ���ϼ���.".md5($_POST['pwd']),"back");
}
unset($db);

?>


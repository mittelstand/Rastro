<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$exp = explode("_",$_GET['code']);
$db = new Dbcon();
$db->table = "member";
$db->keyfield = "idx";
$db->where = "tempEmail = ''";
if($db->TotalCnt() <= 0){
	$db->field = "email = tempEmail , tempEmail = ''";
	$db->where = "idx='".$exp[1]."' and emailCode='".$exp[0]."'";
	$db->Update();

	if($db->TotalCnt() > 0){
		unset($db);
		?>
	<script>
		location.href = "/pwEmailAcS.php";
	</script>
		<?
		exit();
	}else{
		unset($db);
		?>
	<script>
		location.href = "/pwEmailAcF.php";
	</script>
		<?
		exit();
	}
}else{
	unset($db);
?>
	<script>
		location.href = "/pwEmailAcF.php";
	</script>
<?
	exit();
}
?>
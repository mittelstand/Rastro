<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir."/option.php";


$db =  new Dbcon();
$db->table = "member";
$db->field = "id";
foreach($_POST['number'] as $key=>$val){	
	$db->where = "id= '".$val."'";
	if($db->TotalCnt() > 0){
		$db->Delete();
		$msg = "삭제 되었습니다.";
	}else{
		$msg = "권한 없습니다.";
	}
}








unset($db);



?>
<script>

location.href = "/member/memberList.php";
</script>
<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table="member";
$db->where = "email='".$_POST['email']."'";
$cnt = $db->TotalCnt();
if($cnt<0){
 echo "fail";

}else{
	$db->field="idx";
	$sel = $db->Select();
	$row =mysql_fetch_array($sel);

	echo $row['idx'];
	
}

unset($db);
  
?>

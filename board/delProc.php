<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir."/option.php";

$key = $_POST['key'];
$db =  new Dbcon();
$db->table = $option[$key]['table'];
$db->keyfield = $option[$key]['keyfield'];
if($_SESSION['admin'] == "1"){ 
	$db->where = $option[$key]['keyfield'] ."= '".$_POST[($option[$key]['keyName'])]."'";
	
		
	
}else{
	$db->where = $option[$key]['keyfield'] ."= '".$_POST[($option[$key]['keyName'])]."'";
	if($_POST['tab']){
		$db->where = "tab='".$_POST['tab']."' and fidx='".$_POST['fidx']."' and writer='".$_SESSION['id']."'";
	}



}

//echo $db->where;

if($db->TotalCnt() > 0){
	$db->Delete();
	$msg = "삭제 되었습니다.";

}else{
	$msg = "권한이 없습니다.";
}



$ret = explode("&",$option[$key]['delVal']);
$returnVal = str_replace("http://".$_SERVER['SERVER_NAME'],"",$option[$key]['delRet'].$_POST['type']);
$folder = explode("_",$k);
$returnVal = str_replace("{folder}",$folder[0],$returnVal);

foreach($ret as $key=>$val){
	if(preg_match("/([a-zA-Z0-9_]{1,})\=([a-zA-Z0-9_]{1,})/",$val,$arr)){
		$returnVal = AddParam($returnVal,$arr[1]."=",$_POST[$arr[2]]);
	}else{
		$returnVal = AddParam($returnVal,$val."=",$_POST[$val]);
	}
	echo $_POST[$arr[2]];
}


unset($db);




?>
<script>
alert("<?=$msg?>");
location.href = "<?=$returnVal?>";
</script>
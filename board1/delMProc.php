<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir."/option.php";

$k = KeyReplace($_SERVER['HTTP_REFERER']);
$mkey = $_POST['key'];
$db =  new Dbcon();
$db->table = $option[$mkey]['table'];
$db->keyfield = $option[$mkey]['keyfield'];

foreach($_POST['number'] as $key=>$val){	
	$db->where = $option[$mkey]['keyfield'] ."= '".$val."'";
	if($db->TotalCnt() > 0){
		$db->Delete();
		$msg = "���� �Ǿ����ϴ�.";
	}else{
		$msg = "������ �����ϴ�.";
	}
}






$returnVal = str_replace("http://".$_SERVER['SERVER_NAME'],"",$option[$mkey]['delRet'].$_POST['type']);
$folder = explode("_",$k);
$returnVal = str_replace("{folder}",$folder[0],$returnVal);

if($option[$mkey]['delVal']){
	$ret = explode("&",$option[$key]['delVal']);
	foreach($ret as $key=>$val){
		if(preg_match("/([a-zA-Z0-9_]{1,})\=([a-zA-Z0-9_]{1,})/",$val,$arr)){
			$returnVal = AddParam($returnVal,$arr[1]."=",$_POST[$arr[2]]);
		}else{
			$returnVal = AddParam($returnVal,$val."=",$_POST[$val]);
		}
	}
}

unset($db);



?>
<script>
alert("<?=$msg?>");
location.href = "<?=$returnVal ?>";
</script>
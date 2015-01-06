<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

//echo $_FILES['arrow']['name'];
$fl = explode(".",$_FILES['arrow']['name']);
$flExp = $fl[1];

$fl2 = explode(".",$_POST['imgMain']);
$flName = $fl2[0];

foreach($_FILES['arrow'] as $key=>$val){
	echo "[".$key."]".$val;
}
$file = "img/select/".$flName."_arrow.".$flExp;
copy($_FILES['arrow']['tmp_name'],$file);
$db = new Dbcon();
$db->table = "selectCss";
if($flName){
	$db->field = "ImgArrowOn='".$flName."_arrow.".$flExp."', align='".$_POST['align']."', widPosi='".$_POST['widPosi']."',hidPosi='".$_POST['hidPosi']."' ,leftPadding='".$_POST['leftPadding']."' ,rightPadding='".$_POST['rightPadding']."' ,topPadding='".$_POST['topPadding']."'";
}else{
	$db->field = "align='".$_POST['align']."', widPosi='".$_POST['widPosi']."',hidPosi='".$_POST['hidPosi']."' ,leftPadding='".$_POST['leftPadding']."' ,rightPadding='".$_POST['rightPadding']."' ,topPadding='".$_POST['topPadding']."'";
}
$db->where = "idx='".$_POST['idx']."'";
$db->Update();

unset($db);


?>
<script>
history.back();
</script>
<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

// 대상 이미지명 
$srcimg = "img/select/".$_POST['fileName']; 

$fl = explode(".",$_POST['fileName']);
$flName = $fl[0];
$flExp = $fl[1];

// 생성 이미지명 
$tgtimg = "img/select/".$flName."_repeat.".$flExp; 




$size = getimagesize($srcimg); 
echo $size[0]."---".$size[1];
// copyresampled 값이 동일하다 why? 이미지의 확대 축소가 발생하지는 않기 때문이다. 
$sc_img_width = $rs_img_width; 
$sc_img_height = $rs_img_height; 

$rs_x =0; 
$rs_y =0; 
switch($flExp){
	case "png": 
		$sc_img = imagecreatefrompng($srcimg); 
		break;
	case "gif": 
		$sc_img = imagecreatefromgif($srcimg); 
		break;
	case "jpg": 
		$sc_img = imagecreatefromjpeg($srcimg); 
		break;
	case "jpeg": 
		$sc_img = imagecreatefromjpeg($srcimg); 
		break;
}

$rs_img = imagecreatetruecolor($size[0],1); 
$bgColor = imagecolorallocate($rs_img,255,255,255);
imagefill($rs_img,0,0,$bgColor);

imagecopyresampled($rs_img, $sc_img, 0, 0, 0, $_POST['posi'], $size[0], 1, $size[0], 1);
//imagecopyresampled($rs_img, $sc_img, 100, 100, 0, 0, 100, 100, 100, 100);

switch($flExp){
	case "png": 
		imagepng($rs_img, $tgtimg, 9);
		break;
	case "gif": 
		imagegif($rs_img, $tgtimg, 100);
		break;
	case "jpg": 
		imagejpeg($rs_img, $tgtimg, 100);
		break;
	case "jpeg": 
		imagejpeg($rs_img, $tgtimg, 100);
		break;
}

$tgtimg = "img/select/".$flName."_last.".$flExp; 
switch($flExp){
	case "png": 
		$sc_img = imagecreatefrompng($srcimg); 
		break;
	case "gif": 
		$sc_img = imagecreatefromgif($srcimg); 
		break;
	case "jpg": 
		$sc_img = imagecreatefromjpeg($srcimg); 
		break;
	case "jpeg": 
		$sc_img = imagecreatefromjpeg($srcimg); 
		break;
}
$lastHid = ($size[1] + ($size[1]-$_POST['posi']));
$rs_img = imagecreatetruecolor($size[0],$lastHid); 
$bgColor = imagecolorallocate($rs_img,255,255,255);
imagefill($rs_img,0,0,$bgColor);


 
imagecopyresampled($rs_img, $sc_img, 0, $size[1], 0, $_POST['posi'], $size[0], ($size[1]-$_POST['posi']), $size[0], ($size[1]-$_POST['posi']));
for($i = ($size[1]-1); $i >= 0; $i--){
	imagecopyresampled($rs_img, $sc_img, 0, $i, 0, $_POST['posi'], $size[0], 1, $size[0], 1);
}
switch($flExp){
	case "png": 
		imagepng($rs_img, $tgtimg, 9);
		break;
	case "gif": 
		imagegif($rs_img, $tgtimg, 100);
		break;
	case "jpg": 
		imagejpeg($rs_img, $tgtimg, 100);
		break;
	case "jpeg": 
		imagejpeg($rs_img, $tgtimg, 100);
		break;
}
imagedestroy($sc_img);
$db = new Dbcon();
$db->table = "selectCss";
$db->keyfield = "idx";
$db->where = "imgMain='".($flName.".".$flExp)."'";

if($db->TotalCnt() <= 0){
	$db->field = "imgMain,imgRepeat,imgLast,wid,hid,ulTop";
	$db->value = "'".($flName.".".$flExp)."','".($flName."_repeat.".$flExp)."','".($flName."_last.".$flExp)."','".$size[0]."','".$size[1]."','".$_POST['posi']."'";
	$db->Insert();
}else{
	$db->field = "imgMain='".($flName.".".$flExp)."',imgRepeat='".($flName."_repeat.".$flExp)."',imgLast='".($flName."_last.".$flExp)."',wid='".$size[0]."',hid='".$size[1]."',ulTop='".$_POST['posi']."'";
	$db->Update();
}

unset($db);
?>
<script>
history.back();
</script>
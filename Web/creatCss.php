<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/cssHeader.php";
unlink($dir."/css/select.css"); 
$fp2 = fopen($dir."/css/select.css", "a+");

$select = "span.select {background:#fafafb;  float:left; position:relative; Box-sizing: border-box;}
span.select button{width:100%; height:100%; }
span.select button span{width:100%; height:100%; background:url('/img/arrow.png') no-repeat right 18px;  font-size:13px !important; Box-sizing: border-box;}
span.select div.bg{ z-index:9998; background-color:#FFF;}
span.select ul{position:absolute; z-index:999999999999;   left:0; margin:0 !important;}
span.select ul li{width:100% !important;  Box-sizing: border-box;line-height:25px; background-color:#FFF; float:left; margin:0 !important;}
span.select ul li a{width:100%; height:100%; Box-sizing: border-box; text-indent:0; text-align:center; font-size:13px !important; display:block;}
span.select ul li a:hover{background-color:#daf3f4;}

span.select div.bg{width:60px; height:150px; background:url('/img/ulback.png') no-repeat 0 -100px; position:absolute;}
span.select ul.limitL{height:145px; overflow:auto;}
span.select ul.limitL{
	scrollbar-face-color:#F7F7F7;
	scrollbar-shadow-color:#FFFFFF;
	scrollbar-highlight-color:#ffffff;
	scrollbar-3dlight-color:#FFFFFF;
	scrollbar-darkshadow-color:#ffffff;
	scrollbar-track-color:#FFFFFF;
	scrollbar-arrow-color:#84d7dc;
}";
fwrite($fp2,$select);

$db = new Dbcon();
$db->table = "selectCss";
$db->field = "idx,imgMain,imgRepeat,imgLast,wid,hid,ulTop,ImgArrowOn,ImgArrowOff,align,widPosi,hidPosi,leftPadding,rightPadding,topPadding"; 
$db->page = "1";
$db->block = "";
$sel2 = $db->Select();
while($row = mysql_fetch_array($sel2)){
	$exp = explode(".",$row['imgMain']);
	$padding = (int)($row['hid']/2) - 12;

$sel = "span.".($exp[0])." {width:".($row['wid'])."px; height:".($row['hid'])."px !important; background:url('/img/select/".($row['imgMain'])."') no-repeat;}
span.".($exp[0])." button span{padding:".(($row['topPadding']) ? $row['topPadding'] :$padding)."px ".(($row['rightPadding']) ? $row['rightPadding'] :"0")."px 0 ".(($row['leftPadding']) ? $row['leftPadding'] :"0")."px; ".((($row['ImgArrowOn']) ? "background:url('/img/select/".$row['ImgArrowOn']."') no-repeat ".$row['widPosi']."px ".$row['hidPosi']."px;":"") )."".(($row['align']) ? ("text-align:".$row['align']) : "")."; }
span.".($exp[0])." ul{width:100%; top:".($row['ulTop'])."px}
span.".($exp[0])." ul li{width:100% !important; height:".($row['hid'])."px !important; background:url('/img/select/".($row['imgRepeat'])."') repeat-y !important;}
span.".($exp[0])." ul li a{padding:".(($row['topPadding']) ? $row['topPadding'] :$padding)."px ".(($row['rightPadding']) ? $row['rightPadding'] :"0")."px 0 ".(($row['leftPadding']) ? $row['leftPadding'] :"0")."px; ".(($row['align']) ? ("text-align:".$row['align']) : "").";}
span.".($exp[0])." ul li:last-child a{height:".($row['hid'])."px !important;}
span.".($exp[0])." ul li:last-child{height:".(($row['hid']+($row['hid']-$row['ulTop']))+1)."px !important; background:url('/img/select/".($row['imgLast'])."') no-repeat !important;}";

echo "<pre>".$sel."</pre>";


	fwrite($fp2,$sel);
}
unset($db);





fclose($fp2);
include $dir."/inc/footer/cssFooter.php";
?>
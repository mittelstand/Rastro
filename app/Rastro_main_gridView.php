<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();

$db->table = "personalList";
$db->where = "type='sc'";
$cnt=$db->TotalCnt();
$val['sc']= $cnt;

$db->where = "type='ca'";
$cnt=$db->TotalCnt();
$val['ca']= $cnt;

$db->where = "type='tr";
$cnt=$db->TotalCnt();
$val['tr']= $cnt;

$db->where = "type='qu'";
$cnt=$db->TotalCnt();
$val['qu']= $cnt;

$db->where = "type='cp'";
$cnt=$db->TotalCnt();
$val['cp']= $cnt;

$db->where = "type='se'";
$cnt=$db->TotalCnt();
$val['se']= $cnt;


echo json_encode($val);




unset($db);
  
?>

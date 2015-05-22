<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();

$db->table = "personalList";
$db->where = "type='sc' and midx='".$_POST['midx']."'";
$cnt=$db->TotalCnt();

$val['type']= $cnt;

$db->where = "type='ca' and midx='".$_POST['midx']."'";
$cnt=$db->TotalCnt();
$val['type']= $cnt;

$db->where = "type='tr' and midx='".$_POST['midx']."'";
$cnt=$db->TotalCnt();
$val['type']= $cnt;

$db->where = "type='qu' and midx='".$_POST['midx']."'";
$cnt=$db->TotalCnt();
$val['type']= $cnt;

$db->where = "type='cp' and midx='".$_POST['midx']."'";
$cnt=$db->TotalCnt();
$val['type']= $cnt;

$db->where = "type='se' and midx='".$_POST['midx']."'";
$cnt=$db->TotalCnt();
$val['type']= $cnt;


echo json_encode($val);




unset($db);
  
?>

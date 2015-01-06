<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
$_GET['page'] = ($_GET['page']) ? $_GET['page'] : 1; 

$keyTab = "board";

$mit =  new Mittel();
$mit->opt = $option['board'];
$mit->block=8;
$row = $mit->outputList();
$cnt = $mit->listCnt;
unset($mit);


?>







<?
include $dir."/inc/footer/mainFooter.php";
?>
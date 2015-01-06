<?$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
echo $_SESSION['id']. $_SESSION['idx'];
;
?>
<?
include $dir."/inc/footer/mainFooter.php";
?>
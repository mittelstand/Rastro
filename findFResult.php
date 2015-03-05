<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

?>
<button type="button" class="btnFJoin" onclick="location.href='<?=$loginUrl?>'" style="margin-bottom:9px;">페이스북으로 로그인</button>

<?
include $dir."/inc/footer/mainFooter.php";
?>
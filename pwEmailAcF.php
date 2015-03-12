<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class = "messageFind">인증에 실패하였습니다.<br/> 다시 확인해 주세요. </div>

<?
include $dir."/inc/footer/mainFooter.php";
?>
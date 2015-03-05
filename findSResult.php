<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

?>
<div class = "message">임시비밀번호가 발급되었습니다. 로그인 하시겠습니까?</div>


<?
include $dir."/inc/footer/mainFooter.php";
?>
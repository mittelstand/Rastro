<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

?>
<div class = "messageFind">임시비밀번호가 발급되었습니다.<br/> 로그인 하시겠습니까?</div>
<button type="submit" class="btnLogin">로그인</button>

<?
include $dir."/inc/footer/mainFooter.php";
?>
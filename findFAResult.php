<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class = "messageFind">아직 회원이 아닙니다.<br/> 가입 하시겠습니까?</div>
<button type="button" class="btnRegist" onclick="location.href = '/join'">가입하기</button>
<?
include $dir."/inc/footer/mainFooter.php";
?>
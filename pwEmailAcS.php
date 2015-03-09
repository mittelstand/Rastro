<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
if($_SESSION['idx'] > 0){
?>
	<div class = "messageFind">인증이 완료되었습니다. </div>
	<button type="button" class="btnRegist" onclick="location.href = '/info'">마이페이지</button>
<? }else{ ?>
	<div class = "messageFind">인증이 완료되었습니다. <br/> 로그인 하시겠습니까?</div>
	<button type="button" class="btnRegist" onclick="location.href = '/login'">로그인</button>
<?
}
include $dir."/inc/footer/mainFooter.php";
?>
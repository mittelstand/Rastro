<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
if($_SESSION['idx'] > 0){
?>
	<div class = "messageFind">������ �Ϸ�Ǿ����ϴ�. </div>
	<button type="button" class="btnRegist" onclick="location.href = '/info'">����������</button>
<? }else{ ?>
	<div class = "messageFind">������ �Ϸ�Ǿ����ϴ�. <br/> �α��� �Ͻðڽ��ϱ�?</div>
	<button type="button" class="btnRegist" onclick="location.href = '/login'">�α���</button>
<?
}
include $dir."/inc/footer/mainFooter.php";
?>
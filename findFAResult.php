<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class = "messageFind">���� ȸ���� �ƴմϴ�.<br/> ���� �Ͻðڽ��ϱ�?</div>
<button type="button" class="btnRegist" onclick="location.href = '/join'">�����ϱ�</button>
<?
include $dir."/inc/footer/mainFooter.php";
?>
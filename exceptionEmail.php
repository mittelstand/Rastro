<?
session_start();

$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<form method="post" action="/joinInsert.php" id="joinForm">
	<div class="leftObj">		
        <span class="text3">이메일 입력하라고 진짜 ㅋㅋㅋㅋ</span>
	</div>
	<ul class="joinForm">
		<li class="email list">
			<!--span class="lab">E-mail</span-->
			<span class="input"><input type="text" name="email" id="email" placeholder="이메일을 입력하세요."/></span><div style="clear:both"></div>
		</li>
	</ul>
</form>
<script>


</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
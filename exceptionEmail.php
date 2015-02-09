<?
session_start();

$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<form method="post" action="/joinInsert.php" id="joinForm">
	<div class="leftObj">		
        <span class="text3">죄송합니다! 이메일을 한번 더 입력해주세요.</span>
	</div>
	<ul class="joinForm">
		<li class="email list">
			<!--span class="lab">E-mail</span-->
			<span class="input"><input type="text" name="email" id="email" placeholder="이메일을 입력하세요."/></span><div style="clear:both"></div>
		</li>
		<li class="email button">
			<!--span class="lab">E-mail</span-->
			<span class="input"><button type="submit" id="emailButton">확인</button></span><div style="clear:both"></div>
		</li>
	</ul>
</form>
<script>


</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
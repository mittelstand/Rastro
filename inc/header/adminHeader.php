
<?
include $dir."/inc/header/globalHeader.php";
if($_SESSION['amin'] != "admin"){
	?>
	<script>
		location.href = "/index.php";
	</script>
	<?
	exit;
}

?>
<div id="header">
	<h1><a href="http://www.socialrainbow.kr/"></a></h1>
	<ul class="gnb">
		<li class="we"><a href="/we/index.php">우리는</a></li>
		<li class="program"><a href="/social/index.php">소셜러닝</a></li>
		<li class="request"><a href="/index.php">신청하기</a></li>
		<li class="epilogue"><a href="/board/index.php">참여후기</a></li>
		<li class="episode"><a href="/gallery/index.php">에피소드</a></li>
	</ul>
</div>
<div id="container">
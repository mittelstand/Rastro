<?$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

$text = "dfsfsdfdsaf<span>dfdfdfd</span>fdfdfdfddddeegfdgfd<div>fdfdfdf</div>";
preg_match_all("/\<[a-z]{1,}\>[a-z0-9가-힣A-Z_]{0,}\<\/[a-z]{1,}\>/",$text,$a);

echo $a[0][0]."<br/>";
echo $a[0][1];
?>
<form action="fileTest.php" method="post" enctype="multipart/form-data">
	<input type="file" name="fil"/>
	<button type="submit">확인</button>
</form>

<?
include $dir."/inc/footer/mainFooter.php";
?>


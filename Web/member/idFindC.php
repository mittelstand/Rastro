<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class="idpwFind contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<?
	$db = new Dbcon();
	$db->table = "member";
	$db->keyfield = "id";
	$db->field = "id";
	$db->where = "email='".$_POST['email']."@".(($_POST['emailFooter']) ? $_POST['emailFooter'] : $_POST['emailFooter2'])."' and phone='".$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']."'";
	$cnt = $db->TotalCnt();
	$id = mysql_fetch_array($db->Select());
	unset($db);
	if( $cnt <= 0){
	?>
	<div class ="idpwFindRe notFind">
		<div class="tit">
		<span class="title"></span></div>
		<div class ="result">
			<span class="tit">아이디찾기 결과</span>
			<span class="idText">bomlove2002</span>
		</div>
		<div class="button" >
			<button type="button" class="reFind"></button>
		</div>
	</div>
	<? }else{ ?>
	<div class ="idpwFindRe idFindWrap">
		<div class="tit">
		<span class="title"></span></div>
		<div class ="result">
			<span class="tit">아이디찾기 결과</span>
			<span class="idText"><?=$id['id']?></span>
		</div>
		<div class="button" >
			<button type="button" class="reFind"></button>
			<button type="button" class="login"></button>
		</div>
	</div>
	<? } ?>
</div>
	
<?
include $dir."/inc/footer/mainFooter.php";
?>
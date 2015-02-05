<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
include $dir.'/gmail/MAIL.php';
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
	$mail = $_POST['email']."@".(($_POST['emailFooter']) ? $_POST['emailFooter'] : $_POST['emailFooter2']);
	$db->where = "id ='".$_POST['id']."' and email='".$mail."' and phone='".$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']."'";
	$cnt = $db->TotalCnt();
	$id = mysql_fetch_array($db->Select());
	
	if( $cnt > 0){
		$rand = get_random_string(6,'az').get_random_string(3,'09');
		$m = new MAIL;
		$m->From('socialmessenger@hanmail.net',"우체통");
		$m->AddTo($mail);
		$m->Subject('우체통 인증메일 입니다.');
		$m->Html('임시비밀번호는 '.$rand.'입니다');
		$c = $m->Connect('smtp.gmail.com', 465, 'ysmin0914@gmail.com', 'messagebox11', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));
		$m->Send($c);
		$m->Disconnect();
		$db->field = "pwd='".md5($rand)."'";
		$db->Update();
	}
	
	unset($db);
	?>
	<div class ="idpwFindRe idFindWrap">
		<div class="tit">
		<span class="title"></span></div>
		<div class ="result">
			<span class="pwtit">비밀번호찾기 결과</span>
			<span class="pwText"></span>
		</div>
		<div class="button" >
			<button type="button" class="reFind"></button>
			<button type="button" class="login"></button>
		</div>
	</div>
	
</div>
	
<?
include $dir."/inc/footer/mainFooter.php";
?>
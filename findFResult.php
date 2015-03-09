<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
$facebook = new Facebook(array(
  'appId'  => '782151931875268',
  'secret' => '0f67e1e25529fedaaa368e26e7e23331',
));
$user = $facebook->getUser();
if ($user) {
  $user_profile = $facebook->api('/me');
  $logoutUrl = $facebook->getLogoutUrl();
  $db = new Dbcon();
  $db->table = "member";
  $db->keyfield = "idx";	
  $db->where = "fbcode='".$user_profile['id']."'";
  if($db->TotalCnt() > 0){	
	$db->field = "idx";
	$row = mysql_fetch_array($db->Select());
	$_SESSION['idx'] = $row['idx'];
	?>
	<script>
		location.href = "info";
	</script>
	<?
	unset($db);
	exit();
  }else if($user_profile['email']){
	if($_GET['join']==1){
		$db->field = "email,name,dob,sex,fbcode,Ps";
		$sex = ($user_profile['gender']=="male") ? "남성" : "여성";
		if($user_profile['birthday']){
			$b = explode("/",$user_profile['birthday']);
			$birthday = $b[2]."-".$b[0]."-".$b[1];
		}	
		$db->value = "'".$user_profile['email']."','".($user_profile['last_name'].$user_profile['first_name'])."','".$birthday."','".$sex."','".$user_profile['id']."','https://graph.facebook.com/".$user."/picture?type=large'";
		$_SESSION['idx'] = $db->Insert();
	?>
	<script>
		location.href = "info";
	</script>
	<?
		unset($db);
		exit();
	}else{
		?>
	<script>
		$(document).ready(function(){
			if(confirm("아직 가입하지 않으셨습니다.\n가입하시겠습니까?")){
				location.href = "/findFResult?join=1";
			}else{
				location.href = "/logOut?return=login";
			}
		})
	</script>
		<?
	}
  }
  unset($db);
} else {
  $loginUrl = $facebook->getLoginUrl(array('scope'=>'publish_stream,email,user_birthday'));
}
unset($facebook);
?>
<div class = "messageFind">페이스북으로 가입하신 회원이십니다.<br/> 로그인 하시겠습니까?</div>
<button type="button" class="btnFJoin" onclick="location.href='<?=$loginUrl?>'" style="margin-bottom:9px;">페이스북으로 로그인</button>

<?
include $dir."/inc/footer/mainFooter.php";
?>
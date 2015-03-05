<?
$title = "로그인";
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
  $db->where = "email='".$user_profile['email']."'";
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
				location.href = "/login?join=1";
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
<div class = "message"></div>
<form method="post" action="/loginProc.php" id="loginForm">
	<h2 style="color:#323232; margin-bottom:70px;">로그인</h2>
	<div class="loginBox">
		<ul class="joinForm">
			<li class="email list">
				<!--span class="lab">E-mail</span-->
				<span class="input"><input type="text" name="email" id="email" placeholder="이메일을 입력하세요."/></span><div style="clear:both"></div>
			</li>
			<li class="password list">
				<!--span class="lab">비밀번호</span-->
				<span class="input"><input type="password" name="pwd" id="pwd" placeholder="비밀번호를 입력하세요."/></span><div style="clear:both"></div>
				<!--span class="desc">비밀번호는 영문/숫자 포함하여 8 ~ 16자리</span-->
			</li>
			<!--li class="gender list">
				<span class="Lradio">
					<label for="male" class="chk2"><input type="radio" name="sex" value="남성" id="male" global="0"/></label><span class="labR m" style="margin-right:25px">이메일 저장</span>
					<label for="fmale" class="chk2"><input type="radio" name="sex" value="여성" id="fmale" global="0"/></label><span class="labR f">자동로그인</span> 
				</span>
			</li-->
		</ul>
		<button type="submit" class="btnLogin">로그인</button>
		<button type="button" class="btnFJoin" onclick="location.href='<?=$loginUrl?>'" style="margin-bottom:9px;">페이스북으로 로그인</button>		
		<span class="textQ">비밀번호를 잊으셨나요? <a href="#">비밀번호 찾기</a></span>
		<span class="textQ">아직 회원이 아니시라면 <a href="/join">가입하기</a></span>
		<!--button type="button" class="btnFlogin">페이스북으로 로그인</button-->
	</div>
</form>
<script>
function Echk(m)
{ 
	var esn = m;
	var re=/^[a-z A-Z 0-9\-_]+@[a-z A-Z 0-9\-_]+(\.[a-z A-Z 0-9\-_]+)+$/;
	var st=re.test(esn); 
	return st;
}
function Pchk(m)
{ 
	var rg = m;
	var re=/[a-zA-Z0-9]{8,16}/g;
	var st=re.test(rg); 
	if(st==true){
		re = /[0-9]/ig;
		var st2 = re.test(rg);
		return st2;
	}else{
		return st;
	}
}
function Nchk(m)
{ 
	var rg = m;
	var re=/[0-9]/ig;
	var st=re.test(rg); 
	if(st==true){
		return (!st);
	}else{
		re=/[^a-zA-Z가-힣]+/;
		var st2=re.test(rg);
		return (!st2);
	}
}


$("#loginForm").submit(function(){
	//alert($("#email").val());
	if(trim($("#email").val())==""){
		MAlert("이메일을 입력하세요.", $("#email").parent());
		return false;
	}
	if(Echk($("#email").val())==false){
		alert("올바른 이메일 형식이 아닙니다.");
		return false;
	}	
	if(trim($("#pwd").val())=="" ){
		MAlert("비밀번호를 입력하세요.", $("#pwd").parent());
		return false;
	}
	if(Pchk($("#pwd").val())==false){
		alert("올바른 비밀번호 형식이 아닙니다.");
		return false;	
	}
	var sw = 0;
	$.ajax({
		type : "POST",
		url : "/login.ax.php",
		dataType : 'json',
		async : false,
		data : {
			email : $("#email").val(),
			pwd : $("#pwd").val()
		},success : function(result){
			if(result.loginChk=="true"){
				sw = 1;
			};
		},error : function(result,a,b){
		
		}		
	});
	if(sw===0){
		alert("아이디 또는 비밀번호를 다시 확인하세요.");
		return false;
	};	
});
</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>

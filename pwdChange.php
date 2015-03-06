<?
$title = "비밀번호변경";
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
if(strlen($_SESSION['idx']) <= 0){
	MsgBox("로그인 해주세요.","login");
	exit();
}
$db = new Dbcon();
$db->table = "member";
$db->field = "email, name, pwd, dob, sex, fbcode, Ps";
$db->where = "idx=".$_SESSION["idx"];
$rel= $db->Select();
$array = mysql_fetch_assoc($rel);
$birth = explode("-",$array["dob"]);


?>
<div class = "message"></div>
<form method="post" action="/pwdCProc.php" id="loginForm">
	<h2 style="color:#323232; margin-bottom:70px;">비밀번호변경</h2>
	<div class="loginBox">
		<ul class="joinForm">
			<?if($array['pwd']){?>
			<li class="password list">
				<!--span class="lab">비밀번호</span-->
				<span class="input"><input type="password" name="nowPwd" id="nowPwd" placeholder="현재 비밀번호를 입력하세요."/></span><div style="clear:both"></div>
				<!--span class="desc">비밀번호는 영문/숫자 포함하여 8 ~ 16자리</span-->
			</li>
			<? } ?>
			<li class="password list">
				<!--span class="lab">비밀번호</span-->
				<span class="input"><input type="password" name="pwd" id="pwd" placeholder="새 비밀번호를 입력하세요."/></span><div style="clear:both"></div>
				<span class="desc">비밀번호는 영문/숫자 포함하여 8 ~ 16자리</span>
			</li>
			<li class="password list">
				<!--span class="lab">비밀번호</span-->
				<span class="input"><input type="password" id="pwd2" placeholder="새 비밀번호확인을 입력하세요."/></span><div style="clear:both"></div>
				<!--span class="desc">비밀번호는 영문/숫자 포함하여 8 ~ 16자리</span-->
			</li>
		
		</ul>
		<button type="submit" class="btnLogin">비밀번호변경</button>	
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
	<? if($array['pwd']){ ?>
	if(trim($("#nowPwd").val())=="" ){
		MAlert("현재 비밀번호를 입력하세요.", $("#nowPwd").parent());
		return false;
	}
	if(Pchk($("#nowPwd").val())==false){
		alert("올바른 비밀번호 형식이 아닙니다.");
		return false;	
	}
	<? } ?>
	
	if(trim($("#pwd").val())=="" ){
		MAlert("비밀번호를 입력하세요.", $("#pwd").parent());
		return false;
	}
	if(Pchk($("#pwd").val())==false){
		alert("올바른 비밀번호 형식이 아닙니다.");
		return false;	
	}

	if(trim($("#pwd2").val())=="" ){
		MAlert("비밀번호를 입력하세요.", $("#pwd2").parent());
		return false;
	}
	if(Pchk($("#pwd2").val())==false){
		alert("올바른 비밀번호 형식이 아닙니다.");
		return false;	
	}

	if(trim($("#pwd").val())!=trim($("#pwd2").val()) ){
		alert("비밀번호가 일치하지 않습니다.");
		return false;
	}

});
</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>

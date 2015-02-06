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
  $db->where = "email='".$user_profile['email']."'";
  if($db->TotalCnt() > 0){
	$row = mysql_fetch_array($db->Select());
	$db->field = "idx";
	$_SESSION['idx'] = $row['idx'];
  }else if($user_profile['email']){
    $db->field = "email,name,dob,sex,fbcode,Ps";
	$sex = ($user_profile['gender']=="male") ? "남성" : "여성";
	if($user_profile['birthday']){
		$b = explode("/",$user_profile['birthday']);
		$birthday = $b[2]."-".$b[0]."-".$b[1];
	}	
	$db->value = "'".$user_profile['email']."','".($user_profile['last_name'].$user_profile['first_name'])."','".$birthday."','".$sex."','".$user_profile['id']."','https://graph.facebook.com/".$user."/picture?type=large'";
	$_SESSION['idx'] = $db->Insert();
  }
  unset($db);
} else {
  $loginUrl = $facebook->getLoginUrl(array('scope'=>'user_birthday,email'));
}
unset($facebook);
if($_SESSION['idx']){
?>
<script>
	location.href = "info.php";
</script>
<?
exit();
}?>
<div class = "message"></div>
<form method="post" action="/joinInsert.php" id="joinForm">
	<div class="leftObj">
		<span class="text1">팀장님 바보</span>
		<span class="text1">손쉽게 이력서를 작성하세요.</span>
		<span class="text2">단순한 기록 방식, 다양한 항목 저장, 안전한 보관 및 관리<br/>	
							그리고 중요한 항목만 추출하여 작성하는 나만의 이력서가 필요하신가요?
		</span
		<span class="text3">라스트로는 영원히 무료 서비스입니다.</span>
	</div>
	<div class="rightObj">
		<ul class="joinForm">
			<li class="name list">
				<!--span class="lab">이름</span--> 
				<span class="input"><input type="text" name="name" id="Nname" placeholder="실명을 입력하세요."/></span>
			</li>
			<li class="email list">
				<!--span class="lab">E-mail</span-->
				<span class="input"><input type="text" name="email" id="email" placeholder="이메일을 입력하세요."/></span>
			</li>
			<li class="password list">
				<!--span class="lab">비밀번호</span-->
				<span class="input"><input type="password" name="pwd" id="pwd" placeholder="비밀번호를 입력하세요."/></span>
				<span class="desc">비밀번호는 영문/숫자 포함하여 8 ~ 16자리</span>
			</li>
			
			<!--li class="births list">
				<span class="lab">생년월일</span>
				<ul class="period start">
					<li class="year">
						<span class="select selectR">
							<input type="hidden" name="birthYear" class="value" value="<?=$row['eventDateS']['y']?>" >
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple">년</span>
							</button>
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
					</li>
					<li class="month">
						<span class="select selectR">
							<input type="hidden" name="birthMonth" class="value" value="<?=$row['eventDateS']['m']?>" >
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple">월</span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
					</li>
					<li class="theDay">
						<span class="select selectR">
							<input type="hidden" name="birthDay" class="value" value="<?=$row['eventDateS']['d']?>" >
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple">일</span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
					</li>				
				</ul>
			</li-->
			<!--li class="gender list">
				<span class="lab">성별</span>
				<span class="radio">
					<label for="male" class="chk"><input type="radio" name="sex" value="남성" id="male" global="0"/></label><span class="labR m" style="margin-right:50px">남성</span>
					<label for="fmale" class="chk"><input type="radio" name="sex" value="여성" id="fmale" global="0"/></label><span class="labR f">여성</span> 
				</span>
			</li-->
			
		</ul>
		<button type="submit" class="btnRegist">라스트로 시작하기</button>
		<button type="button" class="btnFJoin" onclick="location.href='<?=$loginUrl?>'">페이스북으로 가입하기</button>
		<span class="agreeDesc">‘라스트로 등록하기’를 클릭하시면 라스트로의 <a href="terms" style="color:#FFF; display:inline;"><b>이용약관</b></a>과<br/>
<a href="policy" style="color:#FFF; display:inline;"><b>개인정보취급방침</b></a>에 동의하시는 것으로 간주합니다.</span>
		
		<!--span class="loginQ textQ">이미 가입하셨나요? <a href="login.php">로그인하기</a></span-->
	</div>
</form>
<script>
var date    = new Date();
var Nyear   = (date.getFullYear()-70);
var Nyear2  = (date.getFullYear());
var NMonth  = date.getMonth()+1;
var Nday    = date.getDate();


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


$("#joinForm").submit(function(){
	//alert($("#email").val());
	
	
	if(trim($("#Nname").val())==""){
		MAlert("실명을 입력하세요.", $("#Nname").parent());
		return false;
	};
	if(Nchk($("#Nname").val())==false){
		MAlert("올바른 실명 형식이 아닙니다.", $("#Nname").parent());
		return false;	
	};
	if(trim($("#email").val())==""){
		MAlert("이메일을 입력하세요.", $("#email").parent());
		return false;
	};
	if(Echk($("#email").val())==false){
		MAlert("올바른 이메일 형식이 아닙니다.", $("#email").parent());
		return false;
	};
	if(trim($("#pwd").val())==""){
		MAlert("비밀번호를 입력하세요.", $("#pwd").parent());
		return false;
	}
	if(Pchk($("#pwd").val())==false){
		MAlert("올바른 비밀번호 형식이 아닙니다.", $("#pwd").parent());
		return false;	
	}
	sw = 0
	$.ajax({
		type : "POST",
		url : "/mailChk.ax.php",
		dataType : 'json',
		async : false,
		data : {
			email : $("#email").val()
		},success : function(result){
			if(result.loginChk=="true"){
				sw = 1;
			};
		},error : function(result,a,b){
		
		}		
	});
	if(sw===1){
		alert("이미 존재하는 메일입니다.");
		return false;
	}
});
function addDate(obj,yObj,mbObj,nDate){
	var year  = parseInt(yObj.find("input.value").attr("value"));
	var month = parseInt(mbObj.find("input.value").attr("value"));
	var lastDayArr = Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	var lastDay;
	if(month == 2){
		if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)){
			lastDay = 29;
		}else{
			lastDay = 28;
		}
	
	}else{
		lastDay = lastDayArr[month];
	};
	return lastDay;	
}
function addDateT(y,m){
	var lastDayArr = Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	if(m == 2){
		if ((y % 4 == 0) && (y % 100 != 0) || (y % 400 == 0)){
			lastDay = 29;
		}else{
			lastDay = 28;
		}
	
	}else{
		lastDay = lastDayArr[m];
	};
	return lastDay;	
};


function appDate(ob1,ob2){
	var Lyear   =  ob1.find("li.year span.select input.value");
	var Lmonth  =  ob1.find("li.month span.select input.value");
	var Lday    =  ob1.find("li.theDay span.select input.value");

	var Fyear   =  ob2.find("li.year span.select");
	var Fmonth  =  ob2.find("li.month span.select");
	var Fday    =  ob2.find("li.theDay span.select");

	appendNum(Fyear, parseInt(Lyear.val()), Nyear2, Fyear.find("input.value").val(),1);		
	var lastDay = addDate(Fday,Fyear,Fmonth,Fday.find("input.value").val());
	
	if(Lyear.val()==Fyear.find("input.value").val()){
		appendNum(Fmonth,parseInt(Lmonth.val()), 12, Fmonth.find("input.value").val(),1);
		if(Lmonth.val()==Fmonth.find("input.value").val()){
			appendNum(Fday,parseInt(Lday.val()),lastDay,Fday.find("input.value").val(),1);			

		}else{
			appendNum(Fday,1,lastDay,Fday.find("input.value").val(),1);
		};
	}else{
		appendNum(Fmonth, 1, 12, Fmonth.find("input.value").val(),1);
		appendNum(Fday,1,lastDay,Fday.find("input.value").val(),1);
	};
};
function LimitDate(y,m,d,h,i,obj){
	var Lyear   =  obj.find("li.year span.select");
	var Lmonth  =  obj.find("li.month span.select");
	var Lday    =  obj.find("li.theDay span.select");
	y = parseInt(y);
	m = parseInt(m);
	d = parseInt(d);		
	
	var lastDay = addDateT(parseInt(Lyear.find("input.value").val()),parseInt(Lmonth.find("input.value").val()));
	if(Lyear.find("input.value").val()==y){		
		appendNum(Lmonth, m, 12, Lmonth.find("input.value").val(),1);		
		if(Lmonth.find("input.value").val()==m){
			appendNum(Lday, d, lastDay, Lday.find("input.value").val(),1);			
		}else{			
			appendNum(Lday, 1, lastDay, Lday.find("input.value").val(),1);
		}
	}else{	
		appendNum(Lday, 1, lastDay, Lday.find("input.value").val(),1);
		appendNum(Lmonth, 1, 12, Lmonth.find("input.value").val(),1);
	};	
};
function saleChn(){
	if($("#free").attr("checked")){
		$("#saleObj").hide();
	}else{
		$("#saleObj").show();
	};
};
function readURL(input,obj) { 
	if (input.files && input.files[0]) {
		var image =  new Image();
		var reader = new FileReader(); 
		reader.onload = function (e) {
			image.src = e.target.result;
			//alert(obj.attr(""))
			obj.css('background',"url('"+image.src+"') no-repeat");
			
			obj.css('background-size',"100% auto");
		} 
		reader.readAsDataURL(input.files[0]);
	}
	$("#imgModi").val("n");
};
$(document).ready(function(){
	var eventSY = $("ul.start li.year span.select");
	var eventSM = $("ul.start li.month span.select");
	var eventSD = $("ul.start li.theDay span.select");

	appendNum(eventSY,Nyear2,Nyear,"",-1);
	appendNum(eventSM,1,12,"",1);
	appendNum(eventSD,1,addDate(eventSD,eventSY,eventSM,Nday),"",1);
	
	eventSY.find("input.value").change(function(){		
		LimitDate((Nyear-1),1,1,0,0,$("ul.start"));
	});
	eventSM.find("input.value").change(function(){
		eventSY.find("input.value").change();
	});
	eventSD.find("input.value").change(function(){
		eventSY.find("input.value").change();
	});

});





</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
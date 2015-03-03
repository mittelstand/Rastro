<?
$title = "회원정보수정";
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
$facebook = new Facebook(array(
  'appId'  => '782151931875268',
  'secret' => '0f67e1e25529fedaaa368e26e7e23331',
));
$user = $facebook->getUser();

if(strlen($_SESSION['idx']) <= 0){
	MsgBox("로그인 해주세요.","login");
	exit();
}
	$db = new Dbcon();
	$db->table = "member";
	$db->field = "email, name, dob, sex, fbcode, Ps";
	$db->where = "idx=".$_SESSION["idx"];
	$rel= $db->Select();
	$array = mysql_fetch_assoc($rel);
	$birth = explode("-",$array["dob"]);

?>
<style>
	/*body{background-color:#ededed;}*/
</style>
<div style = "clear:both"></div>
<div class="popImgMsg">
	<ul>
<?
	if($array["fbcode"]){
?>
	<li><button type = "button" id = "fbImage">페이스북 사진 불러오기</button></li>
<?
	}
?>
	<li><button type = "button" id = "pcImage">PC에서 불러오기</button></li>
	<li><button type = "button" id = "imgDelete">삭제</button></li>
	</ul>
</div>
<form method="post" action="infoModify.php" class = "infoForm" enctype = "multipart/form-data">
	<input type = "hidden" name="fbChange" id = "fbChange"/>
	<!--<div class = "info">
		<span>내 정보 수정</span>
	</div>-->
	<div class="circle, circleTwo" style="z-index:1; position:relative;"></div>
	<div class="circle" style="z-index:1; position:relative;">
		<label for="picture" class="pic">
			<input type="file" name="picture" id="picture" value=""/>
		</label>
	</div>


	<? if($array['Ps']){ ?>
	<input type="hidden" name="imgModi" value="y" />
	<script>
		imagef = new Image();
		imagef.src = '<?=str_replace("/HCK/rastro.kr/public_html","",$array['Ps'])?>';
		$("label[for='picture']").css("background","url('<?=str_replace("/HCK/rastro.kr/public_html","",$array['Ps'])?>') no-repeat 0 0");
		imagef.onload = function(){
			if(imagef.width > imagef.height){
				$("label[for='picture']").css('background-size',"auto 100%");
			}else{
				$("label[for='picture']").css('background-size',"100% auto");
			}
		}
	</script>
	<? } ?>
	<div class = "opacity">
		<ul class="modiForm" style="z-index:8; position:relative;">
			<li class="email list"></li>
			<li class="email list">
				<span class="lab">이메일</span>
				<span class="modify"><input type="text" name="email" id="mEmail" value = "<?= $array["email"]?>"/></span>
				<div style="clear:both;"></div>
			</li>
			<li class="name list">
				<span class="lab">이름</span> 
				<span class="modify"><input type="text" name="name" id="mName" value = "<?= $array["name"]?>"/></span>
				<div style="clear:both;"></div>
			</li>
			<li class="births list">
				<span class="lab birth">생년월일</span>
				<ul class="period start">
					<li class="year">
						<span class="select selectYear">
							<input type="hidden" name="birthYear" class="value" value="<? echo $array["dob"] == "" ? $row['eventDateS']['y'] : $birth[0]?>" >
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
						<span class="select selectMonth">
							<input type="hidden" name="birthMonth" class="value" value="<? echo $array["dob"] == "" ? $row['eventDateS']['m'] : $birth[1]?>" >
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
						<span class="select selectDay">
							<input type="hidden" name="birthDay" class="value" value="<? echo $array["dob"] == "" ? $row['eventDateS']['d'] : $birth[2]?>" >
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
			</li>	
			<li class="gender list">
				<span class="lab gender">성별</span>
				<span class="radio">
					<label for="male" class="chk2 chm"><input type="radio" name="sex" value="남성" id="male" global="0" <? echo $array["sex"]=="남성" ? "checked='checked'":""?>/></label><span class="labR m">남성</span>
					<label for="fmale" class="chk2 chf"><input type="radio" name="sex" value="여성" id="fmale" global="0" <? echo $array["sex"]=="여성" ? "checked='checked'":""?>/></label><span class="labR f">여성</span> 
				</span>
			</li>
		</ul>
		<div style = "clear:both;"></div>
		<div class="btn" style="z-index:1; position:relative;">
			<button class = "mPass">비밀번호변경</button>
			<button type="submit" class = "infoSave">저장</button>
		</div>
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

$("div.circle").mouseover(function(){
	$("label.pic").css('opacity', "0.6");
	$("div.circleTwo").css('visibility',"visible");
});
$("div.circle").mouseout (function(){
	$("label.pic").css('opacity', "1");
	$("div.circleTwo").css('visibility',"hidden");
	
});
$("#fbImage").click(function(){
	var fbImage = new Image();
	fbImage.src = "https://graph.facebook.com/<?=$array['fbcode']?>/picture?type=large";
	fbImage.onload = function (e) {
			 $("label[for='picture']").css("background","url('https://graph.facebook.com/<?=$array['fbcode']?>/picture?type=large') no-repeat 0 0");
			 $("#fbChange").attr("value","https://graph.facebook.com/<?=$array['fbcode']?>/picture?type=large");
					  
			 if(fbImage.width > fbImage.height){
				$("label[for='picture']").css('background-size',"auto 100%");
			 }else{
				$("label[for='picture']").css('background-size',"100% auto");
			 }
	}
	$("div.popImgMsg").hide();
	$(window).unbind("click");
	$("*").unbind("focus");
	$("div.circle").unbind("mouseleave");	
});
$("#pcImage").click(function(){
	$("#picture").click();
	console.log($("#picture").click());
	$("div.popImgMsg").hide();
	$(window).unbind("click");
	$("*").unbind("focus");
	$("div.circle").unbind("mouseleave");	
});

$("#imgDelete").click(function(){
	var del = "<input type = 'hidden' name = 'del' value = 'http://rastro.kr/img/profile.gif'>"
	$("label[for='picture']").css("background","url('http://rastro.kr/img/profile.gif') no-repeat 0 0");

	$("form.infoForm").append(del);
	$("div.popImgMsg").hide();
	$(window).unbind("click");
	$("*").unbind("focus");
});
$("div.circle").click(function(e){
	
	$("div.popImgMsg").show();
	$(this).mouseleave(function(){
		$("*").focus(function(e){
			$(this).click();
			$("div.popImgMsg").hide();
			$(window).unbind("click");
			$("*").unbind("focus");
			$("div.circle").unbind("mouseleave");			
		});
		$(window).click(function(e){
			$("div.popImgMsg").hide();
			$(window).unbind("click");
			$("*").unbind("focus");
			$("div.circle").unbind("mouseleave");	
		});
		/*
		$(this).hover(function(e){
			console.log("c");
			$(window).unbind("click");
			$("*").unbind("focus");		
		});	
		*/

		//text.css("background","url('/img/arrowDown.png') no-repeat right center");
	});
	if(event.preventDefault){

        event.preventDefault(); //FF

    } else {

        event.returnValue = false; //IE

    }



	event.preventDefault();
	

});


$("form.infoForm").submit(function(){
	if(trim($("#mEmail").val())==""){
		alert("이메일을 입력하세요.");
		return false;
	}
	if(Echk($("#mEmail").val())==false){
		alert("올바른 이메일형식이 아닙니다.");
		return false;
	}	
	if(trim($("#mName").val())==""){
		alert("이름을 입력하세요.");
		return false;
	}
	if(Nchk($("#mName").val())==false){
		alert("올바른 이름형식이 아닙니다.");
		return false;	
	}
	
	if($("#sex").val()==""){
		alert("성별을 선택하세요.");
		return false;
	}
	if(($("input[name='birthYear']").val()=="") || ($("input[name='birthMonth']").val()=="") || ($("input[name='birthDay']").val()=="")){
		alert("생년월일을 입력하세요.");
		return false;
	}
	sw = 0
	$.ajax({
		type : "POST",
		url : "/modMailChk.ax.php",
		dataType : 'json',
		async : false,
		data : {
			email : $("#mEmail").val()
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
			image.onload = function(){
				obj.css('background',"url('"+image.src+"') no-repeat");	
				
				if(image.width > image.height){
					obj.css('background-size',"auto 100%");
				}else{
					obj.css('background-size',"100% auto");
				}
			}
		} 
		reader.readAsDataURL(input.files[0]);
	}
	$("#imgModi").val("n");
};
$(document).ready(function(){
	$("#picture").change(function(){ 
		readURL(this,$("label[for='picture']")); 
	});
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
	eventSY.find("input.value").change();
});





</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
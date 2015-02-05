<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>

<form method="post" action="/joinInsert.php" id="joinForm">
	<ul class="joinForm">
		<li class="email list">
			<span class="lab">E-mail</span>
			<span class="input"><input type="text" name="email" id="email"/></span>
		</li>
		<li class="password list">
			<span class="lab">비밀번호</span>
			<span class="input"><input type="password" name="pwd" id="pwd"/></span>
		</li>
		<li class="name list">
			<span class="lab">이름</span> 
			<span class="input"><input type="text" name="name" id="Nname"/></span>
		</li>
		<li class="gender list">
			<span class="lab">성별</span>
			<span class="select selectH">
				<input type="hidden" name="sex" id="sex" class="value" value="<?=$row['sex']?>"/>
				<button type="button" class="selectBtn">
					<span class="selectSex">성별 선택</span>
				</button>
				<ul class="selectUl1" style="display:none;">
					<li><a href="javascript:;">남자</a></li>
					<li><a href="javascript:;">여자</a></li>
				</ul>									
			</span>
		</li>
		<li class="births list">
			<span class="lab">생년월일</span>
			<ul class="period start">
				<li class="year">
					<span class="select selectH">
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
					<span class="select selectH">
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
					<span class="select selectH">
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
		</li>
	</ul>
	<button type="submit">가입</button>
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
	if(trim($("#email").val())==""){
		alert("이메일을 입력하세요.");
		return false;
	};
	if(Echk($("#email").val())==false){
		alert("올바른 이메일형식이 아닙니다.");
		return false;
	};	
	if(trim($("#pwd").val())==""){
		alert("비밀번호를 입력하세요.");
		return false;
	};
	if(Pchk($("#pwd").val())==false){
		alert("올바른 비밀번호형식이 아닙니다.");
		return false;	
	};
	if(trim($("#Nname").val())==""){
		alert("이름을 입력하세요.");
		return false;
	};
	if(Nchk($("#Nname").val())==false){
		alert("올바른 이름형식이 아닙니다.");
		return false;	
	};
	
	if($("#sex").val()==""){
		alert("성별을 선택하세요.");
		return false;
	};
	if(($("input[name='birthYear']").val()=="") || ($("input[name='birthMonth']").val()=="") || ($("input[name='birthDay']").val()=="")){
		alert("생년월일을 입력하세요.");
		return false;
	};
	$.ajax({
		type : "POST",
		url : "/mailChk.ax.php",
		dataType : 'json',
		async : false,
		data : {
			email : $("#email").val(), 
			pwd : $("#pwd").val()
		},success : function(result){
			if(result.idChk=="true"){
				sw = 1;
			};
		},error : function(result,a,b){
		
		}		
	});
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

	appendNum(eventSY,Nyear,Nyear2,"",1);
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
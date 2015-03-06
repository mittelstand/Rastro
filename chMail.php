<?
session_start();
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

?>
<div class = "message"></div>
<form method="post" action="/chMailProc.php" id="joinForm">	
	<div class="rightObj">
		<ul class="joinForm">			
			<li class="email list">
				<!--span class="lab">E-mail</span-->
				<span class="input"><input type="text" name="email" id="email" placeholder="이메일을 입력하세요."/></span><div style="clear:both"></div>
				<button type="button" class="btnClose"></button>
			</li>			
		</ul>
		<button type="submit" class="btnRegist">이메일 인증 및 변경하기</button>
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
	
	if(trim($("#email").val())==""){
		MAlert("이메일을 입력하세요.", $("#email").parent());
		$("#Nname").focus();
		return false;
	};
	if(Echk($("#email").val())==false){
		alert("올바른 이메일 형식이 아닙니다.");
		MAlert("올바른 이메일 형식이 아닙니다.", $("#email").parent());
		$("#Nname").focus();
		return false;
	};
	
	
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
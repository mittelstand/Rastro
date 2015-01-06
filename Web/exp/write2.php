<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

$_GET['type']=($_GET['type'])?$_GET['type'] : "cExp";

if($_GET['type']=="cExp"){
?>


<div class="cExpDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div style="clear:both;"></div>
	<!-- <div class="btn">
	 <button type="button" class="personApp" onclick="location.href='#'"/>개인신청</button>
		<button type="button" class="groupApp" onclick="location.href='#'"/>단체신청</button>
	</div> -->
</div>
<?}else{?>
<div class="wExpDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div style="clear:both;"></div>
	<!-- <div class="btn">
		<button type="button" class="noPay" onclick="location.href='#'"/>무급</button>
		<button type="button" class="pay" onclick="location.href='#'"/>유급</button> 
	</div> -->
</div>
<?}?>
<?
if($_GET['idx']){
	$mit =  new Mittel();
	$mit->opt = $option['exp'];
	$row = $mit->outputDetail();
	unset($mit);}	
?>
<form action="/proc.php" method="post" enctype="multipart/form-data">
<?
if($_GET['idx']){?>
	<input type="hidden" name="idx" value="<?=$_GET['idx']?>">
	<?}?>

	<div class="expWrite contentBox">
		<div class="sdL"></div>
		<div class="sdR"></div>
		<div class="sdT"></div>
		<div class="sdB"></div>
		<ul class="write">
			<li class="title clear">
				<span class="input">
					<input type="text" name="title" value="<?=$row['title']?>" maxlength="20" class="off"/>
				</span>
			</li>
			<li class="address clear">
				<span class="input">
					<input type="text" name="address" value="<?=$row['address']?>" maxlength="20" class="off"/>
				</span>
			</li>
			<li class="thumb clear">
				<label for="addPic">
					<input type="file" name="mainImg" id="addPic" />
				</label>
				
				<? if($row['img']){ ?>
				<input type="hidden" name="imgModi" value="y" />
				<script>
					imagef = new Image();
					imagef.src = '<?=str_replace("/HCK/messagebox.co.kr/public_html","",$row['img'])?>';
					$("label[for='addPic']").css("background","url('<?=str_replace("/HCK/messagebox.co.kr/public_html","",$row['img'])?>') no-repeat 0 0");
					
					if(imagef.width > imagef.height){
						$("label[for='addPic']").css('background-size',"auto 100%");
					}else{
						$("label[for='addPic']").css('background-size',"100% auto");
					}
				</script>
				<? } ?>
			</li>			
			<li class="num floatL">
				<span class="input">
					<input type="text" name="people" maxlength="8" value="<?=$row['people']?>" onKeyup='checkNum(this)' class="off"/>
				</span>
				
			</li>			
		
			<li class="cost floatL">
				<span class="input">
					<input type="text" name="cost" maxlength="8" value="<?=$row['cost']?>" onKeyup='checkNum(this)' class="off"/>
				</span>			
			</li>	
			<li class="apply floatL">
				<span class="select selectMM2">
					<input type="hidden" name="appType" class="value" value="<?=$row['appType']?>">
					<button type="button" class="appType" id="selectBtn">
						<span class="selectText yellow peple">개인</span>
					</button>
					<div class="bg" style="display:none;"></div>
					<ul class="selectUl2 limit" style="display:none;">
						<li><a href="javascript:;">개인</a></li>
						<li ><a href="javascript:;">단체</a></li>
						<li><a href="javascript:;">개인 및 단체</a></li>
					</ul>
				</span>			
			</li>
			<li class="groupradio">
				<label class="TR1" for="Team_Roster1">
					<input type="radio" id="Team_Roster1" name="radioG" value="1" global="-965" checked="checked"/>
				</label>
				<label class="TR2" for="Team_Roster2">
					<input type="radio" id="Team_Roster2" name="radioG" value="2"  global="-965"/>
				</label>
			</li>
			<li class="dateTerm clear">
				<div class="input">
					<ul class="period start">
						<li class="year">
							<span class="select selectMM">
								<input type="hidden" name="eventYear1" class="value" value="<?=$row['eventDateS']['y']?>" >
								<button type="button" class="selectBtn" id="selectBtn">
									<span class="selectText yellow peple"></span>
								</button>
								<div class="bg" style="display:none;"></div>
								<ul class="selectUl2 limitL" style="display:none;">
									<li><a href="javascript:;"></a></li>
								</ul>
							</span>
						</li>
						<li class="month">
							<span class="select selectMM">
								<input type="hidden" name="eventMonth1" class="value" value="<?=$row['eventDateS']['m']?>" >
								<button type="button" class="selectBtn" id="selectBtn">
									<span class="selectText yellow peple"></span>
								</button>							
								<div class="bg" style="display:none;"></div>
								<ul class="selectUl2 limitL" style="display:none;">
									<li><a href="javascript:;"></a></li>
								</ul>
							</span>
						</li>
						<li class="theDay">
							<span class="select selectMM">
								<input type="hidden" name="eventTheDay1" class="value" value="<?=$row['eventDateS']['d']?>" >
								<button type="button" class="selectBtn" id="selectBtn">
									<span class="selectText yellow peple"></span>
								</button>							
								<div class="bg" style="display:none;"></div>
								<ul class="selectUl2 limitL" style="display:none;">
									<li><a href="javascript:;"></a></li>
								</ul>
							</span>
						</li>				
					</ul>
					<ul class="period end">
						<li class="year">
							<span class="select selectMM">
								<input type="hidden" name="eventYear2" class="value" value="<?=$row['eventDateE']['d']?>" >
								<button type="button" class="selectBtn" id="selectBtn">
									<span class="selectText yellow peple"></span>
								</button>							
								<div class="bg" style="display:none;"></div>
								<ul class="selectUl2 limitL" style="display:none;">
									<li><a href="javascript:;"></a></li>
								</ul>
							</span>
						</li>
						<li class="month">
							<span class="select selectMM">
								<input type="hidden" name="eventMonth2" class="value" value="<?=$row['eventDateE']['d']?>" >
								<button type="button" class="selectBtn" id="selectBtn">
									<span class="selectText yellow peple"></span>
								</button>							
								<div class="bg" style="display:none;"></div>
								<ul class="selectUl2 limitL" style="display:none;">
									<li><a href="javascript:;"></a></li>
								</ul>
							</span>
						</li>
						<li class="theDay">
							<span class="select selectMM">
								<input type="hidden" name="eventTheDay2" class="value" value="<?=$row['eventDateE']['d']?>" >
								<button type="button" class="selectBtn" id="selectBtn">
									<span class="selectText yellow peple"></span>
								</button>							
								<div class="bg" style="display:none;"></div>
								<ul class="selectUl2 limitL" style="display:none;">
									<li><a href="javascript:;"></a></li>
								</ul>
							</span>
						</li>										
					</ul>
				</div>
			</li>
			<li class="etc clear">
				<span class="input">
					<textarea name="etc" class="off" onkeyup="checkEnter()"><?=str_replace("<br />","",$row['etc']) ?></textarea>
				</span>
			</li>
			
			<li class="text clear">
				<textarea id="content" name="content"><?=$row['content'] ?></textarea>
			</li>
			<li class="btn clear">
				<button type="submit" class="regist btnW">등록</button>
			</li>			
		</ul>
		<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
		<input type="hidden" name="page" value="<?=$_GET['page']?>"/>		
	</div>
</form>
<script>

var txt;
function checkEnter()
{
	 var tn = document.all.etc;
	 var borderH = (tn.offsetHeight - tn.clientHeight) / 2;
	 var lineC = (tn.scrollHeight - borderH) / ((tn.clientHeight - borderH) / tn.rows);
	 var cnt =  Math.ceil(lineC*10);
	 if(cnt > 20){
		alert("5줄을 초과할 수 없습니다.")
		tn.value = txt
	 }else{
		txt = tn.value;
	 }
}

$('ul.write li.title span.input input.off').focus(function(){
	$(this).attr("class","on");
});
$('ul.write li.title span.input input.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});
$('ul.write li.address span.input input.off').focus(function(){
	$(this).attr("class","on");
});
$('ul.write li.address span.input input.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});

$('ul.write li.etc span.input textarea.off').focus(function(){
	$(this).attr("class","on");
});
$('ul.write li.etc span.input textarea.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});

var date    = new Date();
var Nyear   = date.getFullYear();
var Nyear2  = Nyear+4;
var NMonth  = date.getMonth()+1;
var Nday    = date.getDate();

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
	
}


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
		}
	}else{
		appendNum(Fmonth, 1, 12, Fmonth.find("input.value").val(),1);
		appendNum(Fday,1,lastDay,Fday.find("input.value").val(),1);
	}
}
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
	}	
}
function saleChn(){
	if($("#free").attr("checked")){
		$("#saleObj").hide();
	}else{
		$("#saleObj").show();
	}
}
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
}
$(document).ready(function(){
	$("#addPic").change(function(){ 
		readURL(this,$("label[for='addPic']")); 
	}); 
	
	var eventSY = $("li.dateTerm ul.start li.year span.select");
	var eventSM = $("li.dateTerm ul.start li.month span.select");
	var eventSD = $("li.dateTerm ul.start li.theDay span.select");
	
	var eventEY = $("li.dateTerm ul.end li.year span.select");
	var eventEM = $("li.dateTerm ul.end li.month span.select");
	var eventED = $("li.dateTerm ul.end li.theDay span.select");


	<? if($_GET['idx'] <= 0){ ?>
		
		appendNum(eventSY,(Nyear-1),Nyear2,Nyear,1);
		appendNum(eventSM,1,12,NMonth,1);
		appendNum(eventSD,1,addDate(eventSD,eventSY,eventSM,Nday),Nday,1);
		

		appendNum(eventEY,Nyear,Nyear2,Nyear,1);
		appendNum(eventEM,NMonth,12,NMonth,1);		
		appendNum(eventED,Nday,addDate(eventED,eventEY,eventEM,Nday),Nday,1);
		
	<? }else{ 
			$eventData1 = $row['eventDateS'];
			$eventData2 = $row['eventDateE'];
			//$early	  = divDate($row['earlyCost']);
	?>
		appendNum(eventSY,(Nyear-1),<?=$eventData1['y']?>,Nyear,1);
		appendNum(eventSM,1,12,<?=$eventData1['m']?>,1);
		appendNum(eventSD,1,addDate(eventSD,eventSY,eventSM,Nday),<?=$eventData1['d']?>,1);
		<?
			
		$eventData1['m'] = ($eventData1['y']==$eventData2['y']) ? $eventData1['m'] : 1;
		$eventData1['d'] = (($eventData1['y']==$eventData2['y']) && ($eventData1['m']==$eventData2['m'])) ? $eventData1['d'] : 1;
		?>
		appendNum(eventEY,<?=$eventData1['y']?>,Nyear2,<?=$eventData2['y']?>,1);
		appendNum(eventEM,<?=$eventData1['m']?>,12,<?=$eventData2['m']?>,1);		
		appendNum(eventED,<?=$eventData1['d']?>,addDate(eventED,eventEY,eventEM,Nday),<?=$eventData2['d']?>,1);
		

	<? } ?>
	eventSY.find("input.value").change(function(){		
		LimitDate((Nyear-1),1,1,0,0,$("li.dateTerm ul.start"));
		appDate($("li.dateTerm ul.start"),$("li.dateTerm ul.end"));

	});
	eventSM.find("input.value").change(function(){
		eventSY.find("input.value").change();
	});
	eventSD.find("input.value").change(function(){
		eventSY.find("input.value").change();
	});
	
	eventEY.find("input.value").change(function(){
		LimitDate(eventSY.find("input.value").val(),eventSM.find("input.value").val(),eventSD.find("input.value").val(),00,00,$("li.dateTerm ul.end"));
	});
	eventEM.find("input.value").change(function(){		
		eventEY.find("input.value").change();
	});
	eventED.find("input.value").change(function(){
		eventEY.find("input.value").change();
	});
});

function groupList(){
	var text = $(this).val();
	if(text=="단체"){
		$("li.groupradio").show();
		
		
	}else{
		$("li.groupradio").hide();
	}
		
}
$("input[name='appType']").change(groupList);

var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "/setest/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});
$("form").submit(function(){
	if($("li.title input").val().length<=0){
		alert("제목을 입력하세요.");
		$("li.title input").focus();
		return false;
	}
	if($("#addPic").val().length<=0){
		if($("input[name='imgModi']").val()!="y"){
			alert("이미지를 넣으세요");
			$("addPic").focus();
			return false;
		}
	}
	if($("li.num input").val().length<=0){
		alert("인원을 입력하세요.");
		$("li.num input").focus();
		return false;
	}
	if($("li.cost input").val().length<=0){
		alert("인원을 입력하세요.");
		$("li.cost input").focus();
		return false;
	}
	if($("li.etc textarea[name='etc']").val().length<=0){
		alert("기타 안내사항을 입력하세요.");
		$("li.etc textarea[name='etc']").focus();
		return false;
	}
	/*
	if($("#content").val().length<=0){
		alert("내용을 입력하세요.");
		$("#content").focus();
		return false;
	}
	*/
	oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
});
function checkNum( obj ) {
	var num_regx=/^[0-9]*$/i;
	if(!num_regx.test(obj.value) ) {
		alert("숫자만 입력할수 있습니다.");
		var num_regx=/[^0-9]*$/i;
		var st = obj.value.match(num_regx)
		obj.value = obj.value.replace(st,"");
	} 	
}



</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
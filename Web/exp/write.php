<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
if($_GET['idx'] > 0){
	$db = new Dbcon();
	$db->table = "event";
	$db->field = "title, eventDateF, eventDateB, appDateF, appDateB, content, cash, earlyCost, doubleCost, cost, open, cachDesc, earlyDate, img, addr1, addr2, people, cdate, mdate";
	$db->where = "idx='".$_GET['idx']."'";
	$row = mysql_fetch_array($db->Select());
}
?>
<div class="applyWrite">
	<form method="post" action="./writeProc.php" id="mainForm" enctype="multipart/form-data">
	<? if($_GET['idx'] > 0){ ?>
	<input type="hidden" name="idx" value="<?=$_GET['idx']?>" />
	<? } ?>
	<ul class="mainForm">
	<?
	if($_GET['idx'] > 0){
	?>
		<li class="choice">
			<ul class="radio">
				<li class="open">
					<label for="openEvent">
						<input type="radio" name="openEnd" value="y" id="openEvent" <?=($row['open']=='y') ? "checked='checked'" : ""  ?>  global="-1263" />
					</label>
				</li>
				<li class="end">						
					<label for="endEvent">
						<input type="radio" name="openEnd" value="n" id="endEvent" <?=($row['open']=='n') ? "checked='checked'" : ""  ?>  global="-1263"/>
					</label>							
					<span class="text"></span>
				</li>
			</ul>
		</li>
	<?
	}
	?>	
		<li class="title">
			<span class="tit">제목</span>
			<div class="input bigInput"><input type="text" name="title" value="<?=$row['title']?>" /></div>
		</li>

		<li class="content" style="height:540px;">
			<span class="tit">내용</span>
			<div class="input textarea" style="width:100%;"><textarea name="content" id="content" style="width:100%; height:450px;"><?=$row['content']?></textarea><div style="clear:both;"></div></div>
			<div style="clear:both;"></div>
		</li>
		<li style="clear:both;"></li>
		<li class="addPic">
			<label for="addPic">
				<input type="file" name="mainImg" id="addPic" />
			</label>
		</li>
	<?
	if($_GET['idx'] > 0){
	?>
	<input name="imgModi" value="y" id="imgModi" type="hidden"/>
	<script>
		var imagef =  new Image();
		imagef.src = '<?=str_replace("/HCK/socialrainbow.kr/public_html","",$row['img'])?>';
		$("label[for='addPic']").css("background","url('<?=str_replace("/HCK/socialrainbow.kr/public_html","",$row['img'])?>') no-repeat 0 0");
		
		if(imagef.width > imagef.height){
			$("label[for='addPic']").css('background-size',"auto 100%");
		}else{
			$("label[for='addPic']").css('background-size',"100% auto");
		}

	</script>
	<?
	}else{
	?>
	<input name="imgModi" value="n" id="imgModi" type="hidden"/>
	<? } ?>
		<li class="eventPer">			
			<span class="tit">신청기간</span>
			<div class="input">
				<ul class="period start">
					<li class="year">
						<span class="select select1">
							<input type="hidden" name="eventYear1" class="value">							
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
						<span class="select select1">
							<input type="hidden" name="eventMonth1" class="value">
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
						<span class="select select1">
							<input type="hidden" name="eventTheDay1" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
					</li>
					
					<li class="time">
						<span class="select select1 hour">
							<input type="hidden" name="eventHour1" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
						<span class="select select1 miniue">
							<input type="hidden" name="eventMiniue1" class="value">
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
				<span class="bar">-</span>
				<ul class="period end" style="clear:both;">
					<li class="year">
						<span class="select select1">
							<input type="hidden" name="eventYear2" class="value">
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
						<span class="select select1">
							<input type="hidden" name="eventMonth2" class="value">
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
						<span class="select select1">
							<input type="hidden" name="eventTheDay2" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
					</li>					
					<li class="time">
						<span class="select select1 hour">
							<input type="hidden" name="eventHour2" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
						<span class="select select1 miniue">
							<input type="hidden" name="eventMiniue2" class="value">							
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

		<li class="applyPer" style="clear:both;">			
			<span class="tit">행사기간</span>
			<div class="input">
				<ul class="period start">
					<li class="year">
						<span class="select select1">
							<input type="hidden" name="appYear1" class="value">							
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
						<span class="select select1">
							<input type="hidden" name="appMonth1" class="value">
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
						<span class="select select1">
							<input type="hidden" name="appTheDay1" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
					</li>					
					<li class="time">
						<span class="select select1 hour">
							<input type="hidden" name="appHour1" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
						<span class="select select1 miniue">
							<input type="hidden" name="appMiniue1" class="value">
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
				<span class="bar">-</span>
				<ul class="period end" style="clear:both;">
					<li class="year">
						<span class="select select1">
							<input type="hidden" name="appYear2" class="value">
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
						<span class="select select1">
							<input type="hidden" name="appMonth2" class="value">
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
						<span class="select select1">
							<input type="hidden" name="appTheDay2" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
					</li>					
					<li class="time">
						<span class="select select1 hour">
							<input type="hidden" name="appHour2" class="value">
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText yellow peple"></span>
							</button>							
							<div class="bg" style="display:none;"></div>
							<ul class="selectUl2 limitL" style="display:none;">
								<li><a href="javascript:;"></a></li>
							</ul>
						</span>
						<span class="select select1 miniue">
							<input type="hidden" name="appMiniue2" class="value">
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
		<li class="place">
			<span class="tit">장소</span>
			<div class="input bigInput"><input type="text" name="place" maxlength="27" value="<?=$row['addr2']?>" /></div>
			
		</li>
		<li class="people">
			<span class="tit">서브타이틀</span>
			<div class="input">
				<span class="input">
					<input type="text" name="subtitle" value="<?=$row['people']?>" />
				</span>
			</div>
		</li>
		<li class="people">
			<span class="tit">인원</span>
			<div class="input">
				<span class="input">
					<input type="text" name="persons" value="<?=$row['people']?>" />
				</span>
			</div>
		</li>
		<li class="cost">
			<span class="tit">비용</span>
			<div class="input">
				<span class="input">
					<input type="text" name="money" value="<?=$row['money']?>" />원
				</span>
			</div>
			
		</li>
 		<li class="cost">
			<span class="tit">소속</span>
			<div class="input">
				<span class="input">
					<input type="text" name="group" value="<?=$row['belong']?>" />
				</span>
			</div>
			
		</li>
 		<li class="cost">
			<span class="tit">종류</span>
			<div class="input">
				<span class="input">
					<input type="text" name="type" value="<?=$row['type']?>" />
				</span>
			</div>
			
		</li>
		<li class="submit">
			<button type="submit">등록완료</button>
		</li>

	</ul>
	</form>
</div>
<script>
	var date    = new Date();
	var Nyear   = date.getFullYear();
	var Nyear2  = Nyear+4;
	var NMonth  = date.getMonth()+1;
	var Nday    = date.getDate();
	var NHour	= date.getHours();
	var NMinute = parseInt(date.getMinutes()/5) * 5;

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
		var Lhour   =  ob1.find("li.time span.hour input.value");
		var Lminute =  ob1.find("li.time span.miniue input.value");

		var Fyear   =  ob2.find("li.year span.select");
		var Fmonth  =  ob2.find("li.month span.select");
		var Fday    =  ob2.find("li.theDay span.select");
		var Fhour   =  ob2.find("li.time span.hour");
		var Fminute =  ob2.find("li.time span.miniue");

		appendNum(Fyear, parseInt(Lyear.val()), Nyear2, Fyear.find("input.value").val(),1);		
		var lastDay = addDate(Fday,Fyear,Fmonth,Fday.find("input.value").val());
		
		if(Lyear.val()==Fyear.find("input.value").val()){
			appendNum(Fmonth,parseInt(Lmonth.val()), 12, Fmonth.find("input.value").val(),1);
			if(Lmonth.val()==Fmonth.find("input.value").val()){
				appendNum(Fday,parseInt(Lday.val()),lastDay,Fday.find("input.value").val(),1);
				if(Lday.val()==Fday.find("input.value").val()){
					appendNum(Fhour,parseInt(Lhour.val()),23,Fhour.find("input.value").val(),1);
					if(Lhour.val()==Fhour.find("input.value").val()){
						appendNum(Fminute,parseInt(Lminute.val()),55,Fminute.find("input.value").val(),5);
					}else{
						appendNum(Fminute,0,55,Fminute.find("input.value").val(),5);
					}
				}else{
					appendNum(Fhour,0,23,Fhour.find("input.value").val(),1);
					appendNum(Fminute,0,55,Fminute.find("input.value").val(),1);
				}

			}else{
				appendNum(Fday,1,lastDay,Fday.find("input.value").val(),1);
				appendNum(Fhour,0,23,Fhour.find("input.value").val(),1);
				appendNum(Fminute,0,55,Fminute.find("input.value").val(),5);
			}
		}else{
			appendNum(Fmonth, 1, 12, Fmonth.find("input.value").val(),1);
			appendNum(Fday,1,lastDay,Fday.find("input.value").val(),1);
			appendNum(Fhour,0,23,Fhour.find("input.value").val(),1);
			appendNum(Fminute,0,55,Fminute.find("input.value").val(),5);
		}
	}
	function LimitDate(y,m,d,h,i,obj){
		var Lyear   =  obj.find("li.year span.select");
		var Lmonth  =  obj.find("li.month span.select");
		var Lday    =  obj.find("li.theDay span.select");
		var Lhour   =  obj.find("li.time span.hour");
		var Lminute =  obj.find("li.time span.miniue");
		y = parseInt(y);
		m = parseInt(m);
		d = parseInt(d);
		h = parseInt(h);
		i = parseInt(i);		
		
		var lastDay = addDateT(parseInt(Lyear.find("input.value").val()),parseInt(Lmonth.find("input.value").val()));
		if(Lyear.find("input.value").val()==y){
			appendNum(Lmonth, m, 12, Lmonth.find("input.value").val(),1);
			if(Lmonth.find("input.value").val()==m){
				appendNum(Lday, d, lastDay, Lday.find("input.value").val(),1);
				if(Lday.find("input.value").val()==d){
					appendNum(Lhour, h, 23, Lhour.find("input.value").val(),1);
					if(Lhour.find("input.value").val()==h){
						appendNum(Lminute, i, 55, Lminute.find("input.value").val(),5);
					}else{
						appendNum(Lminute, 0, 55, Lminute.find("input.value").val(),5);
					}
				}else{
					appendNum(Lminute, 0, 55, Lminute.find("input.value").val(),5);
					appendNum(Lhour, 0, 23, Lhour.find("input.value").val(),1);
				}
			}else{
				appendNum(Lminute, 0, 55, Lminute.find("input.value").val(),5);
				appendNum(Lhour, 0, 23, Lhour.find("input.value").val(),1);
				appendNum(Lday, 1, lastDay, Lday.find("input.value").val(),1);
			}
		}else{
			appendNum(Lminute, 0, 55, Lminute.find("input.value").val(),5);
			appendNum(Lhour, 0, 23, Lhour.find("input.value").val(),1);
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
				if(image.width > image.height){
					obj.css('background-size',"auto 100%");
				}else{
					obj.css('background-size',"100% auto");
				}
			} 
			reader.readAsDataURL(input.files[0]);
		}
		$("#imgModi").val("n");
	} 





	$(document).ready(function(){
		$("#mainForm").submit(function(){
			if(trim($("[name='title']").val()).length <= 0){
				alert("제목을 입력하세요.");
				return false;
			}
			if(trim($("[name='mainImg']").val()).length <= 0){
				if($("#imgModi").val()=="n"){
					alert("대표사진을 업로드하세요.");
					return false;
				}
				
			}
			if(trim($("[name='addr']").val()).length <= 0){
				alert("주소를 입력하세요.");
				return false;
			}
			if(trim($("[name='place']").val()).length <= 0){
				alert("장소를 입력하세요.");
				return false;
			}
			if(trim($("[name='persons']").val()).length <= 0){
				alert("인원수를 입력하세요.");
				return false;
			}
			if($("#charged").attr("checked")){
				if(trim($("[name='cost']").val()).length <= 0){
					alert("정가를 입력하세요.");
					return false;
				}
				
				switch($("[name='discount']").val()){
					case "적용안함" :
						break;
					case "Early Bird" :
						if($("[name='earlyCost']").val().length <= 0){
							alert("'Early Bird' 할인가를 입력하세요.");
							return false;
						}

						break;
					case "동반할인" :
						if($("[name='doubleCost']").val().length <= 0){
							alert("'동반할인' 할인가를 입력하세요.");
							return false;
						}
						break;
					case "모두적용" :
						if($("[name='earlyCost']").val().length <= 0){
							alert("'Early Bird' 할인가를 입력하세요.");
							return false;
						}
						if($("[name='doubleCost']").val().length <= 0){
							alert("'동반할인' 할인가를 입력하세요.");
							return false;
						}
						break;			
				}
			}	
			oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
		});
		$("[name='doubleCost']").keypress(function(){
			isNum();
		});
		$("[name='earlyCost']").keypress(function(){
			isNum();
		});
		$("[name='cost']").keypress(function(){
			isNum();
		});
		$("[name='persons']").keypress(function(){
			isNum();
		});

		$("#addPic").change(function(){ 
			readURL(this,$("label[for='addPic']")); 
		}); 
		$("input[name='discount']").change(function(){
			switch($(this).val()){
			
				case "적용안함" :
					$("div.earlyBird").hide();
					$("div.partnerDiscount").hide();
					break;
				case "Early Bird" :
					$("div.earlyBird").show();
					$("div.partnerDiscount").hide();
					break;
				case "동반할인" :
					$("div.earlyBird").hide();
					$("div.partnerDiscount").css("border-top","none");
					$("div.partnerDiscount").css("margin-top","0px");
					$("div.partnerDiscount").css("padding-top","0px");
					$("div.partnerDiscount").show();
					break;
				default:
					$("div.earlyBird").show();
					$("div.partnerDiscount").css("border-top","1px solid #c5dee0");
					$("div.partnerDiscount").css("margin-top","15px");
					$("div.partnerDiscount").css("padding-top","15px");
					$("div.partnerDiscount").show();					
			}
		});
		$("input[name='discount']").change();
		var eventSY = $("li.eventPer ul.start li.year span.select");
		var eventSM = $("li.eventPer ul.start li.month span.select");
		var eventSD = $("li.eventPer ul.start li.theDay span.select");
		var eventSH = $("li.eventPer ul.start li.time span.hour");
		var eventSI = $("li.eventPer ul.start li.time span.miniue");
		
		var eventEY = $("li.eventPer ul.end li.year span.select");
		var eventEM = $("li.eventPer ul.end li.month span.select");
		var eventED = $("li.eventPer ul.end li.theDay span.select");
		var eventEH = $("li.eventPer ul.end li.time span.hour");
		var eventEI = $("li.eventPer ul.end li.time span.miniue");

		var applySY = $("li.applyPer ul.start li.year span.select");
		var applySM = $("li.applyPer ul.start li.month span.select");
		var applySD = $("li.applyPer ul.start li.theDay span.select");
		var applySH = $("li.applyPer ul.start li.time span.hour");
		var applySI = $("li.applyPer ul.start li.time span.miniue");

		var applyEY = $("li.applyPer ul.end li.year span.select");
		var applyEM = $("li.applyPer ul.end li.month span.select");
		var applyED = $("li.applyPer ul.end li.theDay span.select");
		var applyEH = $("li.applyPer ul.end li.time span.hour");
		var applyEI = $("li.applyPer ul.end li.time span.miniue");

		var earlyY = $("div.earlyBird ul.period li.year span.select");
		var earlyM = $("div.earlyBird ul.period li.month span.select");
		var earlyD = $("div.earlyBird ul.period li.theDay span.select");
		var earlyH = $("div.earlyBird ul.period li.time span.hour");
		var earlyI = $("div.earlyBird ul.period li.time span.miniue");
		
		$("input[name='costS']").change(saleChn);
		$("input[name='costS']").change();


		<? if($_GET['idx'] <= 0){ ?>
			appendNum(eventSY,(Nyear-1),Nyear2,Nyear,1);
			appendNum(eventSM,1,12,NMonth,1);
			appendNum(eventSD,1,addDate(eventSD,eventSY,eventSM,Nday),Nday,1);
			appendNum(eventSH,0,23,NHour,1)
			appendNum(eventSI,0,55,NMinute,5)

			appendNum(eventEY,Nyear,Nyear2,Nyear,1);
			appendNum(eventEM,NMonth,12,NMonth,1);		
			appendNum(eventED,Nday,addDate(eventED,eventEY,eventEM,Nday),Nday,1);
			appendNum(eventEH,NHour,23,NHour,1)
			appendNum(eventEI,NMinute,55,NMinute,5)

			appendNum(applySY,Nyear,Nyear2,Nyear,1);
			appendNum(applySM,NMonth,12,NMonth,1);
			appendNum(applySD,Nday,addDate(applySD,applySY,applySM,Nday),Nday,1);
			appendNum(applySH,NHour,23,NHour,1)
			appendNum(applySI,NMinute,55,NMinute,5)

			appendNum(applyEY,Nyear,Nyear2,Nyear,1);
			appendNum(applyEM,NMonth,12,NMonth,1);
			appendNum(applyED,Nday,addDate(applyED,applyEY,applyEM,Nday),Nday,1);
			appendNum(applyEH,NHour,23,NHour,1)
			appendNum(applyEI,NMinute,55,NMinute,5);
		<? }else{ 
				$eventData1 = divDate($row['eventDateF']);
				$eventData2 = divDate($row['eventDateB']); 
				$appDate1 = divDate($row['appDateF']);
				$appDate2 = divDate($row['appDateB']);
				//$early	  = divDate($row['earlyCost']);
		?>
			appendNum(eventSY,(Nyear-1),<?=$eventData1['y']?>,Nyear,1);
			appendNum(eventSM,1,12,<?=$eventData1['m']?>,1);
			appendNum(eventSD,1,addDate(eventSD,eventSY,eventSM,Nday),<?=$eventData1['d']?>,1);
			appendNum(eventSH,0,23,<?=$eventData1['h']?>,1)
			appendNum(eventSI,0,55,<?=$eventData1['i']?>,5)
			<?
				
			$eventData1['m'] = ($eventData1['y']==$eventData2['y']) ? $eventData1['m'] : 1;
			$eventData1['d'] = (($eventData1['y']==$eventData2['y']) && ($eventData1['m']==$eventData2['m'])) ? $eventData1['d'] : 1;
			$eventData1['h'] = (($eventData1['y']==$eventData2['y']) && ($eventData1['m']==$eventData2['m']) && ($eventData1['d']==$eventData2['d'])) ? $eventData1['h'] : 0;
			$eventData1['i'] = (($eventData1['y']==$eventData2['y']) && ($eventData1['m']==$eventData2['m']) && ($eventData1['d']==$eventData2['d']) && ($eventData1['h']==$eventData2['h'])) ? $eventData1['i'] : 0;
			?>
			appendNum(eventEY,<?=$eventData1['y']?>,Nyear2,<?=$eventData2['y']?>,1);
			appendNum(eventEM,<?=$eventData1['m']?>,12,<?=$eventData2['m']?>,1);		
			appendNum(eventED,<?=$eventData1['d']?>,addDate(eventED,eventEY,eventEM,Nday),<?=$eventData2['d']?>,1);
			appendNum(eventEH,<?=$eventData1['h']?>,23,<?=$eventData2['h']?>,1)
			appendNum(eventEI,<?=$eventData1['i']?>,55,<?=$eventData2['i']?>,5)
			<?
				
			$eventData2['m'] = ($eventData2['y']==$appDate1['y']) ? $eventData2['m'] : 1;
			$eventData2['d'] = (($eventData2['y']==$appDate1['y']) && ($eventData2['m']==$appDate1['m'])) ? $eventData2['d'] : 1;
			$eventData2['h'] = (($eventData2['y']==$appDate1['y']) && ($eventData2['m']==$appDate1['m']) && ($eventData2['d']==$appDate1['d'])) ? $eventData2['h'] : 0;
			$eventData2['i'] = (($eventData2['y']==$appDate1['y']) && ($eventData2['m']==$appDate1['m']) && ($eventData2['d']==$appDate1['d']) && ($eventData2['h']==$appDate1['h'])) ? $eventData2['i'] : 0;
			?>
			appendNum(applySY,<?=$eventData2['y']?>,Nyear2,<?=$appDate1['y']?>,1);
			appendNum(applySM,<?=$eventData2['m']?>,12,<?=$appDate1['m']?>,1);
			appendNum(applySD,<?=$eventData2['d']?>,addDate(applySD,applySY,applySM,Nday),<?=$appDate1['d']?>,1);
			appendNum(applySH,<?=$eventData2['h']?>,23,<?=$appDate1['h']?>,1)
			appendNum(applySI,<?=$eventData2['i']?>,55,<?=$appDate1['i']?>,5)
			<?
				
			$appDate1['m'] = ($appDate1['y']==$appDate2['y']) ? $appDate1['m'] : 1;
			$appDate1['d'] = (($appDate1['y']==$appDate2['y']) && ($appDate1['m']==$appDate2['m'])) ? $appDate1['d'] : 1;
			$appDate1['h'] = (($appDate1['y']==$appDate2['y']) && ($appDate1['m']==$appDate2['m']) && ($appDate1['d']==$appDate2['d'])) ? $appDate1['h'] : 0;
			$appDate1['i'] = (($appDate1['y']==$appDate2['y']) && ($appDate1['m']==$appDate2['m']) && ($appDate1['d']==$appDate2['d']) && ($appDate1['h']==$appDate2['h'])) ? $eventData2['i'] : 0;
			?>
			appendNum(applyEY,<?=$appDate1['y']?>,Nyear2,<?=$appDate2['y']?>,1);
			appendNum(applyEM,<?=$appDate1['m']?>,12,<?=$appDate2['m']?>,1);
			appendNum(applyED,<?=$appDate1['d']?>,addDate(applyED,applyEY,applyEM,Nday),<?=$appDate2['d']?>,1);
			appendNum(applyEH,<?=$appDate1['h']?>,23,<?=$appDate2['h']?>,1)
			appendNum(applyEI,<?=$appDate1['i']?>,55,<?=$appDate2['i']?>,5);

		<? } ?>


		function earylChange(){
			var sy = parseInt(eventSY.find("input.value").val());
			var sm = parseInt(eventSM.find("input.value").val());
			var sd = parseInt(eventSD.find("input.value").val());
			var sh = parseInt(eventSH.find("input.value").val());
			var si = parseInt(eventSI.find("input.value").val());
			var ey = parseInt(eventEY.find("input.value").val());
			var em = parseInt(eventEM.find("input.value").val());
			var ed = parseInt(eventED.find("input.value").val());
			var eh = parseInt(eventEH.find("input.value").val());
			var ei = parseInt(eventEI.find("input.value").val());
			var ay = parseInt(earlyY.find("input.value").val());
			var am = parseInt(earlyM.find("input.value").val());
			var ad = parseInt(earlyD.find("input.value").val());
			var ah = parseInt(earlyH.find("input.value").val());
			var ai = parseInt(earlyI.find("input.value").val());
			if(!ay){
				ay = sy;
			};
			if(!am){
				am = sm;
			};
			if(!ad){
				ad = sd;
			};
			if(!ah){
				ah = sh;
			};
			if(!ai){
				ai = si;
			};
			if(ey!=ay){				
				em  = 12;
			}else{
				if(em!=am){
					ed  = addDateT(ay,am);
				}else{
					if(ed!=ad){
						eh = 23;
					}else{
						if(eh != ah){
							ei = 55;
						}
					}
				}
			}
			appendNum(earlyY,sy,ey,ay,1);
			//alert(sh+"&"+ah);
			if(sy>=ay){
				appendNum(earlyM,sm,em,am,1);
				if(sm>=am){
					appendNum(earlyD,sd,ed,ad,1);
					if(sd>=ad){						
						appendNum(earlyH,sh,eh,ah,1);
						if(sh>=ah){
							appendNum(earlyI,si,ei,ai,5);
						}else{
							appendNum(earlyI,0,ei,ai,5);
						}
					}else{
						appendNum(earlyI,0,ei,ai,5);
						appendNum(earlyH,0,eh,ah,1);
					}
				}else{
					appendNum(earlyI,0,ei,ai,5);
					appendNum(earlyH,0,eh,ah,1);
					appendNum(earlyD,1,ed,ad,1);
				}
			}else{
				appendNum(earlyI,0,ei,ai,5);
				appendNum(earlyH,0,eh,ah,1);
				appendNum(earlyD,1,ed,ad,1);
				appendNum(earlyM,1,em,am,1);
			}			
		};
		earlyY.find("input.value").change(function(){
			earylChange();
		});
		earlyM.find("input.value").change(function(){
			earlyY.find("input.value").change();
		});
		earlyD.find("input.value").change(function(){
			earlyY.find("input.value").change();
		});
		earlyH.find("input.value").change(function(){
			earlyY.find("input.value").change();
		});
		earlyI.find("input.value").change(function(){
			earlyY.find("input.value").change();
		});	
		
		earylChange();

		eventSY.find("input.value").change(function(){		
			LimitDate((Nyear-1),1,1,0,0,$("li.eventPer ul.start"));
			appDate($("li.eventPer ul.start"),$("li.eventPer ul.end"));
			appDate($("li.eventPer ul.start"),$("li.applyPer ul.start"));
			appDate($("li.eventPer ul.start"),$("li.applyPer ul.end"));
			earylChange();

		});
		eventSM.find("input.value").change(function(){
			eventSY.find("input.value").change();
		});
		eventSD.find("input.value").change(function(){
			eventSY.find("input.value").change();
		});
		eventSH.find("input.value").change(function(){
			eventSY.find("input.value").change();
		});
		eventSI.find("input.value").change(function(){
			eventSY.find("input.value").change();
		});
		
		
		eventEY.find("input.value").change(function(){
			LimitDate(eventSY.find("input.value").val(),eventSM.find("input.value").val(),eventSD.find("input.value").val(),eventSH.find("input.value").val(),eventSI.find("input.value").val(),$("li.eventPer ul.end"));
			appDate($("li.eventPer ul.end"),$("li.applyPer ul.start"));
			appDate($("li.eventPer ul.end"),$("li.applyPer ul.end"));
			earylChange();
		});
		eventEM.find("input.value").change(function(){		
			eventEY.find("input.value").change();
		});
		eventED.find("input.value").change(function(){
			eventEY.find("input.value").change();
		});
		eventEH.find("input.value").change(function(){
			eventEY.find("input.value").change();
		});
		eventEI.find("input.value").change(function(){
			eventEY.find("input.value").change();
		});
		
		
		applySY.find("input.value").change(function(){
			LimitDate(eventEY.find("input.value").val(),eventEM.find("input.value").val(),eventED.find("input.value").val(),eventEH.find("input.value").val(),eventEI.find("input.value").val(),$("li.applyPer ul.start"));
			appDate($("li.applyPer ul.start"),$("li.applyPer ul.end"));
		});
		applySM.find("input.value").change(function(){
			applySY.find("input.value").change();
		});
		applySD.find("input.value").change(function(){
			applySY.find("input.value").change();
		});
		applySH.find("input.value").change(function(){
			applySY.find("input.value").change();
		});
		applySI.find("input.value").change(function(){
			applySY.find("input.value").change();
		});
		
		
		
		applyEY.find("input.value").change(function(){
			LimitDate(applySY.find("input.value").val(),applySM.find("input.value").val(),applySD.find("input.value").val(),applySH.find("input.value").val(),applySI.find("input.value").val(),$("li.applyPer ul.start"));
		});
		applyEM.find("input.value").change(function(){
			applyEM.find("input.value").change();
		});
		applyED.find("input.value").change(function(){
			applyEM.find("input.value").change();
		});
		applyEH.find("input.value").change(function(){
			applyEM.find("input.value").change();
		});
		applyEI.find("input.value").change(function(){
			applyEM.find("input.value").change();
		});		
		
	});
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

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
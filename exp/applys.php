<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

$_GET['type']=($_GET['type'])?$_GET['type'] : "cExp";
$mit =  new Mittel();
$mit->opt = $option['exp'];
$row = $mit->outputDetail();
unset($mit);

if($_GET['type']=="cExp"){
?>


<div class="cExpDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div style="clear:both;"></div>
<!-- 	<div class="btn">
	 		<button type="button" class="personApp" onclick="location.href='#'"/>개인신청</button>
		<button type="button" class="groupApp" onclick="location.href='#'"/>단체신청</button> 
	</div> -->
</div>
<?}else{?>
<div class="wExpDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div style="clear:both;"></div>
	<!--div class="btn">
		<button type="button" class="noPay" onclick="location.href='#'"/>무급</button>
		<button type="button" class="pay" onclick="location.href='#'"/>유급</button>
	</div-->
</div>
<?}?>


<div class="exp contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class="detailTit"><?=$row['title']?></div>
	<div class="contentTop">
		<div class="picture"><img src="<?=$row['img']?>" /></div>
		<div class="text">
			<span class="rcNum"><?=$row['people']?></span>
			<span class="rcDate">~<?=$row['eventDateE']['m']?>.<?=$row['eventDateE']['d']?></span>
			<span class="cost"><?=number_format($row['cost'])?>원</span>
			<span class="pay" style="display:none;">월 <?=$row['pay']?>만원</span>
			<span class="cont"><?=$row['etc']?></span>
			<div class="btn">				
				<?if($_GET['type']=="cExp"){?>
				<? if($row['appType']=="단체"){ ?>
				<button type="button" class="groupApp" onclick="location.href='applys.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"></button>
				<? }else if($row['appType']=="개인"){ ?>
				<button type="button" class="personApp" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"></button>
				<? }else{ ?>
				<button type="button" class="personApp" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"/>개인신청</button>
				<button type="button" class="groupApp" onclick="location.href='applys.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"/>단체신청</button>
				<? } ?>
			
				<?}else{?>
				<button type="button" class="apply" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$row['idx']?>'" />신청하기</button>
				<?}?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<form action="payProc.php" method="post" class="subForm" ' onkeydown="if(event.keyCode==13) return false;">
		<div class="detailCont">
			<span class="applyTit">참여신청</span>
			<input type="hidden" name="tab" value="exp"/>
			<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
			<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
			<input type="hidden" name="appType" value="단체"/>
			<input type="hidden" name="cost" value="<?=$row['cost']?>"/>
			<input type="hidden" name="title" value="<?=$row['title']?>"/>
			<input type="hidden" name="id" value="<?=$_SESSION['id']?>"/>
			<?
			if($_SESSION['id']){
				$db = new Dbcon();
				$db->table = "apply";
				$db->keyfield = "idx";
				$db->where = "writer = '".$_SESSION['id']."' and fidx='".$_GET['idx']."' and tab='exp'";
				$cnt = $db->TotalCnt();
				if($db->TotalCnt() > 0){
					$db->field = "idx,tab,fidx,writer,name,grName,email,phone,job,msg,mdate,cdate";
					$db->orderBy = "idx asc";
					$sel = $db->Select();					
					$row1 = mysql_fetch_array($sel);
					$grName = $row1['grName'];
					$job = $row1['job'];
					$email = explode("@",$row1['email']);
					$name = $row1['name'];
					$phone = explode("-",$row1['phone']);
					$msg = $row1['msg'];
					$idx = $row1['idx'];
				}				
			}			
			?>
			<ul class="apply" id="apply">
				<li class="grp_Name">
					<span class="tit">단체명</span>
					<span class="input"><input type="text" name="grp_Name" class="grp_Name" value="<?=$grName?>"/></span>
				</li>
				<li class="num">
					<span class="tit">인원</span>
					<span class="input"><input type="text" name="people_Num" class="num" value="<?=$cnt?>"/></span>
					<span class="person">명</span>
				</li>
					
				<li class="Respondent">
					<span class="tit">신청인</span>
					<span class="input"><input type="text" name="name[]" class="name off " id="name" value='<?=$name?>'/></span>
				
					<span class="Contacts">
						<span class="select selectM">
							<input type="hidden" value="010" class="inputDefault"/>
							<input type="hidden" name="phone1[]" class="value" id="phonHeader" value='<?=$phone[0]?>'/>
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText purple phone"></span>											
							</button>
							<ul class="selectUl2" style="display:none;">
								<li><a href="javascript:;">010</a></li>
								<li><a href="javascript:;">011</a></li>
								<li><a href="javascript:;">016</a></li>
								<li><a href="javascript:;">017</a></li>
								<li><a href="javascript:;">018</a></li>
								<li><a href="javascript:;">019</a></li>
							</ul>
						</span>	
						<span class="hyphen"></span>
					<span class="input"><input type="text" name="phone2[]" value="<?=$row['phone'][1]?>" maxlength="4" /></span>			
					<span class="hyphen"></span>
					<span class="input"><input type="text" name="phone3[]" value="<?=$row['phone'][2]?>"maxlength="4" /></span>
					</span>
					<? if($idx){ ?>
					<input type="hidden" name='idx[]' value="<?=$idx?>"/>
					<? } ?>  
				</li>
				<? 
				if($cnt > 1){
					while($row1 = mysql_fetch_array($sel)){	
						$job = $row1['job'];
						$name = $row1['name'];
						$phone = explode("-",$row1['phone']);
				?>
				<li class="Respondent">
					<button type="button" class="del">삭제</button>
					<span class="tit">신청인</span>
					<span class="input"><input type="text" name="name[]" class="name off " id="name" value='<?=$name?>'/></span>
					<!--span class="input1"><input type="text" name="job[]" class="job off" id="job" value='<?=$job?>'/></span-->
					<span class="Contacts">
						<span class="select selectM">
							<input type="hidden" value="010" class="inputDefault"/>
							<input type="hidden" name="phone1[]" class="value" id="phonHeader" value='<?=$phone[0]?>'/>
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText purple phone"></span>											
							</button>
							<ul class="selectUl2" style="display:none;">
								<li><a href="javascript:;">010</a></li>
								<li><a href="javascript:;">011</a></li>
								<li><a href="javascript:;">016</a></li>
								<li><a href="javascript:;">017</a></li>
								<li><a href="javascript:;">018</a></li>
								<li><a href="javascript:;">019</a></li>
							</ul>
						</span>	
						<span class="hyphen"></span>
						<span class="input"><input type="text" name="phone2[]" value="<?=$row['phone'][1]?>" maxlength="4" /></span>			
						<span class="hyphen"></span>
						<span class="input"><input type="text" name="phone3[]" value="<?=$row['phone'][2]?>"maxlength="4" /></span>
					</span>
					<? if($row1['idx']){ ?>
					<input type="hidden" name='idx[]' value="<?=$row1['idx']?>"/>
					<? } ?>
				</li>
				<? }
				}	
				?>
				<li class="copy" style="display:none">
					<button type="button" class="del">삭제</button>
					<span class="tit">신청인</span>
					<span class="input"><input type="text" name="name[]" class="name off" /></span>
					<!--span class="input1"><input type="text" name="job[]" class="job off"/></span-->
					<span class="Contacts">
						<span class="select selectM">
							<input type="hidden" value="010" class="inputDefault"/>
							<input type="hidden" name="phone1[]" class="value" id="phonHeader" value='<?=$phone[0]?>'/>
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText purple phone"></span>											
							</button>
							<ul class="selectUl2" style="display:none;">
								<li><a href="javascript:;">010</a></li>
								<li><a href="javascript:;">011</a></li>
								<li><a href="javascript:;">016</a></li>
								<li><a href="javascript:;">017</a></li>
								<li><a href="javascript:;">018</a></li>
								<li><a href="javascript:;">019</a></li>
							</ul>
						</span>	
						<span class="hyphen"></span>
						<span class="input"><input type="text" name="phone2[]" value="" maxlength="4" /></span>			
						<span class="hyphen"></span>
						<span class="input"><input type="text" name="phone3[]" value=""maxlength="4" /></span>
					</span>
				</li>
			</ul>
			<ul class="apply">
				<li class="addBtn" >
					<button type="button" class="addButton">추가</button>
				</li>
				<li class="email">
					<span class="tit">이메일</span>
					<span class="input"><input type="text" name="email" class="name" value="<?=$email[0]?>" onKeyup="checkEng(this);"/></span>
					<span class="at">@</span>
					<span class="select selectL">
						<input type="hidden" name="emailFooter" id="emailSelect" class="value" value="<?=$email[1]?>">							
						<button type="button" class="selectBtn">
							<span class="selectEmail">메일 선택</span>
						</button>
						<ul class="selectUl1" style="display:none;">
							<li><a href="javascript:;">naver.com</a></li>
							<li><a href="javascript:;">nate.com</a></li>
							<li><a href="javascript:;">hanmail.net</a></li>
							<li><a href="javascript:;">daum.net</a></li>
							<li><a href="javascript:;">gmail.com</a></li>
							<li><a href="javascript:;">dreamwiz.com</a></li>
							<li><a href="javascript:;">직접입력</a></li>
						</ul>
						<input type="text" name="emailFooter2" class="emailText" value="<?=$email[1]?>" style="z-index:9999;display:none;width:160px;position:absolute;background-color:none;top:5px;margin-left:6px;height:28px;"/>
					</span>
				</li>
					<li class="msg">
					<span class="tit">메세지</span>
					<span class="input">
						<textarea name="msg"><?=$msg?></textarea>
					</span>
				</li>
			</ul>
			<div style="clear:both" ></div>
		</div >

		<div class="deatilBottom" style="clear:both">
			<button type="button" class="cancle btn" onclick="javascript:history.go(-1)">취소</button>
			<button type="submit" class="btnNext btn">다음</button>
			<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
			
		</div>
	</form>
</div>

<script>
	function add(){
		var ul= $("#apply");
		var copy = ul.find("li.copy").clone();
		
		copy.attr("class","Respondent");
		copy.show();
		copy.find("span.select").each(select);	
		copy.find("button.del").click(del);
		copy.find('input.off').blur(Blur);
		copy.find('input.off').focus(Focus);
		copy.find("input[name='phone2[]']").keyup(phon2Chn);
		copy.find("input[name='phone3[]']").keyup(phon3Chn);
		ul.append(copy);	
		var liCnt = $("li.Respondent").length;
		$("li.num input").val(liCnt);
		

	}
	$("button.addButton").click(add);
	function del(){
		var par=$(this).parent();
		var name=par.find("input[name='name[]']").val();
		//var job =par.find("input[name='job[]']").val();
		var phone2 =par.find("input[name='phone2[]']").val();
		var phone3 =par.find("input[name='phone3[]']").val();
		if(name.length > 0||phone2.length>0||phone3.length>0){
				if(confirm("정말 삭제하시겠습니까")){
					par.remove();
				
				}
		}else{
		par.remove();
		}
		var liCnt = $("li.Respondent").length;
		$("li.num input").val(liCnt);
	} 
	$("button.del").click(del);

	function Focus(){
	$(this).attr("class","on");
	}
	$('input.off').focus(Focus);

	function Blur(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
	}
	$('input.off').blur(Blur);

	function num(){
		var number = parseInt($("li.num input").val());
		var liCnt = $("li.Respondent").length;
		number = number - liCnt;
		if(number>0){
			for(var i=0;i<number;i++){
					add();
			}
		}else if(number<0){
			number=Math.abs(number);
			for(var i=0;i<number;i++){
					$("li.Respondent").eq(-1).remove();
			}
		}
	}
	$("li.num input").change(num);


	$("form.subForm").submit(function(){
		if($("li.grp_Name input").val().length<=0){
         alert("단체명을 입력하세요.");
         $("li.name input").focus();
         return false;
      }
      if($("li.num input").val().length<=0){
         alert("인원을 입력하세요.");
         $("li.name input").focus();
         return false;
      }
	  if($("#name").val().length<=0){
			alert("신청자이름을 입력하세요.");
			$("#name").focus();
			return false;
	} 
	if($("#job").val().length<=0){
			alert("신청자 연락처를 입력하세요.");
			$("#job").focus();
			return false;
	}
	 if($("li.Respondent input.phone2").val().length<=0||$("li.Respondent input.phone3").val().length<=0){
         alert("연락처를 입력하세요");
		return false;
	 }
	if($("li.email input").val().length<=0){
			alert("이메일을 입력하세요.");
			$("li.email input").focus();
			return false;
		}
	});
	$("input").focus();

	
		
	function checkNum( obj ) {
		var num_regx=/^[0-9]*$/i;
		if(!num_regx.test(obj.value) ) {
			alert("숫자만 입력할수 있습니다.");
			var num_regx=/[^0-9]*$/i;
			var st = obj.value.match(num_regx)
			obj.value = obj.value.replace(st,"");
			
		} 
		if($("input[name='phone2[]']").val().length == 4) { 
			$("input[name='phone3[]']").focus(); 
		} 
	}
	function phon2Chn(){
		var num_regx=/^[0-9]*$/i;
		if(!num_regx.test($(this).val()) ) {
			alert("숫자만 입력할수 있습니다.");
			var num_regx=/[^0-9]*$/i;
			var st = $(this).val().match(num_regx)
			$(this).val($(this).val().replace(st,""));
			
		} 
		if($(this).val().length == 4) { 
			$(this).parent().parent().find("input[name='phone3[]']").focus(); 
		} 
	}
	function phon3Chn(){
		var num_regx=/^[0-9]*$/i;
		if(!num_regx.test($(this).val()) ) {
			alert("숫자만 입력할수 있습니다.");
			var num_regx=/[^0-9]*$/i;
			var st = $(this).val().match(num_regx)
			$(this).val($(this).val().replace(st,""));
			
		} 
	}
	$("input[name='phone2[]']").keyup(phon2Chn);
	$("input[name='phone3[]']").keyup(phon3Chn);
	
	function checkEng( obj ) {
		var num_regx=/^[a-zA-Z0-9]*$/i;
		if(!num_regx.test(obj.value) ) {
			alert("한글은 입력할수 없습니다.");
			var num_regx=/[^a-zA-Z0-9]*$/i;
			var st = obj.value.match(num_regx)
			obj.value = obj.value.replace(st,"");
		} 	
	}

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
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
<!-- 	<div class="btn">
		<button type="button" class="noPay" onclick="location.href='#'"/>무급</button>
		<button type="button" class="pay" onclick="location.href='#'"/>유급</button>
	</div> -->
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
			<span class="cost"><?=$row['cost']?></span>
			<span class="pay" style="display:none;">월 <?=$row['pay']?>만원</span>
			<span class="cont"><?=$row['etc']?></span>
			<div class="btn">				
				<?if($_GET['type']=="cExp"){?>
				<button type="button" class="personApp" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$row['idx']?>'"/>개인신청</button>
				<button type="button" class="groupApp" onclick="location.href='applys.php?type=<?=$_GET['type']?>&idx=<?=$row['idx']?>'"/>단체신청</button>
				<?}else{?>
				<button type="button" class="apply" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$row['idx']?>'" />신청하기</button>
				<?}?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<form action="payProc.php?type=<?=$_GET['type']?>" method="post" ' onkeydown="if(event.keyCode==13) return false;">
		<div class="detailCont">
		<?
		if($_SESSION['id']){
			$db = new Dbcon();
			$db->table = "apply";
			$db->keyfield = "idx";
			$db->where = "writer = '".$_SESSION['id']."' and fidx='".$_GET['idx']."' and tab='exp'";
			$cnt = $db->TotalCnt();
			if($cnt > 0){
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
		?>
		<input type="hidden" name="idx" value="<?=$idxso?>"/>
		<?		
			}
		}
		?>
			<span class="applyTit">참여신청</span>
			<input type="hidden" name="tab" value="exp"/>
			<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
			<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
			<input type="hidden" name="cost" value="<?=$row['cost']?>">
			<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
			<input type="hidden" name="one" value="1">
			<ul class="apply">
				<li class="name">
					<span class="tit">이름</span>
					<span class="input"><input type="text" name="name" class="name" value="<?=$name?>"/></span>
					<input type="hidden" name="title" value="<?=$row['title']?>">
				

				</li>
				<li class="email">
					<span class="tit">이메일</span>
					<span class="input"><input type="text" name="email" class="name" value="<?=$email[0]?>" onKeyup="checkEng(this);"/></span>
					<span class="at">@</span>
					<span class="select selectL">
						<input type="hidden" name="emailFooter" id="emailSelect"  value="<?=$email[1]?>" class="value">							
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
				<li class="phone">
					<span class="tit">연락처</span>
					<span class="select selectM">
						<input type="hidden" value="010" class="inputDefault"/>
						<input type="hidden" name="phone1" class="value" id="phonHeader" value='<?=$phone[0]?>'/>
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
					<span class="input"><input type="text" name="phone2" value="<?=$row['phone'][1]?>" maxlength="4" onKeyup='checkNum(this)'/></span>			
					<span class="hyphen"></span>
					<span class="input"><input type="text" name="phone3" value="<?=$row['phone'][2]?>"maxlength="4"onKeyup='checkNum(this);' /></span>
				</li>
				<li class="job">
					<span class="tit">소속</span>
					<span class="input"><input type="text" name="job" class="name" value='<?=$job?>'/></span>
				</li>
				<li class="msg">
					<span class="tit">메세지</span>
					<span class="input">
						<textarea name="msg" value='<?=$msg?>'></textarea>
					</span>
				</li>
			</ul>
		</div>
		<div class="deatilBottom" style="clear:both">
			<button type="button" class="cancle btn" onclick="javascript:history.go(-1)">취소</button>
			<button type="submit" class="btnNext btn">다음</button>
		</div>
	</form>
</div>


<script>
	$("form").submit(function(){
		if($("li.name input").val().length<=0){
			alert("이름을 입력하세요.");
			$("li.name input").focus();
			return false;
		}
		if($("li.email input").val().length<=0){
			alert("이메일을 입력하세요.");
			$("li.email input").focus();
			return false;
		}
		if($("li.phone input[name='phone2']").val().length<=0||$("li.phone input[name='phone3']").val().length<=0){
			alert("연락처를 입력하세요");
			$("li.phone input").focus();
			return false;
		}
		if($("li.job input").val().length<=0){
			alert("소속을 입력하세요");
			$("li.job input").focus();
			return false;
		}

	});
	function checkNum( obj ) {
		var num_regx=/^[0-9]*$/i;
		if(!num_regx.test(obj.value) ) {
			alert("숫자만 입력할수 있습니다.");
			var num_regx=/[^0-9]*$/i;
			var st = obj.value.match(num_regx)
			obj.value = obj.value.replace(st,"");
			
		} 
		if($("input[name='phone2']").val().length == 4) { 
			$("input[name='phone3']").focus(); 
		} 
	}
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
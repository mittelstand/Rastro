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
	<div class="btn">
		<button type="button" class="personApp" onclick="location.href='#'"/>개인신청</button>
		<button type="button" class="groupApp" onclick="location.href='#'"/>단체신청</button>
	</div>
</div>
<?}else{?>
<div class="wExpDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div style="clear:both;"></div>
	<div class="btn">
		<button type="button" class="noPay" onclick="location.href='#'"/>무급</button>
		<button type="button" class="pay" onclick="location.href='#'"/>유급</button>
	</div>
</div>
<?}?>


<div class="exp contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class="detailTit">청년봉GO</div>
	<div class="contentTop">
		<div class="picture"><img src="/file/expTest04.jpg" /></div>
		<div class="text">
			<span class="rcNum">10</span>
			<span class="rcDate">~06.30</span>
			<span class="cost">30,000</span>
			<span class="pay" style="display:none;">월 30만원</span>
			<span class="cont">로티보이의 멤버쉽카드는 구매하신 금액의 3%가 적립됩니다. <br>
(백화점 및 일부 점포에서는 적립 및 사용 불가)<br><br>

적립한 포인트는 3,000포인트 이상부터 사용이 가능합니다.</span>
			<div class="btn">				
				<?if($_GET['type']=="cExp"){?>
				<button type="button" class="personApp" onclick="location.href='apply.php?type=<?=$_GET['type']?>'"/>개인신청</button>
				<button type="button" class="groupApp" onclick="location.href='apply.php?type=<?=$_GET['type']?>'"/>단체신청</button>
				<?}else{?>
				<button type="button" class="apply" onclick="location.href='apply.php?type=<?=$_GET['type']?>'" />신청하기</button>
				<?}?>
			</div>
		</div>			
	</div>
	<form action="/proc.php" method="post">
		<div class="detailCont">
			<span class="applyTit">참여신청</span>
			<input type="hidden" name="tab" value="exp"/>
			<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
			<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
			<ul class="apply" id="apply">
				<li class="grp_Name">
					<span class="tit">단체명</span>
					<span class="input"><input type="text" name="grp_Name" class="grp_Name"/></span>
				</li>
				<li class="num">
					<span class="tit">인원</span>
					<span class="input"><input type="text" name="people_Num" class="num" value="1"/></span>
					<span class="person">명</span>
				</li>
				<li class="copy" style="display:none">
					<button type="button" class="del">삭제</button>
					<span class="tit">신청인</span>
					<span class="input"><input type="text" name="name[]" class="name off" /></span>
					<span class="input1"><input type="text" name="job[]" class="job off"/></span>
					<span class="Contacts">
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
						<span class="input"><input type="text" name="phone2"/></span>			
						<span class="hyphen"></span>
						<span class="input"><input type="text" name="phone3"/></span>
					</span>
				</li>	
				<li class="Respondent">
					<span class="tit">신청인</span>
					<span class="input"><input type="text" name="name[]" class="name off"/></span>
					<span class="input1"><input type="text" name="job[]" class="job off"/></span>
					<span class="Contacts">
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
						<span class="input"><input type="text" name="phone2"/></span>			
						<span class="hyphen"></span>
						<span class="input"><input type="text" name="phone3"/></span>
					</span>
				</li>	
			</ul>
			<ul class="apply">
				<li class="addBtn" >
					<button type="button" class="addButton">추가</button>
				</li>
				<li class="email">
					<span class="tit">이메일</span>
					<span class="input"><input type="text" name="email" class="name"/></span>
					<span class="at">@</span>
					<span class="select selectL">
						<input type="hidden" name="emailFooter" class="value">							
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
						<textarea name="msg"></textarea>
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
		ul.append(copy);	
		var liCnt = $("li.Respondent").length;
		$("li.num input").val(liCnt);
		

	}
	$("button.addButton").click(add);
	function del(){
		var par=$(this).parent();
		var name=par.find("input.name").val();
		var job =par.find("input.job").val();
		var phone2 =par.find("input[name='phone2']").val();
		var phone3 =par.find("input[name='phone3']").val();
		if(name.length>0||job.length>0||phone2>0||phone3>0){
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

$('input.off').focus(function(){
	$(this).attr("class","on");
});
$('input.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});
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

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
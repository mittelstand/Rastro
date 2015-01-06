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
<?


$_GET['idx'] = $_GET['fidx'];
$keyTab = "exp";
$mit =  new Mittel();
$mit->opt = $option['exp'];
$row = $mit->outputDetail();
unset($mit);


?>
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class="detailTit"><?=$row['title']?> </div>
	<div class="contentTop">
		<div class="picture"><img src="<?=$row['img']?>" /></div>
		<div class="text">
			<span class="rcNum"><?=$row['people']?></span>
			<span class="rcDate">~<?=$row['eventDateE']['m']?>.<?=$row['eventDateE']['d']?></span>
			<span class="cost">30,000</span>
			<span class="pay" style="display:none;">월 <?=$row['pay']?>만원</span>
			<span class="cont"><?=$row['etc']?>
			<div class="btn">
			<?if($_GET['type']=="cExp"){?>
			<?	if($row['appType']=="단체"){ ?>
				<button type="button" class="personApp" onclick="location.href='#'">개인신청</button>
			<?	}else if($row['appType']=="개인"){ ?>
				<button type="button" class="groupApp" onclick="location.href='#'">단체신청</button>
			<?	}else{ ?>
				<button type="button" class="personApp" onclick="location.href='#'">개인신청</button>
				<button type="button" class="groupApp" onclick="location.href='#'">단체신청</button>
			<?	} ?>
			<?}else{?>
				<button type="button" class="apply" onclick="location.href='#'" style="display:none;">신청하기</button>
			<? } ?>
			</div>
		</div>			
	</div>
	<?
	$keyTab = "apply";
	$_GET['tab'] = "exp";
	$mit =  new Mittel();
	$mit->opt = $option['apply'];
	$row = $mit->outputList();
	$cnt = $mit->listCnt;
	unset($mit);
	
	?>

	<div class="detailCont" style="width:938px; padding:30px 0 0;">
		<span class="appListTit">신청자 명단</span>
		<form action="/loginProc.php" method="post" id="mainForm">
			<ul class="memberList">
				<li class="top">
					<div class="chk chkW">
						<label for="checkAll" class="chkB">
								<input id="checkAll" global="-53"  type="checkbox"  />
						</label>
					</div>
					<div class="nameApp nameAppW"><span>이름</span></div>
					<div class="phoneApp phoneAppW"><span>연락처</span></div>	
					<div class="emailApp emailAppW"><span>이메일</span></div>		
					<div class="jobApp jobAppW"><span>소속</span></div>
					<div class="msg msgW"><span>메세지</span></div>
				</li>
				<?
				if(is_array($row)){
					foreach($row as $key=>$val){
				?>
				<li class="list" id=<?=$val['idx']?>>
					<div class="chk chkW">
						<label for="ckBox<?=$val['idx']?>" class="chkB">
							<input id="ckBox<?=$val['idx']?>"  global="-53" type="checkbox" class="ckBox" name="number[]" value="<?=$val['idx']?>" />
						</label>
					</div>
					<input type="hidden" class="fidx" value="<?=$_GET['idx']?>">
					<div class="name nameAppW"><span><?=$val['name']?></span></div>
					<div class="phone phoneAppW"><span><?=$val['phone'][0].$val['phone'][1].$val['phone'][2]?></span></div>
					<div class="email emailAppW"><span><?=$val['email'][0]?></span></div>
					<div class="job jobAppW"><span><?=$val['job']?></span></div>
					<div class="msg msgW"><span><?=$val['msg']?></span></div>			
				</li>
						<?
					}
				}
				?>
				
				<? /*}*/ ?>
				<!--li class="none">
				신청자가 없습니다.
				</li-->		
			</ul>
		</form>
	</div>
	<div class="deatilBottom">
		<div class="page pgNum">
			<?
			$pg = new Page();
			$pg->totalCnt = $cnt;
			$pg->nowPage = $_GET['page'];
			$pg->href = "applicantList.php?fidx=".$_GET['idx']."&type=".$_GET['type'];
			$pg->limitPage = 8;
			$pg->limitPageGroup = 10;
			$pg->Setting();	
			?>
			<button class="prev" type="button" onclick="location.href='<?=$pg->prevPageLink?>'">&lt;</button>
			<?echo $pg->Output();
			?>
			<button class="next" type="button" onclick="location.href='<?=$pg->nextPageLink?>'">&gt;</button>
		</div>
	
			<button type="button" class="deleteB btn">삭제</button>
		
	</div>
	
</div>

<script>
	function del(){
		var par = $(this).parent();
		var parprev = par.prev();
		var fidx = parprev.find("li.list input.fidx").val();
		
		var chkli = parprev.find("li.list input[name='number[]']:checked");
		var chk = parprev.find("li.list input[name='number[]']");
			  if(confirm("정말 삭제하시겠습니까")){
				 chkli.each( function(){
				 var i = $(this).val();
		
				$.ajax({
				type: 'POST',
				url: '/exp/deletechk.ax.php',
				dataType: 'json',
				data: {
					fidx : fidx,
					id : i
				},success: function(result){
					$("#"+i).remove();
					
				}
			});
			   });
			   }
			  
	}
	$("button.deleteB").click(del);
	

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
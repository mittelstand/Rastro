<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
$_GET['page'] = ($_GET['page']) ? $_GET['page'] : 1; 

$keyTab = "board";

$mit =  new Mittel();
$mit->opt = $option['board'];
$mit->block=8;
$row = $mit->outputList();
$cnt = $mit->listCnt;
unset($mit);


?>
<form action="delMProc.php" method="post" id="mainForm">
<div class="contentTop contentBox">	
	<?if($_GET['type']=="nlc"){?>
	<div class="tit" style="margin: 70px 0 75px 0;">로그인 없는 게시판</div>
	<?}?>
	<ul class="boardList">
	
		<li class="top bListTop">
			<?if($_SESSION['admin']==1){?>

			 <div class="chk chkW board">
				<label for="checkAll" class="chkC adChkB">
					<input id="checkAll" global="-1029"  type="checkbox"  />
				</label>
			</div>
		<?}else{?>
			<div class="num numW board"><span>번호</span></div>
			<?}?>
			<div class="title titleW board" ><span>제목</span></div>
			<div class="name nameW board" ><span>글쓴이</span></div>
			<div class="date dateW board" ><span>날짜</span></div>
			<div class="hits hitsW board" ><span>조회수</span></div>
			
		</li>
	
		<? 
		
		
		$num = $cnt -($option['board']['listBlock'] * ($_GET['page']-1));
		if(is_array($row)){
			foreach($row as $key=>$val){
				$_GET['tab'] = 'board';
				$_GET['idx']=$val['idx'];
				$mit =  new Mittel();
				$mit->opt = $option['cmnt'];
				$row1 = $mit->outputList();
				$cnt1 = $mit->listCnt;
				unset($mit);
		?>
		<li class="bList" style="clear:both">
			
		<?if($_SESSION['admin']==1){?>

			 <div class="chk chkW board">
				<label for="ckBox<?=$val['idx']?>" class="chkC adChkB">
					<input id="ckBox<?=$val['idx']?>" global=""  class="ckBox" type="checkbox" name="number[]" value="<?=$val['idx']?>" />
				</label>
			</div>
		<?}else{?>
			<div class="num numW board"><span><?=$num?>.</span></div>
			<?}?>
			<div class="title titleW board" style="color:#aaaaaa;">	
				<span class="title">
					<a href="detail.php?idx=<?=$val['idx']?>&type=<?=$_GET['type']?>&page=<?=$_GET['page']?>&num=<?=$num?>">
						<nobr><?=$val['title']?> [<?=$cnt1?>]
							<span class="reply">
							</span>
						</nobr>
					</a>
				</span>
			</div>
			<div class="name nameW board"><span><?=$val['nName']?></span></div>
			
			<div class="date dateW board"><span><?=substr($val['cdate']['y'],2,2)?>. <?=$val['cdate']['m']?>. <?=$val['cdate']['d']?></span></div>
			<div class="hits hitsW board"><span><?=$val['hits']?></span></div>
		</li>
		<?
		$num--;
			}
		}
		?>
		
		
	</ul>
		<input type="hidden" name="key" value="board"/>
		<input type="hidden" name="type" value="<?=$_GET['type']?>" />
		<input type="hidden" name="page" value="<?=$_GET['page']?>" />
	</form>
	<div class="boardBottom">
		
		<div class="page pgNum" style="margin-top:42px">
			<?
			$pg = new Page();
			$pg->totalCnt = $cnt;
			$pg->nowPage = $_GET['page'];
			$pg->href = "index.php";
			$pg->limitPage = 10;
			$pg->limitPageGroup = 10;
			$pg->Setting();	
			?>
			<button class="prev" type="button" onclick="location.href='<?=$pg->prevPageLink?>'" >◀</button>
			<?echo $pg->Output();
			?>
			<button class="next" type="button" onclick="location.href='<?=$pg->nextPageLink?>'">▶</button>
		</div>
		<div class="writeBtn">
		
		
		<button type="button" class="boardWrite" onclick="location.href='write.php?type=nlc'">글쓰기</button>
	
		</div>
		<!-- <script>
			$("button.write").click(function(){
				$('ul.tnb li.login a').click();
				$("div.layerLogin input[name='returnUrl']").val("/board/write.php?type=<?=$_GET['type']?>");
			});
		</script> -->
	
	</div>
	<? if($_SESSION['admin']==1){?>
	<div class="adminBtn" style="float:left;">
		<button type="button" class="icon del">삭제</button>
	</div>
</div>
	<?}?>
<script>
	$("button.del").click(function(){
		var chkli = $("#mainForm").find("li.bList input[name='number[]']:checked");
		if(chkli.length <=0){
			alert("선택을 하여주세요");
			return false;
		}
		if(confirm("정말삭제하시겠습니까")){		
			$("#mainForm").submit();
		}	
	})
	

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
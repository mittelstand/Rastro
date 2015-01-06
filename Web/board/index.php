<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
$_GET['page'] = ($_GET['page']) ? $_GET['page'] : 1; 
if($_GET['ms']==1){
	$_GET['id']=$_SESSION['id'];
}
$keyTab = "board";

$mit =  new Mittel();
$mit->opt = $option['board'];
$mit->block=8;
$row = $mit->outputList();
$cnt = $mit->listCnt;
unset($mit);


?>
<div class="topImg"></div>
<div class="contentTop contentBox">	
<form action="delMProc.php" method="post" id="mainForm">
	
	<?if($_GET['type']=="c"){?>
	<div class="tit" style="margin: 20px 0 20px 0;"><!--로그인기능 있는게시판--></div>
	<?}else{?>
	<div class="tit" style="margin: 20px 0 20px 0;"><!--관리자만 쓸수 있는게시판--></div>
	<?}?>

	<?if($_SESSION['admin']){?>
	<?}else if($_SESSION['id']){?>
		<button type="button" onclick="location.href='/board/index.php?type=<?=$_GET['id']?>&ms=1'"></button>
	<?}else{?>
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
			<div class="num numW board" ><!--<span>번호</span>--></div>
		<?} ?>
			<div class="title titleW board" ><!--<span>제목</span>--></div>
			<div class="name nameW board" ><!--<span>글쓴이</span>--></div>
			<div class="date dateW board" ><!--<span>날짜</span>--></div>
			<div class="hits hitsW board" ><!--<span>조회수</span>--></div>
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
		<?		if($_SESSION['admin']==1){?>
				 <div class="chk chkW board">
					<label for="ckBox<?=$val['idx']?>" class="chkC adChkB">
						<input id="ckBox<?=$val['idx']?>" global=""  class="ckBox" type="checkbox" name="number[]" value="<?=$val['idx']?>" />
					</label>
				 </div>
		<?		}else{?>
			<div class="num numW board"><span><?=$num?>.</span></div>
		<?		}?>
				<div class="title <?=($_SESSION['admin']==1) ?"titleAW" : "titleW"?> board">	
					<span class="title" >
						<a href ="detail.php?idx=<?=$val['idx']?>&type=<?=$_GET['type']?>&page=<?=$_GET['page']?>&num=<?=$num?>">
							<nobr><?=$val['title']?> [<?=$cnt1?>]
								<span class="reply">
								</span>
							</nobr>
						</a>
					</span>
				</div>
			<?if($_GET['type']=="c"){?>
				<div class="name nameW board nameT"><span><?=$val['writer']['id']?></span></div>
			<?}else{?>
				<div class="name nameW board nameT"><span><?=($val['writer']['name']) ? $val['writer']['name'] : "noName" ?></span></div>
			<?}?>
				<div class="date dateW board dateT"><span><?=substr($val['cdate']['y'],2,2)?>. <?=$val['cdate']['m']?>. <?=$val['cdate']['d']?></span></div>
				<div class="hits hitsW board hitsT"><span><?=$val['hits']?></span></div>
				<div style="float:none; clear:both;"></div>
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
		
		<div class="page pgNum" style="margin-top:25px;top:5px;">
			<?
			$pg = new Page();
			$pg->totalCnt = $cnt;
			$pg->nowPage = 1;
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
		<?if($_GET['type']=="n"){?>
			<?if($_SESSION['admin']=="1"){?>
			<button type="button" class="boardWrite" onclick="location.href='write.php?type=n'">글쓰기</button>
			<?}else{?>
			<?}?>
		<?}else{?>
			<?if($_SESSION['id']){?>
			<button type="button" class="boardWrite" onclick="location.href='write.php?type=c'">글쓰기</button>
			<?}else{?>
			<button type="button" class="boardWrite" onclick="location.href='/login.php'">글쓰기</button>
			<?}
		}?>
		</div>
		<script>
			$("button.write").click(function(){
				$('ul.tnb li.login a').click();
				$("div.layerLogin input[name='returnUrl']").val("/board/write.php?type=<?=$_GET['type']?>");
			});
		</script>
	
	</div>
	
	
	<? if($_SESSION['admin']==1){?>
	<div class="adminBtn" style="float:left;">
		<button type="button" class="icon del admindel">삭제</button>
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
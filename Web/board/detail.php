<?
if($_GET['idx']){
	if($_COOKIE[("board".$_GET['idx'])]){
		$plusCount = 0;
	}else{		
		setcookie(("board".$_GET['idx']),"1",time()+3600,"/");
		$plusCount = 1;
	}
}

$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
if($_GET['idx']){
	$db = new Dbcon();
	$db->table = "board";
	$db->field = "hits";
	$db->where = "idx='".$_GET['idx']."'";
	
	if($plusCount==1){
		$row = mysql_fetch_array($db->Select());
		$cnt = $row['hits'] + 1;
		$db->field = "hits='".$cnt."'";
		$db->Update();
	}else{
	}
	$row = mysql_fetch_array($db->Select());
	unset($db);
}else{
	MsgBox('잘못된 접근입니다.','back');
	exit;
}
$keyTab = "board";

$mit =  new Mittel();
$mit->opt = $option['board'];
$row = $mit->outputDetail();
$row_id = $row['writer']['id'];
$cnt = $mit->listCnt;
unset($mit);

?>
	<div class="topImg"></div>

	<div class="contentTop contentBox">
	<div class="conBox">

		<?if($_GET['type']=="c"){?>
			<div class="tit" style="margin: 20px 0 20px 0;"><!--로그인기능 있는게시판--></div>
		<?}else{?>
			<div class="tit" style="margin: 20px 0 20px 0;"><!--관리자만 쓸수 있는게시판--></div>
		<?}?>
		
		<!-- <div class="num numW"><span><?=$_GET['num']?>.</span></div> -->
		<div class="title titleW board" style="font-weight:bold; margin-bottom :10px; text-align:left;">	
			<span class="title">
			<?=$row['title']?>
			</span>
		</div>
		<div class = "rightWriter">
			<div class="name nameW board"><span><?=$row['writer']['id']?></span></div>
			<div class="date dateW board"><span><?=substr($row['cdate']['y'],2,2)?>. <?=$row['cdate']['m']?>. <?=$row['cdate']['d']?></span></div>

			<div class="hits hitsW board"><span><?=$row['hits']?></span></div>
		</div>	
		
		<div class="content board" style="clear:both;margin-bottom:30px;word-wrap: break-word; ">
			<span class="line"></span>
			<span class = "conOutput"><?=$row['content']?> </span>
		</div>
	
	<!--!!!!댓글부분 여기서 부터 -->	
		<div class="comment">
			<?
			$_GET['tab'] = 'board';
			$mit =  new Mittel();
			$mit->opt = $option['cmnt'];
			$row1 = $mit->outputList();
			$cnt = $mit->listCnt;
			
		
			unset($mit);
			?>
		
			<span class="cmtCount" style="clear:both;font-weight:bold;">댓글 <?=$cnt?></span>
			<span class="line"></span>
			
			<ul class="cmtOutput">
			<?
			if(is_array($row1)){
				foreach($row1 as $key=>$val){
			?>
			<!--댓글 출력되는부분-->					
					<li style="clear:both;">
						<div class="head">
							<span class="name" ><?=$val['writer']['id']?></span>
							<span class="cdate"><?=substr($val['cdate']['allTime'],2,14)?></span>
							<button type="button" class="close cmtD c" global="<?=$val['idx']?>">삭제</button>
							<div style = "clear:both"></div>
							<span class="text">
								<?=$val['content']?>
							</span>	
						</div>
						<div style="clear:both;"></div>
					</li>
				<?}
			}?>
			</ul>
			<? if($_SESSION['id']){?>
			<form action="/proc.php" method="post" id="cmtIForm">
			<? }else{ ?>
			<form action="/login.php" method="get" id="loginForm">
				<input type="hidden" name="returnUrl" value="/index.php?idx=<?=$_GET['idx']?>"/>
			<? } ?>
				
				<input type="hidden" name="tab" value="board"/>
				
				<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
				<!--댓글입력부분-->
				<ul class="cmtInput" style="clear:both;">				
					<li class="inputTxt">
						<span class="input">
							<textarea class="off" name="content"></textarea>
						</span>					
					</li>
					<li class="btn">
						<button type="submit" class="cmtBtn">댓글쓰기</button>
					</li>
				</ul>
				<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
			<input type="hidden" name="page" value="<?=$_GET['page']?>"/>
			</form>
		</div>
		<!--여기 까지 !!!!! -->
	
	</div> <!--contBox 닫는 부분-->
	
	<!--목록/수정/삭제 버튼 -->

	<div class="btnWrap" style="margin-top:30px;">
	<div style = "clear:both"></div>
		<button type="button" class="icon golist" onclick="location.href = 'index.php?page=<?=$_GET['page']?>&searchTxt=<?=$_GET['searchTxt']?>&type=<?=$_GET['type']?>'">목록<button>
		<? if($_GET['type']=="n"){?>
				<? if($_SESSION['admin']==1){?>
		<form id="MDform" type="post">
			<?foreach($_GET as $key=>$val){?>
			<input type="hidden" name="<?=$key?>" value="<?=$val?>"/>
			<?}?>
			<input type="hidden" name="key" value="img"/>
		</form>			
		<button type="button" class="icon del">삭제<button>
		<button type="button" class="icon modify">수정<button>
		<script>
			$("button.modify").click(function(){
				$("#MDform").attr("type","get");	
				$("#MDform").attr("action","write.php");
				$("#MDform").submit();
			});
			
			$("button.del").click(function(){
				if(confirm("정말 삭제하시겠습니까?")){
				$("#delForm").submit();
				}
			});
		</script>
		<form id="delForm" action="delProc.php" method="post">
			<input type="hidden" name="key" value="board"/>
			<input type="hidden" name="idx" value="<?=$_GET['idx']?>" />
			<input type="hidden" name="type" value="<?=$_GET['type']?>" />
			<input type="hidden" name="page" value="<?=$_GET['page']?>" />
		</form>
		<?}
		}else{?>
			
		<? if(($row['writer']['id']==$_SESSION['id']) or ($_SESSION['admin']==1)){?>
		<form id="MDform" type="post">
			<?foreach($_GET as $key=>$val){?>
			<input type="hidden" name="<?=$key?>" value="<?=$val?>"/>
			<?}?>
			<input type="hidden" name="key" value="img"/>
		</form>			
		<button type="button" class="icon del">삭제<button>
		<button type="button" class="icon modify">수정<button>
		<script>
			$("button.modify").click(function(){
				$("#MDform").attr("type","get");	
				$("#MDform").attr("action","write.php");
				$("#MDform").submit();
			});
			
			$("button.del").click(function(){
				if(confirm("정말 삭제하시겠습니까?")){
				$("#delForm").submit();
				}
			});
		</script>
		<form id="delForm" action="delProc.php" method="post">
			<input type="hidden" name="key" value="board"/>
			<input type="hidden" name="idx" value="<?=$_GET['idx']?>" />
			<input type="hidden" name="type" value="<?=$_GET['type']?>" />
			<input type="hidden" name="page" value="<?=$_GET['page']?>" />
		</form>
		
	
		<? }else{ ?>
		<button type="button" class="icon del" onclick='alert("본인만 삭제할수 있습니다. ")'>삭제<button>			
		<button type="button" class="icon modify" onclick='alert("본인만 수정할수 있습니다. ")'>수정<button>
		<!--<button type="button" class="icon write" onclick='alert("본인만 수정할수 있습니다. ")'>글쓰기<button>-->
		<? } 
}?>
	</div>		
		<div style = "clear:both"></div>
	</div>


</div>
<script>
$('#cmtIForm').submit(function(){
	if(trim($("textarea[name='content']").val())==""){
		alert("댓글을 입력하세요.");
		$("textarea[name='content']").focus();
		return false;
	}
});

$("button.cmtD").click(function(){
	if(confirm("정말 삭제하시겠습니까?")){
		var idx = $(this).attr("global");
		var btn = $(this);
		
		$.ajax({
			type:'POST',
			url:'/cmtDel.ax.php',
			dataType:'text',
			data:{		
				idx : idx,
				fidx : "<?=$_GET['idx']?>",
				tab : "board"
			},success:function(result){

				if(trim(result)=="true"){
					btn.parent().parent().remove();
					$("span.cmtCount").text("댓글 "+$("ul.cmtOutput li").length);
				}else{
					alert("본인만 삭제 할 수 있습니다!");

				}
			},error:function(result,a,b){
				alert(b);
			}
		});
	}
})
/*댓글입력*/
$('li.inputTxt textarea.off').focus(function(){
	$(this).attr("class","on");
});
$('li.inputTxt textarea.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});


</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>
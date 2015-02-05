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

	<div class="contentTop contentBox">
	
		<div class="tit" style="margin: 70px 0 75px 0;">로그인 없는 게시판</div>
		
		
		<!-- <div class="num numW"><span><?=$_GET['num']?>.</span></div> -->
		<div class="title titleW board" style="font-weight:bold; margin-bottom :10px; text-align:left;">	
			<span class="title">
			<?=$row['title']?>
			</span>
		</div>
		<div class="name nameW board"><span><?=$row['nName']?></span></div>
		<div class="date dateW board"><span><?=substr($row['cdate']['y'],2,2)?>. <?=$row['cdate']['m']?>. <?=$row['cdate']['d']?></span></div>

		<div class="hits hitsW board"><span><?=$row['hits']?></span></div>
		
		<div class="content" style="clear:both;margin-left:30px;margin-bottom:30px;word-wrap: break-word; ">
		<span class="line"></span>
			<span><?=$row['content']?> </span>
		</div>
	<!--댓글부분 -->	
	<div class="comment">
		<ul class="cmtOutput" id="cmnt">
			<input type="hidden" value="<?=$_SESSION['admin']?>" class="admin">

			<?/*
			while($row = mysql_fetch_array($sel)){*/
			?>
			<? $db = new Dbcon();
			$db ->table="comment";
			$db->where = "fidx='".$_GET['idx']."'";
			$db->orderBy="idx asc";
			$sel=$db->Select();
			while($row1=mysql_fetch_array($sel)){?>
				<li class="cmtList" id="<?=$row1['idx']?>">
					<input type="hidden" class="hidden" value="<?=$row1['idx']?>">
					<div class="head">
						<span class="name" ><?=TextToHtml($row1['name'])?></span>
						<div class="text">
							<span class="text" >
							<?=TextToHtml($row1['content'])?></span>
							<button type="button" class="close cmtD" style="float:left;">삭제</button>
							<div class="pwBox" style="display:none;">
								<button type="button" class="close cmtC">X</button>
								<input type="password" name="pw" class="off pw" />
								<button type="button" class="pwbtn">삭제</button>
							</div>
							<span class="cdate" style="float:right;"><?=substr($row1['cdate'],2,14)?></span>
						</div>			
					</div>			
				</li>
				<?}
				unset($db); ?>
				<li class="copy" >
					<input type="hidden" class="hidden" value="">
					<div class="head">
						
						<span class="name" ></span>
						<div class="text">
							<span class="text" ></span>
							<button type="button" class="close cmtD">삭제</button>	
							<div class="pwBox" style="display:none;">
								<button type="button" class="close cmtC">X</button>
								<input type="password" name="pw" class="off pw" />
								<button type="button" class="pwbtn" >삭제</button>
							</div>
							<span class="cdate" style="float:right;"></span>
						</div>
					</div>			
				</li>
				<?/*}*/?>
		</ul>
		
				<ul class="cmtInput" style="clear:both; padding-top:12px">
					<li class="title">
					<span>별명</span>
					<input type="hidden" name="fidx" value="<?=$row1['idx']?>">
					
						<span class="input inputR1">
							<input type="text" name="name" class="off" maxlength="10"/>
						</span>
					</li>
					<li class="pwd">
						<span >비밀번호</span>
						<span class="input inputR1">
							<input type="password" name="pwd" class="pwd off"/>
						</span>
					</li>
					<li class="inputTxt" style="clear:both">
						<span class="textarea">
							<textarea class="off character500" name="content" ></textarea>
						</span>					
					</li>
					<li class="btn" style="width:77px; float:right;">
						<button type="button" class="cmtBtn">댓글쓰기</button>
					</li>
				</ul>
	</div>
	<!--목록/수정/삭제 버튼 -->
	<div class="bPw"style="clear:both; display:none">
		<span>비밀번호</span>
		<span class="input">
		<input type="password" class="password" value=""/>	
		</span>
		<button type="button" class="bClose">X</button>
		<button type="button" class="bpwBtn">수정</button>
		
	</div>
	<div class="boardPw"style="clear:both; display:none">
		<span>비밀번호</span>
		<span class="input">
		<input type="password" class="password" value=""/>	
		</span>
		<button type="button" class="bClose">X</button>
		<button type="button" class="bpwBtn">삭제</button>
		
	</div>
	
	<div class="btnWrap" style="margin-top:100px;">
			<button type="button" class="icon golist" onclick="location.href = 'index.php?page=<?=$_GET['page']?>&searchTxt=<?=$_GET['searchTxt']?>&type=<?=$_GET['type']?>'">목록<button>
			
				
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
		
				
			<? }else{ ?>
			
			<button type="button" class="icon pwDel">삭제<button>			
			<button type="button" class="icon pwModify">수정<button>
			
	<?}?>
		</div>
		
	


		</script>

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

/*댓글입력*/
$('li.inputTxt textarea.off').focus(function(){
	$(this).attr("class","on");
});
$('li.inputTxt textarea.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});
function cmtWrite(){

	var parpar = $(this).parent().parent();
	var ul =parpar.prev();
	
	var name=parpar.find("input[name='name']").val();
	var pwd=parpar.find("input.pwd").val();
	var content=parpar.find("textarea[name='content']").val();
	var fidx=parpar.find("input[name='fidx']").val();
	var copy = ul.find("li.copy").clone();
	
	
	if(name.length<=0){
	alert("별명을 입력하세요.");
	return false;
	}
	/*if(pwd.length<=0){
	alert("비밀번호를 입력하세요.");
	return false;
	}*/
		$.ajax({
				type: 'POST',
				url: '/board1/cmtInsert.ax.php',
				dataType: 'json',
				data: {
					fidx : "<?=$_GET['idx']?>",
					name : name,
					pwd : pwd,
					content : content
				},success: function(result){
					
					var date=result.value[0];
					copy.find('input.off').focus(function(){
						$(this).attr("class","on");
					});
					copy.find('input.off').blur(function(){
						if($(this).val().length<=0){
							$(this).attr("class","off");
						}
					});

					copy.find("input.hidden").val(date.i);
					copy.find("span.name").text(date.name);
					copy.find("div.text").css("width","750px");
					copy.find("span.text").text(date.content);
					copy.find("span.cdate").text(date.cdate.substr(2,14));
					copy.find("button.cmtD").click(cmtDel);
					copy.find("button.cmtC").click(pbc);
					copy.find("button.pwbtn").click(pwbtn);
					copy.attr("id",date.i);
					copy.removeClass("copy");
					ul.append(copy);
					parpar.find("input[name='name']").val("");
					parpar.find("input[name='pwd']").val("");
					parpar.find("textarea[name='content']").val("");
					parpar.find("input[name='name']").attr("class","off");
					parpar.find("input[name='pwd']").attr("class","off");
					parpar.find("textarea[name='content']").attr("class","off");
				}
		});
}
$("button.cmtBtn").click(cmtWrite);

function cmtDel(){
	var parparpar = $(this).parent().parent().parent();
	var parparparpar = $(this).parent().parent().parent().parent();
	var parpar = $(this).parent().parent().parent();
	var idx=parparpar.find("input.hidden").val();
	var par = $(this).parent();
	
	if(confirm("정말 삭제하시겠습니까?")){
		<?if($_SESSION['id']=="admin"){?>
		$.ajax({
			type: 'POST',
			url: 'board1/cmtDelete.ax.php',
			dataType: 'text',
			data: {
				idx : idx,
				id : id
			},success: function(result){
				$("#"+idx).remove();
			}
		});
		<?}else{?>
		par.find("div.pwBox").show();
		<?}?>
		
		
	}
}
$("button.cmtD").click(cmtDel);

function pbc(){
		var par = $(this).parent();
		par.hide();
}
$("button.cmtC").click(pbc);

function pwbtn(){
	
	var par = $(this).parent();
	var parpar = $(this).parent().parent();
	var parparparpar = $(this).parent().parent().parent().parent();
	var idx=parparparpar.find("input.hidden").val();
	var pw=parpar.find("input.pw").val();


			$.ajax({
				type: 'POST',
				url: '/board1/cmtDelete.ax.php',
				dataType: 'text',
				data: {
					idx : idx,
					pw:pw
				},success: function(result){
					if(trim(result)=="1"){
						$("#"+idx).remove();
					}else{
					 alert(trim(result));
					 parpar.find("input[name='pw']").val("");
						parpar.find("input[name='pw']").focus();
					}		
			
				}
			});
}

$("button.pwbtn").click(pwbtn);
function boardDel(){
	
	if(confirm("정말 삭제하시겠습니까?")){	
		$("div.boardPw").show();
	
		
		
	}
}
$("button.pwDel").click(boardDel);
$("button.bClose").click(pbc);
function boardWrite(){
	$("div.bPw").show();
}
$("button.pwModify").click(boardWrite);
function bDel(){
	
	var par=$(this).parent();
	var pw=par.find("input.password").val();
	
	$.ajax({
		type: 'POST',
		url: '/board1/boardDelete.ax.php',
		dataType: 'text',
		data: {
			idx : "<?=$_GET['idx']?>",
			pw:pw
		},success: function(result){
			if(trim(result)=="1"){
				location.href="index.php?type=nlc"
			}else{
				alert(result);
			}
	
		},error: function(a,b,c){
		
		}
	});

}
$("div.boardPw button.bpwBtn").click(bDel);
function bWrite(){
	
	var par=$(this).parent();
	var pw=par.find("input.password").val();
	var idx="<?=$_GET['idx']?>";

	$.ajax({
		type: 'POST',
		url: '/board1/boardWrite.ax.php',
		dataType: 'text',
		data: {
			idx : "<?=$_GET['idx']?>",
			pw:pw
		},success: function(result){
			if(trim(result)=="1"){
				location.href="write.php?type=nlc&idx="+idx+"&tab=board";
			}else{
				alert(result);
			}
	
		},error: function(a,b,c){
		
		}
	});

}
$("div.bPw button.bpwBtn").click(bWrite);
</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>
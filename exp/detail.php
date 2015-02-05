<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
$se =  $_SESSION['id'];
$_GET['type']=($_GET['type'])?$_GET['type'] : "cExp";
$mit =  new Mittel();
$mit->opt = $option['exp'];
$row = $mit->outputDetail();
$row_id = $row['writer']['id'];
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
	<div class="detailTit"><?=$row['title']?> 
	<? if($_SESSION['auth'] > 0 and $_SESSION['auth']<10){?>
	<?
			$db=new Dbcon();
			$db->table="bookmark";
			$db->field="fidx";
			$db->where="fidx='".$_GET['idx']."' and tab='exp' and writer='".$_SESSION['id']."'";
			$i=$db->TotalCnt();
			unset($db);
			if($i>0){
		?>
		<input type="hidden" name="tab" value="exp" />
		<input type="hidden" name="fidx" value="<?=$_GET['idx']?>" />
		<button type="button" class="btnC btn">찜</button>
		<?}else{?>
		<input type="hidden" name="tab" value="exp" />
		<input type="hidden" name="fidx" value="<?=$_GET['idx']?>" />
		<button type="button" class="btnWish btn">찜</button>
		<?}?>
	<?}?>

	</div>
	<div class="contentTop">
		<div class="picture" style="text-align:center;"><img src="<?=$row['img']?>" style="width:100%; height:auto;"/></div>
		<div class="text">
			<span class="rcNum"><?=$row['people']?>명</span>
			<span class="rcDate">~<?=$row['eventDateE']['y']?>.<?=$row['eventDateE']['m']?>.<?=$row['eventDateE']['d']?></span>
			<span class="cost"><?=number_format($row['cost'])?>원</span>
			<span class="pay" style="display:none;">월 <?=$row['pay']?>만원</span>
			<span class="address"><?=$row['address']?></span>
			<span class="cont"><?=$row['etc']?></span>
			<div class="btn">	
				<?if($_SESSION['auth']>0){
				
				if($_SESSION['auth'] == 10 || $_SESSION['id']==$row_id){ ?>
				<button type="button" class="appList btn" onclick="location.href='/exp/applicantList.php?fidx=<?=$_GET['idx']?>&type=<?=$_GET['type']?>'"/>신청자명단 보기</button>
				<?}else{?>
				<?if($_GET['type']=="cExp"){?>
				<?$db = new Dbcon();
					$db->table="apply";
					$db->field="fidx,writer,idx,cs";
					$db->where="fidx='".$_GET['idx']."' and writer='".$se."' and tab='exp' and cs='y'";
					$i = $db->TotalCnt();
					$member = mysql_fetch_array($db->Select());
					
					unset($db);
					if($i>0){
					?>
					<button  type="button" class="checkApp" onclick="location.href='payCancel.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'">신청조회</button>
					<button  type="button" class="closeApp">신청취소</button>
						<form id="delForm1" action="/delProc.php" method="post">
							<input type="hidden" name="key" value="apply" />
									<input type="hidden" name="tab" value="exp" />
								<input type="hidden" name="fidx" value="<?=$_GET['idx']?>" />
								<input type="hidden" name="idx" value="<?=$member['idx']?>"/>
							<input type="hidden" name="writer" value="<?=$se?>" />
							<input type="hidden" name="page" value="<?=$_GET['page']?>" />
						</form>
					<script>
					$("button.closeApp").click(function(){
						if(confirm("정말 삭제하시겠습니까?")){
							$("#delForm1").submit();
						}
					});


				</script>
	
					<? }else if($row['appType']=="단체"){ ?>
				<button type="button" class="groupApp" onclick="location.href='applys.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"/>단체신청</button>
					<? }else if($row['appType']=="개인"){ ?>
				<button type="button" class="personApp" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"/>개인신청</button>
					<? }else{ ?>				
				<button type="button" class="personApp" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"/>개인신청</button>
				<button type="button" class="groupApp" onclick="location.href='applys.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'"/>단체신청</button>
					<? } ?>
				<?	}else{?>
				<button type="button" class="apply" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$_GET['idx']?>'" />신청하기</button>
				<?}?>

				<?	}?>
				<?}else{
				if($_GET['type']=="cExp"){?>
				<div class="btn">		
					<? if($val['appType']=="단체"){ ?>
					<span class="null" ></span>
					<button type="button" class="groupApp" onclick="loginView();"></button>
					<? }else if($val['appType']=="개인"){ ?>
					<span class="null" ></span>
					<button type="button" class="personApp" onclick="loginView();"></button>
					<? }else{ ?>
					<button type="button" class="personApp" onclick="loginView();"></button>
					<button type="button" class="groupApp" onclick="loginView();"></button>	
					<? } ?>
				</div>
				<? }else{?>
				<div class="btn">		
				
					<button type="button" class="personApp" onclick="loginView();"></button>
			
				
				</div>

				<?}
				}?>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div class="detailCont seConTents" style="text-align:center;">
	<?=$row['content']?>
	</div>
	<div >
	<div class="comment">
		<?
		$_GET['tab'] = 'exp';
		$mit =  new Mittel();
		$mit->opt = $option['cmnt'];
		$row = $mit->outputList();
		$cnt = $mit->listCnt;
		unset($mit);
		?>
		<span class="cmtCount">댓글 <?=$cnt?></span>

		<ul class="cmtOutput">
		<?
		if(is_array($row)){
			foreach($row as $key=>$val){
		?>
			<li>
				<div class="head">
					<span class="name"><?=$val['writer']['name']?></span>
					<div class="text">
					<?=$val['content']?>
					</div>
					<span class="date"><?=substr($val['cdate']['y'],2,2)?>.<?=$val['cdate']['m']?>.<?=$val['cdate']['d']?> <?=$val['cdate']['h']?>:<?=$val['cdate']['i']?></span>
					<?if($val['writer']['id']==$_SESSION['id'] or $_SESSION['authority']==10){?>
						<button type="button" class="close cmtD" global="<?=$val['idx']?>"></button>
					<?}?>							
				</div>
				<div style="clear:both;"></div>
			</li>
		<?	}
		}
		?>
		</ul>
		<? if($_SESSION['id']){?>
		<form action="/proc.php" method="post" id="cmtIForm">
			<input type="hidden" name="tab" value="exp"/>
			<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
			<input type="hidden" name="menuNum" value="<?=$_GET['menuNum']?>"/>
			<ul class="cmtInput">				
				<li class="inputTxt">
					<span class="input">
						<textarea class="off" name="content"></textarea>
					</span>					
				</li>
				<li class="btn">
					<button type="submit" class="cmtBtn">댓글쓰기</button>
				</li>
			</ul>
		</form>
		<? } ?>
	</div>
	<div>
	</div>
	<div class="deatilBottom">
		<button type="button" class="btnList btn" onclick="location.href='index.php?type=<?=$_GET['type']?>'">목록</button>
		
			<? if(($_SESSION['auth'] == 10 || $_SESSION['id']==$row_id) and strlen($_SESSION['id']) > 0){ ?>
		<div class="adminBtn">
			<button type="button" class="deleteW btn">삭제</button>
			<button type="button" class="modify btn" onclick="location.href='write.php?idx=<?=$_GET['idx']?>'">수정</button>
		</div>
		<form id="delForm" action="/delProc.php" method="post">
			<input type="hidden" name="key" value="exp" />
			<input type="hidden" name="idx" value="<?=$_GET['idx']?>" />
			<input type="hidden" name="type" value="<?=$_GET['type']?>" />
			<input type="hidden" name="page" value="<?=$_GET['page']?>" />
		</form>
		<script>
		$("div.adminBtn button.deleteW").click(function(){
			if(confirm("정말 삭제하시겠습니까?")){
				$("#delForm").submit();
			}
		});


		</script>
		<? } ?>
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
function btnWish(){
	var par  = $(this).parent();
	var _self = $(this);
	var tab  = par.find("input[name='tab']").val();
	var fidx = par.find("input[name='fidx']").val();
	
	$.ajax({
		type: 'POST',
		url: '/bookMark.ax.php',
		dataType: 'text',
		data: {
			tab : tab,
			fidx : fidx
		},success: function(result){
			var cp = _self.clone();
			_self.remove();
			par.append(cp);
			cp.attr("class","btnc btn");
			cp.click(btnC);
		}		
	});
}
$("button.btnWish").click(btnWish);
function btnC(){
	var par  = $(this).parent();
	var _self = $(this);
	var tab  = par.find("input[name='tab']").val();
	var fidx = par.find("input[name='fidx']").val();
	$.ajax({
		type: 'POST',
		url: '/bookMarkDelete.ax.php',
		dataType: 'text',
		data: {
			tab : tab,
			fidx : fidx
		},success: function(result){
			//par.remove();	
			var cp = _self.clone();
			_self.remove();
			par.append(cp);
			cp.attr("class","btnWish btn");
			cp.click(btnWish);
		}		
	});
}
$("button.btnc").click(btnC);

$("button.cmtD").click(function(){
	if(confirm("정말 삭제하시겠습니까?")){
		var idx = $(this).attr("global");
		var btn = $(this);
		$.ajax({
			type:'POST',
			url:'/board/cmtDel.ax.php',
			dataType:'text',
			data:{		
				idx : idx,
				fidx : "<?=$_GET['idx']?>",
				tab : "exp"
			},success:function(result){
				
				if(trim(result)=="true"){
					btn.parent().parent().remove();
					$("span.cmtCount").text("댓글 "+$("ul.cmtOutput li").length);
				}
			},error:function(result,a,b){
				alert(b);
			}
		});
	}
})

</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>
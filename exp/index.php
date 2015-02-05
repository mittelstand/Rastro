<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

$_GET['type']=($_GET['type'])?$_GET['type'] : "cExp";


$keyTab = "exp";

$mit =  new Mittel();
$mit->opt = $option['exp'];
if($_GET['search']){
	$listWhere = "title like '%".$_GET['search']."%' or people like '%".$_GET['search']."%' or cost like '%".$_GET['search']."%' or pay like '%".$_GET['search']."%'";
}

$listWhere = TrimStr($listWhere," or ");
$listWhere = "type='".(($_GET['type']=="cExp")?"c":"w")."' ".(($listWhere) ? "and (".$listWhere.")" : "");
$mit->listwhereD = $listWhere;
$row = $mit->outputList();
$cnt = $mit->listCnt;
unset($mit);

?>

<div class="expList contentBox">
	<ul class="main">
	<?
	if(is_array($row)){
		foreach($row as $key=>$val){
	?>
		<li id="<?=$val['idx']?>">
		 
			<div class="thumb">
				<input type="hidden" name="type" value="<?=($_GET['type']=="cExp")?"c":"w"?>">

				<a href="detail.php?type=<?=$_GET['type']?>&idx=<?=$val['idx']?>">					
					<img src="<?=$val['img']?>">
				</a>
				<span class="tit" style="width:100%; height:45px; line-height:45px; color:#545454; text-align:center; bottom:0px; background-color:#FFF; filter:alpha(opacity=70); opacity: 0.7; -moz-opacity:0.3; position:absolute;">
					<?=$val['title']?>
				</span>
			</div>
			<div class="text">
				<span class="rcNum"><?=$val['people']?>명</span>
				<span class="rcDate">~<?=$val['eventDateE']['y']?>.<?=$val['eventDateE']['m']?>.<?=$val['eventDateE']['d']?></span>
				<?if($_GET['type']=="cExp"){?>
				<span class="cost"><?=number_format($val['cost'])?>원</span>
				<?}else{?>
				<!--span class="pay">월 <?=$val['cost']?>만원</span-->
				<span class="cost"><?=number_format($val['cost'])?>원</span>
				<?}?>
			</div>
			<?
			$db = new Dbcon();
			$db->table="apply";
			$db->where="fidx='".$val['idx']."' and writer='".$_SESSION['id']."' and cs='y'";
			$i = $db->TotalCnt();
			unset($db);
			if($_SESSION['auth']<=0 or $i>0){
				if($_GET['type']=="cExp"){?>
				<div class="btn">		
					<? if($val['appType']=="단체"){ ?>
					<span class="null" ></span>
					<button type="button" class="group" onclick="loginView();"></button>
					<? }else if($val['appType']=="개인"){ ?>
					<span class="null" ></span>
					<button type="button" class="person" onclick="loginView();"></button>
					<? }else{ ?>
					<button type="button" class="person" onclick="loginView();"></button>
					<button type="button" class="group" onclick="loginView();"></button>	
					<? } ?>
				</div>
				<? }else{?>
					<div class="btn">				
						<button type="button" class="person" onclick="loginView();"></button>
					</div>
				<?}
				}else{?>
					<?if($_GET['type']=="cExp"){?>
					<div class="btn">		
						<? if($val['appType']=="단체"){ ?>
						<span class="null" ></span>
						<button type="button" class="group" onclick="location.href='applys.php?type=<?=$_GET['type']?>&idx=<?=$val['idx']?>'"></button>
						<? }else if($val['appType']=="개인"){ ?>
						<span class="null" ></span>
						<button type="button" class="person" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$val['idx']?>'"></button>
						
						<?}else{?>
						<button type="button" class="person" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$val['idx']?>'"></button>
						<button type="button" class="group" onclick="location.href='applys.php?type=<?=$_GET['type']?>&idx=<?=$val['idx']?>'"></button>	
						<? } ?>
					</div>
					<?}else{ ?>
					<div class="btn">
						<button type="button" class="person" onclick="location.href='apply.php?type=<?=$_GET['type']?>&idx=<?=$val['idx']?>'"></button>					
					</div>
			<?}?>
		</li>
	<?
		}
		}
	}
	?>

	</ul>

			
			<div class="page pgNum">
				<?
				$pg = new Page();
				$pg->totalCnt = $cnt;
				$pg->nowPage = $_GET['page'];
				$pg->href = "/exp/index.php?type=".$_GET['type'];
				$pg->limitPage = $option['exp']['listBlock'];
				$pg->limitPageGroup = 10;
				$pg->Setting();	
				?>
				<button class="prev" type="button" onclick="location.href='<?=$pg->prevPageLink?>'">&lt;</button>
				<?echo $pg->Output();
				?>
				<button class="next" type="button" onclick="location.href='<?=$pg->nextPageLink?>'">&gt;</button>
			</div>
			<? if($_SESSION['auth']>=2){ ?>
			<div class="adminBtn">
			 <? if($_SESSION['auth']==10){ ?>
				<button type="button" class="deleteW btn">삭제</button>
			   <? } ?>			
				<button type="button" class="write btn" onclick="location.href = 'write.php?type=<?=$_GET['type']?>&page=<?=$_GET['page']?>'">글쓰기</button>
			</div>
			<? } ?>
		</div>
</div>

<script>
$('input.off').focus(function(){
	$(this).attr("class","on");
});
$('input.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});
function del(){
	var par = $(this).parent();
	var parparparpar = $(this).parent().parent().parent().parent();
	var type=parparparpar.find("input[name='type']").val();
	var chkli=parparparpar.find("input[name='number[]']:checked");
		
		if(confirm("정말 삭제하시겠습니까")){
			 chkli.each( function(){
					 var i = $(this).val();
							
					$.ajax({
					type: 'POST',
					url: 'delete.ax.php',
					dataType: 'text',
					data: {
						type : type,
						id : i
					},success: function(result){
						
						$("#"+i).remove();
						
					}
					});
			 });
		 }
	}
	$("button.deleteW").click(del);
</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>
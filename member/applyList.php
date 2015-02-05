<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>

<div style="clear:both;"></div>
<div class="mbDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div class="btn">
		<button type="button" class="infoOff" onclick="location.href = '/member/memberInfo.php'"/></button>
		<button type="button" class="scrapOff" onclick="location.href = '/member/scrapList.php'"/></button>
		<button type="button" class="applyListOn" onclick="location.href = '/member/applyList.php'"/></button>
		<button type="button" class="mySseungelOff" onclick="location.href='/member/mySseungeul.php'"/></button>
	</div>
</div>

<div class="contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div style="clear:both; height:1px;"></div>
	<div class="topBtn memberTopBtn applyList">
		<button type="button" class="applyList" onclick="location.href = '/member/bookMark.php'" ></button>
		<button type="button" class="applyList" onclick="location.href = '/member/applyList.php'" ></button>
		<button type="button" class="applyList" onclick="location.href = '/member/applySchd.php'" ></button>
	</div>
	<?


	$_GET['type'] = "c";
	$_GET['id']   = $_SESSION['id'];
	$_GET['tab']  = "exp";
	$mit =  new Mittel();
	$mit->opt = $option['joinAppExp'];
	$row = $mit->outputList();
	unset($mit);
	?>
	<div class="expList cExpList">
		<span class="scrapTit">진로체험</span>
		<ul class="main">
			<?
			if(is_array($row)){
				foreach($row as $key=>$val){
			?>
			<li>
				<div class="thumb">
					<a href="/exp/detail.php?type=<?=$_GET['type']?>&idx=<?=$val['ex.idx']?>">
						<img src="<?=$val['ex.img']?>">
					</a>
				</div>
				<div class="text">
					<span class="rcNum"><?=$val['ex.people']?>명</span>
					<span class="rcDate">~<?=$val['ex.eventDateE']['m']?>.<?=$val['ex.eventDateE']['d']?></span>
					<?if($_GET['type']=="cExp"){?>
					<span class="cost"><?=$val['ex.cost']?>원</span>
					<?}else{?>
					<span class="pay">월 <?=$val['ex.pay']?>만원</span>
					<?}?>
				</div>
			</li>
		<?
			}
		}
		?>

		</ul>
	</div>
	
	<?
	$keyTab = "joinAppMen";
	$_GET['id']   = $_SESSION['id'];
	$_GET['tab']  = "mentor";
	$mit =  new Mittel();
	$mit->opt = $option['joinAppMen'];
	$row = $mit->outputList();
	unset($mit);
	?>
	<div style="clear:both;"></div>
	<div class="mentorCon">
		<span class="scrapTit">멘토링</span>
		<ul class="main">
			<?
			if(is_array($row)){
				foreach($row as $key=>$val){
				
			?>
				<li>
					<span class="tit"><?=$val['title']?></span>
					<div class="con">
						
						<a href="/mentor/detail.php?idx=<?=$val['men.idx']?>&page=<?=$_GET['page']?>">
							<span class="img"><img src="<?=$val['img']?>"/></span>
							<ul class="con">
								<li><?=$val['personal1']?></li>
								<li><?=$val['personal2']?></li>
								<li><?=$val['personal3']?></li>
								<li><?=$val['personal4']?></li>
								<li><?=$val['personal5']?></li>	
							</ul>
						</a>
					</div>
					<span class="subInfo"><?=$val['subtitle']?></span>
					<button type="button" class="app" onclick="location.href ='/mentor/detail.php?idx=<?=$val['men.idx']?>'"></button>
				</li>
			<?
				}
			}
			?>
		</ul>
	</div>
	
	<?
	$_GET['type'] = "w";
	$_GET['id']   = $_SESSION['id'];
	$_GET['tab']  = "exp";
	$mit =  new Mittel();
	$mit->opt = $option['joinAppExp'];
	$row = $mit->outputList();
	unset($mit);
	?>
	<div style="clear:both;"></div>
	<div class="expList wExpList">
		<span class="scrapTit">실무경험</span>
		<ul class="main">
			<?
			if(is_array($row)){
				foreach($row as $key=>$val){
			?>
			<li>
				<div class="thumb">
					<a href="/exp/detail.php?type=<?=$_GET['type']?>&idx=<?=$val['ex.idx']?>">
						<img src="<?=$val['ex.img']?>">
					</a>
				</div>
				<div class="text">
					<span class="rcNum"><?=$val['ex.people']?>명</span>
					<span class="rcDate">~<?=$val['ex.eventDateE']['m']?>.<?=$val['ex.eventDateE']['d']?></span>
					<?if($_GET['type']=="cExp"){?>
					<span class="cost"><?=$val['ex.cost']?>원</span>
					<?}else{?>
					<span class="pay">월 <?=$val['ex.pay']?>만원</span>
					<?}?>
				</div>
			</li>
		<?
			}
		}
		?>

		</ul>
	</div>
	<div style="clear:both;"></div>

</div>

<?
include $dir."/inc/footer/mainFooter.php";
?>
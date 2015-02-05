<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

$db = new Dbcon();

?>
<style>
div.gallery div.topImg{width:940px; height:104px; background:url('/img/titGallery.png') no-repeat;}

</style>

<div class="gallery">
	<div class="topImg"></div>

	<div class="detailG">
	
		<div class="top">
		<?
			$db->table = "board";
			$db->field = "title, hits, mdate, writer";
			$db->where = "idx = ".$_GET['idx'];
			$arr = mysql_fetch_assoc($db->Select());
		?>
			<span class="title titleW"><?= $arr['title']?></span>
			<span class="name"><?= $arr['writer']?></span>
			<span class="date"><?= $arr['mdate']?></span>
			<span class="count"><?= $arr['hits']?></span>
		</div>

		<div class="img">

				<?
					$db->table = "file";
					$db->field = "sidx, ord, src";
					$db->where = "sidx = '".$_GET["idx"]."'";
					$rel = $db->Select();
					$i = 0;
					while($row = mysql_fetch_assoc($rel)){
						if($i == 0){
				?>
					<div class="leftArrow"><!--왼쪽화살표--></div>		
					<div class="rightArrow"><!--오른쪽화살표--></div>
					<div class="Gcount"><!--갤러리사진순서표시-->3/10</div>
					<div class="mainImg"><img src = "<?=preg_replace("/\/[A-Z]{1,}\/[a-z]{1,}\.[a-z]{1,}\/[a-zA-Z_]{1,}/", "", $row[src])?>"/></div>
					<ul class="imgList">						
						<li class="imgView"><img src = "<?=preg_replace("/\/[A-Z]{1,}\/[a-z]{1,}\.[a-z]{1,}\/[a-zA-Z_]{1,}/", "", $row[src])?>"/></li>
				<?

						$array = $row["ord"];
					}else{
				?>
						<li class="imgView"><img src = "<?=preg_replace("/\/[A-Z]{1,}\/[a-z]{1,}\.[a-z]{1,}\/[a-zA-Z_]{1,}/", "", $row[src])?>"/></li>
				<?
						$array = $row["ord"].",".$array;
						}
						$i++;
					}
				?>
			</ul>	
		</div>
<!--!!!!댓글부분 -->	
		<div class="comment">
		
			<span class="cmtCount" style=" clear:both;font-weight:bold;">댓글 <?=$cnt?></span>
			<span class="line"></span>
			
			<ul class="cmtOutput">
			
			<!--댓글 출력되는부분-->
					<li style="clear:both">
						<div class="head">
							<span class="name">관리자</span>
							<span class="cdate">14.12.12 13:00</span>
							<button type="button" class="close cmtD c" global="<?=$val['idx']?>">삭제</button>
							<div style = "clear:both"></div>
							<span class="text">
								테스트 중1
							</span>	
						</div>
						<div style="clear:both;"></div>
					</li>
					<li style="clear:both">
						<div class="head">
							<span class="name">관리자</span>
							<span class="cdate">14.12.12 14:00</span>
							<button type="button" class="close cmtD c" global="<?=$val['idx']?>">삭제</button>
							<div style = "clear:both"></div>
							<span class="text">
								테스트 중2
							</span>	
						</div>
						<div style="clear:both;"></div>
					</li>
			</ul>
			
			<form action="/login.php" method="get" id="loginForm">
				<input type="hidden" name="returnUrl" value="/index.php?idx=<?=$_GET['idx']?>"/>		
				
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



	</div>
	<div class="del"><!--삭제버튼--></div>
	<div class="edit"><!--수정버튼--></div>
	<div class="write"><!--글쓰기버튼--></div>
</div>
<script>

var idx = <?=$_GET["idx"]?>;
var num = new Array(<?= $array ?>);
var i = 0;

$(document).ready(function(){
	$("div.leftArrow").click(function(){
		i--;
		if(i < 0){
			i = num.length - 1;
		}
		$.ajax({
			type : "GET",
			url : "gallery.ax.php",		
			dataType : "json",
			data : {
				idx : idx,
				num : num[i]
			},
			success:function(result){
				var img = "<img src = '" + result.value[0].src +"'/>";					
				$("div.mainImg").html(img);
			},error:function(a,b,c){
					alert(c);				
			}
		})//ajax 닫음
	}) //div 닫음

	$("div.rightArrow").click(function(){
		i++;
		if( i >=num.length){
			i = 0;
		}
		$.ajax({
			type : "GET",
			url : "gallery.ax.php",		
			dataType : "json",
			data : {
				idx : idx,
				num : num[i]
			},
			success:function(result){
				var img = "<img src = '" + result.value[0].src +"'/>";					
				$("div.mainImg").html(img);
			},error:function(a,b,c){
					alert(c);				
			}
		})//ajax 닫음
	}); //div 닫음
});	//documnet 닫음
</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
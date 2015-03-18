<?$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<?
	$block = 2;
	$page = 1;
	$db = new Dbcon();
	$db->table = "board";
	$db->field = "idx, title, mdate, nName";

	$db->block = $block;
	$db->page = $page;
	$sel = $db->Select();
	$total = $db->TotalCnt();

	$count = $total - (($page-1)*$block); //count = 2 첫번째 페이지에 있는 게시글 수 
	unset($db);
	$abc
	$name = "123123";
?>
<style>
ul.main {width:900px;}
ul.main li{clear:both;}
ul.main div{float:left;}
div.num{width:80px;}
div.title{width:130px;}
div.name{width:250px;}
div.date{width:250px;}

</style>
<div style="border:1px solid #000;">
	<div style="width:100px;height:100px; border:1px solid #FF0000; float:left;"></div><div style="clear:both;"></div>
</div>
<ul class="main">
	<li class="top">
		<div class="num">번호</div>
		<div class="title">제목</div>
		<div class="name">이름</div>
		<div class="date">날짜</div>
	</li>
	<?while($row = mysql_fetch_assoc($sel)){?>
	<li class="list">
		<div class="num">
			<?= $count?>	
		</div>
		<div class="title"><?= $row{"title"} ?></div>
		<div class="name"><?= $row{"nName"} ?></div>
		<div class="date"><?= $row{"mdate"} ?></div>
	</li>
	<?$count--; }	?>
</ul>
<!--ul class = "sub">
	<li class="stop">
		<div class="stitle"><input type = "text" class="st">제목</div>
		<div class="sname"><input type = "text" class="n">이름</div>
		<div class="sdate"><input type = "text" class="d">날짜</div>
	</li>
</ul-->
<button type="button" class="more" style="clear:both;">더보기</button>
<button type="button" class="sub" style="clear:both;">입력하기</button>
<script>
var page = 2;
var num = <?=$total-$block?>;
var block = <?=$block?>;
$(document).ready(function(){
	$("button.more").click(function(){
		var button = $(this);

		$.ajax({
			type : "GET",
			url : "/board.ax.php",		
			dataType : "json",
			data : {
				page : page,
				block : block
			},
			success:function(rel){
				for(var i=0; i<rel.value.length; i++){
					var li = $("ul.main li.list").eq(0).clone();					
					li.find("div.num").text(num);
					li.find("div.title").text(rel.value[i].title);
					li.find("div.name").text(rel.value[i].con);
					li.find("div.date").text(rel.value[i].date);
					$("ul.main").append(li);
					num--;
				}
				page++;
				if(num <=0){
					button.remove();
					
					
				}
			}
		})
	});

});
</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>


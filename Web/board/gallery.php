<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

$db = new Dbcon();
$db->table = "board";
$db->field = "idx, title, cdate, content";
$db->where = "type = '".$_GET{"type"}."'";
$db->orderBy = "idx DESC ";
$rel = $db->Select();

unset($db);


?>
<style>
div.gallery div.topImg{width:940px; height:104px; background:url('/img/titGallery.png') no-repeat;}
div.gallery ul.gallery{clear:both; margin-top:20px; }
div.gallery ul.gallery li{width:216px; height:431px; float:left; margin:0 20px 20px 0; border:1px solid #dbdbdb}
div.gallery ul.gallery li:nth-child(4){margin-right:0;}
div.gallery ul.gallery li div.con{width:100%; box-sizing:border-box; padding:0 13px }
div.gallery ul.gallery li span.title{width:100%; height:20px; display:block; font-size:18px; font-weight:bold; margin-top:13px; overflow:hidden; text-overflow:ellipsis;}
div.gallery ul.gallery li span.date{font-size:11px; color:#44bbe0; margin:6px 0 17px;}
div.gallery ul.gallery li span.contents{width:100%; height:125px;font-size:12px; color:#2f2f2f; line-height:20px; display:block;  overflow:hidden;}
</style>
<div class="gallery">
	<div class="topImg"></div>
	<ul class = "gallery">
		<?
			while($row = mysql_fetch_assoc($rel)){
		?>
					<li>
						<a  href = "galleryDetail.php?type=<?=$_GET["type"]?>&idx=<?=$row[idx]?>">
						<img src="/img/img1.jpg"/>
						<div class="con">
							<span class="title">
								
								<nobr><?= $row["title"]?></nobr>
								
							</span>
							<span class="date"><?= $row["cdate"]?></span>
							<span class="contents"><?=preg_replace("/\<([a-zA-z]{1,})\>|\<\/([a-zA-z]{1,})\>/", "",$content)?></span>
							<button type="button" class="listMore"></button>
						</div>
						</a>
					</li>
		<?
				}
		?>
	</ul>
	<!--<ul class="gallery">
		<li>
			<img src="/img/img1.jpg"/>
			<div class="con">
				<span class="title"><nobr>크리스마술 솔로파티</nobr></span>
				<span class="date">June 15, 2012</span>
				<span class="contents">영 크리에이터 네트워크를 기반으로 한 "디노마드"와 함께, 2015년 3월 디자인, 예술, 음악, 영화, 패션, 게임 등 크리에이티브 분야를 막론한 대한민국 최초의 최대규모의 「2015 영 크리에이티브 페스티벌 코리아」을</span>
				<button type="button" class="listMore"></button>
			</div>
		</li>
		<li>
			<img src="/img/img2.jpg"/>
			<div class="con">
				<span class="title"><nobr>배고픈데 뭘먹어야 하</nobr></span>
				<span class="date">June 15, 2012</span>
				<span class="contents">2030골목 최초의 삼겹살집! 11년동안 쭉쭉~ 사랑받고 있는 동성로 "WHAT 머꼬"
		두께 깡패 고기들은 이제 질렸어... 동성로 최초의 소스 & 삼겹살의 퓨전! 삼겹살의 파스타가 크로스!</span>
				<button type="button" class="listMore"></button>
			</div>
		</li>
		<li>
			<img src="/img/img3.jpg"/>
			<div class="con">
				<span class="title"><nobr>크리스마술 솔로파티</nobr></span>
				<span class="date">June 15, 2012</span>
				<span class="contents">영 크리에이터 네트워크를 기반으로 한 "디노마드"와 함께, 2015년 3월 디자인, 예술, 음악, 영화, 패션, 게임 등 크리에이티브 분야를 막론한 대한민국 최초의 최대규모의 「2015 영 크리에이티브 페스티벌 코리아」을</span>
				<button type="button" class="listMore"></button>
			<div>
		</li>
		<li>
			<img src="/img/img4.jpg"/>
			<div class="con">
				<span class="title"><nobr>배고픈데 뭘먹어야 하할까요</nobr></span>
				<span class="date">June 15, 2012</span>
				<span class="contents">2030골목 최초의 삼겹살집! 11년동안 쭉쭉~ 사랑받고 있는 동성로 "WHAT 머꼬"
		두께 깡패 고기들은 이제 질렸어... 동성로 최초의 소스 & 삼겹살의 퓨전! 삼겹살의 파스타가 크로스!</span>
				<button type="button" class="listMore"></button>
			</div>
		</li>
		<li>
			<img src="/img/img4.jpg"/>
			<div class="con">
				<span class="title"><nobr>배고픈데 뭘먹어야 하</nobr></span>
				<span class="date">June 15, 2012</span>
				<span class="contents">2030골목 최초의 삼겹살집! 11년동안 쭉쭉~ 사랑받고 있는 동성로 "WHAT 머꼬"
		두께 깡패 고기들은 이제 질렸어... 동성로 최초의 소스 & 삼겹살의 퓨전! 삼겹살의 파스타가 크로스! 2030골목 최초의 삼겹살집! 11년동안 쭉쭉~ 사랑받고 있는 동성로 "WHAT 머꼬"
		두께 깡패 고기들은 이제 질렸어... 동성로 최초의 소스 & 삼겹살의 퓨전! 삼겹살의 파스타가 크로스!</span>
				<button type="button" class="listMore"></button>
			</div>
		</li>


	</ul>-->
	<div style="clear:both;"></div>
	<button type="button" class="boardWrite" onclick="location.href='galleryWrite.php?type=g'">글쓰기</button>
</div>
<script>
$(document).ready(function(){
	$('span.contents').dotdotdot({watch: true, wrap:'letter', fallbackToLetter: true});
})

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class="srchResult contentBox">
	<div class="searchBox">
			<input type="text" name="search" class="off"/>
			<button type="submit"></button>
		</div>
	<div class="srchCount">
		검색결과 2건
	</div>
	<ul class="result">
		<li>
			<div class="text">
				성장해나가면서 자신의 외모에 관심을 가지는 것은 당연한 일이에요.<br/>
				생활하면서 자기관리, <b class="red">치장은 꼭 필요한 것이지</b> 불필요한 것은 절대 아니죠.<br/>
				하지만 저는 다른 사람들처럼 그러한 현상에 대해 신경쓰지 말라고 말하고 싶지는 않아요. <br/>
				민철학생이 공부에만 열심히 집중하고 싶고 이러한 고민이 신경쓰일 정도로 심각하다면, 그 고민을 파고 들어 심각하게, 진지하게 생각해봐야해요.<br/>
				그러한 과정이 동반되어야 '나는 이러한 고민을 왜 하고 있었던가'에 대한 답을 얻을 수 있어요.<br/>
				아무리 공부에 큰 방해가 될 것 같고, 그렇기에 생각을 하고 싶지 않더라도<br/>
				항상 생각하세요. 놓아버리지 마세요.
			</div>				
			<div class="info">				
				<span class="date">실무경험</span>	
				<span>l</span>
				<span class="date">2014.07.11</span>		
				<span>l</span>
				<span class="name">진아영</span>			
			</div>
		</li>
		<li>
			<div class="text">
				성장해나가면서 자신의 <b class="red">외모에 관심</b>을 가지는 것은 당연한 일이에요.<br/>
				생활하면서 자기관리, 치장은 꼭 필요한 것이지 불필요한 것은 절대 아니죠.<br/>
				하지만 저는 다른 사람들처럼 그러한 현상에 대해 신경쓰지 말라고 말하고 싶지는 않아요. <br/>
				민철학생이 공부에만 열심히 집중하고 싶고 이러한 고민이 신경쓰일 정도로 심각하다면, 그 고민을 파고 들어 심각하게, 진지하게 생각해봐야해요.<br/>
				그러한 과정이 동반되어야 '나는 이러한 고민을 왜 하고 있었던가'에 대한 답을 얻을 수 있어요.<br/>
				아무리 공부에 큰 방해가 될 것 같고, 그렇기에 생각을 하고 싶지 않더라도<br/>
				항상 생각하세요. 놓아버리지 마세요.
			</div>				
			<div class="info">				
				<span class="date">실무경험</span>	
				<span>l</span>
				<span class="date">2014.07.11</span>	
				<span>l</span>
				<span class="name">진아영</span>				
			</div>
		</li>
		<li>
			<span class="null">검색결과가 없습니다.</span>
		</li>		
	</ul>
	<div class="bottom">
		<div class="page pgNum">
			<?
			$pg = new Page();
			$pg->totalCnt = 80;
			$pg->nowPage = $_GET['page'];
			$pg->href = "http://messagebox.co.kr/cSearch/index.php";
			$pg->limitPage = 10;
			$pg->limitPageGroup = 10;
			$pg->Setting();	
			?>
			<button class="prev" type="button" onclick="location.href='<?=$pg->prevPageLink?>'">&lt;</button>
			<?echo $pg->Output();
			?>
			<button class="next" type="button" onclick="location.href='<?=$pg->nextPageLink?>'">&gt;</button>
		</div>
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
</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>
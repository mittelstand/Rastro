<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class="mbDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div class="btn">
		<button type="button" class="infoOff" onclick="location.href = '/member/memberInfo.php'"/></button>
		<button type="button" class="scrapOff" onclick="location.href = '/member/scrapList.php'"/></button>
		<button type="button" class="applyListOn" onclick="location.href = '/member/applySchd.php'"/></button>
		<button type="button" class="mySseungelOff" onclick="location.href='/member/mySseungeul.php'"/></button>
	</div>
</div>


<div class="schdCon contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div style="clear:both; height:1px;"></div>
	<div class="topBtn memberTopBtn applyList3">
		<button type="button" class="applyList" onclick="location.href = '/member/bookMark.php'" ></button>
		<button type="button" class="applyList" onclick="location.href = '/member/applyList.php'" ></button>
		<button type="button" class="applyList" onclick="location.href = '/member/applySchd.php'" ></button>
	</div>
	<div id="calendar" class="calendar"></div>	
</div>

<script>
	$(document).ready(function() {	
		$("#container div.bg").click(function(){
			$("#container div.schdDetail").hide();
			$(this).hide();
			$("body").css("overflow","auto");
		})
		$('#calendar').fullCalendar({
			lang: 'kr',
			header: {
				left: ' ',
				center: 'prev,title,next',
				right: ''
			},
			events: {
				url: 'schd.json.php',
				success: function(result){

				},
				error: function() {
					
				}
			},
			eventClick: function(event) {
				
				$.ajax({
					type: 'GET',
					url: 'schdDetail.json.php',
					dataType: 'json',
					data: {
						idx : event.id
					},
					success: function(result){
						var obj = result.value[0];
						$("div.schdDetail div.con img").attr("src",obj.img)
						$("div.schdDetail div.con li.people span.ans").text(obj.people)
						$("div.schdDetail div.con li.period span.ans").text(obj.period)
						$("div.schdDetail div.con li.cost span.ans").text(obj.cost)
						$("div.schdDetail div.con li.txt").text(obj.text);					
						
						$("#container div.bg").css("top",$(window).scrollTop() + "px");
						$("#container div.bg").show();
						$("#container div.schdDetail").css("top",$(window).scrollTop()+400 + "px");
						$("#container div.schdDetail").show();
						$("body").css("overflow","hidden");
					}
				});
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			}
		});		
	});
</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>
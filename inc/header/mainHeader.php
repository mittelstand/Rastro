<?
include $dir."/inc/header/globalHeader.php";
$bUrl = AddParam("/board/index.php","type=",$_GET['type']);

?>

	<script>
		var gap = 25;
		var ret = 0;
		$(document).ready(function(){
			$("button").focus();
			
		});	

		$('ul.tnb li.login a').click(function(){
			$('div.bgLogin').show();
			$('div.bgLogin').css("top",$(window).scrollTop())
			$('div.layerLogin').css("top",($(window).scrollTop()+400)+"px");
			$('div.layerLogin').show();
			$('body').css("overflow","hidden");
			$("div.layerLogin input[name='returnUrl']").val("");
		});
		$("button.logClose").click(function(){
			$('div.bgLogin').click()
		})
		$('div.bgLogin').click(function(){
			$('div.bgLogin').hide();
			$('div.layerLogin').hide();
			$('body').css("overflow","");
		});
		function loginView(){
			$('ul.tnb li.login a').click();
		}
	</script>
	<div id="header">
		<div class="logOutBox">
			<h1><a href="/" style="width:100%; height:100%; display:block;"></a></h1>
			<div class="button">
				<? if($_SESSION['idx']<=0){ ?>
				<button type="button" class="btnTopLogin" onclick='location.href = "/login"'>로그인</button>
				<? }else{ ?>
				<button type="button" class="btnTopLogOut" onclick='location.href = "/logOut.php"'>로그아웃</button>
				<button type="button" class="btnTopMyPage" onclick='location.href = "/info"' style="margin-right:20px;">MyPage</button>
				<? } ?>
			</div>
		</div>
	</div>
	<div id="container">
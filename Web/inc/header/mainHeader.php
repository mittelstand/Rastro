<?
include $dir."/inc/header/globalHeader.php";
$bUrl = AddParam("/board/index.php","type=",$_GET['type']);

?>
	<div class="bgLogin" style="display:none;"></div>
	<div class="layerLogin" style="display:none;">
		<div class="redLine"></div>
		<span class="tit">로그인</span>
		<div class="loginBox">
			<button type="button" class="logClose">X</button>
			<form action="/loginProc.php" method="post">
				<div class="inputBox">
					<span class="id input"><input name="id" type="text" value="" /></span>
					<span class="password input"><input name="pwd" type="password" /></span>  
				</div>
				<button type="submit " class="login">로그인</button>
				<input type="hidden" name="returnUrl" value=""/>
			</form>
		</div> 
		 <label for="keepLogin" class="keepLogin">
			<input id="keepLogin" global="-1" type="checkbox" class="ckBox" name="number[]" value="<?=$row['idx']?>" />
		</label>	
		<div class="bottom">  			
			<button type="button" class="join"  onclick="location.href='/member/index.php'" >회원가입</button>     
			<button type="button" class="findPw" style="margin-left:0px;" onclick="location.href='/member/idpwFind.php'">E-mail/PW찾기</button>  			
		</div>
	</div>
	<div id="header">
		<div class="top">
			<h1><a href = "/index.php"></a></h1>
			<ul class="tnb">
			
			<!-- 	<li class="contact">
					<a href="/board/index.php?type=samsunglions" <?if($_GET['type']=='samsunglions'){?>class='on'<? } ?>>
						<span class="tit">CONTACT</span>
					</a>
				</li>
				<li class="about">
					<a href="/intro/index.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
						<span class="tit">ABOUT</span>		
					</a>
				</li> -->
			<? if($_SESSION['admin'] == 1){ ?>
				<li class="logOut">
					<a href="/logOutProc.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
						<span class="tit">로그아웃</span>		
					</a>
				</li>
				<li class="admin">
					 <a href="/member/memberList.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>> 
						<span class="tit">관리페이지</span>		
					 </a> 
				</li>
				
				<? }else if($_SESSION['auth'] >= 1){ ?>	
				
				<li class="logOut">
					<a href="/logOutProc.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
						<span class="tit">로그아웃</span>		
					</a>
				</li>
				<li class="info">
					<a href="/member/memberPw.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>> 
						<span class="tit">마이페이지</span>		
					</a>
				</li>
				
				<? }else{ ?> 
				<li class="join">
					<a href="/member/index.php">
						<span class="tit">회원가입</span>		
					</a>
				</li>
				<li class="login">
					<a href="/login.php" >
						<span class="tit">로그인</span>		
					</a>
				</li>
			<? } ?> 
			</ul>
		</div>
		<!-- <h1><a href="/"></a></h1> -->
		<div class="gnb"> 
			<ul class="menu">
				<li class="home">
					<a href="/index.php?type=c">
						홈
					</a>
				</li>
				<li class="board1">
					<a href="/board/index.php?type=c">로그인 기능있는 게시판 
					<!-- <a href="/board/index.php?type=n"> 관리자 -->
						
					</a>
				</li>
				
				<li class="gallery">
					<a href="/board/gallery.php?type=g">
						로그인 없는 게시판
					</a>
				</li>
				<li class = "bin">
				</li>
			</ul>
				<!--<li class="workExp">
					<a href="/exp/index.php?type=workExp" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
						<span class="tit">실무경험</span>		
					</a>
				</li>
				<li class="mentor">
					<a href="/mentor/index.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
						<span class="tit">멘토링</span>		
					</a>
				</li>
				<li class="community">
					<a href="/board/index.php" <?if($_GET['type']=='community'){?>class='on'<? } ?>>
						<span class="tit">커뮤니티</span>		
					</a>
				</li>
							</ul>
							<button class="schd" onclick="location.href = '/schd/index.php'"></button> -->
			<div style="clear:both"></div>
		</div>
	</div>
	<script>
	var gap = 25;
	var ret = 0;
	$(document).ready(function(){
		
		$("[type='checkbox']").each(function(){
			$(this).change(function(){
			
				if($(this).attr("class")=="box"){
					chkChnage($(this),30);
				}else{					
					chkChnage($(this),25);
				}
			});
			if($(this).attr("global")!="-881"){
				$(this).change();
			}else{
				//alert($(this).attr("class"));
			}
			
		});	
		
	
			
		$("input").eq(0).focus();
		ret = 1;	


		$("#checkAll").change(function(){
			if($(this).is(":checked")){
				$("#mainForm input.ckBox").each(function(){
					$(this).prop("checked",true);
					chkChnage($(this),25);
				});
			}else{
				$("#mainForm input.ckBox").each(function(){
					$(this).prop("checked",false);
					chkChnage($(this),25);
				});
			}
		});
		$("#mainForm input.ckBox").each(function(){
			$(this).change(function(){
				if($(this).is(":checked")){
				}else{
					$("#checkAll").attr("checked",false);
					chkChnage($("#checkAll"),25);
				}
				
			});
		});	
	});	

	/*$('ul.tnb li.login a').click(function(){
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
	}*/
	</script>
	<div id="container">
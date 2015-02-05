<?
include $dir."/option.php";
include $dir."/inc/function.php";
include $dir."/inc/class/clsDbConn.php";
include $dir."/inc/class/clsFile.php";
include $dir."/inc/class/clsPage.php";
include $dir."/inc/class/clsMittel.php";
if((strpos($_SERVER["HTTP_HOST"],"admin.solive")===0) and ($_SESSION['amin']!="admin") and !(strpos($_SERVER["HTTP_REFERER"],"/adminLogin.php"))){	
	?>
	<script>
		location.href = "/adminLogin.php";
	</script>
	<?
	exit;
}
if($_SERVER["HTTP_HOST"]=="solive.kr"){
?>
	<script>
		location.href = "http://www.solive.kr";
	</script>
<?
	exit();
}


?>

<html>
<head>
<title>메세지팩토리 :: 우체통</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel='stylesheet' type='text/css' href='/css/common.css' />
<link rel='stylesheet' type='text/css' href='/css/board.css' />
<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="/js/function.js"></script>
<script type='text/javascript' src='/js/moment.min.js'></script>
<script type='text/javascript' src='/js/fullcalendar.min.js'></script>
<script type="text/javascript" src="/setest/js/HuskyEZCreator.js" charset="utf-8"></script>

<link rel='stylesheet' type='text/css' href='/css/fullcalendar.css' />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51785394-1', 'solive.kr');
  ga('send', 'pageview');
  function re(){
	calcF($("#header"),"100%",20);
	calcF($("#container div.h2Board"),"100%",20);
	calcF($("ul.boardList"),"100%",20);
	calcF($("div.boardWrite"),"100%",20);
  }
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
	});
  $(window).resize(function(){
	 //re();
  });

</script>
<script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script>
<script language=javascript>
	StartSmartUpdate();
</script>
<!------------------------------------------------------------------------------- 
* 웹SITE 가 https를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js를 사용 
* 웹SITE 가 Unicode(UTF-8)를 이용하면 http://plugin.inicis.com/pay61_secuni_cross.js를 사용 
* 웹SITE 가 https, unicode를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js 사용 
--------------------------------------------------------------------------------> 
<!---------------------------------------------------------------------------------- 
※ 주의 ※
 상단 자바스크립트는 지불페이지를 실제 적용하실때 지불페이지 맨위에 위치시켜 
 적용하여야 만일에 발생할수 있는 플러그인 오류를 미연에 방지할 수 있습니다.

<script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script> 
  <script language=javascript>
  StartSmartUpdate();	// 플러그인 설치(확인)
  </script>
-----------------------------------------------------------------------------------> 


<script language=javascript>

	var openwin;

	function pay(frm)
	{
		// MakePayMessage()를 호출함으로써 플러그인이 화면에 나타나며, Hidden Field
		// 에 값들이 채워지게 됩니다. 일반적인 경우, 플러그인은 결제처리를 직접하는 것이
		// 아니라, 중요한 정보를 암호화 하여 Hidden Field의 값들을 채우고 종료하며,
		// 다음 페이지인 INIsecureresult.php로 데이터가 포스트 되어 결제 처리됨을 유의하시기 바랍니다.

		if(document.ini.clickcontrol.value == "enable")
		{
			
			if(document.ini.goodname.value == "")  // 필수항목 체크 (상품명, 상품가격, 구매자명, 구매자 이메일주소, 구매자 전화번호)
			{
				alert("상품명이 빠졌습니다. 필수항목입니다.");
				return false;
			}
			else if(document.ini.buyername.value == "")
			{
				alert("구매자명이 빠졌습니다. 필수항목입니다.");
				return false;
			} 
			else if(document.ini.buyeremail.value == "")
			{
				alert("구매자 이메일주소가 빠졌습니다. 필수항목입니다.");
				return false;
			}
			else if(document.ini.buyertel.value == "")
			{
				alert("구매자 전화번호가 빠졌습니다. 필수항목입니다.");
				return false;
			}
			else if( ( navigator.userAgent.indexOf("MSIE") >= 0 || navigator.appName == 'Microsoft Internet Explorer' ) &&  (document.INIpay == null || document.INIpay.object == null) )  // 플러그인 설치유무 체크
			{
				alert("\n이니페이 플러그인 128이 설치되지 않았습니다. \n\n안전한 결제를 위하여 이니페이 플러그인 128의 설치가 필요합니다. \n\n다시 설치하시려면 Ctrl + F5키를 누르시거나 메뉴의 [보기/새로고침]을 선택하여 주십시오.");
				return false;
			}
			else
			{
				/******
				 * 플러그인이 참조하는 각종 결제옵션을 이곳에서 수행할 수 있습니다.
				 * (자바스크립트를 이용한 동적 옵션처리)
				 */
				
							 
				if (MakePayMessage(frm))
				{
					disable_click();
					openwin = window.open("childwin.html","childwin","width=299,height=149");		
					return true;
				}
				else
				{
					if( IsPluginModule() )     //plugin타입 체크
					{
						alert("결제를 취소하셨습니다.");
					}
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}


	function enable_click()
	{
		document.ini.clickcontrol.value = "enable"
	}

	function disable_click()
	{
		document.ini.clickcontrol.value = "disable"
	}

	function focus_control()
	{
		if(document.ini.clickcontrol.value == "disable")
			openwin.focus();
	}
	</script>


	<script language="JavaScript" type="text/JavaScript">
	<!--
	function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
	  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
	}
	MM_reloadPage(true);

	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	//-->
</script>

<meta name="viewport" content="width=device-width, initial-scale=0.4, minimum-scale=0, maximum-scale=1, user-scalable=yes" />
</head>
<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 onload="javascript:enable_click()" onFocus="javascript:focus_control()">
<div id="wrap">
	<div class="bgLogin" style="display:none;">
	</div>
	<div class="layerLogin" style="display:none;">
		<div class="redLine"></div>
		<span class="tit">로그인</span>
		<div class="loginBox">
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
		<ul class="tnb">
			<li class="home">
				<a href="/index.php" >
					<span class="tit">홈</span>
				</a>
			</li>
			<!--li class="contact">
				<a href="/board/index.php?type=samsunglions" <?if($_GET['type']=='samsunglions'){?>class='on'<? } ?>>
					<span class="tit">CONTACT</span>
				</a>
			</li-->
			<li class="about">
				<a href="/intro/index.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
					<span class="tit">ABOUT</span>		
				</a>
			</li>
			<? if($_SESSION['auth'] >= 10){ ?>
			<li class="admin">
				<a href="/member/memberList.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
					<span class="tit">관리페이지</span>		
				</a>
			</li>
			<li class="logOut">
				<a href="/logOutProc.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
					<span class="tit">로그아웃</span>		
				</a>
			</li>
			<? }else if($_SESSION['auth'] >= 1){ ?>	
			
			<li class="logOut">
				<a href="/logOutProc.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
					<span class="tit">로그아웃</span>		
				</a>
			</li>
			<li class="info">
				<a href="/member/memberInfo.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
					<span class="tit">관리페이지</span>		
				</a>
			</li>
			
			<? }else{ ?>
			<li class="join">
				<a href="/member/index.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
					<span class="tit">회원가입</span>		
				</a>
			</li>
			<li class="login">
				<a href="javascript:;" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
					<span class="tit">로그인</span>		
				</a>
			</li>
			<? } ?>
		</ul>
		<h1><a href="/"></a></h1>
		<div class="gnb">
			<button class="firstIcon" onClick="window.open('http://www.messagefactory.co.kr')"></button>
			<ul class="menu">
				<li class="postbox">
					<a href="/intro/index.php" <?if($_GET['type']=='daeguFC'){?>class='on'<? } ?> >
						<span class="tit">우체통이란?</span>
					</a>
				</li>
				<li class="cSearch">
					<a href="/cSearch/index.php" <?if($_GET['type']=='freeboard'){?>class='on'<? } ?>>
						<span class="tit">진로탐색</span>		
					</a>
				</li>
				<li class="cExp">
					<a href="/exp/index.php?type=cExp" <?if($_GET['type']=='samsunglions'){?>class='on'<? } ?>>
						<span class="tit">진로체험</span>
					</a>
				</li>				
				<li class="workExp">
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
			<button class="schd" onclick="location.href = '/schd/index.php'"></button>
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
				$(this).change();
					$("input").each(function(){
			
				$(this).focus();
				});
			});	
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

		$('ul.tnb li.login a').click(function(){
			$('div.bgLogin').show();
			$('div.bgLogin').css("top",$(window).scrollTop())
			$('div.layerLogin').show();
			$('body').css("overflow","hidden");
			$("div.layerLogin input[name='returnUrl']").val("");
		});

		$('div.bgLogin').click(function(){
			$('div.bgLogin').hide();
			$('div.layerLogin').hide();
			$('body').css("overflow","");
		});
	</script>
	<div id="container">
		<form name=ini method=post action="INIsecureresult.php" onSubmit="return pay(this)"> 	

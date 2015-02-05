<?


include $dir."/inc/header/inc.php";


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
<title>INIpay50 결제페이지 데모</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" href="css/group.css" type="text/css">
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

<style>
body, tr, td {font-size:10pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
table, img {border:none}

/* Padding ******/ 
.pl_01 {padding:1 10 0 10; line-height:19px;}
.pl_03 {font-size:20pt; font-family:굴림,verdana; color:#FFFFFF; line-height:29px;}

/* Link ******/ 
.a:link  {font-size:9pt; color:#333333; text-decoration:none}
.a:visited { font-size:9pt; color:#333333; text-decoration:none}
.a:hover  {font-size:9pt; color:#0174CD; text-decoration:underline}

.txt_03a:link  {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:visited {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:hover  {font-size: 8pt;line-height:18px;color:#EC5900; text-decoration:underline}
</style>

<script>
	var openwin=window.open("childwin.html","childwin","width=299,height=149");
	openwin.close();
	
	function show_receipt(tid) // 영수증 출력
	{
		if("<?php echo ($inipay->GetResult('ResultCode')); ?>" == "00")
		{
			var receiptUrl = "https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=" + "<?php echo($inipay->GetResult('TID')); ?>" + "&noMethod=1";
			window.open(receiptUrl,"receipt","width=430,height=700");
		}
		else
		{
			alert("해당하는 결제내역이 없습니다");
		}
	}
		
	function errhelp() // 상세 에러내역 출력
	{
		var errhelpUrl = "http://www.inicis.com/ErrCode/Error.jsp?result_err_code=" + "<?php echo($inipay->GetResult('ResultErrorCode')); ?>" + "&mid=" + "<?php echo($inipay->GetResult('MID')); ?>" + "&tid=<?php echo($inipay->GetResult('TID')); ?>" + "&goodname=" + "<?php echo($inipay->GetResult('GoodName')); ?>" + "&price=" + "<?php echo($inipay->GetResult('TotPrice')); ?>" + "&paymethod=" + "<?php echo($inipay->GetResult('PayMethod')); ?>" + "&buyername=" + "<?php echo($inipay->GetResult('BuyerName')); ?>" + "&buyertel=" + "<?php echo($inipay->GetResult('BuyerTel')); ?>" + "&buyeremail=" + "<?php echo($inipay->GetResult('BuyerEmail')); ?>" + "&codegw=" + "<?php echo($inipay->GetResult('HPP_GWCode')); ?>";
		window.open(errhelpUrl,"errhelp","width=520,height=150, scrollbars=yes,resizable=yes");
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
//-->
</script>
<meta name="viewport" content="width=device-width, initial-scale=0.4, minimum-scale=0, maximum-scale=1, user-scalable=yes" />
</head>

<body bgcolor="#FFFFFF" text="#242424">
<div id="wrap">
div class="bgLogin" style="display:none;">
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

<center> 
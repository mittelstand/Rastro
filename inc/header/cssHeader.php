<?


include $dir."/inc/header/inc.php";
include $dir."/inc/grobalVariable.php";

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
<title>���ý�Ÿ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel='stylesheet' type='text/css' href='/css/common.css' />
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



<meta name="viewport" content="width=device-width, initial-scale=0.4, minimum-scale=0, maximum-scale=1, user-scalable=yes" />

</head>
<body>
<div id="wrap">
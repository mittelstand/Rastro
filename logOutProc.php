<?
header("content-type:text/html; charset=utf-8");
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$_SESSION['id'] = "";
$_SESSION['auth'] = "";
$_SESSION['admin']="";
$_SESSION['idx']="";
session_unregister("id"); 
session_unregister("auth");
session_unregister("admin");
session_unregister("idx");
?>
<script>
location.href = "index.php";
</script>	
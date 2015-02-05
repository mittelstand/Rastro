<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$pwd = md5($_POST['pwd']);

$db = new Dbcon();
$db ->table="comment";
$db->field = "tab,fidx,name,pwd,content,cdate";
$db->value="'board','".$_POST['fidx']."','".$_POST['name']."','".$pwd."','".$_POST['content']."',now()";
$i=$db->Insert();
$db->where="idx='".$i."'";
$sel = $db->Select();
$row=mysql_fetch_array($sel);
?>
{"value":[{"name":"<?=$_POST['name']?>","content":"<?=$_POST['content']?>","i":"<?=$i?>","cdate":"<?=$row['cdate']?>"}]}
<?
unset($db);
?>

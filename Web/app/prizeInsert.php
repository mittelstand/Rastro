<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir.'/gmail/MAIL.php';
/*if($_POST['birthYear'] and $_POST['birthMonth'] and $_POST['birthDay']){
	$_POST['dob'] = $_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
}*/

$db= new Dbcon();
$db->table="prize";
$db->field = "fidx,writer,pname,pinstitution,pdetail";
$db->value = 	"'".$_POST['idx']."','".$_POST['name']."','".$_POST['Pname']."','".$_POST['Pinst']."','".$_POST['Pdetails']."'";
$i =$db->Insert();
echo $i;
unset($db);
?>

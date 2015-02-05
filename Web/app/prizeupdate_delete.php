<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";


$db= new Dbcon();
$db->table="prize";
if($_POST['division']=="del"){
	$db->where="fidx='".$_POST['fidx']."' and idx = '".$_POST['idx']."'";
	$db->Delete();
	echo "del";
}else if($_POST['division']=="modify"){
	$db->field="pname='".$_POST['Pname']."',writer='".$_POST['name']."',pinstitution='".$_POST['Pinst']."',pdetail='".$_POST['Pdetails']."'";
	$db->where="fidx='".$_POST['fidx']."' and idx = '".$_POST['idx']."'";
	$db->Update();

}

unset($db);


?>

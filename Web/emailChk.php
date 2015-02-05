<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$email = $_POST['email'];
$db = new Dbcon();
$db->table = "member";
$db->where = "email='".$email."'";
$cnt = $db->TotalCnt();

if($cnt>0){
echo "fail";
}else{

}
unset($db);
?>

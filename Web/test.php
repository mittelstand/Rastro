<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->field = "*";
$db->page = "1";
$db->block = "3";
$db->where = "idx > 50";
$sel = $db->Select();
while($row=mysql_fetch_array($sel)){
	//echo $row[0]." ".$row[1]." ".$row[2]."<br>";

}
$txt = "yusng00@naver.comfdfdfdfdedwdsds010-6685-5462";
preg_match_all("/(^[a-z]{1}[a-zA-Z0-9]{1,})@([a-zA-Z0-9]{1,}.[a-z]{1,}.[a-z]{1,})/",$txt,$arr);
print_r($arr);



unset($db);

?>

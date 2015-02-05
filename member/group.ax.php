<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";


$db =  new Dbcon();
$db->table = "optionP";
$i = 0;
$grp = AddZero($_POST['group'],3);

foreach($_POST['idx'] as $key=>$val){
	$db->field = "grp,id,title";
	$db->where = "id = '".$val."'";
	$row = mysql_fetch_array($db->Select());	
	if(trim($row['grp'])==""){
		$grpTem = $grp;
		$add[$i]['grp'] = $grp;
		$add[$i]['id'] = $row['id'];
		$add[$i]['title'] = $row['title'];
		$i++;
	}else if(strpos($row['grp'],$grp) === false){
		$grpTem = $row['grp']."||".$grp;
		$add[$i]['grp'] = $grp;
		$add[$i]['id'] = $row['id'];
		$add[$i]['title'] = $row['title'];
		$i++;
	}else{
		$grpTem = $row['grp'];
	}
	$db->field = "grp = '".$grpTem."'";
	$db->Update();
}
unset($db);
?>
{"value":[{"group":"<?=$grp?>"}<?foreach($add as $key=>$val){?>,{"id":"<?=$val['id']?>","title":"<?=$val['title']?>"}<? } ?>]}
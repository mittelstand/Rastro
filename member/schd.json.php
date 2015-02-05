<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir."/inc/class/utils.php";

/*
[
  {
    "title": "청년봉지",
    "start": "2014-08-01"
  },
  {
    "title": "청년봉지",
    "start": "2014-08-07",
    "end": "2014-08-10"
  },
  {
    "id": "999",
    "title": "청년봉지",
    "start": "2014-08-09"
  },
  {
    "id": "999",
    "title": "청년봉지",
    "start": "2014-08-16"
  },
  {
    "title": "청년봉지",
    "start": "2014-08-12",
    "end": "2014-08-12"
  },
  {
    "title": "청년봉지",
    "start": "2014-08-12"
  },
  {
    "title": "청년봉지",
    "start": "2014-08-13"
  }
]

*/
$range_start = date('Y-m-d',$_GET['start']);
$range_end = date('Y-m-d',$_GET['end']);


$mit =  new Mittel();
$mit->opt = $option['joinAppSchd'];
$_GET['tab'] = "exp";
$_GET['id'] = $_SESSOIN['idx'];
$row = $mit->outputList();
unset($mit);

$i = 0;


?> 
[
	<?				
	if(is_array($row)){
		foreach($row as $key=>$val){
			$sdate = $val['ex.eventDateS']['y']."-".$val['ex.eventDateS']['m']."-".$val['ex.eventDateS']['d'];
			$edate = $val['ex.eventDateE']['y']."-".$val['ex.eventDateE']['m']."-".$val['ex.eventDateE']['d'];	
			if($sdate==$edate){
				$ret = "\"start\":\"".$sdate."\"";
			}else{
				$ret = "\"start\":\"".$sdate."\",\"end\":\"".$edate."\"";
			}
	?>
		<?=($i==0) ? "":","?>{
		"id": "<?=$val['ex.idx']?>",
		"title": "<?=$val['ex.title']?>",
		<?=($val['url']) ? "\"url\":\""."http://".str_replace("http://","",$val['url'])."\"," : '' ?>
		<?=$ret?>
		}
	<?
		 $i++; }
	}
	?>
  

  
  
]
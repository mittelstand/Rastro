<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

include $dir."/option.php";




$k = KeyReplace($_SERVER['HTTP_REFERER']);
$keyTab = $ke[$k];


$db = new Dbcon();
$db->table = $option[$keyTab]['table'];
$name  =  explode(",",$option[$keyTab]['name']);

$type  =  explode(",",$option[$keyTab]['type']);
$value = "";
$fileCnt = 0;
$kNum = $option[$keyTab]['keyName'];
if(strlen($_POST[$kNum]) > 0){
	$field    = explode(",",$option[$keyTab]['field']);
	$isUpdate = explode(",",$option[$keyTab]['isUpdate']);
	foreach($name as $key=>$val){			
		
		if($isUpdate[$key]=='y'){
			if($key > 0){
				$coma = ",";
			}
			switch($type[$key]){
				case "enum":
					$enum = explode("&",$val);
					for($i=1; $i<sizeof($enum); $i++){
						$enumVal = explode(":",$enum[$i]);
						if($enumVal[0] == $_POST[$enum[0]]){
							$v = $enumVal[1];
							break;
						}
						unset($enumVal);
					}
					$value .= $coma.$field[$key]." = '".$v."'";
					break;
				case "none":
					$value .= $coma.$field[$key]." = '".$_POST[$val]."'";
					break;
				case "char":
					$value .= $coma.$field[$key]." ='".HtmlToText($_POST[$val])."'";
					break;
				case "file":
					if($fileCnt==0){
						$file = new EncFileInfo();
						$file->ReadinPost();
						$file->renameFile();
						$file->FileWriteExec();
						$filedir = $file->_wirte_dir;
						$fileName = $file->_named_file;				
						unset($file);
					}		
					$img = ($fileName[$fileCnt]) ? $field[$key]."='".$filedir."/".$fileName[$fileCnt]."'" : "";
				
					$fileCnt++;
					$value .= ($img) ? $coma.$img : "";
					break;
				case "date":
					$eventDate = explode("-",$val);			
					$dateTrans = dateTrans($_POST[$eventDate[0]],$_POST[$eventDate[1]],$_POST[$eventDate[2]],($eventDate[3]) ? $_POST[$eventDate[3]] : '00',($eventDate[4]) ? $_POST[$eventDate[4]] : '00');
					$value .= $coma.$field[$key]." = '".$dateTrans."'";
					break;
				case "text":
					$con = nl2br($_POST[$val]);
					$con = HtmlToText($con);
					$value .= $coma.$field[$key]."='".$con."'";
					break;
				case "setext":
					$value .= $coma.$field[$key]." ='".HtmlToText($_POST[$val])."'";
					break;
				case "now":
					$value .= $coma.$field[$key]." = now()";
					break;
				case "phone":
					$phon = explode("-",$val);	
					$value .= $coma.$field[$key]." = '".$_POST[$phon[0]]."-".$_POST[$phon[1]]."-".$_POST[$phon[2]]."'";
					break;
				case "email":
					$email = explode("-",$val);	
					$value .= $coma.$field[$key]." = '".$_POST[$email[0]]."@";
					$value .= ($_POST[$email[1]]) ? $_POST[$email[1]] ."'" : $_POST[$email[2]] ."'";
					break;
				case "pwd":
					$value .= $coma.$field[$key]." = '".md5($_POST[$val])."'";
					break;
				case "member":
					$value .= $coma.$field[$key]." = '".$_SESSION['id']."'";
					break;
				case "chcked":
					$chk="";
					if(is_array($_POST[$val])){
						foreach($_POST[$val] as $ke=>$va){
						$chk.= $va."||";
						}
					}						
					$value .= $coma.$field[$key]." = '".TrimStr($chk,"||")."'";
					break;
				case "noName":
					$value .= $coma.$field[$key]." = '".$val."'";
					break;
			}
		}
	}
	$db->field =TrimStr($value,",");
	$db->field;
	$db->where = $option[$keyTab]['keyfield']." = '".$_POST[$kNum]."'";
	$db->Update();

}else{
	foreach($name as $key=>$val){
			
		if($key > 0){
			$value = $value.",";
		}
		switch($type[$key]){
			case "enum":
				$enum = explode("&",$val);
				for($i=1; $i<sizeof($enum); $i++){
					$enumVal = explode(":",$enum[$i]);
					if($enumVal[0] == $_POST[$enum[0]]){
						$v = $enumVal[1];
						break;
					}
					unset($enumVal);
				}
				$value .= "'".$v."'";
				break;
			case "none":
				$value .= "'".$_POST[$val]."'";
				break;
			case "char":
				$value .= "'".HtmlToText($_POST[$val])."'";
				break;
			case "file":
				if($fileCnt==0){
					$file = new EncFileInfo();
					$file->ReadinPost();
					$file->renameFile();
					$file->FileWriteExec();
					$filedir = $file->_wirte_dir;
					$fileName = $file->_named_file;	
					unset($file);
				}			
				$imgInput = ($fileName[$fileCnt]) ? $filedir."/".$fileName[$fileCnt] : "";
				$fileCnt++;
				$value .= "'".$imgInput."'";
				break;
			case "date":
				$eventDate = explode("-",$val);			
				$dateTrans = dateTrans($_POST[$eventDate[0]],$_POST[$eventDate[1]],$_POST[$eventDate[2]],($eventDate[3]) ? $_POST[$eventDate[3]] : '00',($eventDate[4]) ? $_POST[$eventDate[4]] : '00');
				$value .= "'".$dateTrans."'";
				break;
			case "text":
				$con = nl2br($_POST[$val]);
				$con = HtmlToText($con);
				$value .= "'".$con."'";
				break;
			case "setext":
				$value .= "'".HtmlToText($_POST[$val])."'";
				break;
			case "now":
				$value .= "now()";
				break;
			case "phone":
				$phon = explode("-",$val);	
				$value .= "'".$_POST[$phon[0]]."-".$_POST[$phon[1]]."-".$_POST[$phon[2]]."'";
				break;
			case "email":
				$email = explode("-",$val);	
				$value .= "'".$_POST[($email[0])]."@";
				$value .= (($_POST[($email[1])]) ? $_POST[($email[1])] : $_POST[($email[2])]);
				$value .= "'";
				break;
			case "pwd":
				$value .= "'".md5($_POST[$val])."'";
				break;
			case "member":
				$value .= "'".$_SESSION['id']."'";
				break;
			case "chcked":
				$chk="";
				if(is_array($_POST[$val])){
					foreach($_POST[$val] as $ke=>$va){
						$chk.= (($ke==0) ? "": "||").$va;
					}
				}
				
				$value .= "'".$chk."'";
				break;
			case "noName":
				$value .= "'".$val."'";
				break;
		}
	}
	//echo $option[$keyTab]['field']."</br>";
	//echo  $value;
	$db->field = $option[$keyTab]['field'];
	$db->value = $value;
	
	$_POST[$option[$keyTab]['keyName']] = $db->Insert();
	if($db->table=="member"){
		?>
		<script>
			/*alert("회원가입이 완료되었습니다.")*/
		</script>
		<?
		if($row['id']=="admin"){
		
		$_SESSION['id'] = $row['id'];
		$_SESSION['admin'] = 1;
		}else{
		$_SESSION['idx']=$_POST[$option[$keyTab]['keyName']];
		$_SESSION['id'] = $row["name"];
		$_SESSION['auth'] = 1;	
		}
	}
}
$ret = explode("&",$option[$keyTab]['returnVal']);

$returnVal = str_replace("http://".$_SERVER['SERVER_NAME'],"",$option[$keyTab]['return']);

$folder = explode("_",$k);
$returnVal = str_replace("{folder}",$folder[0],$returnVal);

foreach($ret as $key=>$val){
	if(preg_match("/([a-zA-Z0-9_]{1,})\=([a-zA-Z0-9_]{1,})/",$val,$arr)){
		$returnVal = AddParam($returnVal,$arr[1]."=",$_POST[$arr[2]]);
	}else{
		$returnVal = AddParam($returnVal,$val."=",$_POST[$val]);
	}
	echo $_POST[$arr[2]];
}
unset($db);



?>

<script>
location.href = "<?=$returnVal?>";
</script>
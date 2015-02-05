<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$grp_Name=$_POST['grp_Name'];
$people_Num=HtmlToText($_POST['people_Num']);
$msg = nl2br($_POST['msg']);
$msg = HtmlToText($msg);
$email=$_POST['email']."@".(($_POST['emailFooter'])?$_POST['emailFooter']:$_POST['emailFooter2']);

$db = new Dbcon();
$db->table = "apply";
$db->field ="tab, fidx,writer,name,grName,email,phone,job,msg,mdate,cdate";
if($_POST['idx']){
	if(is_array($_POST['idx'])){
		foreach($_POST['idx'] as $key=>$val){
			$in .= $val.",";
		}
		$db->where = "writer = '".$_SESSION['id']."' and fidx='".$_POST['fidx']."' and tab='exp'";
		$in = TrimStr($in,",");
		$db->where = $db->where." and (idx not in (".$in."))";
		$db->Delete();
		foreach($_POST['name'] as $key=>$val){
			$phone = $_POST['phone1'][$key]."-".$_POST['phone2'][$key]."-".$_POST['phone3'][$key];
			$job = HtmlToText($_POST['job'][$key]);
			$name = HtmlToText($val);
			if($_POST['idx'][$key]){
				$db->field ="name='".$name."', grName='".$grp_Name."', email='".$email."',phone='".$phone."',job='".$job."',msg='".$msg."',mdate=now()";
				$db->where = "idx='".$_POST['idx'][$key]."'";
				if($name=="" || $job==""){	
				}else{
					$db->Update();
				} 
			}else{
				$db->field ="tab,fidx,writer,name,grName,email,phone,job,msg,mdate,cdate";
				$db->value = "'".$_POST['tab']."','".$_POST['fidx']."','".$_SESSION['id']."','".$name."','".$grp_Name."','".$email."','".$phone."','".$job."','".$msg."',now(),now()";
				if($name=="" || $job==""){	
				}else{
					$a = $db->Insert();
				}
			}
		}
	}else{

	}
}else{
	if(is_array($_POST['name'])){
		foreach($_POST['name'] as $key=>$val){
			$phone=$_POST['phone1'][$key]."-".$_POST['phone2'][$key]."-".$_POST['phone3'][$key];
			$job= HtmlToText($_POST['job'][$key]);
			$name = HtmlToText($val);
			if($name=="" || $job==""){	
			}else{
				$db->value = "'".$_POST['tab']."','".$_POST['fidx']."','".$_SESSION['id']."','".$name."','".$grp_Name."','".$email."','".$phone."','".$job."','".$msg."',now(),now()";			
				$a = $db->Insert();	
			}
		}
	}else{
		$phone=$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3'];
		$job= HtmlToText($_POST['job']);
		$name = HtmlToText($_POST['name']);
		$db->value = "'".$_POST['tab']."','".$_POST['fidx']."','".$_SESSION['id']."','".$name."','".$grp_Name."','".$email."','".$phone."','".$job."','".$msg."',now(),now()";
		$a = $db->Insert();	
	}
}
unset($db);



?>

<script>
 location.href = "/exp/applys.php?type=cExp&idx=<?=$_POST['fidx']?>";
</script>
<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$uploadDir = $dir."/file/";
$fileName = $_POST['fName'];
$upfile = explode(".", $_FILES['uploadedfile']['name']);
$upfileExt = $upfile[1]; //�̹��� �̸��� Ȯ����
$uploadFile = $uploadDir.time().".".$upfileExt;


$db= new Dbcon();
if($_POST['div']=="insert"){
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadFile)){
		$aSize = GetImageSize($uploadFile); 
		
		$fwidth = $aSize[0]; //�̹����� ���α���
		$fheight = $aSize[1]; //�̹����� ���α���
		
		$fw=500;// ���� ������
		$fh=500; //���� ������ 
		$canvas=imagecreatetruecolor($fw,$fh); //imagecreatetruecolor : ������ ũ���� ���� �̹����� ���� 
		$dc = imagecolorallocate($canvas, 255, 255, 255);
		$bc = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
		imagefilledrectangle($canvas, 0, 0, $fw, $fh, $bc);
		 

		if($upfileExt == 'gif' || $upfileExt == 'GIF'){          
			 $newImage=imagecreatefromgif($uploadFile);                                     
			 imagecopyresampled($canvas,$newImage,0,0,0,0,$fw,$fh,$fwidth,$fheight);
			 $thum = $uploadDir."/file/".time().".gif";   
			 imagegif($canvas,$thum);                  
		}else if($upfileExt == 'jpeg' || $upfileExt == 'jpg' || $upfileExt == 'JPEG' || $upfileExt == 'JPG'){

			 $newImage=imagecreatefromjpeg($uploadFile);
			 imagecopyresampled($canvas,$newImage,0,0,0,0,$fw,$fh,$fwidth,$fheight);
			 $thum = $uploadDir."/file/".time().".jpg";    
			 imagejpeg($canvas,$thum);      
			 
		}else if($upfileExt == 'png' || $upfileExt == 'PNG'){
			 
			 $newImage=imagecreatefrompng($uploadFile);                                     

			 imagecopyresampled($canvas,$newImage,0,0,0,0,$fw,$fh,$fwidth,$fheight);
			 $thum = $uploadDir."/file/".time().".png";   
			 imagepng($canvas,$thum); 
		}
	}
	$db->table="prize";
	$db->field = "fidx,writer,pname,pinstitution,pdetail,src,cdate";
	if($_POST['idx']){
	
	$db->value="'".$_POST['idx']."','".$_POST['name']."','".$_POST['Pname']."','".$_POST['Pinst']."','".$_POST['Pdetails']."','".$uploadFile."',now()";
	$i =$db->Insert();
	$db ->field="idx,src";
	$db->where = "idx='".$i."'";
	$db->ExportJson();
}else if($_POST['div']=="update"){
	
}
unset($db);
?>

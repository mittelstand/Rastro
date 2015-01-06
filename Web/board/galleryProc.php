<?
	header("Content-type: text/html; charset=utf-8"); 
	$dir = $_SERVER["DOCUMENT_ROOT"];
	include $dir."/inc/header/inc.php";
	include $dir."/option.php";
	include "ykFunction.php";

	$db = new Dbcon();
	$db->table = "board";
	$db->field = "type, title, content, hits, mdate, cdate, writer";
	$db->value = "'".$_POST["type"]."','".$_POST["title"]."','".$_POST["content"]."',0,now(),now(),'".$_SESSION["id"]."'";

	$db->Insert();
	$num = mysql_insert_id();
	$uploadDir = $dir."/file/";


	for($i=0; $i<5; $i++){
		$k = $i;
		$fileName[$i] = $_FILES['imageFile'] ['name'][$i];
		$new_name = date("Y_m_d_H_i_s"); 
		
		if($fileName[$i]){
			if(fileExt($fileName[$i], "png") || fileExt($fileName[$i], "jpg") || fileExt($fileName[$i], "gif") || fileExt($fileName[$i], "jpeg")){
				$uploadFile[$i] = $uploadDir.time().$i.$fileName[$i];
				move_uploaded_file($_FILES['imageFile'] ['tmp_name'][$i], $uploadFile[$i]);

				
				$db->table = "file";
				$db->field = "sidx, ord, src";
				$db->value = "'".$num."','".$k."','".$uploadFile[$i]."'";
				$db->Insert();
				
			}else{
				$j = $i+1;
				echo "
					<script>
						alert('$j 번째 파일은 지원하는 형식의 파일이 아닙니다!');
					</script>
				";	
			}
		}
	}

?>
<script>
	location.replace("gallery.php?type=g");
</script>
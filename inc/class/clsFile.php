<? 
class EncFileInfo
{
	var $_post;
	var $_count;
	var $_error;
	var $_limit_size = '2000000';
	var $_exception = 'image';
	var $_wirte_dir = 'image';
	var $_named_file;

	## POST 로 넘어온 파일을 체크할 때 쓴다
	function TempLoad(){
		global $_FILES;
		$a=array_keys($_FILES);
		while( list( $k, $v )=each( $_FILES )){
			echo $k." = ".$v."<br>";
			while( list( $x, $y ) = each( $v) ){
				echo $x." = ".$y."<br>";
			}
		}
	}
	## POST 값를 클레스의 객체로 REWRITE
	function ReadinPost()
	{
		global $HTTP_POST_FILES;
		global $_SERVER;
		for( $i=0; list( $k, $v )=each( $HTTP_POST_FILES ); $i++ ){
			$this->_post["vars"][$i] = $k;
			$this->_post[$k] = $v;
			
			while( list( $x, $y ) = each( $v ) ){
				$this->_post[$x][$i] = $y;
				//echo $x."==".$y."<br/>";
			}
		}

		$this->_count = $i;
		$dir = $_SERVER["DOCUMENT_ROOT"]."/file";
		$newDir = date("Ym",mktime());
		if(!is_dir($dir."/".$newDir)){
			mkdir($dir."/".$newDir,0777,true);
		}
		$this->ResetFileDir($dir."/".$newDir);
	}
	## 파일 용량 제한을 재설정
	function ResetFileSize( $size )
	{
		$this->_limit_size=$size;
	}
	## 파일 MIME/TYPE 제한을 재설정
	function ResetFileExec( $exec )
	{
		$this->_exception=$exec;
	}
	## 파일 쓰는 디렉토리 설정
	function ResetFileDir( $dir )
	{
		$this->_wirte_dir=$dir;
	}
	## 업로드 파일의 MIME/TYPE 제한
	# 이미지만 가능
	function ImageFileLimit(){
		for( $i=0; $i < $this->_count; $i++ ){
			if( $this->_post['tmp_name'][$i] ){
				if( strcmp(current(explode('/', $this->_post["type"][$i])),$this->_exception) ){
					$this->_error["Result"] = 401;
					$this->_error["errMsg"] = "죄송합니다. 업로드 파일은 GIF,JPG 같은 이미지 파일만 가능합니다.";
					return $this->_error;
					exit;
				}
			}
		}
		return 0;
	}
	# 설정을 빼고 모두 가능
	function FileLimitNegative(){
		for( $i=0; $i < $this->_count; $i++ ){
			if( $this->_post['tmp_name'][$i] ){
				if( !strcmp(current(explode('/', $this->_post["type"][$i])),$this->_exception) ){
					$this->_error["Result"] = 402;
					$this->_error["errMsg"] = "죄송합니다. 해당 파일은 업로드가 제한되어 있습니다.";
					return $this->_error;
					exit;
				}
			}
		}
		return 0;
	}
	## 업로드 파일의 용량의 제한
	function ByteFileLimit(){
		for( $i=0; $i < $this->_count; $i++ ){
			if( $this->_post['tmp_name'][$i] ){
				if( $this->_post["size"][$i] > $this->_limit_size ){
					$this->_error["Result"] = 403;
					$this->_error["errMsg"] = "죄송합니다. 업로드 파일은 ".$this->_limit_size."Byte로 제한되어 있습니다.";
					return $this->_error;
					exit;
				}
			}
		}
		return 0;
	}

	## 파일 이름 재설정
	function renameFile(){
		for( $i=0; $i < $this->_count; $i++ )
		{
			if( $this->_post['tmp_name'][$i] )
			{
				$exp = str_replace("image/","",$this->_post['type'][$i]);	
				$this->_post["rename"][$i] = date("YmdHis").abs(microtime()).".".$exp;
				$this->_post["exp"][$i] = $exp;
				//echo $this->_post["rename"][$i];
			}
		}
	}

	## 파일 쓰기
	function FileWriteExec(){		
		
		if( !is_dir($this->_wirte_dir) ){
			$this->_error["Result"] = 404;
			$this->_error["errMsg"] = "죄송합니다. 파일을 저장할 디렉토리가 존재하지 않습니다.";
			return $this->_error;
			exit;
		}
		$this->_named_file = ( $this->_post["rename"] ) ? $this->_post["rename"] : $this->_post["name"] ;
		for( $i=0; $i < $this->_count; $i++ ){			
			if( $this->_post['tmp_name'][$i] ){	
				if( !copy($this->_post['tmp_name'][$i],$this->_wirte_dir."/".$this->_named_file[$i]) ){
					$this->_error["Result"] = 405;
					$this->_error["errMsg"] = "죄송합니다. 파일을 지정한 디렉토리에 복사하는데 실패하였습니다.";
					return $this->_error;
					exit;
				}if( !unlink($this->_post['tmp_name'][$i])){
					$this->_error["Result"] = 406;
					$this->_error["errMsg"] = "죄송합니다. 임시파일을 삭제하는데 실패하였습니다.";
					return $this->_error;
					exit;
				}
			}
		}
		echo $this->_error["errMsg"];
		return 0;
	}
}//End Class
?> 
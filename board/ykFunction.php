<?
	/* 
		2015년 1월 2일 부터 시작   
		아직 지식끈이 짦기 때문에 이게 함순가? 싶은게 많음 ㅎ;ㅎ;;;
		혹시라도 이 파일 보는 사람들은 비웃는거 ㄴㄴ
	*/


	
	/*
		fileExt : 파일 확장자를 체크 하는 함수
			$fileName : 파일명
			$ext : 확인하고 싶은 확장자
	*/
	function fileExt($fileName, $ext){
		$epFile = explode(".", $fileName);
		$exFile = $epFile[1];

		if($exFile != $ext){
			return false;
		}else{
			return true;
		}
	};


?>
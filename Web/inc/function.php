<?
/*

함수명   : MsgBox 
작성자   : 민유성
만든날짜 : 2013.08.07
설명     : 경고창 띄우는 함수 
변수     
--$strMsgText   string  경고메세지
--$location     string  경고메세지후 이동 페이지(back는 바로 뒤페이지로이동)           


*/
function MsgBox($strMsgText, $location){
    if (strlen($strMsgText) > 0) {
        echo "<script>";
        echo "alert(\"".$strMsgText."\");";

        if (strlen($location) > 0) {
            switch ($location) {
                case "place":
                    echo "";
                    break;
                case "back":
                    echo "history.go(-1);";
                    break;
                default:
                    echo "window.location = \"".$location."\"";
            };
        };
        echo "</script>";
    };
};
/*

함수명   : ExtTag 
작성자   : 민유성
만든날짜 : 2013.08.20
설명     : 텍스트에서 태그를 추출하는 함수
변수     
--$text     string  추출하고자 하는 텍스트
--$tagname  string  추출하려고 하는 테그
--출력값    array

*/
function ExtTag($text, $tagname){
    if(strpos($text,"</".$tagname.">")){
        preg_match_all("@<".$tagname.".+?<\/".$tagname.">@i",$text,$matches);
    }else{
        preg_match_all("@<".$tagname.".+?>@i",$text,$matches);
    }
    return $matches;
};
/*

함수명   : ExtAttr 
작성자   : 민유성
만든날짜 : 2013.08.20
설명     : 테그에서 속성을 추출하는 함수
변수     
--$tag     string  추출하고자 하는 테그
--$Attr    string  추출하려고 하는 속성
--출력값   string

*/
function ExtAttr($tag,$Attr){
    
    if(preg_match_all("@".$Attr."\=\".+?\"@i",$tag,$matches) == false){
        if(preg_match_all("@".$Attr."\=\'.+?\'@i",$tag,$matches) == false){
           preg_match_all("@".$Attr."\=\\\\\".+?\\\\\"@i",$tag,$matches);
           $matches[0][0] = str_replace("\\","",$matches[0][0]);
        };
        $matches[0][0] = str_replace("'","",$matches[0][0]);
    };
    $matches[0][0] = str_replace($Attr."=","",$matches[0][0]);    
    $matches[0][0] = str_replace("\"","",$matches[0][0]);
    
    return $matches[0][0];
};

 

/*

함수명   : newWindow 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : Window 팝업을 띄우는 함수
변수     
--$strUrl    string  바꿀 텍스트
--$strName   string  팝업창의 이름   
--$type      string  팝업창 or 새창 인지 검사하는 부분(pop이면 팝업창)
--$width     int     창 가로길이
--$height    int     창 세로길이
--$left      int     창 가로위치
--$top       int     창 세로위치   
*/

function newWindow($strUrl,$strName,$type = "pop",$width=500,$height=500,$left=0,$top=0)
{

    switch ($type){
        case "pop":         
            echo "<script>
                    window.open(\"".$strUrl."\",\"".$strName."\",\"width=".$width.", height=".$height.", left=".$left.", top=".$top."\")
                  </script>";
            break;
        default :
            echo "<script>
                    window.open(\"".$strUrl."\",\"".$strName."\",\"width=".$width.", height=".$height.", left=".$left.", top=".$top.", scrollbars=no,titlebar=no,status=no,resizable=no,fullscreen=no\");

                  </script>";
            break;
    };

};


/*

함수명   : TextToHtml 
작성자   : 민유성
만든날짜 : 2013.08.07
설명     : 특수문자를 html기호로 치환하는 함수
변수     
--$strText   string  바꿀 텍스트
--출력값     string  바뀐텍스트


*/
function HtmlToText($strText)
{
    $strText = trim($strText);    
    $strText = str_replace("&","&amp;",$strText);    
    $strText = str_replace("'","&apos;",$strText);
    $strText = str_replace("<","&lt;",$strText);
    $strText = str_replace(">","&gt;",$strText);
    $strText = str_replace("\"","&quot;",$strText);
    return $strText;
};
/*

함수명   : HtmlToText 
작성자   : 민유성
만든날짜 : 2013.08.07
설명     : html기호를 특수문자로 치환하는 함수
변수     
--$strText   string  바꿀 텍스트
--출력값     string  바뀐텍스트


*/

function TextToHtml($strText)
{
    $strText = str_replace("&amp;","&",$strText);    
    $strText = str_replace("&apos;","'",$strText);
    $strText = str_replace("&lt;","<",$strText);
    $strText = str_replace("&gt;",">",$strText);
    $strText = str_replace("&quot;","\"",$strText);
    return $strText;
};
/*

함수명   : IsCheck 
작성자   : 민유성
만든날짜 : 2013.08.07
설명     : 체크가 되었는지 검사하고 체크 속성을 반환하는 함수 
변수     
--$variable  string  input객체의 값
--$value     string  비교대상의 값
--$type      string  input타입이 뭔지 구분하는 값 

*/


function IsCheck($variable, $value, $type) 
{
    $returnValue = "";
    if ($variable and $value) {
        $variable = trim($variable);
        $value    = trim($value);

        if ($variable == $value) {
            switch (strtolower($type)) {
                case "s":
                    $returnValue = " selected=\"selected\" ";
                    break;
				case "sel": 
					$returnValue = " selected=\"selected\" ";
                    break;
				case "select":
					$returnValue = " selected=\"selected\" ";
                    break;
                default:
                    $returnValue = " checked=\"checked\"";
            };
        } else {
            if (strtolower($type) == "c" or strtolower($type) == "check" or strtolower($type) == "chk") {
                $value = ",".str_replace($value, " ", "").",";
                if (strpos($value, ",".$variable.",")) {
                    $returnValue = " checked=\"checked\" ";
                };
            };
        };
    };

    return $returnValue;
};
/*

함수명   : AddZero 
작성자   : 민유성
만든날짜 : 2013.08.13
설명     : 자리수를 지정해서 숫자가 모자라는 만큼 0을 입력하는 함수
변수     
--$num       int  0을 추가하려는 숫자
--$add_Num   int  추가하려는 자릿수
--출력값     string
*/

function AddZero($num,$add_Num)
{
    
    for($i = strlen($num); $i < $add_Num ; $i++ ){
        $num = "0".$num;
    };
    return $num;
};

/*

함수명   : TrimStr 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 앞뒤에 특정문자를 제거하는 함수
변수     
--$strText         string  대상 문자열  
--$strRomoveText   string  제거하려는 문자
--출력값           string
*/

function TrimStr($strText,$strRomoveText) 
{
    switch (preg_match("/[^a-z가-힣0-9_]/",$strRomoveText)){
        case true : 
            $exp = "/^\\".$strRomoveText."/";
            $strText = preg_replace($exp,"",$strText);
            $exp = "/\\".$strRomoveText."$/";
            $strText = preg_replace($exp,"",$strText);
        default :
            $exp = "/^".$strRomoveText."/";
            $strText = preg_replace($exp,"",$strText);
            $exp = "/".$strRomoveText."$/";
            $strText = preg_replace($exp,"",$strText);

    }
    return $strText;
}

 

/*

함수명   : AddBr 
작성자   : 민유성
만든날짜 : 2013.08.13
설명     : 줄띄움을 앞에 추가하는 함수
변수     
--$strText   string  추가하려는 텍스트
--$type      string     
--출력값     string
*/

function AddBr($strText,$type = "front")
{
    if($strText){
        switch ($type){
            case "front":         
                return "<br/>".$strText;
                break;
            default :
                return $strText."<br/>";
        };
    }else{
        return $strText;
    };    
};


/*

함수명   : IsKor 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 문자열에 한글이 있는지 판별하는 함수 
변수     
--$strText   string  검사하려는 텍스트
--출력값     boolean
*/
function IsKor($strText){
    return preg_match("/[가-힣]/",$strText);

};
/*

함수명   : IsInt 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 문자열에 숫자가 있는지 판별하는 함수 
변수     
--$num   string  검사하려는 텍스트
--출력값 boolean
*/
function IsInt($num) {
    if (!preg_match("/[0-9]/",$num)) {
        return false;
    } else {
        return true;
    };
}
/*
함수명   : IsEnglish 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 문자열에 영문이 있는지 판별하는 함수 
변수     
--$strText   string  검사하려는 텍스트
--출력값     boolean
*/
function IsEng($strText)
{
    return preg_match("/[A-Za-z]/",$strText);
    
}
/*
함수명   : IsEngL 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 문자열에 영문 소문자가 있는지 판별하는 함수 
변수     
--$strText   string  검사하려는 텍스트
--출력값     boolean
*/


function IsEngL($strText)
{
    return preg_match("/[a-z]/",$strText);
    
}
/*
함수명   : IsEngU 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 문자열에 영문 대문자가 있는지 판별하는 함수 
변수     
--$strText   string  검사하려는 텍스트
--출력값     boolean
*/


function IsEngU($strText)
{
    return preg_match("/[A-Z]/",$strText);
    
}
/*
함수명   : IsEmail 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 문자열이 email이 맞는지 검사하는 함수
변수     
--$email   string   검사대상 email
--출력값   string
*/
function IsEmail($email)
{
    return preg_match("/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/",$strText);
}

/*
함수명   : AddParam 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : 주소 파라메터에 해당 변수가 있는지 검사하고 없으면 추가하는 함수
변수     
--$url          string   검사대상 url
--$strParam     string   검사할 파라메터 ex) abc=   
--$strValue     string   파라메터에 대한값 
--출력값        string
*/
function AddParam($url,$strParam,$strValue)
{
    if(strpos($url,'=')){
        if(strpos($url,$strParam) == 0){
        
            $url = preg_replace("/\&$/","",$url);
            $url = $url."&".$strParam.$strValue;
        }
        
    }else{
        $url = preg_replace("/\?$/","",$url);
        $url = $url."?".$strParam.$strValue;    
    }
    
    
    return $url;
}
/*
함수명   : Encoding 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : Url주소로 인코딩 하는 함수
변수     
--$data      string   치환대상 url
--출력값     string
*/
function Encoding($data)
{
    return base64_encode($data)."||";
}
/*
함수명   : Decoding 
작성자   : 민유성
만든날짜 : 2013.08.14
설명     : Url주소변수를 php 배열로 치환 하는 함수
변수     
--$data    string   치환대상 url
--출력값   array
*/
function Decoding($sending_data)
{
    $vars=explode("&",base64_decode(str_replace("||","",$sending_data)));
    $vars_num=count($vars);
    for($i=0;$i<$vars_num;$i++)
    {
        $elements=explode("=",$vars[$i]);
        $var[$elements[0]]=$elements[1];
    }
    return $var;
}

/*
함수명   : ModAddOne 
작성자   : 민유성
만든날짜 : 2013.08.16
설명     : 나누어서 나누어 떨어지지 않으면 나눈값에 1을 더하고 그렇지 않으면 나눈값 만 출력(소수점 내림)
변수     
--$num1    int   나누기 숫자1
--$num2    int   나누기 숫자2
--출력값   string
*/
function ModAddOne($num1,$num2)
{
    return ($num1 % $num2 == 0) ? (int)($num1 / $num2) : ((int)($num1 / $num2)) + 1;
}

/*
함수명   : whereInput 
작성자   : 민유성
만든날짜 : 2013.08.16
설명     : 
변수     
--$num1    int   치환대상 url
--$num1    int   치환대상 url
--출력값   string
*/
function whereInput($where, $andor, $value)
{
     if($where){
        $where .= $andor." ".$value;
     }else{
        $where = $value;
     }       
}
/*
함수명   : DefResult 
작성자   : 민유성
만든날짜 : 2013.08.16
설명     : 값을 체크하고 있으면 그값을 출력하고 없으면 기본값을 입력하는 함수
변수     
--$strDate    string   비교대상 텍스트
--$strDef     string   기본값
--출력값   string
*/
function DefaultResult($strDate,$strDefault){
    if($strDate){
        return $strDate;
    }else{
        return $strDefault;
    }
}
function Random($min, $max) {
    srand((double) microtime() * 1000000);
    $rand = rand($min, $max);

    return $rand;
};
function CreateMovie($movieKey){
    $obj = "<object width=\"640\" height=\"391\"><param name=\"movie\" value=\"". $movieKey ."\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"//www.youtube.com/v/". $movieKey ."\" type=\"application/x-shockwave-flash\" width=\"640\" height=\"391\" allowfullscreen=\"true\"></embed></object>";
    return $obj;                    
};
function ReturnVideokey($url){
    
    if(preg_match("/v\=([A-Za-z0-9_\,-]*)/",$url,$code)){
        return $code[1];
    }else if(preg_match("/video_id\=([A-Za-z0-9_\,-]*)/",$url,$code)){
        return $code[1];
    }else if(preg_match("/\.be\/([A-Za-z0-9_\,-]*)/",$url,$code)){
        return $code[1];
    }else if(preg_match("/\/embed\/([A-Za-z0-9_\,-]*)/",$url,$code)){
        return $code[1];
    }else if(preg_match("/\/v\/([A-Za-z0-9_\,-]*)/",$url,$code)){
        return $code[1];
    }else{
        return false;
    };
    
};

function CreateNhnMovie($movieKey,$outKey){
    $obj = "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0\" width=\"640\" height=\"391\" id=\"NFPlayer09564\" align=\"middle\"><param name=\"allowScriptAccess\" value=\"always\" /><param name=\"allowFullScreen\" value=\"true\" /><param name=\"movie\" value=\"http://serviceapi.nmv.naver.com/flash/NFPlayer.swf?vid=".$movieKey."&outKey=".$outKey."\" /><param name=\"wmode\" value=\"window\" /><embed src=\"http://serviceapi.nmv.naver.com/flash/NFPlayer.swf?vid=".$movieKey."&outKey=".$outKey."\" wmode=\"window\" width=\"640\" height=\"391\" allowScriptAccess=\"always\" name=\"NFPlayer09564\" allowFullScreen=\"true\" type=\"application/x-shockwave-flash\" /></object>";
    return $obj;                    
};


function ReturnNhnVideokey($url){  
    if(preg_match("/vid\=([A-Za-z0-9_\,-]*)/",$url,$code)){
        $returnArr[0] = $code[1];           
    }else{
        return false;
    };
    
    if(preg_match("/outKey\=([A-Za-z0-9_\,-]*)/",$url,$code)){
        $returnArr[1] = $code[1]; 
    }else{
        return false;
    };
    return $returnArr;
    
};
function VideoCompany($url){
    if(preg_match("/\.naver/",$url)){
        return "naver";
    }else{
        return "youtube";
    }

};
function TransDate($num,$type=0){
	if($num<=0){
		return "";
	}
	$num = str_replace("-","",$num);
	$num = str_replace(".","",$num);
	$num = str_replace(" ","",$num);
	switch($type){
		case 1:
			return substr($num,0,4).".".substr($num,4,2).".".substr($num,6,2);
			break;
		case 2:
			return substr($num,2,2).". ".substr($num,4,2).". ".substr($num,6,2);
			break;
		case "kr":
			return substr($num,0,4)."년 ".substr($num,4,2)."월 ".substr($num,6,2)."일 ";
			break;
		default:
			return substr($num,2,2).".".substr($num,4,2).".".substr($num,6,2);
			break;	
	}
}
function extra($code){
	$db = new Dbcon();
	$db->table		= "xe_document_extra_vars";
	$db->field		= "*";
	$db->where		= "document_srl='".$code."'";
	$db->orderBy	= "var_idx asc";
	$select = $db->Select();
	while($row = mysql_fetch_array($select)){
		$exp[$row['eid']]=$row['value'];
	}
	unset($db);
	return $exp;


}
function sendMail($fromName, $fromEmail, $toName, $toEmail, $subject, $contents, $isDebug=0){
	//Configuration
	$smtp_host = "ssl://smtp.naver.com";
	//$smtp_host = "smtp.mail.yahoo.co.kr";
	$port = 465;
	$type = "text/html";
	$charSet = "UTF-8";

	//Open Socket
	$fp = @fsockopen($smtp_host, $port, $errno, $errstr, 1);
	if($fp){
		//Connection and Greetting
		$returnMessage = fgets($fp, 128);
		if($isDebug)
			print "CONNECTING MSG:".$returnMessage."\n";
		fputs($fp, "HELO YA\r\n");
		$returnMessage = fgets($fp, 128);
		if($isDebug)
			print "GREETING MSG:".$returnMessage."\n";

		// 이부분에 다음과 같이 로긴과정만 들어가면됩니다.
		fputs($fp, "auth login\r\n");
		fgets($fp,128);
		fputs($fp, base64_encode("yusng00")."\r\n");
		fgets($fp,128);
		fputs($fp, base64_encode("abwmqodzm410")."\r\n");
		fgets($fp,128);

		fputs($fp, "MAIL FROM: <".$fromEmail.">\r\n");
		$returnvalue[0] = fgets($fp, 128);
		fputs($fp, "rcpt to: <".$toEmail.">\r\n");
		$returnvalue[1] = fgets($fp, 128);

		if($isDebug){
			print "returnvalue:";
			print_r($returnvalue);
		}

		//Data
		fputs($fp, "data\r\n");
		$returnMessage = fgets($fp, 128);
		if($isDebug)
			print "data:".$returnMessage;
		fputs($fp, "Return-Path: ".$fromEmail."\r\n");
		$fromName = "=?".$fromName."?B?".base64_encode($fromName)."?=";
		fputs($fp, "From: ".$fromName." <".$fromEmail.">\r\n");
		fputs($fp, "To: <".$toEmail.">\r\n");
		$subject = "=?".$charSet."?B?".base64_encode($subject)."?=";

		fputs($fp, "Subject: ".$subject."\r\n");
		fputs($fp, "Content-Type: ".$type."; charset=\"".$charSet."\"\r\n");
		fputs($fp, "Content-Transfer-Encoding: base64\r\n");
		fputs($fp, "\r\n");
		$contents= chunk_split(base64_encode($contents));

		fputs($fp, $contents);
		fputs($fp, "\r\n");
		fputs($fp, "\r\n.\r\n");
		$returnvalue[2] = fgets($fp, 128);

		//Close Connection
		fputs($fp, "quit\r\n");
		fclose($fp);

		//Message
		if (ereg("^250", $returnvalue[0])&&ereg("^250", $returnvalue[1])&&ereg("^250", $returnvalue[2])){
			$sendmail_flag = true;
		}else {
			$sendmail_flag = false;
			print "NO :".$errno.", STR : ".$errstr;
		}
  	}

	if (! $sendmail_flag){
		echo "메일 보내기 실패";
	}
	return $sendmail_flag;
}
function dateTrans($y,$m,$d,$h,$i){
	return $y."-".AddZero($m,2)."-".AddZero($d,2)." ".AddZero($h,2).":".AddZero($i,2).":00";
}
function divDate($date){
	$wr = array("일","월","화","수","목","금","토");
	$a = explode(" ",$date);
	$d = explode("-",$a[0]);
	$t = explode(":",$a[1]);
	$arr['y'] = $d[0];
	$arr['m'] = $d[1];
	$arr['d'] =	$d[2];
	$arr['h'] = $t[0];
	$arr['i'] = $t[1];
	$arr['h2'] = ($t[0] > 12) ? "오후 ".($t[0]-12) : "오전 ".$t[0];
	$arr['time'] = mktime($arr['h'],$arr['i'],0,$arr['m'],$arr['d'],$arr['y']);
	$arr['w'] = $wr[date('w',$arr['time'])];
	return $arr;
}
function dateR($date,$type=0){
	$d = divDate($date);
	switch($type){
		case 1 :
			return $d['y'].".".$d['m'].".".$d['d']."(".$d['w'].") ";
			break;
		case 2 :
			return $d['m'].".".$d['d']."(".$d['w'].")".str_replace(" ","",$d['h2']).":".$d['i'];
			break;
		case 3 :
			return $d['y'].".".$d['m'].".".$d['d']." ".$d['h'].":".$d['i'];
			break;
		default :
			return $d['m'].".".$d['d']."&nbsp;(".$d['w'].")&nbsp;".$d['h2'].":".$d['i'];
	}
}
function get_random_string($len = 10, $type = '') {

    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numeric = '0123456789';
    $special = '`~!@#$%^&*()-_=+\\|[{]};:\'",<.>/?';
    $key = '';
    $token = '';
    if ($type == '') {
        $key = $lowercase.$uppercase.$numeric;
    } else {
        if (strpos($type,'09') > -1) $key .= $numeric;
        if (strpos($type,'az') > -1) $key .= $lowercase;
        if (strpos($type,'AZ') > -1) $key .= $uppercase;
        if (strpos($type,'$') > -1) $key .= $special;
    }

    for ($i = 0; $i < $len; $i++) {
        $token .= $key[mt_rand(0, strlen($key) - 1)];
    }
    return $token;

}
function KeyReplace($host){
	preg_match("/\/([a-zA-Z0-9_]{1,})\/([a-zA-Z0-9_]{1,})\.php/",$host,$met);
	return $met[1]."_".$met[2];
}
/*
function MkWhere($where,$method='get'){
	foreach($where as $wk=>$wv){
		$arr = preg_match_all("/\[([a-zA-Z0-9_]{1,})\]/",$wv,$out);

		$re = array_unique($out[0]);
		$ke = array_unique($out[1]);
		foreach($re as $key=>$val){
			if(strtolower($method)=='get'){
				$where = str_replace($val,$_GET[$ke[$key]],$where);
			}else if(strtolower($method)=='post'){
				$where = str_replace($val,$_POST[$ke[$key]],$where);
			}
		}
	}
	$where = preg_replace('/\{[^{}]{0,}\'s{0,}\'\s{0,}\){0,}\s{0,}\}/','',$where);
	$where = preg_replace('/\(\s{0,}\)/i','',$where);
	$where = preg_replace('/\(\s{0,}(and|or)/i','',$where);
	//$where = preg_replace('/(and|or)\s{0,}\)/i','',$where);
	$where = str_replace("{","",$where);
	$where = str_replace("}","",$where);
	


	

	return $where;
}
*/


function MkWhere($where,$method='get'){
	$allWhe = "";
	foreach($where as $wk=>$wv){
		preg_match_all("/\[([a-zA-Z0-9_]{1,})\]/",$wv,$out);
		$re = array_unique($out[0]);
		$ke = array_unique($out[1]);


		foreach($re as $key=>$val){
			if(strtolower($method)=='get'){
				$value = $_GET[$ke[$key]];				
				
			}else if(strtolower($method)=='post'){
				$value = $_POST[$ke[$key]];				
			}
			if($value){
				
				$ep = explode("&",$wv);
				if(sizeof($ep) > 1){
					for($i=1; $i<sizeof($ep); $i++){
						$epVal = explode(":",$ep[$i]);
						if($value==$epVal[0]){
							$value = $epVal[1];
							unset($epVal);
							break;
						}
						unset($epVal);
					}
					$where2 = preg_replace("/\[([a-zA-Z0-9_]*)\](\&[a-zA-Z0-9_\'\:&]*)/",$value,$wv);					
				}else{
					$where2 = str_replace($val,$value,$wv);
				}
				if(preg_match("/(and|or)\s([^()]{0,})/",$where2,$ot)){
					if($allWhe){
						$allWhe .=" ".$ot[0];
					}else{
						$allWhe .= $ot[2];
					}
				}else{
					$allWhe .= $where2;
				}
			}
		}
	}
	return $allWhe;
}
?>

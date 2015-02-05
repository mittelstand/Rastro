<?
$option['member']['table']			= "member";
$option['member']['keyfield']		= "idx";
$option['member']['keyName']		= "idx";
$option['member']['field']			= "id,name,email,pwd,phone,mdate,cdate,authority,sex";
$option['member']['name']			= "id,name,email-emailFooter-emailFooter2,pwd,phone1-phone2-phone3,now(),now(),1,sex";
$option['member']['type']			= "char,char,email,pwd,phone,now,now,noName,char";
$option['member']['isList']			= "y,y,y,y,y,y,y,y,y";
$option['member']['isUpdate']		= "n,n,y,n,y,y,y,n,n";
$option['member']['isDetail']		= "y,y,y,y,y,y,n,n,y";
$option['member']['detailWhere'][0] = "id='[id]'";
$option['member']['detailWhere'][1] = "idx='[idx]'";
$option['member']['return']			= "/member/memberCom.php?";
$option['member']['returnVal']= "idx&page";
$option['member']['delRet']		    = "/index.php?";

$option['board']['table']		   = "board";
$option['board']['keyfield']	   = "idx";
$option['board']['keyName']		   = "idx";
$option['board']['field']		   = "type,title,content,mdate,cdate,hits,writer,nName,pwd";
$option['board']['name']		   = "type,title,content,now(),now(),hits,writer,nName,pwd";
$option['board']['type']		   = "none,char,setext,now,now,none,member,char,pwd";
$option['board']['isUpdate']	   = "n,y,y,y,n,n,n,y,y";
$option['board']['isList']		   = "n,y,n,n,y,y,y,y,n";
$option['board']['isDetail']	   = "n,y,y,n,y,y,y,y,n";
$option['board']['listWhere'][0]   = "type='[type]'";
$option['board']['listWhere'][1]   = "and writer='[id]'";
$option['board']['listBlock']	   = "8";
$option['board']['listOrder']	   = "idx desc";
$option['board']['detailWhere'][0] = "idx='[idx]'";
$option['board']['return']		   = "{folder}/detail.php";
$option['board']['returnVal']      = "idx&page&type";
$option['board']['detailWhere'][0] = "idx='[idx]'";
$option['board']['delRet']		   = "index.php?type=";
$option['board']['delVal']		   = "page&type";

$option['cmnt']['table']			= "comment";
$option['cmnt']['keyfield']			= "idx";
$option['cmnt']['keyName']			= "idx";
$option['cmnt']['field']			= "tab,fidx,writer,content,cdate";
$option['cmnt']['name']				= "tab,fidx,writer,content,now()";
$option['cmnt']['type']				= "none,char,member,setext,now";
$option['cmnt']['isUpdate']			= "y,y,n,y,n";
$option['cmnt']['isList']			= "n,n,y,y,y";
$option['cmnt']['listWhere'][0]		= "tab='[tab]'";
$option['cmnt']['listWhere'][1]		= "and fidx='[idx]'";
$option['cmnt']['listBlock']	    = "";
$option['cmnt']['listOrder']	    = "idx asc";
$option['cmnt']['return']			= $_SERVER['HTTP_REFERER'];
$option['cmnt']['returnVal']        = "idx=fidx&page&type";
$option['cmnt']['delRet']		    = $_SERVER['HTTP_REFERER'];
$option['cmnt']['delVal']		    = "idx=fidx&page&type";


$ke['board_write'] = 'board';
$ke['board1_write'] = 'board';
$ke['member_join'] = 'member';
$ke['detail']='cmnt';
$ke['board_detail']='cmnt';
$ke['exp_write']='request';
?>
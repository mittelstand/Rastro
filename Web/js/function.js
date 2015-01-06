function KrChk(text){
	if (text.charCodeAt(text.length-1) % 28 == 16) {
      return "를";
    } else {
      return "을";
    }
}

var hangulToJaso = function (text)
{

    //초성(19자) ㄱ ㄲ ㄴ ㄷ ㄸ ㄹ ㅁ ㅂ ㅃ ㅅ ㅆ ㅇ ㅈ ㅉ ㅊ ㅋ ㅌ ㅍ ㅎ
    var ChoSeong = new Array ( 0x3131, 0x3132, 0x3134, 0x3137, 0x3138,
                  0x3139, 0x3141, 0x3142, 0x3143, 0x3145, 0x3146, 0x3147, 0x3148,
                  0x3149, 0x314a, 0x314b, 0x314c, 0x314d, 0x314e );

    //중성(21자) ㅏ ㅐ ㅑ ㅒ ㅓ ㅔ ㅕ ㅖ ㅗ ㅘ(9) ㅙ(10) ㅚ(11) ㅛ ㅜ ㅝ(14) ㅞ(15) ㅟ(16) ㅠ ㅡ ㅢ(19) ㅣ
    var JungSeong = new Array ( 0x314f, 0x3150, 0x3151, 0x3152, 0x3153,
                  0x3154, 0x3155, 0x3156, 0x3157, 0x3158, 0x3159, 0x315a, 0x315b,
                  0x315c, 0x315d, 0x315e, 0x315f, 0x3160, 0x3161, 0x3162, 0x3163 );

    //종성(28자) <없음> ㄱ ㄲ ㄳ(3) ㄴ ㄵ(5) ㄶ(6) ㄷ ㄹ ㄺ(9) ㄻ(10) ㄼ(11) ㄽ(12) ㄾ(13) ㄿ(14) ㅀ(15) ㅁ ㅂ ㅄ(18) ㅅ ㅆ ㅇ ㅈ ㅊ ㅋ ㅌ ㅍ ㅎ
    var JongSeong = new Array ( 0x0000, 0x3131, 0x3132, 0x3133, 0x3134,
                  0x3135, 0x3136, 0x3137, 0x3139, 0x313a, 0x313b, 0x313c, 0x313d,
                  0x313e, 0x313f, 0x3140, 0x3141, 0x3142, 0x3144, 0x3145, 0x3146,
                  0x3147, 0x3148, 0x314a, 0x314b, 0x314c, 0x314d, 0x314e );
    var chars = new Array()
    var v = new Array();
    for (var i = 0; i < text.length; i++) 
    {
     chars[i] = text.charCodeAt(i);
     //// "AC00:가" ~ "D7A3:힣" 에 속한 글자면 분해  
     if (chars[i] >= 0xAC00 && chars[i] <= 0xD7A3) 
     {
      var i1, i2, i3;
   
      i3 = chars[i] - 0xAC00;
      i1 = i3 / (21 * 28);   
      i3 = i3 % (21 * 28);  
   
      i2 = i3 / 28;
      i3 = i3 % 28;   
   
      v.push(String.fromCharCode(ChoSeong[parseInt(i1)]));

         //복모음 분리
         switch(parseInt(i2))
         {
             case 9 : v.push('ㅗㅏ'); break;
          case 10 : v.push('ㅗㅐ'); break; 
             case 11 : v.push('ㅗㅣ'); break;
             case 14 : v.push('ㅜㅓ'); break;
             case 15 : v.push('ㅜㅔ'); break;
             case 16 : v.push('ㅜㅣ'); break;
             case 19 : v.push('ㅡㅣ'); break;         
          
             default : v.push(String.fromCharCode(JungSeong[parseInt(i2)]));
         }   
      //v.push(String.fromCharCode(JungSeong[parseInt(i2)]));
   
   
   
      if (i3 != 0x0000) // c가 0이 아니면, 즉 받침이 있으면
      {      
          //복자음 분리
          switch(parseInt(i3))
          {
              case 3 : v.push('ㄱㅅ'); break;
              case 5 : v.push('ㄴㅈ'); break; 
              case 6 : v.push('ㄴㅎ'); break;
              case 9 : v.push('ㄹㄱ'); break;
              case 10 : v.push('ㄹㅁ'); break;
              case 11 : v.push('ㄹㅂ'); break;
              case 12 : v.push('ㄹㅅ'); break;
              case 13 : v.push('ㄹㅌ'); break;
              case 14 : v.push('ㄹㅍ'); break;
              case 15 : v.push('ㄹㅎ'); break;
              case 18 : v.push('ㅂㅅ'); break;
           
              default : v.push(String.fromCharCode(JongSeong[parseInt(i3)])); 
          }
      }
   
     }
     else {
      v.push(String.fromCharCode(chars[i] ));
     }
    }
 
    return v;
}



String.prototype.cut = function(len) {
	var str = this;
	var l = 0;
	for (var i=0; i<str.length; i++) {
			l += (str.charCodeAt(i) > 128) ? 2 : 1;
			if (l > len) return str.substring(0,i) ;
	}
	return str;
}

String.prototype.recut = function(len) {
	var str = this;
	var l = 0;
	for (var i=0; i<str.length; i++) {
			l += (str.charCodeAt(i) > 128) ? 2 : 1;
			if (l > len) return str.substr(i) ;
	}
	return str;
}

String.prototype.substr2 = function(stt, len) {
 var str = this;
 var str_tmp = str.recut(stt);
 //alert(str_tmp);
 return str_tmp.cut(len);
}         
	  
var a = "가123나233";



/*
함수명 : headerCtrl
설명   : 상단 메뉴의 위치조종하는 함수
$document 이벤트 안에만 써야한다. 
*/

function headerCtrl(){
	var wid = $(this).width();
	var gnbwid = $("#gnb").width();
	$("#right_wrap").css("width",(wid-gnbwid)+"px"); 
	//$("#wrap").css("width",wid+"px");
}
/*
함수명 : ctnCtrl
설명   : 내용부분의 높이를 조절하는 함수
$document 이벤트 안에만 써야한다. 
*/
function ctnCtrl(){
	var hei = $(this).height();
	$("#container").css("height",(hei-257)+"px");//237은 위에서 메뉴까지 높이 
	var conhei = $("#container").height();
	$(".content").css("height",(conhei-63)+"px");//63은 푸터높이 
}
/*
함수명 : setting
설명   : 퍼센트를 px단위로 바꾸어 주는 함수 
변수설명 : 
--obj       (object)    퍼센트화된 객체
*/

function setting(obj){
	var wid = $(window).width();
	obj.css("width",wid+"px");
}
/*
함수명 : footerCtrl
설명   : 푸터 위치를 잡아주는 함수

*/
function footerCtrl(){
	var winhei = $(window).height();
	if (winhei>1071){
		winhei = 1071;//1071은 창 최대 높이
	}
	else if(winhei<800){//800은 창 최소 높이
		winhei = 800;
	}
	winhei = winhei - $("#footer").height() - 40;
	$("#wrap").css("height",winhei+"px");
	var footertop = winhei-$("#footer").height();
	$("#footer").css("top",footertop+"px");
}
/*
함수명 : heightCenter
설명   : 높이를 가운데로 맞추어주는 함수
--obj       (object)    가운데 정렬할 객체
*/
function heightCenter(obj){	
	var par = obj.parent();	
	var parHeight = par.height();
	var objHeight = obj.height();
	//alert(parHeight+"-"+objHeight);
	par.css("position","relative");
	obj.css("position","absolute");
	//alert(parHeight+"-"+objHeight);
	if(parHeight < objHeight){		
		obj.css("top", "20px");
	}else{		
		obj.css("top", parseInt((parHeight - objHeight)/2)+"px");
	}
}
/*
함수명 : heightCenter
설명   : 너비를 가운데로 맞추어주는 함수
--obj       (object)    가운데 정렬할 객체
*/
function widthCenter(obj){	
	var par = obj.parent();
	var parWidth = par.width();
	var objWidth = obj.width();	
	par.css("position","relative");
	obj.css("position","absolute");
	obj.css("left",parseInt((parWidth - (obj.width()))/2)+"px");
}
function widthCenter2(obj,num){	
	var par = obj.parent();
	var parWidth = par.width();
	var objWidth = obj.width();	
	par.css("position","relative");
	obj.css("position","absolute");
	obj.css("left",parseInt(((parWidth - objWidth)/2)+num)+"px");
}
/*
함수명 : heightCenter
설명   : ul 너비를 가운데로 맞추어주는 함수
--liObj       (object-group)    li 그룹
--liObj       (object)			ul 객체
*/
function widthLiCenter(liObj,boxObj){
	var totalWidth = 0; 
	liObj.each(function(){
		totalWidth = totalWidth + $(this).outerWidth(true);
	});
	boxObj.css("width",totalWidth + "px");
}

/*
함수명 : commentCtrl
설명   : 창크기 조절 시 게시판의 코멘트박스 너비 자동조절 및 textarea 너비 자동조절 
$document 이벤트 안에 써야한다. 
*/
function commentCtrl(){
	var outCmtWid = $("div.outComment").width();
	$("div.inComment").css("width",(outCmtWid+32)+"px");//32는 outCmtWid내부의 패딩값. 합해줘야 너비가 같아짐
	var inCmtWid = $("div.inComment").width();
	var btnCmtSm = $("button.submitCmt").width();
	$("textarea.inputText").css("width",(inCmtWid-btnCmtSm-21)+"px");//20은 textarea 내부 패딩값

}

/*
함수명 : contentImgCtrl
설명   : 창크기가 줄어들었을시, 이미지크기도 함께 줄어들게 함
$document 이벤트 안에 써야한다. 
*/
function contentImgCtrl(obj1,obj2){
	var parentWid = obj1.width(); //컨테이너창
	obj2.css("width",(parentWid-30)+"px");//창크기가 줄어들었을시, 이미지크기가 같아지도록
}

/*
함수명 : sameWidth
설명   : 똑같은 넓이를 적용해 줌
$document 이벤트 안에 써야한다. 
*/
function sameWidth(obj1,obj2){
	var stdWid = obj1.width();
	obj2.css("width",(stdWid)+"px");//16는 outCmtWid내부의 패딩값. 합해줘야 너비가 같아짐
}

/*
함수명 : LoadFlash
설명   : 플래시를 삽입하기 위한 함수
변수설명 : 
--swfPath       (string)    플래시 경로
--width         (integer)   플래시 너비
--height        (integer)   플래시 높이
--flashObjId    (string)    플래시 객체이름

*/


function LoadFlash(swfPath, width, height, flashObjId) {
	document.write("<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"" + width + "\" height=\"" + height + "\" id=\"" + flashObjId + "\" align=\"middle\">");
	document.write("<param name=\"movie\" value=\"" + swfPath + "\" />");
	document.write("<param name=\"quality\" value=\"best\" />");
	document.write("<param name=\"wmode\" value=\"transparent\" />");
	document.write("<param name=\"bgcolor\" value=\"#ffffff\" />");
	document.write("<embed src=\"" + swfPath + "\" quality=\"best\" wmode=\"transparent\" bgcolor=\"#ffffff\" width=\"" + width + "\" height=\"" + height + "\" name=\"" + flashObjId + "\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />");
	document.write("</object>");
};
/*
함수명 : addCommas
설명   : 3자리마다 , 를 붙여주는 함수 (금액 콤마 찍기)
변수설명 : 
--nStr       (string)    바꾸고자하는 값
리턴 값      (string)    
*/

var addCommas = function(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
};
/*
함수명 : GetNavigatorVersion
설명   : 브라우저 버전을 체크하는 함수
변수설명 : 
리턴 값    (string)   
*/
function GetNavigatorVersion() {//브라우저출력
    returnValue = true;
    if (navigator.appName.charAt(0) == "M") {
        if (navigator.appVersion.charAt(0) == "4") {
            if (navigator.appVersion.indexOf("MSIE 7") != -1) {
                returnValue = true;
            } else if (navigator.appVersion.indexOf("MSIE 8") != -1) {
                returnValue = true;
            } else {
                returnValue = false;
            };
        };
    };
    return returnValue;
};
/*
함수명 : AddZero
설명   : 지정한 자리수 만큼 0을 삽입하는 변수
변수설명 :
--value       (string)    바꾸고자하는 값
--length      (string)    숫자의 자리수
리턴 값       (string)   
*/
var AddZero = function(value, length) {
    value = "" + value;
    if (value.length < length) {
        do {
            value = "0" + value;
        } while (value.length < length);
    };

    return value;
};
/*
함수명 : LoadEditorSingle
설명   : 네이버 se에디터 불러오는 함수
출처   : www.naver.com
변수설명 :
--targetId    (string)    textarea태그 id값   
*/

var oEditors1 = [];	//Editor 전역변수
var LoadEditorSingle = function(targetId) {
    if ($("#" + targetId).length) {
        $("#" + targetId).attr("placeholder", "");
       
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors1,
            elPlaceHolder: targetId,
            sSkinURI: "http://ns.engnews.co.kr/~ftp_hdpress_new/scripts/se/SmartEditor2Skin.html",
            htParams : {bUseToolbar : true,
              fOnBeforeUnload : function(){}
            }, 					
            fCreator: "createSEditor2"
        });

        $("#" + targetId).parents("form").submit(function() {
            oEditors1.getById[targetId].exec("UPDATE_CONTENTS_FIELD", []);
        });
       
    };
};
/*
함수명 : DateAdd
설명   : 지정한 날짜 단위를 더해서 날짜 형태로 출력하는 함수
변수설명 :
--timeU    (string)    textarea태그 id값
--byMany   (integer)   더하고자하는 수 
--dateObj  (date)      날짜 오브젝트   
   
*/
function DateAdd(timeU,byMany,dateObj) {
    var timeV = {y:"FullYear", m:"Month", d:"Date", h:"Hours", mi:"Minutes", s:"Seconds", ms:"Milliseconds"}[timeU.toLowerCase()];
    dateObj["set"+timeV](dateObj["get"+timeV]()+byMany);

    with(dateObj) {
        return getFullYear() + "-" + AddZero((getMonth()+1), 2) + "-" + AddZero(getDate(), 2);
    };
};
/*
함수명 : chkAll
설명   : 체크박스의 그룹(이름이 같은것)을 모두체크하는 함수
변수설명 :
--name    (object)    체크박스이름
   
*/
function chkAll(name){
    obj = document.getElementsByName(name);
    if(obj[0].checked == true){
        for(var i=0 ; i < obj.length ; i++){
            obj[i].checked = true;
        };
    }else{
        for(var i=0 ; i < document.getElementsByName(name).length ; i++){
            obj[i].checked = false;
        };
    };
};


/*
함수명 : ClosePopup
설명   : 창을 닫는 함수

*/

var ClosePopup = function() {
    if (GetNavigatorVersion()) {
		parent.$("body").css("overflow", "");
        parent.$("#popup").remove();
    } else {
        window.close();
    };
};
/*
함수명 : returnVideokey
설명   : 비디오 코드를 넘겨받는 함수

*/
function returnVideokey(url){
    var tempCode, replaceKey;
    
    if(url.match(/v\=[A-Za-z0-9_\,-]*/ig)){
        tempCode=url.match(/v\=[A-Za-z0-9_\,-]*/ig);
        replaceKey="v=";
    }else if(url.match(/video_id\=[A-Za-z0-9_\,-]*/ig)){
        tempCode=url.match(/video_id\=[A-Za-z0-9_\,-]*/ig);
        replaceKey="video_id=";
    }else if(url.match(/\.be\/[A-Za-z0-9_\,-]*/ig)){
        tempCode=url.match(/\.be\/[A-Za-z0-9_\,-]*/ig);
        replaceKey=".be/";
    }else if(url.match(/\/embed\/[A-Za-z0-9_\,-]*/ig)){   
        tempCode=url.match(/\/embed\/[A-Za-z0-9_\,-]*/ig);
        replaceKey="/embed/";
    }else if(url.match(/\/v\/[A-Za-z0-9_\,-]*/ig)){       
        tempCode=url.match(/\/v\/[A-Za-z0-9_\,-]*/ig);
        replaceKey="/v/";
    }else{
        return false;
    };
    var videoCode = new String(tempCode);
    videoCode = videoCode.replace(replaceKey,"");
    return videoCode;
};


/*
함수명 : trim
설명   : 모든 공백 제거
--value	  String	제거할 문자열
*/
function trim(value){
	return value.replace(/^\s+|\s+$/g,"");
}
/*
함수명 : ltrim
설명   : 왼쪽 공백 제거
--value	  String	제거할 문자열
*/
function ltrim(value) {
 return value.replace(/^\s+/,"");
}
/*
함수명 : rtrim
설명   : 오른쪽 공백 제거
--value	  String	제거할 문자열
*/
function rtrim(value) {
 return value.replace(/\s+$/,"");
}





var JsonDecode = function (txt) {
    return decodeURIComponent(txt).replace(/\+/g, ' ');
};	


/*
함수명 : chkChnage
설명   : 체크박스 이미지화
변수설명 : 
--obj		    (integer)   적용될 체크박스 객체 (input)
--gap			(integer)	이미지 y축 좌표 차이값
주의사항 : 
--라벨안에 input 박스가 있어야 한다. (예) <label><input type="checkbox"></label>
--라벨의 background 이미지에서 비체크이미지가 체크이미지의 위(y자표)에 있어야 한다.
--global에는 비체크일 때의 y축좌표를 넣는다.
*/

function chkChnage(obj,gap){
	var position = parseInt(obj.attr("global"));
	var par = obj.parent();
	position2 = par.css("background-position");
	
	positionArr = position2.split(" ");
	positionArr[0] = positionArr[0].replace("px","");
	positionArr[1] = positionArr[1].replace("px",""); 	
	positionArr[0] = parseInt(positionArr[0].replace("%",""));
	positionArr[1] = parseInt(positionArr[1].replace("%","")); 
	

	if (obj.is(":checked")){
		par.css("background-position",positionArr[0]+"px "+(position-gap)+"px");
		//alert("test1");
	}else{
		par.css("background-position",positionArr[0]+"px "+(position)+"px");
	}
	if(obj.attr("disabled")){
		par.css("background-position",positionArr[0]+"px "+(position-(gap*2))+"px");
	}
 }
/*
함수명 : radioChnage
설명   : 체크박스 이미지화
변수설명 : 
--obj		    (integer)   적용될 체크박스 객체 (input)
--gap			(integer)	이미지 y축 좌표 차이값
주의사항 : 
--라벨안에 input 박스가 있어야 한다. (예) <label><input type="checkbox"></label>
--라벨의 background 이미지에서 비체크이미지가 체크이미지의 위(y자표)에 있어야 한다.
--global에는 비체크일 때의 y축좌표를 넣는다.
*/

function radioChnage(obj,gap){
	var position = parseInt(obj.attr("global"));
	var par = obj.parent();
	position2 = par.css("background-position");
	positionArr = position2.split(" ");
	positionArr[0] = parseInt(positionArr[0].replace("px",""));
	positionArr[1] = parseInt(positionArr[1].replace("px",""));
	if (obj.is(":checked")){
		par.css("background-position",positionArr[0]+"px "+(position-gap)+"px");
	}else{
		par.css("background-position",positionArr[0]+"px "+(position)+"px");
	}
	if(obj.attr("disabled")){
		par.css("background-position",positionArr[0]+"px "+(position-(gap*2))+"px");
	}
 }



function onYearSelect(Year){
	$("[name='birthYear']").val(Year);
	$(".birthYearText").text(Year);
	$(".birthYear").css("display","none");
	$("[name='birthYear']").change();
	$(".spanYear").find("span.birthYearText").css("background","url('/img/arrowDown.png') no-repeat right center");
	$(".spanYear").find("div.bg").css("display","none");
	addDay();
};
function onMonthSelect(Month){
	$("[name='birthMonth']").val(Month);
	$(".birthMonthText").text(Month);
	$(".birthMonth").css("display","none");
	$("[name='birthMonth']").change();
	addDay();
};
function onDaySelect(Day){
	$("[name='birthDay']").val(Day);
	$(".birthDayText").text(Day);
	$(".birthDay").css("display","none");
	$("[name='birthDay']").change();
};
function addDay(){
	var month = parseInt($("[name='birthMonth']").val());
	var year  =	parseInt($("[name='birthYear']").val());
	var day   =	parseInt($("[name='birthDay']").val());
	lastDayArr = Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	var lastDay;
	if(month == 2){
		if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)){
			lastDay = 29;
		}else{
			lastDay = 28;
		}
	
	}else{
		lastDay = lastDayArr[month];
	};
	if(day > lastDay){
		onDaySelect(lastDay);
	};


	$(".birthDay").empty(); 
	for(var i=1; i<=lastDay ; i++){
		$(".birthDay").append("<li><a href='javascript:;' onclick='onDaySelect(\"" + i + "\");'>" + i + "</a></li>");
	};		
	
};
String.prototype.IsNumber = function() { return (/^[0-9]+$/).test(this); }


function isNum(){ 
   var key = event.keyCode;
  // alert(key);
   if(!(key==8||key==9||key==13||key==46||key==144||(key>=48&&key<=57)||key==110||key==190)){ 
      //  alert('숫자만 입력 가능합니다'); 
        event.returnValue = false; 
   } 
}

function calBytes(str)
{
  var tcount = 0;

  var tmpStr = new String(str);
  var temp = tmpStr.length;

  var onechar;
  for ( k=0; k<temp; k++ )
  {
    onechar = tmpStr.charAt(k);
    if (escape(onechar).length > 4)
    {
      tcount += 2;
    }
    else
    {
      tcount += 1;
    }
  }

  return tcount;
}
function limitNum(obj,num){
	obj.keypress(function(){
		isNum();
		if(calBytes($(this).val()) >= num){
			return false;
		}
	});
};
function AboveNum(obj,num,code){
	var par = obj.parent().parent();
	var alt = par.find("span.alert");
	obj.blur(function(){		
		if(calBytes($(this).val()) < num){
			ShowAlert(obj,code);
		}		
	});
	obj.keyup(function(){
		if(calBytes($(this).val()) >= num){	
			HideAlert(obj);
		};
	});
};
function nullChk(obj,code){
	
	if(calBytes(obj.val())<=0){
		ShowAlert(obj,code);
		obj.focus();
		return false;
	}
	return true;
};
function ShowAlert(obj,code){
	switch(code){
		//이름은 필수 항목입니다.
		case "needName" : 
			width="139px";
			position="-215px 0";
			text = "이름은 필수 항목입니다.";
			break;
		//이름은 2자이상 입력하셔야 합니다.
		case "aboveName" : 
			width="204px";
			position="-215px -96px";
			text = "이름은 2자이상 입력하셔야 합니다.";
			break;
		//이메일은 필수 항목입니다.
		case "needEmail" : 
			width="151px";
			position="-215px -16px";
			text = "이메일은 필수 항목입니다.";
			break;
		//이미 사용중인 이메일 주소입니다.
		case "overlapEmail" : 
			width="193px";
			position="-215px -32px";
			text = "이미 사용중인 이메일 주소입니다.";
			break;
		//비밀번호를 입력해주세요.
		case "needPw" : 
			width="146px";
			position="-215px -48px";
			text = "비밀번호를 입력해주세요.";
			break;
		//비밀번호는 7자이상 입력하셔야 합니다.
		case "abovePw" : 
			width="228px";
			position="-215px -112px";
			text = "비밀번호는 7자이상 입력하셔야 합니다.";
			break;
		//비밀번호 확인을 입력해주세요.
		case "needPwChk" : 
			width="177px";
			position="-215px -64px";
			text = "비밀번호 확인을 입력해주세요.";
			break;
		//비밀번호를 다시 확인해주세요.
		case "overlapPw" : 
			width="177px";
			position="-215px -80px";
			text = "비밀번호를 다시 확인해주세요.";
			break;
		//연락처는 필수 항목입니다.
		case "needPhone" : 
			width="152px";
			position="-215px -128px";
			text = "연락처는 필수 항목입니다.";
			break;
		//생년월일은 필수 항목입니다.
		case "needBirth" : 
			width="164px";
			position="-215px -144px";
			text = "생년월일은 필수 항목입니다.";
			break;
	}
	var par = obj.parent().parent();
	var alt = par.find("span.alert");
	alt.css("background-position",position);
	alt.css("width",width);
	alt.text(text);
	alt.css("display","block");
};
function mAlert(obj,code){
	switch(code){
		//이름은 필수 항목입니다.
		case "needName" : 
			width="139px";
			position="-215px 0";
			text = "이름은 필수 항목입니다.";
			break;
		//이름은 2자이상 입력하셔야 합니다.
		case "aboveName" : 
			width="204px";
			position="-215px -96px";
			text = "이름은 2자이상 입력하셔야 합니다.";
			break;
		//이메일은 필수 항목입니다.
		case "needEmail" : 
			width="151px";
			position="-215px -16px";
			text = "이메일은 필수 항목입니다.";
			break;
		//이미 사용중인 이메일 주소입니다.
		case "overlapEmail" : 
			width="193px";
			position="-215px -32px";
			text = "이미 사용중인 이메일 주소입니다.";
			break;
		//비밀번호를 입력해주세요.
		case "needPw" : 
			width="146px";
			position="-215px -48px";
			text = "비밀번호를 입력해주세요.";
			break;
		//비밀번호는 7자이상 입력하셔야 합니다.
		case "abovePw" : 
			width="228px";
			position="-215px -112px";
			text = "비밀번호는 7자이상 입력하셔야 합니다.";
			break;
		//비밀번호 확인을 입력해주세요.
		case "needPwChk" : 
			width="177px";
			position="-215px -64px";
			text = "비밀번호 확인을 입력해주세요.";
			break;
		//비밀번호를 다시 확인해주세요.
		case "overlapPw" : 
			width="177px";
			position="-215px -80px";
			text = "비밀번호를 다시 확인해주세요.";
			break;
		//연락처는 필수 항목입니다.
		case "needPhone" : 
			width="152px";
			position="-215px -128px";
			text = "연락처는 필수 항목입니다.";
			break;
		//생년월일은 필수 항목입니다.
		case "needBirth" : 
			width="164px";
			position="-215px -144px";
			text = "생년월일은 필수 항목입니다.";
			break;
	}
	var par = obj.parent().parent();
	var alt = par.find("span.alert");
	alt.css("background-position",position);
	alt.css("width",width);
	alt.text(text);
	alt.css("display","block");
};


function HideAlert(obj){
	var par = obj.parent().parent();
	var alt = par.find("span.alert");	
	alt.css("display","none");
};

function srcBrowser(){
	if(navigator.userAgent.indexOf("MSIE") >= 0){
		return "Explorer";
	}else if(navigator.userAgent.indexOf("Firefox") >= 0){
		return "Firefox";
	}else if(navigator.userAgent.indexOf("Safari") >= 0){
		if(navigator.userAgent.indexOf("Chrome") >= 0){
			return "Chrome";
		}else if("Android"){
			return "Android";
		}else{
			return "Safari";
		}
	};
};


function calcChk(){
	switch(navigator.appName){
		case "Netscape":
			return true;
			break;
	}
	return false;

};
function calcF(obj,per,width){
	obj.css("width",per);
	wid = obj.width();
	obj.css("width",(wid-width)+"px");
};

function br2nl(str) {
    return str.replace(/<br\s*\/?>/mg,"\n");
};
function appendNum(obj,startNum,endNum,selectNum,step){
	var input  = obj.find("input.value");
	var button = obj.find("button");	
	var text   = obj.find("button span.selectText");
	var ul	   = obj.find("ul");
	var back   = obj.find("div.bg");
	ul.empty();
	for(var i = startNum; i <= endNum; i=i+step ){
		var aText = $("<a href='javascript:;'>"+AddZero(i,2)+"</a>");		

		aText.click(function(){				
			input.val($(this).text());
			text.text($(this).text());
			ul.css("display","none");
			back.css("display","none");			
			input.change();
		});
		var li = $("<li></li>");
		li.append(aText);
		ul.append(li);
	}
	if(startNum > selectNum){
		input.val(AddZero(startNum,2));
		text.text(AddZero(startNum,2));
	}else if(endNum < selectNum){			
		input.val(AddZero(endNum,2));
		text.text(AddZero(endNum,2));
	}else{
		input.val(AddZero(selectNum,2));
		text.text(AddZero(selectNum,2));
	}
	text.css("background","none");
};


/*세로길이를 가로길이의 1/2로*/
function picHeight(){
		var picWid = $("div.picture").width();
		var picHei = parseInt(picWid/2);
		$("div.picture").css('height', picHei+"px");
		}


/*댓글보기, 댓글쓰기 누르면 각 내용 뜨는 것*/
function btnCmt(){
	
	$("button.viewRp").click(function(){
		$(this).css("border-bottom","none");
		$("button.writeRp").css("border-bottom","1px solid #E9E8E8");
		$("div.inputReply").hide();
		$("ul.outputReply").show();
	});

	$("button.writeRp").click(function(){
		$(this).css("border-bottom","none");
		$("button.viewRp").css("border-bottom","1px solid #E9E8E8");
		$("div.inputReply").show();
		$("ul.outputReply").hide();
	});
}

function getMatStr(s,pat){
	var r, re;
	re = new RegExp(pat,"igm");
	if (!re.test(s)) return null;
	r = s.match(re);
	return(r);	
}

function getMatNum(s){
	var r, re;
	var pat = "/^[0-9]*$/";
	re = new RegExp(pat,"igm");
	if (!re.test(s)) return null;
	r = s.match(re);
	return(r);	
}

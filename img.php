<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/cssHeader.php";
?>
<form action="test.php" method="post" enctype="multipart/form-data">
	<div>	
		<select id="selectImgS" name="fileName">
			<option>선택하세요</option>
			<?
			$op = opendir($dir."/img/select");
			$all = "";
			$i = 0;
			while(($file=readdir($op)) !== false){
				if(!(($file==".") or ($file=="..") or (strpos($file,"_repeat")!==false) or (strpos($file,"_last")!==false) or (strpos($file,"_arrow")!==false))){
					$all .= ( ($i==0) ? "":",")."\"/img/select/".$file."\"";
			?>
			<option value="<?=$file?>"><?=$file?></option>
			<?
					$i++;
				}
			}
			?>
		</select><br/>
		<div id="preview2" style="padding:0; text-align:center; position:relative;">
			<img id="selectImg"/>
		</div>
		<br/>
		cutHeight : <input type="text" id="position" name="posi" />
	</div>
	<button type="submit">추가</button>
</form>

<?
$db = new Dbcon();
$db->table = "selectCss";
$db->field = "idx,imgMain,imgRepeat,imgLast,wid,hid,ulTop,ImgArrowOn,ImgArrowOff,align,widPosi,hidPosi,leftPadding,rightPadding,topPadding"; 
$sel = $db->Select();
while($row = mysql_fetch_array($sel)){
	$exp = explode(".",$row['imgMain']);
	$padding = (int)($row['hid']/2) - 12;
?>
<form action="imgModi.php" method="post" enctype="multipart/form-data">
	<div>
		<input type="hidden" name="imgMain" value="<?=$row['imgMain']?>"/>
		<input type="hidden" name="idx" value="<?=$row['idx']?>"/>
		<span class="select <?=$exp[0]?>">
			<input type="hidden" class="value" value=""/>
			<button type="button" class="selectBtn">
				<span>선택</span>
			</button>
			<ul class="selectUl1" style="display:none;">
				<li><a href="javascript:;">항목1</a></li>
				<li><a href="javascript:;">항목2</a></li>
				<li><a href="javascript:;">항목3</a></li>
				<li><a href="javascript:;">항목4</a></li>
				<li><a href="javascript:;">항목5</a></li>
				<li><a href="javascript:;">항목6</a></li>
				<li><a href="javascript:;">항목7</a></li>
			</ul>
		</span>
		<br/><br/>
		화살표 위치<input type="text" style="width:50px; border:1px solid #000;" value="<?=(($row['widPosi']) ? $row['widPosi'] :($row['wid']-20))?>" class="widPosi" name="widPosi"/> <input type="text" style="width:50px; border:1px solid #000;" value="<?=(($row['hidPosi']) ? $row['hidPosi'] : (((int)($row['hid']/2))-5))?>" class="hidPosi" name="hidPosi" /> <input type="file" name="arrow"/>
		<br/>
		정렬
		<select name="align">
			<option value="center" selected="selected">가운데</option>
			<option value="left">왼쪽</option>
			<option value="right">오른쪽</option>
		</select>
		왼쪽여백<input type="text" name="leftPadding" style="width:50px; border:1px solid #000;" value="<?=$row['leftPadding']?>"/>
		오른쪽여백<input type="text" name="rightPadding" style="width:50px; border:1px solid #000;" value="<?=$row['rightPadding']?>"/>
		위쪽여백<input type="text" name="topPadding" value="<?=$padding?>" style="width:50px; border:1px solid #000;" value="<?=$row['topPadding']?>"/>
		<br/>
		<button type="submit">수정</button>
		<br/><br/>
	</div>
</form>
<?
}
//$db->field = "idx,imgMain,imgRepeat,imgLast,wid,hid,ulTop,ImgArrowOn,ImgArrowOff,align,widPosi,hidPosi,leftPadding,rightPadding,topPadding"; 
?>
<style>

span.select {background:#fafafb;  float:left; position:relative; Box-sizing: border-box;}
span.select button{width:100%; height:100%; }
span.select button span{width:100%; height:100%; background:url('/img/arrow.png') no-repeat right 18px;  font-size:13px !important; Box-sizing: border-box;}
span.select div.bg{ z-index:9998; background-color:#FFF;}
span.select ul{position:absolute; z-index:9999;  }
span.select ul li{width:100% !important;  Box-sizing: border-box;line-height:25px; background-color:#FFF; }
span.select ul li a{width:100%; height:100%; Box-sizing: border-box; text-indent:0; text-align:center; font-size:13px !important; display:block;}
span.select ul li a:hover{background-color:#daf3f4;}

span.select div.bg{width:60px; height:150px; background:url('/img/ulback.png') no-repeat 0 -100px; position:absolute;}
span.select ul.limitL{height:145px; overflow:auto;}
span.select ul.limitL{
	scrollbar-face-color:#F7F7F7;
	scrollbar-shadow-color:#FFFFFF;
	scrollbar-highlight-color:#ffffff;
	scrollbar-3dlight-color:#FFFFFF;
	scrollbar-darkshadow-color:#ffffff;
	scrollbar-track-color:#FFFFFF;
	scrollbar-arrow-color:#84d7dc;
}
<?
$sel = $db->Select();
while($row = mysql_fetch_array($sel)){
		$exp = explode(".",$row['imgMain']);
		$padding = (int)($row['hid']/2) - 12;
?>
span.<?=$exp[0]?> {width:<?=$row['wid']?>px; height:<?=$row['hid']?>px !important; background:url('/img/select/<?=$row['imgMain']?>') no-repeat;}
span.<?=$exp[0]?> button span{padding:<?=($row['topPadding']) ? $row['topPadding'] :$padding?>px <?=($row['rightPadding']) ? $row['rightPadding'] :"0"?>px 0 <?=($row['leftPadding']) ? $row['leftPadding'] :"0"?>px; <?=(($row['ImgArrowOn']) ? "background:url('/img/select/".$row['ImgArrowOn']."') no-repeat ".$row['widPosi']."px ".$row['hidPosi']."px;":"") ?><?=($row['align']) ? ("text-align:".$row['align']) : ""?>; }
span.<?=$exp[0]?> ul{width:100%; top:<?=$row['ulTop']?>px}
span.<?=$exp[0]?> ul li{width:100% !important; height:<?=$row['hid']?>px !important; background:url('/img/select/<?=$row['imgRepeat']?>') repeat-y !important;}
span.<?=$exp[0]?> ul li a{padding:<?=($row['topPadding']) ? $row['topPadding'] :$padding?>px <?=($row['rightPadding']) ? $row['rightPadding'] :"0"?>px 0 <?=($row['leftPadding']) ? $row['leftPadding'] :"0"?>px; <?=($row['align']) ? ("text-align:".$row['align']) : ""?>;}
span.<?=$exp[0]?> ul li:last-child a{height:<?=$row['hid']?>px !important;}
span.<?=$exp[0]?> ul li:last-child{height:<?=($row['hid']+($row['hid']-$row['ulTop']))+1?>px !important; background:url('/img/select/<?=$row['imgLast']?>') no-repeat !important;}


<?
}
?>


</style>







<script>

$(".widPosi").change(function(){
	var par = $(this).parent();
	par.find("button.selectBtn span").css("background-position-x",$(this).val()+"px");
})
$(".hidPosi").change(function(){
	var par = $(this).parent();
	par.find("button.selectBtn span").css("background-position-y",$(this).val()+"px")
})
$("select[name='align']").change(function(){
	var par = $(this).parent();
	par.find("button.selectBtn span").css("text-align",$(this).val());
	par.find("ul.selectUl1 a").css("text-align",$(this).val());
});

$("input[name='leftPadding']").change(function(){
	var par = $(this).parent();
	par.find("button.selectBtn span").css("padding-left",$(this).val()+"px");
	par.find("ul.selectUl1 a").css("padding-left",$(this).val()+"px");
});
$("input[name='rightPadding']").change(function(){
	var par = $(this).parent();
	par.find("button.selectBtn span").css("padding-right",$(this).val()+"px");
	par.find("ul.selectUl1 a").css("padding-right",$(this).val()+"px");
});
$("input[name='topPadding']").change(function(){
	var par = $(this).parent();
	par.find("button.selectBtn span").css("padding-top",$(this).val()+"px");
	par.find("ul.selectUl1 a").css("padding-top",$(this).val()+"px");
});

function select(){
	var input		  = $(this).find("input.value");		//실제 제출되는 값
	var inputDefault  = $(this).find("input.inputDefault"); //값이 비었을때 기본값
	var button		  = $(this).find("button");				//클릭 영역 버튼
	var text		  = button.find("span");				//실제 선택된걸 보여주는 텍스트
	var ul			  = $(this).find("ul");					//리스트 영역
	var li			  = ul.find("li");						//리스트
	var back		  =	$(this).find("div.bg");
	var cls			  = $(this).attr("class");
	var clsSw		  = false;
	if(cls.indexOf("selectS") > 0){
		clsSw = true;
	}
	if(input.val()){
		text.text(input.val());
		text.css("background","none");
	}else if(inputDefault.val()){
		input.val(inputDefault.val());
		text.text(input.val());		
		text.css("background","none");
	}
	button.click(function(){
		$("span.select").each(function(){
			autherUl = $(this).find("ul");
			if(autherUl.attr("global")!="on"){
				autherUl.css("display","none");
			}
		});
		if(ul.css("display")=="none"){	
			ul.css("display","");
			ul.attr("global","on");
			//text.css("background","url('/img/arrowUp.png') no-repeat right center");
			back.css("display","");
		}else{
			ul.css("display","none");
			ul.attr("global","");
			//text.css("background","url('/img/arrowDown.png') no-repeat right center");
			back.css("display","none");
		};
		
	});
	$(this).mouseleave(function(){
		back.css("display","none");
		ul.css("display","none");
		ul.attr("global","");
		//text.css("background","url('/img/arrowDown.png') no-repeat right center");
	});
	li.each(function(){
		var a = $(this).find("a");
		a.click(function(){
			if(a.attr("global")){
				input.val(a.attr("global"));
			}else{
				input.val(a.text());
			}
			text.text(a.text());
			ul.css("display","none");
			if(back){
				back.css("display","none");
			}
			if(clsSw==true){
				text.css("background","none");
			}
			input.change();
		});
	});
}
$("span.select").each(select);
function preload() {  
	if (!document.images) return; 
	var ar = new Array(); 
	var arguments = preload.arguments; 
	for (var i = 0; i < arguments.length; i++) { 
		ar[i] = new Image(); 
		ar[i].src = arguments[i]; 
	} 
} 
preload(<?=$all?>)



$("#selectImgS").change(function(){
	$("#selectImg").attr("src","/img/select/" + ($(this).val()));
	$("#preview2").height($("#selectImg").height());
	$("#preview2").width($("#selectImg").width()+50);
	var he = $("#selectImg").height()-10;
	$("#preview2 hr").remove();
	$("#preview2").append("<hr style='width:100%; height:1px; background-color:#000; border:none; position:absolute; top:"+he+"px; margin:0; cursor:pointer;'/>");
	$("#preview2 hr").draggable({
		axis : "y",
		containment: "parent", 
		stop: function() {
			$("#position").val($("#preview2 hr").css("top").replace("px",""));
		}									
	});
	$("#position").val($("#preview2 hr").css("top").replace("px",""));

});



function readURL(input,obj) { 
	//alert("dd")
	if (input.files && input.files[0]) {
		var image =  new Image();
		var reader = new FileReader(); 
		reader.onload = function (e) {
			image.src = e.target.result;
			obj.find("button.selectBtn span").css('background',"url('"+ image.src + "') no-repeat "+obj.find(".widPosi").val()+"px "+obj.find(".hidPosi").val()+"px");			
			//alert(obj.find("button.selectBtn span").css('background'));
		};
		reader.readAsDataURL(input.files[0]);		
	};
};


$("input[name='arrow']").change(function(){ 
	var par = $(this).parent();
	readURL(this,par)
});


$(document).ready(function(){
	$("#addPic").change(function(){ 
		readURL(this,$("#preview"));
	})
	$("button.setting").click(function(){
		$("#preview2").height($("#preview").height());
		$("#preview2").width($("#preview").width()+50);
		var he = $("#preview").height()-10;
		$("#preview2").append("<hr style='width:100%; height:1px; background-color:#000; border:none; position:absolute; top:"+he+"px; margin:0;'/>");
		$("#preview2 hr").draggable({
										axis : "y",
										containment: "parent", 
										stop: function() {
											$("#position").val($("#preview2 hr").css("top"));
										}									
									});
		$("#position").val($("#preview2 hr").css("top"));
		$("#preview2 hr").bind('drag')
	});
});
</script>


<?
include $dir."/inc/footer/cssFooter.php";
?>
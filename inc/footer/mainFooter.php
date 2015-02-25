	<div style="clear:both;"></div>
</div>
<script>
function chn(){
	var input		  = $(this).find("input.value");		//실제 제출되는 값
	var inputDefault  = $(this).find("input.inputDefault"); 
	var button		  = $(this).find("button");		
	var text		  = button.find("span");	
	var cls			  = $(this).attr("class");
	var clsSw		  = false;

	if(input.val()){
		text.text(input.val());
		text.css("background","none");
	}else if(inputDefault.val()){
		input.val(inputDefault.val());
		text.text(input.val());		
		text.css("background","none");
	}
}
$("textarea").each(function(){
	//$(this).focus();
});
$(window).scrollTop(0);
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
		$(this).unbind("mouseleave");
		$(window).unbind("click");
		$(this).unbind("hover");
		$("span.select").each(function(){
			autherUl = $(this).find("ul");
			autherUl.css("display","none");
			$(this).find("div.bg").css("display","none");
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
		$(this).mouseleave(function(){
			$(window).click(function(){
				back.css("display","none");
				ul.css("display","none");
				ul.attr("global","");
			})
			$(this).hover(function(){
				$(window).unbind("click");		
			});	
			//text.css("background","url('/img/arrowDown.png') no-repeat right center");
		});
			
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
			$(window).unbind("click");	
		});
	});
}
$("span.select").each(select);


$("#emailSelect").change(function(){		
	if($(this).val()=="직접입력")	{			
		var par = $(this).parent();
		//par.css("display","none");
		$(this).attr("disabled",true);
		$("input.emailText").css("display","");
		$("input.emailText").attr("disabled",false);
		$("span.selectEmail").text("");
		$("input.emailText").focus();
	}else{
		$(this).attr("disabled",false);
		$("input.emailText").css("display","none");
		$("input.emailText").attr("disabled",true);					
	};
});
var gap = 34;
$(document).ready(function(){
	$("[type='checkbox']").each(function(){
		$(this).change(function(){
		
			if($(this).attr("class")=="box"){
				chkChnage($(this),30);
			}else{					
				chkChnage($(this),25);
			}
		});
		if($(this).attr("global")!="-881"){
			$(this).change();
		}else{
		}
		
	});
	ret = 1;	


	$("#checkAll").change(function(){
		if($(this).is(":checked")){
			$("#mainForm input.ckBox").each(function(){
				$(this).prop("checked",true);
				chkChnage($(this),25);
			});
		}else{
			$("#mainForm input.ckBox").each(function(){
				$(this).prop("checked",false);
				chkChnage($(this),25);
			});
		}
	});
	$("#mainForm input.ckBox").each(function(){
		$(this).change(function(){
			if($(this).is(":checked")){
			}else{
				$("#checkAll").attr("checked",false);
				chkChnage($("#checkAll"),25);
			}
			
		});
	});	
$("[type='radio']").change(function(){
		$("[name='"+$(this).attr("name")+"']").each(function(){
			radioChnage($(this),19);
						
		});		
	});			 
	$("[type='radio']").each(function(){
		
		$(this).change();
	});
	$("li.groupradio").hide();
	
	$(window).scrollTop(0);
});
</script>

<?
include $dir."/inc/footer/globalFooter.php";
?>
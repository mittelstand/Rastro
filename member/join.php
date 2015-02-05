<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
if($_SESSION['id']){
	$mit =  new Mittel();
	$_GET['idx'] = $_SESSION['idx'];
	
	$mit->opt = $option['member'];
	$row = $mit->outputDetail();
	unset($mit);
}
?>

<div class="memberWrite contentBox">
	<form action="/member/pwChnage.php" method="post" id="pwFind">
		
		
		<div class="inputBox" style="display:none">
			<span class="lab">비밀번호변경</span>
			<span class="clear pPw">현재 비밀번호</span>
			<span class="id input"><input name="id" type="password" value="" class="pass3" /></span>
			<span class="clear nPw">새 비밀번호</span>
			<span class="password input"><input name="pwd" type="password" class="pwChk1" /></span>
			<span class="clear nPwRp">새 비밀번호 확인</span>
			<span class="password input"><input type="password" class="pwChk2"/></span> 
			<input type="hidden" name="returnUrl" value=""/>				
		<div class="bottom">  			
			<button type="button" class="submit submitPw">확인</button>   
			<button type="button" class="close">취소</button>
		</div>
		</div>
		
	</form>
	<form action="/proc.php" method="post" id="memberForm">
	<?if($_SESSION['id']){?>
		<input type="hidden" name="idx" value="<?=$_GET['idx']?>"/>
	<?}?>
	<?if($_SESSION['id']){?>
	<div class="joinTit">나의 정보</div>
	<?}else{?>
	<div class="joinTit">회원가입</div>
	<?}?>
	
	<ul class="joinwrite">
		<?if($_SESSION['id']){?>
			<li class="name">
				<span class="label">이름</span>
				<span class="input"><?=$row['name']?></span>
			</li>
		<?}else{?>
			<li class="name">
				<span class="label">이름</span>
				<span class="input"><input type="text" name="name"/></span>
			</li>
		<?}
		if($_SESSION['id']){?>
			<li class="id">
				<span class="label">아이디</span>
				<span class="input"><?=$row['email'][1]?>@<?=$row['email'][2]?></span>
				<span class="idchk"></span>
			</li>
		<?}else{?>
			<li class="mail">
				<span class="label">이메일</span>
				<span class="input"><input type="text" name="email" onKeyup="checkEng(this)" value="<?=$row['email'][1]?>"/></span>
				<span class="at">@</span>
				<span class="select selectH2">
					<input type="hidden" name="emailFooter" id="emailSelect" class="value" value="<?=$row['email'][2]?>"/>
					<button type="button" class="selectBtn">
						<span class="selectEmail">메일 선택</span>
					</button>
					<ul class="selectUl1" style="display:none;">
						<li><a href="javascript:;">naver.com</a></li>
						<li><a href="javascript:;">nate.com</a></li>
						<li><a href="javascript:;">hanmail.net</a></li>
						<li><a href="javascript:;">daum.net</a></li>
						<li><a href="javascript:;">teator.co.kr</a></li>
						<li><a href="javascript:;">gmail.com</a></li>
						<li><a href="javascript:;">dreamwiz.com</a></li>
						<li><a href="javascript:;">직접입력</a></li>
					</ul>									
					<input type="text" name="emailFooter2" class="emailText" value="<?=$email[1]?>" style="z-index:9999;display:none;width:160px;position:absolute;background-color:none;top:5px;margin-left:6px;height:28px;"/>
				</span>	
			</li>
		<?}
		if($_SESSION['id']){?>
			<li class="pwd1">
				<span class="label">새 비밀번호</span>
				<span class="input"></span>
				<span><button type="button" class="pwModify">비밀번호변경</button></span>
			</li>
				
		<?}else{?>
		
			<li class="pwd1">
				<span class="label">비밀번호</span>
				<span class="input"><input type="password" name="pwd" class="pass1"/></span>
			</li>
			<li class="pwd2">
				<span class="label">비밀번호 확인</span>
				<span class="input"><input type="password" class="pass2"/></span>
				<span class="text"></span>
			</li>
			<li>
				<span class="text"></span>
			</li>
		<?}?>
		
			<li class="phone">
				<span class="label">연락처</span>
				<span class="select selectH">
					<input type="hidden" value="010" class="inputDefault"/>
					<input type="hidden" name="phone1" class="value" id="phonHeader" value='<?=$row['phone'][0]?>'/>
					<button type="button" class="selectBtn" id="selectBtn">
						<span class="selectText purple phone"></span>											
					</button>
					<ul class="selectUl2" style="display:none;">
						<li><a href="javascript:;">010</a></li>
						<li><a href="javascript:;">011</a></li>
						<li><a href="javascript:;">016</a></li>
						<li><a href="javascript:;">017</a></li>
						<li><a href="javascript:;">018</a></li>
						<li><a href="javascript:;">019</a></li>
					</ul>
				</span>	
				<span class="hyphen">-</span>
				<span class="input"><input type="text" name="phone2" maxlength="4" onKeyup='checkNum(this)' value="<?=$row['phone'][1]?>"/></span>			
				<span class="hyphen">-</span>
				<span class="input"><input type="text" name="phone3" maxlength="4" onKeyup='checkNum(this)'
				value="<?=$row['phone'][2]?>"/></span>
			</li>
			<li class="sex">
				<div class="input3 input">
					<span class="label">성별</span>
					<span class="select selectH">
						<input type="hidden" name="sex" id="sex" class="value" value="<?=$row['sex']?>"/>
						<button type="button" class="selectBtn">
							<span class="selectSex">성별 선택</span>
						</button>
						<ul class="selectUl1" style="display:none;">
							<li><a href="javascript:;">남성</a></li>
							<li><a href="javascript:;">여성</a></li>
						</ul>									
					</span>
				</div>
			</li>
		</ul>
	
		<?if($_SESSION['id']){?>
		<div class="joinbtn">	
			<button type="submit" class="write">수정</button>
			<button type = "button" onclick="location.href='trashPw.php'" class = "delete" style="text-indent:0;">회원삭제</button>
		</div>
		
		<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
		<input type="hidden" name="page" value="<?=$_GET['page']?>"/>
		<?}else{?>
		<div class="joinbtn">	
			<button type="button" class="back " onclick="location.href='index.php'">뒤로가기</button>
			<button type="submit" class="join" style="text-indent:0;">가입</button>
		</div>
		<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
		<input type="hidden" name="page" value="<?=$_GET['page']?>"/>
		<?}?>
	</form>
<?
	if($_SESSION['id']){
?>
<?
}	
?>

<script>
	$("input").each(function(){
		
		$(this).focus();
		
	});
	$("textarea").each(function(){
		
		$(this).focus();
		
	});
	var gap = 25;
	$("[type='checkbox']").each(function(){
		$(this).change(function(){
			chkChnage($(this),25);
		});
	});
	
	function idchk(){
		var text = $(this).val();
		var leng =text.length;		
		$.ajax({
			type:'POST',
			url:'/member/idChk.ax.php',
			dataType:'json',
			data : {
				id  : text
			},
			success: function(result){
				var date= result.value[0];
				/*if(date.chk>=1){
					alert("아이디를 사용할수 없습니다.");
					$("input[name='id']").focus();
				}*/
					if(date.chk>=1){
						$("span.idchk").text("아이디를 사용할수 없습니다.");
						$("span.idchk").css("color","red");
						$("input[name='id']").addClass("addclass");
						$("input[name='id']").focus();
					}else{
						$("span.idchk").text("");
						$("input[name='id']").removeClass("addclass");
					}
			},
			error: function(){
			}
		});
	}
	$("input[name='id']").change(idchk);
	
	$("#memberForm").submit(function(){
		if($("li.name input").val().length<=0){
			alert("이름을 입력하세요.");
			$("li.name input").focus();
			return false;
		}
		if($("li.id input").val().length<=0){
			alert("아이디를 입력하세요.");
			$("li.id input").focus();
			return false;
		}
		if($("li.mail input").val().length<=0){
			alert("이메일을 입력하세요.");
			$("li.mail input").focus();
			return false;
		}
		if($("#emailSelect").val().length<=0 && $("input[name='emailFooter2']").val().length<=0 ){
			alert("이메일을 입력하세요.");
			$("li.mail input").focus();
			return false;
		}
		if($("li.pwd1 input").val().length<=0){
			alert("비밀번호를 입력하세요.");
			$("li.pwd1 input").focus();
			return false;
		}
		if($("li.pwd2 input").val().length<=0){
			alert("비밀번호를 한번더 입력하세요.");
			$("li.pwd2 input").focus();
			return false;
		}
		if($("input[name='phone1']").val().length<=0 || $("input[name='phone2']").val().length<=0 || $("input[name='phone3']").val().length<=0){
			alert("연락처를 입력하세요.");
			$("li.phone input2").focus();
			return false;
		}
		if($("li.sex input").val().length<=0){
			alert("성별을 선택하세요.");
			$("li.sex input").focus();
			return false;
		}
	
		if($("span.idchk").text().length>=1){
			alert("아이디가 중복되었습니다.다시 입력하세요");
			$("li.id input").focus();
			return false;
		}
	
	});

	function pwChk(){
		var pw2=$(this).val();
		var pw=$("li.pwd1 input.pass1").val();
		if(pw2.length<=0){
			alert("비밀번호를 입력하세요.");
			$("input.pass2").focus();
		}else{
			if(pw!=pw2){
				
				alert("비밀번호를 잘못 입력하였습니다.");
				$("input.pass2").val("");
				$("input.pass2").focus();
			}
		}
	
	}
	$("li.pwd2 input.pass2").change(pwChk);
	function checkNum( obj ) {
		var num_regx=/^[0-9]*$/i;
		if(!num_regx.test(obj.value) ) {
			alert("숫자만 입력할수 있습니다.");
			var num_regx=/[^0-9]*$/i;
			var st = obj.value.match(num_regx)
			obj.value = obj.value.replace(st,"");
		} 
		if($("input[name='phone2']").val().length==4){
			$("input[name='phone3']").focus();
		}
	}
	function checkEng( obj ) {
		var num_regx=/^[a-zA-Z0-9]*$/i;
		if(!num_regx.test(obj.value) ) {
			alert("한글은 입력할수 없습니다.");
			var num_regx=/[^a-zA-Z0-9]*$/i;
			var st = obj.value.match(num_regx)
			obj.value = obj.value.replace(st,"");
		} 	
	}
	function emailchk(){
		var email= $("input[name='email']").val();
		var emailFooter= $("input[name='emailFooter']").val();
		var emailFooter2= $("input[name='emailFooter2']").val();
		$.ajax({
			type:'POST',
			url:'/member/emailchk.php',
			dataType:'json',
			data:{		
				email:email,
				emailFooter:emailFooter,
				emailFooter2:emailFooter2,
			},success:function(result){
				if(result!=""){
					var date=result.value[0];
					if(date.i=="1"){
						$("input[name='email']").val("");
						$("input[name='email']").focus();
						alert("이미 가입한 이메일입니다.");
						$("input.emailchk1").val("c");
					}else{
						$("input.emailchk1").val("n");
					}
				}
			},error:function(result,a,b){
				alert(b);
			}
		});
	}
	$("input.emailText").change(emailchk);
	$("#emailSelect").change(emailchk);
	$("input[name='email']").change(emailchk);

	/*$("form").submit(function(){
		
		<? if($_SESSION['id']){ ?>
		var sw = 1;
		var pwd = $("input.pass3").val();
		if(pwd.length>0){
		$.ajax({
			type:'POST',
			url:'/member/pwChk.ax.php',
			dataType:'text',
			data:{		
				pwd : pwd
			},success:function(result){
				
				if(trim(result).length > 0){
					sw = 0;
				}
			},error:function(result,a,b){
				alert(b);
			}
		});
		}
		if(sw==0){
			alert("현재 비밀번호가 틀렸습니다.")
			return false;
		}
		<? }else{ ?>
		
		if($("li.name input").val().length<=0){
			alert("이름을 입력하세요.");
			$("li.name input").focus();
			return false;
		}
		if($("li.id input").val().length<=0){
			alert("아이디를 입력하세요.");
			$("li.id input").focus();
			return false;
		}
		
		if($("li.pwd1 input").val().length<=0){
			alert("비밀번호를 입력하세요.");
			$("li.pwd1 input").focus();
			return false;
		}
		if($("li.pwd2 input").val().length<=0){
			alert("비밀번호를 한번더 입력하세요.");
			$("li.pwd2 input").focus();
			return false;
		}
		if($("li.mail input").val().length<=0){
			alert("이메일을 입력하세요.");
			$("li.mail input").focus();
			return false;
		}
		if($("#emailSelect").val().length<=0 && $("input[name='emailFooter2']").val().length<=0 ){
			alert("이메일을 입력하세요.");
			$("li.mail input").focus();
			return false;
		}
		if($("input[name='phone1']").val().length<=0 || $("input[name='phone2']").val().length<=0 || $("input[name='phone3']").val().length<=0){
			alert("연락처를 입력하세요.");
			$("li.phone input").focus();
			return false;
		}
		if($("li.sex input").val().length<=0){
			alert("성별을 선택하세요.");
			$("li.sex input").focus();
			return false;
		}
		<? }?>
	
	
	});*/
	$("button.submitPw").click(function(){
		if(trim($("input.pwChk1").val()).length<=0){
			alert("비밀번호를 입력하세요.");
			$("li.pwd1 input").focus();
			return false;
		}
		if(trim($("input.pwChk2").val()).length<=0){
			alert("비밀번호를 한번더 입력하세요.");
			$("li.pwd2 input").focus();
			return false;
		}
		if($("input.pwChk1").val()!=$("input.pwChk2").val()){
			alert("비밀번호와 확인이 같지 않습니다. ");
			return false;
		}
		var sw = 0;
		var pwChk1="";
		var pwd = $("input.pass3").val();
		if(pwd.length>0){
			$.ajax({
				type:'POST',
				url:'/member/pwChk.ax.php',
				dataType:'text',
				data:{		
					pwd : pwd
				},success:function(result){
					pwChk1=trim(result);
					if(pwChk1!="y"){
						alert("현재 비밀번호를 잘못입력하셨습니다.");
						 return false;
					}
					$("#pwFind").submit();
				},error:function(result,a,b){
					alert(b);
				}
			});
		}else{
			alert("현재 비밀번호를 입력하세요.")
			return false;
		}
		
	});
	function pwModify(){
		$("div.inputBox").show();
	}
	$("button.pwModify").click(pwModify);
/*
	function pwChk(){
		var pw2=$(this).val();
		var pw=$("li.pwd1 input.pass1").val();
		if(pw2.length<=0){
			alert("비밀번호를 입력하세요.");
			$("input.pass2").focus();
		}else{
			if(pw!=pw2){
				alert("비밀번호를 잘못 입력하였습니다.");
				$("input.pass2").focus();
			
			}
		}
	
	}*/
</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>
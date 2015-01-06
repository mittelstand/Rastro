<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class="loginWrap contentBox">
	<div class = "loginform">
	<form action="loginProc.php" method="post">
			<?
			if($_GET['returnUrl']){
			?>
			<input type="hidden" name="returnUrl" value="<?=$_GET['returnUrl']?>"/>
			<?
			}
			if($_GET['id']){
				$id =$_GET['id'];
			}else if($_COOKIE['mit_login_id']){
				$id = $_COOKIE['mit_login_id'];
			}

			?>
			<h2></h2>
			<div class="loginBox">
				<div class="loginInput"> 
					<div class="idpwd">
						<ul>
							<li>
								<span class="label"  ></span>
								<span class="inputT" style="margin-top:5px;"><input type="text" name="email" onKeyup="checkEng(this)" value="<?=$id?>" class= "loginOff"/></span>
								<span>
										<span class="mail">
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
								</span>
							</li>
							<li>
								<span class="label"></span>
								<span class="inputT" style="margin-top:5px;"><input type="password" name="pwd"  class="loginOff"/></span>
							</li>
						</ul>
						<button type="submit" class="loginButton"">로그인</button>
					</div>
					
				</div>
			</div>
			<div class="chkGroup">
				<div class="idSave">
					<span class="chkLab">아이디 저장</span>
					<label class="chkC" for="idSave">
						<input class="chkC" type="checkbox" id="idSave" name="idSave"  <?=($_COOKIE['mit_check_id']=="false") ? "" : "checked='checked'" ?> value="yes"/>
					</label>
				</div>
				 <div class="autoLogin">
					<span class="chkLab">자동로그인</span>
					<label class="chkC" for="autoLogin">
						<input class="chkC" type="checkbox" id="autoLogin" name="autoLogin"  <?=($_COOKIE['mit_check_auto']=="false") ? "" : "checked='checked'" ?> value="yes"  global="-1029"/>
					</label>
				</div>
			</div>
			<div class="loginText">
				<ul>
					<li><span class="ans"><a href="/member/findEmail.php">아이디 찾기</a></span></li>
					<li><span class="ans"><a href="/member/findEmail.php">비밀번호 찾기</a></span></li>
					<li><span class="ans"><a href="/member/index.php">회원가입</a></span></li>
				</ul>
			</div>
		</form>
	</div>
</div>
<script>
$('ul li span.inputT input.loginOff').focus(function(){
	$(this).attr("class","loginOn");
});
$('ul li span.inputT input.loginOff').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","loginOff");
	}
});
</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
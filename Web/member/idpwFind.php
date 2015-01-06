<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div class="idpwFind contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class ="idpwFindtitle">
		<span class="tit"></span>
	</div>
	<form action="idFindC.php" method="post">
		<ul class="idFind">
			<li class="eMail">
				<span class="emailTitle"></span>
				<span class="email"><input type="text" name="email"></span>
				<span class="at"></span>
				<span class="select selectL">
					<input type="hidden" name="emailFooter" id="emailSelect" class="value" value="<?=$email[1]?>"/>
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
			<li class="conTact">
				<span class="contactTitle"></span>
				<span class="select selectM">
				<input type="hidden" value="010" class="inputDefault"/>
				<input type="hidden" name="phone1" class="value" id="phonHeader" value='<?=$phone[0]?>'/>
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
			<span class="hyphen"></span>
			<span class="cInput"><input type="text" name="phone2" />
			<span class="hyphen"></span>
			<span class="cInput"><input type="text" name="phone3" />
		  </li>
		  <li class="find">
			<button type="submit" class="idFindBtn"></button>
		  </li>
		</ul>
	</form>
	<div class="line"></div>
	<form action="pwFindC.php"  method="post">
		<ul class="pwFind">
			<li class="id">
				<span class="idTitle"></span>
				<span class="cID"><input type="text" name="id" />
			</li>	
			<li class="pwEmail">
				<span class="emailTitle"></span>
				<span class="email"><input type="text" name="email"></span>
				<span class="at"></span>
				<span class="select selectL">
					<input type="hidden" name="emailFooter" id="emailSelect" class="value" value="<?=$email[1]?>"/>
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
			<li class="pwconTact">
				<span class="contactTitle"></span>
				<span class="select selectM">
				<input type="hidden" value="010" class="inputDefault"/>
				<input type="hidden" name="phone1" class="value" id="phonHeader" value='<?=$phone[0]?>'/>
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
				<span class="hyphen"></span>
				<span class="cInput"><input type="text" name="phone2" />
				<span class="hyphen"></span>
				<span class="cInput"><input type="text" name="phone3" />
		 </li>
			<li class="find">
				<button type="submit" class="pwFindBtn"></button>
			</li>
		</ul>
	</form>
</div>
	
<?
include $dir."/inc/footer/mainFooter.php";
?>
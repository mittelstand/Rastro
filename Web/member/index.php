<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>

<div class="memberWrite contentBox">
	
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
		
	<form action="join.php" method="post" id="indxform">
		<div class="agreeBox">
			<h3 class="provision">이용 약관</h3>
			<div>
				<p><span lang="EN-US" xml:lang="EN-US">· </span>이용약관</p>
			</div>
			<label for="agree1" class="agree">
				<input id="agree1"  global="-53" type="checkbox" class="ckBox" name="number[]" value="<?=$row['idx']?>" />이용 약관에 동의합니다.
			</label>
			<h3 class="personal">개인정보취급방침</h3>
			<div>
		
			</div>	
			<label for="agree2" class="agree">
				<input id="agree2"  global="-53" type="checkbox" class="ckBox" name="number[]" value="<?=$row['idx']?>" />개인정보취급방침에 동의합니다.
			</label>
		</div>
		<button type="submit" class="next" style="text-indent:0;">다음</button>

<script>
	var gap = 25;
	$("[type='checkbox']").each(function(){
		$(this).change(function(){
			chkChnage($(this),25);
		});
	});
	
	
	
	$("#indxform").submit(function(){
	
		if($("#agree1").prop("checked")==false){
			alert("이용약관에 동의해주세요.");
			return false;
		}
		if($("#agree2").prop("checked")==false){
			alert("개인정보취급방침에 동의해주세요.");
			return false;
		}
	
	});


	
</script>


<?
include $dir."/inc/footer/mainFooter.php";
?>
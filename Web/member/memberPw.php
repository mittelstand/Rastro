<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

?>

<div class="memberWrite contentBox">
	<div class="memberPw">	
		<span class="label">비밀번호 확인</span>
		<span class="input"><input type="password" class="pass"/></span>
		<div class="bottom">
			<button type="button"class="pwchk">확인</button>
		</div>
	</div>
<script>
function pwchk(){
	var pwd=$("input.pass").val();
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
					alert("비밀번호를 잘못입력하셨습니다.");
					 return false;
				}
				location.href="/member/join.php"
			},error:function(result,a,b){
				alert(b);
			}
		});
	}else{
		alert("비밀번호를 입력하세요.")
		return false;
	}
}
$("button.pwchk").click(pwchk);
</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

if(strlen($_SESSION['id']) <= 0){
	MsgBox("접근권한이 없습니다.","/board/index.php?type=".$_GET['type']);
	exit();
}
?>
<?
if($_GET['idx']){
	$mit =  new Mittel();
	$mit->opt = $option['board'];
	$row = $mit->outputDetail();
	unset($mit);
}	
?>
<div class="contentTop contentBox">
	<form class="sibal" action="/proc.php" method="post">
		<?if($_GET['idx']){?>
			<input type="hidden" name="idx" value="<?=$_GET['idx']?>"/>
		<?}?>
		<div class="tit"></div>
		<div class = "conBox">
			<ul class="write">
				<li class="input boardtit">
					<div class="input">
						<span class="label"></span>
						<span class="inputT">
							<input type="text" name="title" value="<?=$row['title']?>" class="off"/>
						</span>
					</div>
					
				</li>
				<div style="height:20px;"></div>
				<li class="text clear boardTextarea" >
					<div class="textarea">
						<span class="label"><!--내용--></span>
						<span class="input">
							<textarea id="content" name="content"><?=$row['content']?></textarea>
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
							<!--<?
								$type = $_GET["type"];
								if($type == "g"){
							?>
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
									<input type = "file" name = "imageFile[]" />
							<?
								}
							?>-->
						</span>
					</div>
				</li>
			</ul>
		</div>
		<ul class="write">
			<li class="btnl clear" style="clear:both;">
				<button type="button" class="regist btnW" onclick="location.href='index.php?type=<?=$_GET['type']?>'">목록</button>
				<button type="submit" class="btnList btnW">등록</button>

			</li>
			
		</ul>
		<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
		<input type="hidden" name="page" value="<?=$_GET['page']?>"/>
	</form>	
	

<script>
$('ul.write li.boardtit span.inputT input.off').focus(function(){
	$(this).attr("class","on");
});
$('ul.write li.boardtit span.inputT input.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});

$('ul.write li.etc span.input textarea.off').focus(function(){
	$(this).attr("class","on");
});
$('ul.write li.etc span.input textarea.off').blur(function(){
	if($(this).val().length<=0){
		$(this).attr("class","off");
	}
});
$("form").submit(function(){
	var num =$("li.input input").val();
	if(num.length<=0){
		alert("제목을 입력하세요");
		$("li.input input").focus();
		return false;
	}

});

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
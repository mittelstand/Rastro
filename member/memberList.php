<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
$_GET['page'] = ($_GET['page']) ? $_GET['page'] : 1; 

$keyTab = "member";

$mit =  new Mittel();
$mit->opt = $option['member'];
$mit->block=8;
$row = $mit->outputList();
$cnt = $mit->listCnt;
unset($mit);


?>
<form action="delMProc.php" method="post" id="mainForm">
<input type="hidden" name="key" value="member"/>
<div class="contentTop contentBox">	
	<span class="memberListTit">회원관리</span>
	<ul class="memberList">
	
		<li class="top">
		<div class="chk chkW member">
			<label for="checkAll" class="chkB">
					<input id="checkAll" global=""  type="checkbox"  />
			</label>
		</div>
		<div class="nameMem nameMemW member"><span>이름</span></div>
		<div class="grade gradeW member"><span>회원등급</span></div>
		<div class="id idW member"><span>아이디</span></div>
		<div class="emailMem emailMemW member"><span>이메일</span></div>
		<div class="phoneMem phoneMemW member"><span>연락처</span></div>							
		<!-- <div class="jobMem jobMemW"><span>소속</span></div> -->
		<div class="joinDate joinDateW member"><span>가입일</span></div>
	</li>
	
	
		
		
		
		<?
			if(is_array($row)){
			foreach($row as $key=>$val){
				?>
				<li class="list">
					<div class="chk chkW member">
						<label for="ckBox<?=$val['id']?>" class="chkB">
							<input id="ckBox<?=$val['id']?>"  global="" type="checkbox" class="ckBox" name="number[]" value="<?=$val['id']?>" />
						</label>
					</div>
					<div class="name nameMemW member"><span><?=$val['name']?></span></div>
					<div class="grade gradeW member">
						<?
						if($val['id']=='admin'){
							$txt="관리자";
						}else{
							switch($val['authority']){
							case "1":
								$txt = "준회원";
								break;
							case "2":
								$txt = "정회원";
								break;
							}
						}
	
						?>
						<span class="select selectH">
							<input type="hidden" name="auth[]" class="value"  value='<?=$txt?>'/>
							<button type="button" class="selectBtn" id="selectBtn">
								<span class="selectText purple phone"></span>											
							</button>
							<ul class="selectUl2" style="display:none;">
								<?if($_SESSION['id']!=$val['id']){?>
								<li><a href="javascript:;">준회원</a></li>
								<li><a href="javascript:;">정회원</a></li>
								<? } ?>
							</ul>
						</span>	
					</div>
					<div class="id idW member"><span><?=$val['id']?></span></div>
					<div class="emailMem emailMemW member"><span><?=$val['email'][0]?></span></div>				
					<div class="phoneMem phoneMemW member"><span><?=$val['phone'][0]."-".$val['phone'][1]."-".$val['phone'][2]?></span></div>
					
					<div class="joinDate joinDateW member"><span><?=$val['cdate']['y']."-".$val['cdate']['m']."-".$val['cdate']['d']?></span></div>			
				</li>
				
				<?
					}
				}	
				?>	
	</ul>
	</form>
	</div>
		<div class="deatilBottom">
		<div class="page pgNum">
			<?
			$pg = new Page();
			$pg->totalCnt = $cnt;
			$pg->nowPage = $_GET['page'];
			$pg->href = "/member/memberList.php";
			$pg->limitPage = 10;
			$pg->limitPageGroup = 10;
			$pg->Setting();	
			?>
			<button class="prev" type="button" onclick="location.href='<?=$pg->prevPageLink?>'"></button>
			<?echo $pg->Output();
			?>
			<button class="next" type="button" onclick="location.href='<?=$pg->nextPageLink?>'">&gt;</button>
		</div>
		<button type="button" class="deleteB btn">삭제</button>
	</div>
	<script>
		$("button.deleteB").click(function(){
			if(confirm("정말 삭제하시겠습니까??")){
				$("#mainForm").submit();
			};
		});
		$("input[name='auth[]']").change(function(){
			var txt = $(this).val();
			var id = $(this).parent().parent().parent().find("div.id").text();
			
			$.ajax({
				type:'POST',
				url:'/member/memberList.ax.php',
				dataType:'json',
				data : {
					id : id,
					title : txt
				},
				success: function(result){
					


				},
				error: function(){
				}
			});
		});
	</script>
</div>
<?
include $dir."/inc/footer/mainFooter.php";
?>
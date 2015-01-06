<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";

$_GET['type']=($_GET['type'])?$_GET['type'] : "cExp";
$mit =  new Mittel();
$mit->opt = $option['exp'];
$row = $mit->outputDetail();
unset($mit);

if($_GET['type']=="cExp"){
?>


<div class="cExpDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div style="clear:both;"></div>
	<!-- <div class="btn">
		<button type="button" class="personApp" onclick="location.href='#'"/>개인신청</button>
		<button type="button" class="groupApp" onclick="location.href='#'"/>단체신청</button>
	</div> -->
</div>
<?}else{?>
<div class="wExpDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>
	<div style="clear:both;"></div>
<!-- 	<div class="btn">
		<button type="button" class="noPay" onclick="location.href='#'"/>무급</button>
		<button type="button" class="pay" onclick="location.href='#'"/>유급</button>
	</div> -->
</div>
<?}?>


<div class="exp contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class="detailTit"><?=$row['title']?></div>


	<div class="contentTop">
		<div class="picture"><img src="<?=$row['img']?>" /></div>
		<div class="text">
			<span class="rcNum"><?=$row['people']?></span>
			<span class="rcDate">~<?=$row['eventDateE']['m']?>.<?=$row['eventDateE']['d']?></span>
			<span class="cost"><?=$row['cost']?></span>
			<span class="pay" style="display:none;">월 <?=$row['pay']?>만원</span>
			<span class="cont"><?=$row['etc']?></span>
			
			<div class="btn">				
				<button type="button" class="payCancel" style="background-position:-258px -1119px;" >결제 취소
				</button>
				<form action="payCproc.php"method="post" id="subForm">				
					<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
					<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
				</form>

				<script>
				$("button.payCancel").click(function(){
				if(confirm("정말 취소하시겠습니까?")){
					
				$("#subForm").submit();
				}
				});
				</script>

			</div>
		</div>
		<div style="clear:both;"></div>
	</div>

		<div class="detailCont">
		
		<input type="hidden" name="idx" value="<?=$idxso?>"/>
		
				
			<span class="applyTit">신청 확인</span>
			<input type="hidden" name="tab" value="exp"/>
			<input type="hidden" name="fidx" value="<?=$_GET['idx']?>"/>
			<input type="hidden" name="type" value="<?=$_GET['type']?>"/>
			<input type="hidden" name="cost" value="<?=$row['cost']?>">
			<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
			<input type="hidden" name="one" value="1">
			<ul class="apply">
			<?
			if($_SESSION['id']){
				$db = new Dbcon();
				$db->table = "apply";
				$db->keyfield = "idx";
				$db->where = "writer = '".$_SESSION['id']."' and fidx='".$_GET['idx']."' and tab='exp'";
				$cnt = $db->TotalCnt();
				
					$db->field = "idx,tab,fidx,writer,name,grName,email,phone,job,msg,mdate,cdate";
					$db->orderBy = "idx asc";
					$sel = $db->Select();
					if($cnt==1){
					$row2=mysql_fetch_array($sel);
					$grName = $row2['grName'];
					$job = $row2['job'];
					$email = explode("@",$row2['email']);
					$name = $row2['name'];
					$phone = explode("-",$row2['phone']);
					$msg = $row2['msg'];
					$idx = $row2['idx'];
					?>
					<li class="name" >
						<span class="tit">이름</span>
						<span class="lab" style="margin-top:10px;"><?=$name?></span>
					

					</li>
					<li class="email">
						<span class="tit">이메일</span>
						<span class="lab" style="margin-top:10px;"><?=$email[0]?>@<?=$email[1]?></span>
					</li>
					<li class="phone">
						<span class="tit">연락처</span>
						
						<span class="lab" style="margin-top:10px;"><?=$phone[0]?>-<?=$phone[1]?>-<?=$phone[2]?></span>			
						
					</li>
					<li class="job">
						<span class="tit">소속</span>
						<span class="lab" style="margin-top:10px;"><?=$job?></span>
					</li>
					<li class="msg">
						<span class="tit">메세지</span>
						
						<span class="lab" style="margin-top:10px;"><?=$msg?></span>
			
					</li>
				<?}else{
					$sel1 = $db->Select();
					$row3=mysql_fetch_array($sel);
					$grName = $row3['grName'];
					?>
			
					<li class="grp_Name">
					<span class="tit" >단체명</span>
					<span style="margin-top:10px;"><?=$grName?></span>
				</li>
				<li class="num">
					<span class="tit">인원</span>
					<span class="lab" style="margin-top:10px;"><?=$cnt?></span>
					<span class="person">명</span>
				</li>
				<?
					$sel1 = $db->Select();
					while($row1=mysql_fetch_array($sel1)){
					
					$job = $row2['job'];
					$email = explode("@",$row1['email']);
					$name = $row1['name'];
					$phone = explode("-",$row1['phone']);
					$msg = $row1['msg'];
					$idx = $row1['idx'];
				?>
				
				
				<li class="name">
					<span class="tit">이름</span>
					<span class="lab" style="margin-top:10px;"><?=$name?></span>
				

				</li>
				<li class="email">
					<span class="tit">이메일</span>
					<span class="lab" style="margin-top:10px;"><?=$email[0]?>@<?=$email[1]?></span>
				</li>
				<li class="phone">
					<span class="tit">연락처</span>
					
					<span class="lab" style="margin-top:10px;"><?=$phone[0]?>-<?=$phone[1]?>-<?=$phone[2]?></span>			
					
				</li>
				<li class="job">
					<span class="tit">소속</span>
					<span class="lab" style="margin-top:10px;"><?=$job?></span>
				</li>
				<li class="msg">
					<span class="tit">메세지</span>
					
					<span class="lab" style="margin-top:10px;"><?=$msg?></span>
		
				</li>
				
				<?}
				}
			}?>
			</ul>
			
		</div>
		

</div>


<script>

</script>
<?
include $dir."/inc/footer/mainFooter.php";
?>
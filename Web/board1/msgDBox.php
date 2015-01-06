<?
$dir = $_SERVER["DOCUMENT_ROOT"];
if($_GET['idx']){
	if($_COOKIE[($_GET['type'].$_GET['idx'])]){
	}else{		
		setcookie(($_GET['type'].$_GET['idx']),"1",time()+3600,"/");
		$plusCount = 1;
	}
}
include $dir."/inc/header/mainHeader.php";
if($_GET['idx']<=0){
	MsgBox("잘못된 접근입니다.","./index.php");
	exit;
}else{
	$db = new Dbcon();
	$db->table = "board";	
	$db->field = "type,recom,title,content,name,pwd,count,mdate,cdate";
	$db->where = "idx='".$_GET['idx']."'";	
	$row = mysql_fetch_array($db->Select());
	if($plusCount>0){
		$count = $row['count'] + 1;
		$db->field = "count='".$count."'";
		$db->Update();
	}else{
		$count = $row['count'];
	}
	
	$date = divDate($row['cdate']);
	
	unset($db);
	$text = TextToHtml($row['content']);
	$imgTag = ExtTag($text,"img");
	$db = new Dbcon();
	$db->table = "comment";
	$db->field = "idx,fkidx,name,title,content,cdate";
	$db->where = "tab='board' and fkidx='".$_GET['idx']."'";
	$db->orderBy = "idx desc";
	$cnt = $db->TotalCnt();
	$select = $db->Select();
	unset($db);
}
switch($_GET['type']){
	case "freeboard":
		$tit = "자유게시판";
		break;
	case "samsunglions":
		$tit = "삼성라이온즈";
		break;
	case "daeguFC":
		$tit = "대구FC";
		break;
}
?>
	
	
	<div class="h2Board" style="border-bottom:3px solid #0091d6; padding-bottom:14px; margin-bottom:0;">
		<h2><?=$tit?></h2>
	</div>
	<div class="boardDetail">


		<? if($_SESSION['amin']=="admin"){ ?>
		<form action="./deleteProc.php" method="post">
			<input type="hidden" class="idx" name="idx" value="<?=$_GET['idx']?>"/>
			<input type="password" name="pwd" class="pwd"/>
		</form>

		<?
		}else{	
		?>
		<div class="boardHeader">
			<div class="title">
				<span class="tit">제목</span>
				<span class="con"><?=$row['title']?></span>
			</div>
			<div class="writer">
				<span class="tit">글쓴이</span>
				<span class="con"><?=$row['name']?></span>
			</div>
			<div class="count">
				<span class="tit">조회</span>
				<span class="con"><?=$count?></span>
			</div>
			<div class="comment">
				<span class="tit">댓글</span>
				<span class="con"><?=$cnt?></span>
			</div>
			<div class="recom">
				<span class="tit">추천</span>
				<span class="con"><?=$row['recom']?></span>
			</div>
			<div class="date"></div>
		</div>
		<div class="boardContainer">
			<div class="MsgContent">
				<span class="msg">글을 수정하려면 비밀번호를 입력하세요.</span>
				<div class="in">
				<form action="./write.php?idx=<?=$_GET['idx']?>&page=<?=$_GET['page']?>&type=<?=$_GET['type']?>" method="post">
					<input type="hidden" class="idx" name="idx" value="<?=$_GET['idx']?>"/>
					<input type="password" name="pwd" class="pwd"/>
					<button type="submit" class="recom">확인</button>
				</form>
				</div>
			</div>	
		</div>
		<?
		}	
		?>
	</div>
		<script>
		$("button.recom").click(function(){
			if(confirm("정말 삭제하시겠습니까?")){
				$("form").submit();
			}
		})		
		<? if($_SESSION['amin']=="admin"){ ?>
			if(confirm("정말 삭제하시겠습니까?")){
				$("form").submit();
			}else{
				history.back(-1)
			}	
		<?
		}	
		?>	
		</script>

<?
include $dir."/inc/footer/mainFooter.php";
?>

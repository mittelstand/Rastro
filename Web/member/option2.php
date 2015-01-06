<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>

<div class="adminOption contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class="group">
		<ul class="group">
			
			<?
			$db = new Dbcon();
			$db->table = "optionG";
			$db->field = "idx,title";
			$db->block = "";
			$sel = $db->Select();
			unset($db);
			while($row = mysql_fetch_array($sel)){
			?>
			<li id="group_<?=AddZero($row['idx'],3)?>">
				<span class="title"><?=$row['title']?></span>
				<ul class="OaptitudeG">
					<li class="copy">
						<div class="id"></div>
						<div class="title"></div>
					</li>
					<?
					$db = new Dbcon(); 
					$db->table = "optionP";
					$db->field = "id,grp,title,type";
					$db->where = "grp like '%".AddZero($row['idx'],3)."%'";
					$db->block = "";
					$sel2 = $db->Select();
					unset($db);
					while($row2 = mysql_fetch_array($sel2)){
					?>
					<li>
						<div class="title"><?=$row2['title']?></div>
					</li>
					<?
					}	
					?>
				</ul>			
				<input type="hidden" name="groupId" value="<?=$row['idx']?>" />
			</li>
			<?
			}
			?>
		</ul>
		<div class="input">
			<input type="text" name="title" /><button type="button" class="add">추가</button>	
		</div>
	</div>
	<div class="Oaptitud">
		<ul class="Oaptitud">
			<li class="copy">
				<div class="chk">
					<label class="chkC" for="">
						<input class="chkC" type="checkbox" id="" name="Oaptitud[]" value="<?=$row['id']?>" global="-52"/>
					</label>
				</div>
				<div class="title"></div>
			</li>
			<?
			$db = new Dbcon();
			$db->table = "optionP";
			$db->field = "id,grp,title,type";
			$db->where = "type='Oaptitud'";
			$db->block = "";
			$sel3 = $db->Select();
			unset($db);
			while($row3 = mysql_fetch_array($sel3)){
			?>
			<li>
				<div class="chk">
					<label class="chkC" for="chk_<?=$row3['id']?>">
						<input class="chkC" type="checkbox" id="chk_<?=$row3['id']?>" name="Oaptitud[]" value="<?=$row3['id']?>" global="-52"/>
					</label>
				</div>
				<div class="title"><?=$row3['title']?></div>
			</li>


			<?
			}	
			?>
		</ul>
		<div class="input">
			<div class="groupAdd">
				<span class="select selectL">
					<input type="hidden" name="groupChoice" id="groupChoice" class="value" value=""/>
					<button type="button" class="selectBtn">
						<span class="selectEmail">그룹 선택</span>
					</button>
					<ul class="selectUl1" style="display:none;">
						<?
						$db = new Dbcon();
						$db->table = "optionG";
						$db->field = "idx,title";
						$db->block = "";
						$sel = $db->Select();
						unset($db);
						while($row = mysql_fetch_array($sel)){
						?>
						<li><a href="javascript:;" global="<?=$row['idx']?>"><?=$row['title']?></a></li>
						<?
						}	
						?>
					</ul>									
				</span>
				<button type="button" class="groupChoice">그룹선택</button>
			</div>
			<input type="text" name="title" /><button type="button" class="add">추가</button>	
		</div>
	</div>	
	<div class="Ovalues">
		<ul class="Ovalues">
			<li class="copy">
				<div class="id"></div>
				<div class="title"></div>
			</li>
			<?
			$db = new Dbcon();
			$db->table = "optionP";
			$db->field = "id,grp,title,type";
			$db->where = "type='Ovalues'";
			$db->block = "";
			$sel3 = $db->Select();
			unset($db);
			while($row3 = mysql_fetch_array($sel3)){
			?>
			<li>
				<div class="title"><?=$row3['title']?></div>
			</li>


			<?
			}	
			?>
		</ul>
		<div class="input">
			<ul class="OaptitudeG">			
				<?
				$db = new Dbcon();
				$db->table = "optionP";
				$db->field = "id,grp,title,type";
				$db->where = "grp='".$row['idx']."'";
				$db->block = "";
				$sel2 = $db->Select();
				unset($db);
				while($row2 = mysql_fetch_array($sel2)){
				?>
				<li>
					<div class="title"><?=$row2['title']?></div>
				</li>
				<?
				}	
				?>
			</ul>
			<input type="text" name="title" />
			<button type="button" class="add">추가</button>	
		</div>
	</div>
</div>
<script>
	$("button.groupChoice").click(function(){
		var param=[];
		$("input[name='Oaptitud[]']:checked").each(function(i){
			param.push($(this).val());
		});
		var postData = {
			idx	: param,
			group : $("input[name='groupChoice']").val()
		};
		$.ajax({
			type: 'POST',
			url: '/member/group.ax.php',
			dataType: 'json',
			data : postData,
			success: function(result){
				for(var i = 1; i < result.value.length; i++){
					val = result.value
				}
			}
		});
	})
	function add(){
		
		var par		= $(this).parent();
		var parpar  = $(this).parent().parent();
		var ul		= par.prev();
		var ulClass = parpar.attr("class");
		var title	= par.find("input[name='title']").val();
		var copy	= ul.find("li.copy:first").clone();
		var group	= parpar.find("input[name='groupId']").val();
		var id		= par.find("input[name='id']").val();
		
		
		$.ajax({
			type: 'POST',
			url: '/member/insert.ax.php',
			dataType: 'json',
			data: {
				type : ulClass,
				id : id,
				group : group,
				title : title
			},
			success: function(result){
				if(result.msg){
					alert(result.msg);
				}else{
					var date = result.value[0];
					copy.removeClass("copy");



					switch(date.type){
						case "group":
							copy.find("span.title").text(date.title);
							copy.find("input[name='groupId']").val(date.idx);
							copy.find("button.add").click(add);
							ul.append(copy);
							break;
						case "Oaptitud":
							copy.find("div.id").text(date.id);
							copy.find("div.title").text(date.title);
							ul.append(copy);
							break;
						case "Ovalues":
							copy.find("div.id").text(date.id);
							copy.find("div.title").text(date.title);
							ul.append(copy);
							break;
					}
				}

			},
			error: function(){
			}
		});


	}
	$("button.add").click(add);







</script>


<?
include $dir."/inc/footer/mainFooter.php";
?>
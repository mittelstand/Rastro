<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/mainHeader.php";
?>
<div style="clear:both;"></div>
<div class="temporarilyDesc managerBox">
<div style="clear:both;"></div>
	<span class="tit"></span>
	<div class="btn">
		<button type="button" class=" mManager"/></button>
		<button type="button" class="job_Major"/></button>
	</div>
</div>

<div class="adminOption contentBox">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class="grouptitle">
		<span class="title"></span>
	</div>
	<ul class="group">
		<li id="" class="copy">
			<span class="folder"></span>
			<span class="title"></span>
			<button type="button" class="revise"/></button>
			<ul class="OaptitudeG">				
				<li id="">						
					<span class="title"></span>
					<button type="button" class="del"/></button>
				</li>					
			</ul>	
			<input type="hidden" name="groupId" value="111" />
		</li>
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
			<span class="folder"></span>
			<span class="title"><?=$row['title']?></span>
			<button type="button" class="revise"/></button>
			<ul class="OaptitudeG">
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
				<li id="li_<?=$row2['id']?>">						
					<span class="title"><?=$row2['title']?></span>
					<button type="button" class="del"/></button>
				</li>
				<? } ?>						
			</ul>	
			<input type="hidden" name="groupId" value="111" />
		</li>
		<? } ?>
		<div class="input">
				<span class="folder"></span>
				<input type="text" name="title" value="Sports 운동관련"/><button type="button" class="add"></button>
		</div>
		<div class="input">
			<input class="intext" type="text" name="title" /><button type="button" class="add"></button>	
		</div>
	</ul>
	<!-- 그룹관리페이지-->
	
	<div class="Oaptitud">
		<div class="title"></div>
		<ul class="Oaptitud chkBox">
			<li class="copy">							
				<label class="chkC" for="">
				<input type="checkBox" id="" name="jobType[]" value="" global="-52"></label>
				<span></span>
				<button type="button" class="revise"/></button>
				<button type="button" class=" delet"/></button>									
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
				<label class="chkC" for="chk_<?=$row3['id']?>">
					<input type="checkBox" id="chk_<?=$row3['id']?>" name="jobType[]" value="<?=$row3['id']?>" global="-52">
				</label>
				<span><?=$row3['title']?></span>
				<button type="button" class="revise"/></button>
				<button type="button" class=" delet"/></button>									
			</li>
			<?
			}	
			?>
		</ul>
		<div class="input">
			<input type="text" name="title" /><button type="button" class="add"></button>	
		</div>
		<div class="selectItme">
			<span class="title"></span>
			<span class="select selectL">
				<input type="hidden" name="groupChoice" id="groupChoice" class="value" value=""/>
				<button type="button" class="selectBtn">
					<span class="selectEmail">그룹1</span>
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
			<div class="btnVowel">
				<button type="button" class="groupChoice"></button>
				<span class="heightLine"></span>
				<button type="button" class="remove"></button>
			</div>
		</div>
	</div>
	<div class="Ovalues">		
		<div class="title"></div>
		<ul class="Ovalues chkBox">
			<li>
				<label class="chkC" for="chk_1">
				<input type="checkBox" id="chk_1" name="jobType[]" value="1" global="-52"></label>
				<span>직업유형별탐색</span>
				<button type="button" class="revise"/></button>
				<button type="button" class=" delet"/></button>
			</li>			
		</ul>
		<div class="input">
			<input type="text" name="title" /><button type="button" class="add"></button>	
		</div>
		<div class="btnBottom">
			<span class="title"></span>
			<button type="button" class="remove"></button>
		</div>
		<div class="okBtn">
			<button type="button" class="ok"></button>
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
		var ulClass = ul.attr("class");
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
							var mid = "chk_" + date.id;
							copy.find("label.chkC").attr("for",mid);
							copy.find("label.chkC input").attr("id",mid);
							copy.find("label.chkC input").val(date.id);
							copy.find("span").text(date.title);
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

<?
/*
클래스 : Mittel 


 

*/
Class Mittel{
  
    
	var $opt;
	var $db;
	var $listCnt;
	var $listwhere;
	var $listwhereD;
	var $block;
	var $_GET;
	var $_POST;
    // DB 연결
    function __construct() {
    }


	function outputList(){
		if(!is_array($_GET)){
			global $_GET;
			global $_POST;
		}
		
		$db = new Dbcon();
		$db->table = $this->opt['table'];
		
		$db->block = ($this->block) ? $this->block : $this->opt['listBlock'];
		$db->page  = ($_GET['page']) ? $_GET['page'] : 1;
		//echo $this->opt['listWhere'];
		if($this->listwhereD){
			$db->where = $this->listwhereD;
		}else if($this->listwhere){
			$db->where = MkWhere($this->listwhere);
		}else if($this->opt['listWhere']){
			$db->where = MkWhere($this->opt['listWhere']);
		}
		$db->orderBy  = $this->opt['listOrder'];
		$fild   = explode(",",$this->opt['field']);
		$isList = explode(",",$this->opt['isList']);
		$type = explode(",",$this->opt['type']);
		$name = explode(",",$this->opt['name']);
		$fild2 = "";

		
		$i = 0;
		foreach($fild as $key=>$val){
			if($isList[$key]=='y'){
				$fild2.= (($fild2=="") ? "" : ",").$val;
				$type2[$i] = $type[$key];
				$name2[$i] = $name[$key];
				$i++;
			}
		}
		if($this->opt['keyfield']){
			$fild2 = $fild2.",".$this->opt['keyfield'];
		}
		$db->field = $fild2;
		
		$fild2 = explode(",",$fild2);
		
		$sel = $db->Select();
		
		$value = "";
		$i = $db->TotalCnt();
		$this->listCnt = $i;
		while($row = mysql_fetch_row($sel)){
			foreach($row as $key=>$val){
				switch($type2[$key]){
					case "enum":
						$enum = explode("&",$name2[$key]);
						for($j=1; $j<sizeof($enum); $j++){
							$enumVal = explode(":",$enum[$j]);
							if($enumVal[1] == $val){
								$v = $enumVal[0];
								break;
							}
							unset($enumVal);
						}
						$col[$fild2[$key]] = $v; 
						
						unset($enum);
						break;
					case "none":
						$col[$fild2[$key]] = $val;
						break;
					case "char":
						$col[$fild2[$key]] = TextToHtml($val);
						break;
					case "file":
						$col[$fild2[$key]] = str_replace('/HCK/messagebox.co.kr/public_html','',$val);
						break;
					case "date":
						$div = explode(" ",$val);
						$date = explode("-",$div[0]);
						$time = explode(":",$div[1]);
						$col[$fild2[$key]]['y'] = $date[0];
						$col[$fild2[$key]]['m'] = $date[1];
						$col[$fild2[$key]]['d'] = $date[2];
						$col[$fild2[$key]]['h'] = $time[0];
						$col[$fild2[$key]]['i'] = $time[1];
						$col[$fild2[$key]]['s'] = $time[2];
						break;
					case "text":
						$col[$fild2[$key]] = TextToHtml($val);
						break;
					case "setext":
						$col[$fild2[$key]] = TextToHtml($val);
						break;
					case "now":
						$div = explode(" ",$val);
						$date = explode("-",$div[0]);
						$time = explode(":",$div[1]);
						$col[$fild2[$key]]['all'] = $div[0];
						$col[$fild2[$key]]['y'] = $date[0];
						$col[$fild2[$key]]['m'] = $date[1];
						$col[$fild2[$key]]['d'] = $date[2];
						$col[$fild2[$key]]['h'] = $time[0];
						$col[$fild2[$key]]['i'] = $time[1];
						$col[$fild2[$key]]['s'] = $time[2];
						break;
					case "phone":
						$phon = "";
						$phon = explode("-",$val);
						$col[$fild2[$key]][0] = $phon[0];
						$col[$fild2[$key]][1] = $phon[1];
						$col[$fild2[$key]][2] = $phon[2];
						break;
					case "email":
						$mail = explode("@",$val);
						$col[$fild2[$key]][0] = $val;
						$col[$fild2[$key]][1] = $mail[0];
						$col[$fild2[$key]][2] = $mail[1];
						break;
					case "pwd":
						break;
					case "member":
						$col[$fild2[$key]]['id'] = $val;
						$db->table = "member";
						$db->field = "id,name,email,pwd,phone,job,mdate,cdate";
						$db->where = "id = '".$val."'";
						$db->orderBy = "";
						$mSel = $db->Select();
						$mRow = mysql_fetch_array($mSel);

						$col[$fild2[$key]]['name'] = $mRow['name'];
						$col[$fild2[$key]]['email'] = $mRow['email'];
						break;
					case "chcked":



						break;
					default : 
						$col[$fild2[$key]] = $val;
				
				}
				
			}
			$i--;
			$row2[$i] = $col;
			unset($col);
			
		}
		
		unset($db); 
		return $row2;


		//$type = $this->opt['type'];



	}
	function outputDetail(){
		global $_GET;
		global $_POST;
		
		$db = new Dbcon();
		$db->table = $this->opt['table'];
		$db->block = $this->opt['listBlock'];
		$db->page  = $this->_GET['page'];
		//echo $this->opt['listWhere'];
		$db->where = MkWhere($this->opt['detailWhere']);
		$fild   = explode(",",$this->opt['field']);
		$isList = explode(",",$this->opt['isDetail']);
		$type = explode(",",$this->opt['type']);
		$name = explode(",",$this->opt['name']);
		$fild2 = "";

		
		$i = 0;
		foreach($fild as $key=>$val){
			if($isList[$key]=='y'){
				$fild2.= (($fild2=="") ? "" : ",").$val;
				$type2[$i] = $type[$key];
				$name2[$i] = $name[$key];
				$i++;
			}
		}
		$fild2 = $fild2.",".$this->opt['keyfield'];
		$db->field = $fild2;
		
		$fild2 = explode(",",$fild2);
		
		$sel = $db->Select();
		
		$value = "";
		$i = $db->TotalCnt();
		$this->listCnt = $i;
		while($row = mysql_fetch_row($sel)){
			foreach($row as $key=>$val){
				switch($type2[$key]){
					case "enum":
						$enum = explode("&",$name2[$key]);
						for($j=1; $j<sizeof($enum); $j++){
							$enumVal = explode(":",$enum[$j]);
							if($enumVal[1] == $val){
								$v = $enumVal[0];
								break;
							}
							unset($enumVal);
						}
						$col[$fild2[$key]] = $v; 
						
						unset($enum);
						break;
					case "none":
						$col[$fild2[$key]] = $val;
						break;
					case "char":
						$col[$fild2[$key]] = TextToHtml($val);
						break;
					case "file":
						$col[$fild2[$key]] = str_replace('/HCK/messagebox.co.kr/public_html','',$val);
						break;
					case "date":
						$div = explode(" ",$val);
						$date = explode("-",$div[0]);
						$time = explode(":",$div[1]);
						$col[$fild2[$key]]['y'] = $date[0];
						$col[$fild2[$key]]['m'] = $date[1];
						$col[$fild2[$key]]['d'] = $date[2];
						$col[$fild2[$key]]['h'] = $time[0];
						$col[$fild2[$key]]['i'] = $time[1];
						$col[$fild2[$key]]['s'] = $time[2];
						break;
					case "text":
						$col[$fild2[$key]] = TextToHtml($val);
						break;
					case "setext":
						$col[$fild2[$key]] = TextToHtml($val);
						break;
					case "now":
						$div = explode(" ",$val);
						$date = explode("-",$div[0]);
						$time = explode(":",$div[1]);
						$col[$fild2[$key]]['y'] = $date[0];
						$col[$fild2[$key]]['m'] = $date[1];
						$col[$fild2[$key]]['d'] = $date[2];
						$col[$fild2[$key]]['h'] = $time[0];
						$col[$fild2[$key]]['i'] = $time[1];
						$col[$fild2[$key]]['s'] = $time[2];
						break;
					case "phone":
						$phon = "";
						$phon = explode("-",$val);
						$col[$fild2[$key]][0] = $phon[0];
						$col[$fild2[$key]][1] = $phon[1];
						$col[$fild2[$key]][2] = $phon[2];
						break;
					case "email":
						$mail = explode("@",$val);
						$col[$fild2[$key]][0] = $val;
						$col[$fild2[$key]][1] = $mail[0];
						$col[$fild2[$key]][2] = $mail[1];
						break;
					case "pwd":
						break;
					case "member":
						$col[$fild2[$key]]['id'] = $val;
						$db->table = "member";
						$db->field = "id,name,email,pwd,phone,job,mdate,cdate";
						$db->where = "id = '".$val."'";
						$db->orderBy = "";
						$mSel = $db->Select();
						$mRow = mysql_fetch_array($mSel);

						$col[$fild2[$key]]['name'] = $mRow['name'];
						$col[$fild2[$key]]['email'] = $mRow['email'];
						break;
					
					default : 
						$col[$fild2[$key]] = $val;
				}
			}
			$row2 = $col;
			unset($col);
			
		}
		
		unset($db); 
		return $row2;

	}




    // DB 연결 종료
    function __destruct(){    
    }

    

}
?>

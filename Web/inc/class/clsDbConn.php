
<?
/*
클래스 : clsDbConn
작성일 : 2013.08.07
설명   : db를 연결하는 클레스

 

*/
Class Dbcon {
    private $_dbHost = "localhost";
    private $_dbName = "webiblos";
    private $_dbUser = "webiblos";
    private $_dbPass = "Together1!";
    private $_dbConn = null;
    
    // DB 연결
    function __construct() {
        $this->_dbConn = @mysql_connect($this->_dbHost, $this->_dbUser, $this->_dbPass) or die("서버 연결에 실패 하였습니다. 계정 또는 패스워드를 확인하세요!!");
        @mysql_select_db($this->_dbName, $this->_dbConn) or die("데이터베이스(DB) 연결에 실패 하였습니다. 데이터베이스(DB)명을 확인하세요!!");
        mysql_query("SET NAMES UTF8");
    }

    // DB 연결 종료
    function __destruct() {
        @mysql_close($this->_dbConn);
        unset($this->_dbConn);
    }
    var $table      = "";  //테이블명              string
    var $field      = "";  //필드                  string
    var $value      = "";  //필드에 대칭되는 값    string
    var $where      = "";  //where 절              string
    var $page       = 1;   //현재페이지            integer
    var $block      = 8;  //최대페이지수          integer
    var $totalCount = 0;   //레코드 갯수           integer
    var $orderBy    = "";  //orderBy 절            string
    var $query      = "";  //쿼리문                string
    var $keyfield   = "";  //고유키 필드           string
    
    function Err() { 
        $msg = "Error Message : ".mysql_errno()." : ".mysql_error();
        echo $msg;
        exit(); 
    }
    /*
    함수명     : TotalCnt
    최종수정일 : 2013.08.07
    사용 속성  : keyfield, table, where
    필수 속성  : table
    설명       : 레코드 전체의 갯수를 카운트한다.
    */
    function TotalCnt() {
        if ($this->table == "") die("Select에 필요한 항목이 누락되었습니다");
        else{ 
            $result = mysql_query("select count(".((strlen($this->keyfield) > 0) ? $this->keyfield : "*" ).") cnt from ".$this->table.((strlen($this->where) > 0) ? " where ".$this->where : ""));
            $row = mysql_fetch_row($result); 
            $this->totalCount = $row[0]; 
            return $row[0];
        };
    }
   
    /*
    함수명     : Select
    최종수정일 : 2013.08.07
    사용 속성  : table,query,field,where,orderBy,block,page
    필수 속성  : table
    설명       : Select 문을 출력하기위한 메서드(결과값은 mysql_fetch_array,mysql_fetch_assoc,mysql_fetch_row 등의 함수에 사용된다.  ).     
    */
    function Select() {
        if (strlen($this->query) <= 0) {
            if ($this->table == "") die("Select에 필요한 항목이 누락되었습니다");
            else {
                $this->query = " select ".
                                ((strlen($this->field) > 0) ? $this->field : "*")." from ". $this->table.
                                ((strlen($this->where) > 0) ? " where ".$this->where : "").
                                ((strlen($this->orderBy) > 0) ? " order by ".$this->orderBy : "").
                                (($this->page > 0 and $this->block) > 0 ? (" limit ".(($this->page - 1) * $this->block).", ".$this->block." ") : "");
            };
        };
		//echo  $this->query;
        $result = mysql_query($this->query);
        if($result) $this->query = ""; else $this->Err();        
        return $result;
    }
    function Output(){
        
        $this->query = $this->query.
                    ((strlen($this->orderBy) > 0) ? " order by ".$this->orderBy : "").
                    (($this->page > 0 and $this->block) > 0 ? (" limit ".(($this->page - 1) * $this->block).", ".$this->block." ") : "");
        $result = mysql_query($this->query);
        if($result) $this->query = ""; else $this->Err(); 
        return $result;
    }
    /*
    함수명     : ResultOption
    최종수정일 : 2013.08.19
    변수 설명  :  
    --$valueColumn  (string)    값에 해당하는컬럼
    --$nameColumn   (string)    실제로 보여지는 이름에 해당하는 컬럼
    --$selector     (string)    선택된값
    --$addOption    (string)    추가적인 옵션
    설명       : Select 문을 select태그의 옵션형태로 출력하기위한 옵션형태로 출력
    */
    function ResultOption($valueColumn,$nameColumn,$selector="",$addOption=""){
        $query = $this->Select();
        while($option = mysql_fetch_array($query)){
            if($option[$valueColumn]==$selector){
                echo "<option value=\"".$option[$valueColumn]."\" selected ".$addOption.">".$option[$nameColumn]."</option>";
            }else{
                echo "<option value=\"".$option[$valueColumn]."\" ".$addOption.">".$option[$nameColumn]."</option>";
            }
        }
    }
    /*
    함수명     : ExportXml
    최종수정일 : 2013.08.19
    설명       : Select 문을 xml형태로 출력(<필드명>내용</필드명>)
    */

    function ExportXml(){
        $query = $this->Select();
        
        while($tagname = mysql_fetch_assoc($query)){
            $key = array_keys($tagname);
            echo "<item>";
            for($i=0 ; $i < sizeof($key) ; $i++){
                echo "<".$key[$i].">".$tagname[$key[$i]]."</".$key[$i].">";
            }
            echo "</item>";
        }
        
    }
    /*
    함수명     : Delete
    최종수정일 : 2013.08.14
    사용 속성  : table,query,where,table
    필수 속성  : table
    설명       : 레코드 삭제를 위한 메서드 .     
    */
    function Delete() {
        if (strlen($this->query) <= 0) {
            if ($this->table == "") die("Delete에 필요한 항목이 누락되었습니다");
            else {
                $this->query = "delete from ". $this->table.
                                ((strlen($this->where) > 0) ? " where ".$this->where : "");
            };
        };

         $result = mysql_query($this->query);
         if($result) $this->query = ""; else $this->Err();
    }
    function Update() {
        if (strlen($this->query) <= 0) {
            if ($this->table == "" or $this->field == "") die("Update에 필요한 항목이 누락되었습니다");
            else {
                $this->query = "update ". $this->table ." set ".
                                    $this->field.
                                ((strlen($this->where) > 0) ? " where ".$this->where : "");
            };
        };
		//	echo $this->query;
         $result = mysql_query($this->query);
         if($result) $this->query = ""; else $this->Err();
    }
    /*
    함수명     : Insert
    최종수정일 : 2013.08.07
    사용 속성  : table,query,field,value
    필수 속성  : table,field,value
    설명       : 레코드 입력을 위한 메서트 
    */
    function Insert() {
        if (strlen($this->query) <= 0) {
			//echo $this->table."-".$this->field."-".$this->value;
            if ($this->table == "" or $this->field == "" or $this->value == "") die($this->table.",".$this->field.",".$this->value);
            else {
                $this->query = "insert into ". $this->table ." (".
                                    $this->field.
                                ") values (".
                                    $this->value.
                                ")";
            };
        };
		//echo $this->query;
        $result = mysql_query($this->query);
        if($result) $this->query = ""; else $this->Err();

        return mysql_insert_id();
    }
    /*
    함수명     : GetArray
    최종수정일 : 2013.09.09
    설명       : db값을 배열로반환한다. 
    */
    function GetArray(){
        $query = $this->Select();
        $j = 0;
        while($array = mysql_fetch_assoc($query)){
            $key = array_keys($array);
            
            for($i=0 ; $i < sizeof($key) ; $i++){
               $returnArray[$j][$key[$i]] = $array[$key[$i]];
            }
            $j++;
            
        }
        return $returnArray;
    }
    

}
?>

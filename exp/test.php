<?php
$dir = $_SERVER["DOCUMENT_ROOT"];

/* INIsecurepaystart.php
 *
 * 이니페이 웹페이지 위변조 방지기능이 탑재된 결제요청페이지.
 * 코드에 대한 자세한 설명은 매뉴얼을 참조하십시오.
 * <주의> 구매자의 세션을 반드시 체크하도록하여 부정거래를 방지하여 주십시요.
 *
 * http://www.inicis.com
 * Copyright (C) 2006 Inicis Co., Ltd. All rights reserved.
 */

    /****************************
     * 0. 세션 시작				*
    ****************************/
		session_start(); 					//주의:파일 최상단에 위치시켜주세요!!

    /**************************
     * 1. 라이브러리 인클루드 *
     **************************/
    include $dir."/INIPAY/libs/INILib.php";

    /***************************************
     * 2. INIpay50 클래스의 인스턴스 생성  *
     ***************************************/
    $inipay = new INIpay50;

    /**************************
     * 3. 암호화 대상/값 설정 *
     **************************/
    $inipay->SetField("inipayhome", $_SERVER["DOCUMENT_ROOT"]."/INIPAY");       // 이니페이 홈디렉터리(상점수정 필요)
    $inipay->SetField("type", "chkfake");      // 고정 (절대 수정 불가)
    $inipay->SetField("debug", "true");        // 로그모드("true"로 설정하면 상세로그가 생성됨.)
    $inipay->SetField("enctype","asym"); 			//asym:비대칭, symm:대칭(현재 asym으로 고정)
    /**************************************************************************************************
     * admin 은 키패스워드 변수명입니다. 수정하시면 안됩니다. 1111의 부분만 수정해서 사용하시기 바랍니다.
     * 키패스워드는 상점관리자 페이지(https://iniweb.inicis.com)의 비밀번호가 아닙니다. 주의해 주시기 바랍니다.
     * 키패스워드는 숫자 4자리로만 구성됩니다. 이 값은 키파일 발급시 결정됩니다.
     * 키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오.
     **************************************************************************************************/

	$inipay->SetField("admin", "1111"); 				// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
    $inipay->SetField("checkopt", "false"); 		//base64함:false, base64안함:true(현재 false로 고정)

		//필수항목 : mid, price, nointerest, quotabase
		//추가가능 : INIregno, oid
		//*주의* : 	추가가능한 항목중 암호화 대상항목에 추가한 필드는 반드시 hidden 필드에선 제거하고 
		//          SESSION이나 DB를 이용해 다음페이지(INIsecureresult.php)로 전달/셋팅되어야 합니다.
	$cost = ($_POST['appType']=="단체")?$_POST['cost']*$_POST['people_Num']:$_POST['cost'];
    $inipay->SetField("mid", "messagebox");            // 상점아이디
    $inipay->SetField("price",$cost);                // 가격
    $inipay->SetField("nointerest", "no");             //무이자여부(no:일반, yes:무이자)
    $inipay->SetField("quotabase", "lumpsum:00:02:03:04:05:06:07:08:09:10:11:12");//할부기간

    /********************************
     * 4. 암호화 대상/값을 암호화함 *
     ********************************/
    $inipay->startAction();

    /*********************
     * 5. 암호화 결과  *
     *********************/
 		if( $inipay->GetResult("ResultCode") != "00" ) 
		{
			echo $inipay->GetResult("ResultMsg");
			exit(0);
		}

    /*********************
     * 6. 세션정보 저장  *
     *********************/
		$_SESSION['INI_MID'] = "messagebox";	//상점ID
		$_SESSION['INI_ADMIN'] = "1111";			// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
		$_SESSION['INI_PRICE'] = $cost;     //가격 
		$_SESSION['INI_RN'] = $inipay->GetResult("rn"); //고정 (절대 수정 불가)
		$_SESSION['INI_ENCTYPE'] = $inipay->GetResult("enctype"); //고정 (절대 수정 불가)
	

include $dir."/inc/header/payHeader.php";
?>
<div class="mentDesc descBox">
	<span class="tit"></span>
	<span class="desc"></span>	
</div>
<div class="contentBox mentDetail">
	<div class="sdL"></div>
	<div class="sdR"></div>
	<div class="sdT"></div>
	<div class="sdB"></div>
	<div class="detailTit" ><?=$row['title']?></div>	
	<div class="detailCont">
		<span class="applyTit" style="width:291px; height:16px;background: url('/img/text.png') no-repeat; background-position:0 -2157px">참여신청</span>
		<ul class="apply">
			<li class="pay">
				<span class="tit" style="width:50px;height:16px; margin-top:10px;"></span>
				<span class="select selectL">
					<input type="hidden" name="gopaymethod" class="value" id="paymethod" value=''/>
					<button type="button" class="selectBtn" id="selectBtn">
						<span class="selectText purple phone" style="width:150px; text-align:center;">결 제 방 법</span>											
					</button>
					<ul class="selectUl2" style="display:none;">
					
						<li><a href="javascript:;">신용카드 결제</a></li>
						<li><a href="javascript:;">신용카드 ISP결제</a></li>
						<li><a href="javascript:;">실시</a></li>
						<li><a href="javascript:;">무통장 입금(가상 계좌)</a></li>
						
					</ul>
				</span>	
			</li>
			<li class="pName" >
				<span class="tit"style="width:60px;height:16px;">상 품 명</span>
				<span style="margin-bottom:2px;"><input type="hidden" name=goodname size=20 value="<?=$_POST['title']?>"><?=$_POST['title']?></span>
			</li>

			<li class="cost">
				<span class="tit" style="width:60px;height:16px;">비 용</span>
				<span style="margin-bottom:2px;"><?=$cost?></span>
			</li>
			
			<li class="name1">
				<span class="tit" style="width:60px;height:16px;">성 명</span>
				<span style="margin-bottom:2px;"><input type="hidden" name=buyername size=20 value="<?=($_POST['appType']=="단체")?$_POST['grp_Name']:$_POST['name']?>"><?=($_POST['appType']=="단체")?$_POST['grp_Name']."(".$_POST['people_Num']."명)":$_POST['name']?></span>
			</li>
			<li class="email1">
				<span class="tit" style="width:60px;height:16px;">전자우편</span>
				<span style="margin-bottom:2px;"><input type="hidden" name=buyeremail size=20 value="<?=($_POST['email'])."@".(($_POST['emailFooter']) ? $_POST['emailFooter'] : $_POST['emailFooter2'])?>"><?=($_POST['email'])."@".(($_POST['emailFooter']) ? $_POST['emailFooter'] : $_POST['emailFooter2'])?></span>
			</li>
			<li class="phone1">
				<span class="tit" style="width:60px;height:16px;">이동 전화</span>
				<span style="margin-bottom:2px;"><input type="hidden" name=buyertel size=20 value="<?=($_POST['appType']=="단체")?$_POST['phone1'][0]."-".$_POST['phone2'][0]."-".$_POST['phone3'][0]:$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']?>">
				<?=($_POST['appType']=="단체")?$_POST['phone1'][0]."-".$_POST['phone2'][0]."-".$_POST['phone3'][0]:$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']?></span>
			</li>
		
		</ul>
		<button type="button" class="back" style="float:left; width:90px; 30px;">뒤로 </button>
		<input style="float:right; width:90px; height:30px;"type=image src="/img/pay.png">
			
				<input type="hidden" name="fidx" value="<?=$_POST['fidx']?>">
				<input type="hidden" name="name" value="<?=$_POST['name']?>">
				<input type="hidden" name="email" value="<?=$_POST['email']?>">
				<input type="hidden" name="emailFooter" value="<?=$_POST['emailFooter']?>">
				<input type="hidden" name="emailFooter2" value="<?=$_POST['emailFooter2']?>">
				<input type="hidden" name="phone1" value="<?=$_POST['phone1']?>">
				<input type="hidden" name="phone2" value="<?=$_POST['phone2']?>">
				<input type="hidden" name="phone3" value="<?=$_POST['phone3']?>">
				<input type="hidden" name="job" value="<?=$_POST['job']?>">
				<input type="hidden" name="msg" value="<?=$_POST['msg']?>">
				<input type="hidden" name="tab" value="<?=$_POST['tab']?>">
				<input type="hidden" name="appType" value="<?=$_POST['appType']?>">
				<input type="hidden" name="grp_Name" value="<?=$_POST['grp_Name']?>">
				<input type="hidden" name="people_Num" value="<?=$_POST['people_Num']?>">
				<input type="hidden" name="id" value="<?=$_POST['id']?>">	
		
	</div>
</div>
	<?
					$email=$_POST['email']."@".(($_POST['emailFooter'])?$_POST['emailFooter']:$_POST['emailFooter2']);
					
					$appType=$_POST['appType'];
					$grpName=$_POST['grp_Name'];
					$poepleNum =$_POST['people_Num'];
					$id=$_POST['id'];
					$db = new Dbcon();
					$db ->table="apply";
					$db->field="tab,fidx,writer,name,grName,email,phone,job,msg,mdate,cdate,cs";
					if($appType=="단체"){
						if($_POST['idx']){
							if(is_array($_POST['idx'])){
								foreach($_POST['idx'] as $key=>$val){
									$in .= $val.",";
								}
								$db->where = "writer = '".$id."' and fidx='".$_POST['fidx']."' and tab='".$_POST['tab']."'";
								$in = TrimStr($in,",");
								$db->where = $db->where." and (idx not in (".$in."))";
								$db->Delete();
								foreach($_POST['name'] as $key=>$val){
									$phone=$_POST['phone1'][$key]."-".$_POST['phone2'][$key]."-".$_POST['phone3'][$key];
									$job = HtmlToText($_POST['job'][$key]);
									$name = $val;	
								
										echo $val;
										
										$db->field="tab,fidx,writer,name,grName,email,phone,job,msg,mdate,cdate,cs";
										
										$db->value="'".$_POST['tab']."','".$_POST['fidx']."','".$id."','".$name."','".$grp_Name."','".$email."','".$phone."','".$job."','".$msg."',now(),now(),'n'";
										
										if($name=="" || $job==""){	
										}else{
											$a = $db->Insert();
										}
									}
								
							

							}else{

							}
						}else{
							if(is_array($_POST['name'])){
								foreach($_POST['name'] as $key=>$val){
									echo($val);
									$phone=$_POST['phone1'][$key]."-".$_POST['phone2'][$key]."-".$_POST['phone3'][$key];
									$job= HtmlToText($_POST['job'][$key]);
									$name = HtmlToText($val[$key]);
								
									if($name=="" || $job==""){	
									}else{
										$db->value="'".$_POST['tab']."','".$_POST['fidx']."','".$id."','".$name."','".$grp_Name."','".$email."','".$phone."','".$job."','".$msg."',now(),now(),'n'";			
										$a = $db->Insert();	
									}
								}
							}else{
								$phone=$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3'];
								$job= HtmlToText($_POST['job']);
								$name = HtmlToText($_POST['name']);
								$db->value="'".$_POST['tab']."','".$_POST['fidx']."','".$id."','".$name."','".$grp_Name."','".$email."','".$phone."','".$job."','".$msg."',now(),now(),'n'";
								$a = $db->Insert();	
							}
						}
					
					}else{
						$name = $_POST['name'];
						$phone = $_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3'];
						$job=$_POST['job'];
						$msg = nl2br($_POST['msg']);
						$msg = HtmlToText($msg);
						$db->field = "tab,fidx,name,email,phone,job,msg,writer,mdate,cdate,cs";
						$db->value="'".$_POST['tab']."','".$_POST['fidx']."','".$name."','".$email."','".$phone."','".$job."','".$msg."','".$id."',now(),now(),'n'";
						$row = $db->Insert();
					unset($db);
					}					
					?>
<!-- 기타설정 -->
<input type=hidden name=currency size=20 value="WON">

<!--
SKIN : 플러그인 스킨 칼라 변경 기능 - 5가지 칼라(ORIGINAL/BLUE중 택1, GREEN, YELLOW, RED, PURPLE )  기본/파랑, 녹색, 노랑, 빨강, 보라색
HPP : 컨텐츠 또는 실물 결제 여부에 따라 HPP(1)과 HPP(2)중 선택 적용(HPP(1):컨텐츠, HPP(2):실물).
Card(0): 신용카드 지불시에 이니시스 대표 가맹점인 경우에 필수적으로 세팅 필요 ( 자체 가맹점인 경우에는 카드사의 계약에 따라 설정) - 자세한 내용은 메뉴얼  참조.
OCB : OK CASH BAG 가맹점으로 신용카드 결제시에 OK CASH BAG 적립을 적용하시기 원하시면 "OCB" 세팅 필요 그 외에 경우에는 삭제해야 정상적인 결제 이루어짐.
no_receipt : 은행계좌이체시 현금영수증 발행여부 체크박스 비활성화 (현금영수증 발급 계약이 되어 있어야 사용가능)
-->
<input type=hidden name=acceptmethod size=20 value="HPP(1):Card(0):OCB:receipt:cardpoint">


<!--
상점 주문번호 : 무통장입금 예약(가상계좌 이체),전화결재 관련 필수필드로 반드시 상점의 주문번호를 페이지에 추가해야 합니다.
결제수단 중에 은행 계좌이체 이용 시에는 주문 번호가 결제결과를 조회하는 기준 필드가 됩니다.
상점 주문번호는 최대 40 BYTE 길이입니다.
주의:절대 한글값을 입력하시면 안됩니다.
-->
<input type=hidden name=oid size=40 value="oid_1234567890">


<!--
플러그인 좌측 상단 상점 로고 이미지 사용
이미지의 크기 : 90 X 34 pixels
플러그인 좌측 상단에 상점 로고 이미지를 사용하실 수 있으며,
주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 상단 부분에 상점 이미지를 삽입할수 있습니다.
-->
<!--input type=hidden name=ini_logoimage_url  value="http://[사용할 이미지주소]"-->

<!--
좌측 결제메뉴 위치에 이미지 추가
이미지의 크기 : 단일 결제 수단 - 91 X 148 pixels, 신용카드/ISP/계좌이체/가상계좌 - 91 X 96 pixels
좌측 결제메뉴 위치에 미미지를 추가하시 위해서는 담당 영업대표에게 사용여부 계약을 하신 후
주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 좌측 결제메뉴 부분에 이미지를 삽입할수 있습니다.
-->
<!--input type=hidden name=ini_menuarea_url value="http://[사용할 이미지주소]"-->

<!--
플러그인에 의해서 값이 채워지거나, 플러그인이 참조하는 필드들
삭제/수정 불가
uid 필드에 절대로 임의의 값을 넣지 않도록 하시기 바랍니다.
-->
<input type=hidden name=ini_encfield value="<?php echo($inipay->GetResult("encfield")); ?>">
<input type=hidden name=ini_certid value="<?php echo($inipay->GetResult("certid")); ?>">
<input type=hidden name=quotainterest value="">
<input type=hidden name=paymethod value="">
<input type=hidden name=cardcode value="">
<input type=hidden name=cardquota value="">
<input type=hidden name=rbankcode value="">
<input type=hidden name=reqsign value="DONE">
<input type=hidden name=encrypted value="">
<input type=hidden name=sessionkey value="">
<input type=hidden name=uid value=""> 
<input type=hidden name=sid value="">
<input type=hidden name=version value=4000>
<input type=hidden name=clickcontrol value="">
<?
include $dir."/inc/footer/payFooter.php";
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              

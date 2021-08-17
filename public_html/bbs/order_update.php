<?php
	include_once('./_common.php');

	
	$mb_id = isset($member['mb_id']) ? trim($member['mb_id']) : "";
	$type = isset($_POST['type']) ? trim($_POST['type']) : "";

	if($mb_id == ""){ echo "로그인 후 이용 가능합니다."; exit(); }
	if($type == ""){ echo "주문정보가 없습니다."; exit(); }
	
	$admin_p = "01058311333";
	$admin_p2 = "01058311333";
	//$mb_phone = "01066714320";
	$mb_phone = str_replace("-","",$member['mb_hp']);

	$BANK_NUM = "301-0206-5475-11";
	$BANK_NAME = "농협";
	$BANK_ME = "뉴비코 주식회사";

	if($type == "1" || $type == "2" || $type == "3" || $type == "4")
	{	
		
			
		$sql = "insert into g5_order set mb_id = '{$mb_id}' , ls_type = '{$type}' ";

		if($type == "1"){
			
			$msg_str = "PC";
			$msg_price = "3,000,000";
			$sql = $sql.", ls_price = '3000000' ";
		}
		
		if($type == "2"){
			$msg_str = "Mobile";
			$msg_price = "3,000,000";
			$sql = $sql.", ls_price = '3000000' ";
		}
		
		if($type == "3"){
			$msg_str = "PC + Mobile";
			$msg_price = "4,500,000";
			$sql = $sql.", ls_price = '4500000' ";
		}
		
		if($type == "4"){
			//테스트 한달
			$sql = "";

			$timestamp = strtotime("+1 months");
			$test_dttm = date("Y-m-d H:i:s",$timestamp);
			
			$sql = "insert into g5_order set mb_id = '{$mb_id}' , ls_type = '4' , ls_use = 'Y' , ls_dttm = '{$test_dttm}'";
			$rtn = sql_query($sql);

			$rtn = miriMms("[에이아이시그널] \n 테스트 라이센스신청 완료\n".substr($test_dttm,0,10)."까지 이용가능" , $mb_phone);
			$rtn = mirisms("회원 : ".$mb_id."\n 테스트 라이센스신청 완료\n".substr($test_dttm,0,10)."까지 이용가능" , $admin_p);
			
			goto_url("http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/content.php?co_id=product");
		}


		$rtn = sql_query($sql);
		$rtn = miriMms("[에이아이시그널]".$msg_str." 라이센스 신청완료\n라이센스비:".$msg_price."원\n은행 : ".$BANK_NAME."\n계좌번호 : ".$BANK_NUM."\n예금주 명 : ".$BANK_ME , $mb_phone);
		$rtn = mirisms("회원 : ".$mb_id."\n 라이센스신청" , $admin_p);
		//$rtn = mirisms("회원 : ".$mb_id."\n 라이센스신청" , $admin_p2);

		alert_url("입금정보가 본인 휴대전화로 발송되었습니다.","http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/content.php?co_id=product");
	}

	


?>
<?php
	include_once('./_common.php');

	$mb_id = isset($member['mb_id']) ? trim($member['mb_id']) : "";
	$month = isset($_REQUEST['month']) ? trim($_REQUEST['month']) : "";
	
	$admin_p = "01058311333";
	$admin_p2 = "01058311333";
	//$mb_phone = "01066714320";
	$mb_phone = str_replace("-","",$member['mb_hp']);

	$BANK_NUM = "301-0206-5475-11";
	$BANK_NAME = "농협";
	$BANK_ME = "뉴비코 주식회사";

	if($mb_id == ""){ 
		echo json_encode(array( "result" => "404" , "msg" => $mb_id));
	}

	if($month == ""){ 
		echo json_encode(array( "result" => "404" , "msg" => $month));
	}
	
	//월결제 건수는 한건만
	$sql = "select * from g5_payment where mb_id = '{$mb_id}' and pm_del_yn = 'N' and pm_use_yn = 'N'";
	$rtn = sql_query($sql);
	if($rtn->num_rows > 0){
		echo json_encode(array( "result" => "405" , "msg" => $month));
		exit();
	}

	//라이센스가 있어야 월회비 결제가능
	$sql = "select * from g5_order where mb_id = '{$mb_id}' and ls_use = 'Y' and ls_type != '4'";
	$rtn = sql_query($sql);
	if($rtn->num_rows <= 0){
		echo json_encode(array( "result" => "406" , "msg" => $month));
		exit();
	}


	$msg_price = $month * 100000;

	$rtn = miriMms("[에이아이시그널]".$msg_str." 월회비 신청완료\n".$month."개월권 회비:".number_format($msg_price)."원\n은행 : ".$BANK_NAME."\n계좌번호 : ".$BANK_NUM."\n예금주 명 : ".$BANK_ME , $mb_phone);
	$rtn = mirisms("회원 : ".$mb_id."\n ".$month."개월권 회비 신청 (계좌이체)" , $admin_p);
	
	
	$sql = "insert into g5_payment set mb_id = '{$mb_id}', pm_payment = 'iche' , pm_iche_month = '{$month}', pm_price = '{$msg_price}'";
	$rtn = sql_query($sql);

	echo json_encode(
					array("result" => "00" , 
							"msg" => "success"));

?>
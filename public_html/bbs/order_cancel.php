<?php
	include_once('./_common.php');

	
	$mb_id = isset($member['mb_id']) ? trim($member['mb_id']) : "";
	$type = isset($_POST['type']) ? trim($_POST['type']) : "";

	if($mb_id == ""){ echo "로그인 후 이용 가능합니다."; exit(); }
	if($type == ""){ echo "주문정보가 없습니다."; exit(); }
	
	$sql = "select * from g5_order where mb_id = '{$mb_id}' and ls_type = '{$type}'";
	$rtn = sql_query($sql);
	
	if($rtn->num_rows > 0){
		$sql = "delete from g5_order where mb_id = '{$mb_id}' and ls_type = '{$type}'";
		$rtn = sql_query($sql);

		alert_url("정상적으로 취소 되었습니다.","http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/content.php?co_id=product");
	}else {
		alert_url("주문데이터가 존재하지 않습니다.","http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/content.php?co_id=product");
	}

	

?>
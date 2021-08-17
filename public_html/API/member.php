<?php

	include_once('./_common.php');
	
	$mb_id = isset($_REQUEST['mb_id']) ? $_REQUEST['mb_id'] : "";

	if($mb_id == ""){
		echo json_encode(array(
			"code" => "404",
			"msg" => "ID는 필수 항목 입니다.",
		));
	}

	$sql = "select mb_id , mb_hp , mb_email , mb_2 , mb_3 from g5_member where mb_id = '{$mb_id}'";
	$list = sql_fetch($sql);
	
	$sql = "select ls_type, ls_price, ls_use, ls_dttm from g5_order where mb_id = '{$mb_id}'";
	$ord_rtn = sql_query($sql);
	
	$ord_list = array();
	while($ord_row = sql_fetch_array($ord_rtn)){
		$ord_list[] = $ord_row;
	}

	$sql = "select pm_payment, pm_iche_month, pm_start_dttm, pm_next_dttm , pm_use_yn , pm_price from g5_payment where mb_id = '{$mb_id}' and pm_del_yn = 'N'";
	$pay_rtn = sql_query($sql);
	
	$pay_list = array();
	while($pay_row = sql_fetch_array($pay_rtn)){
		$pay_list[] = $pay_row;
	}

	$list['license'] = $ord_list;
	$list['payment'] = $pay_list;

	echo json_encode(array(
		"list" => $list, 
		"code" => "00",
		"msg" => "success",
	));
	

?>
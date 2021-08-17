<?php

	include_once('./_common.php');

	$sql = "select mb_id , mb_hp , mb_email , mb_2 , mb_3 from g5_member";
	$rtn = sql_query($sql);

	$list = array();
	while($row = sql_fetch_array($rtn)){
		
		$sql = "select ls_type, ls_price, ls_use, ls_dttm from g5_order where mb_id = '{$row['mb_id']}'";
		$ord_rtn = sql_query($sql);
		
		$ord_list = array();
		while($ord_row = sql_fetch_array($ord_rtn)){
			$ord_list[] = $ord_row;
		}

		$sql = "select pm_payment, pm_iche_month, pm_start_dttm, pm_next_dttm , pm_use_yn , pm_price from g5_payment where mb_id = '{$row['mb_id']}' and pm_del_yn = 'N'";
		$pay_rtn = sql_query($sql);
		
		$pay_list = array();
		while($pay_row = sql_fetch_array($pay_rtn)){
			$pay_list[] = $pay_row;
		}

		$row['license'] = $ord_list;
		$row['payment'] = $pay_list;
		$list[] = $row;

	}

	echo json_encode(array(
		"list" => $list, 
		"code" => "00",
		"msg" => "success",
	));
	

?>
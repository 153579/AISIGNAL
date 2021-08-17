<?php
include_once('./_common.php');

$type = isset($_GET['type']) ? $_GET['type'] : "";
$pm_id = isset($_GET['pm_id']) ? $_GET['pm_id'] : "";

if($pm_id == "" || $type == ""){
	alert_url("등록된 주문번호가 없습니다." , "http://xn--2i0bs2dqwxnic8tam0fba.com/adm/orderlist.php");
	exit();
}

if($type == "payment"){

	$sql = "select * from g5_payment where pm_id = '{$pm_id}'";
	$rtn = sql_fetch($sql);

	$dttm = date('Y-m-d H:i:s');
	
	$months = "+1 months";

	if($rtn['pm_payment'] == "iche"){
		$months = "+".$rtn['pm_iche_month']." months";

		$next_dttm = date('Y-m-d H:i:s', strtotime($months));
	}else {
		$next_dttm = date('Y-m-d H:i:s', strtotime($months));
	}
	

	$sql = "update g5_payment set pm_use_yn = 'Y' , pm_start_dttm = '{$dttm}' , pm_next_dttm = '{$next_dttm}'";
	$sql = $sql." where pm_id = '{$pm_id}'";
	
	$rtn = sql_query($sql);
	
	alert_url("정상처리 되었습니다." , "paymentlist.php");
	
}


?>
<?php
include_once('./_common.php');

$type = isset($_GET['type']) ? $_GET['type'] : "";
$ord_id = isset($_GET['ord_id']) ? $_GET['ord_id'] : "";

if($ord_id == "" || $type == ""){
	alert_url("등록된 주문번호가 없습니다." , "http://xn--2i0bs2dqwxnic8tam0fba.com/adm/orderlist.php");
}

if($type == "Y" || $type == "N"){

	$dttm = date('Y-d-m H:i:s');
	$sql = "update g5_order set ls_use = '{$type}'";
	$sql = ($type == "Y") ? $sql.", ls_dttm = '{$dttm}'" :   $sql.", ls_dttm = ''";
	$sql = $sql." where ord_id = '{$ord_id}'";
	
	$rtn = sql_query($sql);
	
	alert_url("정상처리 되었습니다." , "orderlist.php");
}


?>
<?php

include_once('./_common.php');

check_demo();

$paymethod = isset($_REQUEST['paymethod']) ? $_REQUEST['paymethod'] : "";
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
$mb_id = isset($_REQUEST['mb_id']) ? $_REQUEST['mb_id'] : "";

if($type == "" || $paymethod == "" ){ echo "정상적인 방법을 통하세요."; exit(); }


$sql = "select * from g5_member where mb_id = '{$mb_id}'";
$rtn = sql_fetch($sql);

$date = date("Y-m-d h:i:s");
$next_date = date("Y-m-d H:i:s", strtotime("+1 months"));


$price = 0;
if($paymethod == "iche"){
	$price = $rtn['mb_4'] * 100000;
}else {
	$price = 100000;
}

if($type == "ok"){
	$sql = "update g5_member set mb_5 = (mb_5 + {$price}), mb_6 = 'Y' , mb_7 = '{$date}' , mb_8 = '{$next_date}', mb_9 = '{$paymethod}' where mb_id = '{$mb_id}'";
}else {
	$sql = "update g5_member set mb_6 = 'N' where mb_id = '{$mb_id}'";
}

$rtn = sql_query($sql);

alert_url("정상 처리되었습니다.", "./ai_memberlist.php");





?>
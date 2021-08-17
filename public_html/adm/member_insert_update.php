<?php
	include_once('./_common.php');
	auth_check($auth[$sub_menu], "w");

	$mb_id = isset($_POST['mb_id']) ? $_POST['mb_id'] : "";
	$mb_password = isset($_POST['mb_password']) ? $_POST['mb_password'] : "";

	if($mb_id == "" || $mb_password == ""){
		alert("정보가 부족합니다.", "./ai_memberlist.php");
		exit();
	}

	$sql = "select * from g5_member where mb_id = '{$mb_id}'";
	$is_member = sql_query($sql);

	if($is_member->num_rows > 0){
		alert("이미 존재하는 아이디 입니다.", "./ai_memberlist.php");	
	}
	
	$sql = "insert into g5_member set mb_id = '{$mb_id}' , mb_password = PASSWORD('{$mb_password}') , mb_name = '테스트계정'";
	$rtn = sql_query($sql);

	if($rtn){

		$ndate = date("Y-m-d h:i:s");
		$sql = "insert into g5_order set mb_id = '{$mb_id}' , ls_type = '3' , ls_price = '0' , ls_use = 'Y' , ord_dttm = '{$ndate}' , ls_dttm = '{$ndate}'";

		$rtn = sql_query($sql);

		if($rtn){

			$sql = "insert into g5_payment set mb_id = '{$mb_id}' , pm_payment = 'iche' , pm_iche_month = '99' , pm_dttm = '{$ndate}' , pm_start_dttm = '{$ndate}' , pm_next_dttm = '9999-12-31 00:00:00' , 
			pm_use_yn = 'Y' , pm_price = '0'";
			$rtn = sql_query($sql);

			if($rtn) {
				alert("등록 완료", "./ai_memberlist.php");	
			}
		}	
	}

	alert("등록 완료", "./ai_memberlist.php");	
?>
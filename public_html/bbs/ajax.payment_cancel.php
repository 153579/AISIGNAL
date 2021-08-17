<?php
	include_once('./_common.php');

	$mb_id = isset($member['mb_id']) ? trim($member['mb_id']) : "";
	$type = isset($_REQUEST['type']) ? trim($_REQUEST['type']) : "";
	
	if($mb_id == "" || $type == ""){ 
		echo json_encode(array( "result" => "404" , "msg" => $mb_id));
	}
	

	if($type == "iche"){
		$sql = "select * from g5_payment where mb_id = '{$mb_id}' and pm_use_yn = 'N' and pm_del_yn = 'N'";
		$rtn = sql_query($sql);

		if($rtn->num_rows > 0){
			$sql = "update g5_payment set pm_del_yn = 'Y' where mb_id = '{$mb_id}'";
			$rtn = sql_query($sql);
		}else {
			echo json_encode(array( "result" => "403" , "msg" => $mb_id));
		}
		
		echo json_encode(array( "result" => "00" , "msg" => $mb_id));

	}else if($type == "all"){
		$sql = "select * from g5_payment where mb_id = '{$mb_id}' and pm_use_yn = 'Y' and pm_del_yn = 'N'";
		$rtn = sql_query($sql);

		if($rtn->num_rows > 0){
			$sql = "update g5_payment set pm_del_yn = 'Y' where mb_id = '{$mb_id}'";
			$rtn = sql_query($sql);
		}else {
			echo json_encode(array( "result" => "403" , "msg" => $mb_id));
		}
		

		echo json_encode(array( "result" => "00" , "msg" => $mb_id));
	}
	
?>
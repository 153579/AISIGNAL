<?php
include_once('./_common.php');

$type = $_REQUEST['type'];
$phone = $_REQUEST['phone'];
$code = $_REQUEST['code'];

if($type == "send_code"){
	
	$sql = "delete from g5_phone_code where pc_phone = '{$phone}'";
	$result = sql_query($sql);
	if(isset($phone)){
		$code = GenerateString(5);
		$sql = "insert into g5_phone_code set pc_phone = '{$phone}' , pc_code = '{$code}'";
		$result = sql_query($sql);
		
		$code = "에이아이시그널 인증코드 [".$code."]";
		$rtn = miriSms($code , $phone);

		echo json_encode(
				array("result" => "00",
						"code" =>$code , "phone" => $phone , "rtn" => $rtn));
		exit();
	}
}

if($type == "code_confirm") {
	
	$sql = "select * from g5_phone_code where pc_phone = '{$phone}' and pc_code = '{$code}'";
	$result = sql_query($sql);
	
	if($result->num_rows > 0){
		echo json_encode(
				array("result" => "00",
						"code" =>$code , "email" => $email));
		exit();
	}else {
		echo json_encode(
				array("result" => "404",
						"code" =>$code , "email" => $email));
		exit();
	}
}




?>
<?php
include_once('./_common.php');

$mb_id = isset($_REQUEST['mb_id']) ? $_REQUEST['mb_id'] : ""; //필수 아이디
$mb_password = isset($_REQUEST['mb_password']) ? $_REQUEST['mb_password'] : ""; //필수 비밀번호
$db_id = isset($_REQUEST['db_id']) ? $_REQUEST['db_id'] : ""; //필수 동부
$eb_id = isset($_REQUEST['eb_id']) ? $_REQUEST['eb_id'] : ""; //필수 이베스트
$ls_type = isset($_REQUEST['ls_type']) ? $_REQUEST['ls_type'] : ""; //필수 pc냐 mobile이냐 1, 2

if($mb_id == "" || $mb_password == ""){
	echo json_encode(array(
		"code" => "001",
		"msg" => "필수 항목을 채워주세요.",
	));
	exit();
}

if($db_id == "" && $eb_id == ""){
	echo json_encode(array(
		"code" => "002",
		"msg" => "증권사 아이디가 없습니다.",
	));
	exit();
}

if($ls_type == ""){
	echo json_encode(array(
		"code" => "003",
		"msg" => "라이센스 타입이 없습니다.",
	));
	exit();
}


$sql = "select * from g5_member where mb_id = '{$mb_id}'";
$rtn = sql_query($sql);
if($rtn->num_rows > 0) {
	$rtn = sql_fetch_array($rtn);
	if( ! check_password($mb_password, $rtn['mb_password'])){
		echo json_encode(array(
			"code" => "004",
			"msg" => "비밀번호 또는 아이디가 틀렸습니다.",
		));
		exit();
	}

	if($db_id != ""){ // DB증권
		if($db_id != $rtn['mb_2']){
			echo json_encode(array(
				"code" => "005",
				"msg" => "증권사 아이디가 일치하지 않습니다.",
			));
			exit();
		}
	}

	if($eb_id != ""){ // EB증권
		if($eb_id!= $rtn['mb_3']){
			echo json_encode(array(
				"code" => "006",
				"msg" => "증권사 아이디가 일치하지 않습니다.",
			));
			exit();
		}
	}
}else {
	echo json_encode(array(
			"code" => "007",
			"msg" => "존재하지 않는 아이디 입니다.",
		));
		exit();
}


//테스트 신청했을시 그냥 넘어간다. (체험판 한달)
$ndate = date('Y-m-d H:i:s');

$sql = "select * from g5_order where mb_id = '{$mb_id}' and ls_use = 'Y' and ls_type != '4' and ( ls_type = '{$ls_type}' or ls_type = '3')";
$rtn = sql_query($sql);
if( ! ($rtn->num_rows > 0)){

	$sql = "select * from g5_order where mb_id = '{$mb_id}' and ls_type = '4' and ls_use = 'Y' and ls_dttm > '{$ndate}'";
	$rtn = sql_query($sql);

	if($rtn->num_rows > 0){
		echo json_encode(array(
			"code" => "00",
			"msg" => "정상적으로 확인 되었습니다. (체험판 1달)",
			"type" => "free"
		));
		exit();
	}

	echo json_encode(array(
		"code" => "008",
		"msg" => "보유하신 라이센스가 존재하지 않습니다.",
	));
	exit();
}

$sql = "select * from g5_payment where mb_id = '{$mb_id}' and pm_next_dttm > '{$ndate}' and pm_use_yn = 'Y' and pm_del_yn = 'N'";
$rtn = sql_query($sql);
if( ! ($rtn->num_rows > 0)){
	echo json_encode(array(
		"code" => "009",
		"msg" => "월회비를 결제하지 않은 회원입니다.",
	));
	exit();
}

echo json_encode(array(
		"code" => "00",
		"msg" => "정상적으로 확인 되었습니다.",
		"type" => "pay"
	));
exit();



?>
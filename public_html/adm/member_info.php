<?php
include_once('./_common.php');

$mb_id = $_REQUEST['mb_id'];
$w = $_REQUEST['w'];

$mb_password = isset($_REQUEST['mb_password']) ? $_REQUEST['mb_password'] : "";
$mb_name = isset($_REQUEST['mb_name']) ? $_REQUEST['mb_name'] : "";
$mb_hp = isset($_REQUEST['mb_hp']) ? $_REQUEST['mb_hp'] : "";
$mb_email = isset($_REQUEST['mb_email']) ? $_REQUEST['mb_email'] : "";
$mb_2 = isset($_REQUEST['mb_2']) ? $_REQUEST['mb_2'] : "";
$mb_3 = isset($_REQUEST['mb_2']) ? $_REQUEST['mb_3'] : "";


$rtn = "";
if($w == "u"){
	$sql_common = "update g5_member set ";
	$sql_set = "mb_name = '{$mb_name}' , mb_hp = '{$mb_hp}' , mb_email = '{$mb_email}' , mb_2 = '{$mb_2}' , mb_3 = '{$mb_3}'";
	
	$sql_password = "";
	if($mb_password != ""){
		$sql_password = " , mb_password = '".get_encrypt_string($mb_password)."'";
	}

	$sql_where = " where mb_id = '{$mb_id}'";

	$sql = "{$sql_common} {$sql_set} {$sql_password} {$sql_where}";
	$rtn = sql_query($sql);

	alert_url("정상처리되었습니다.","./member_info.php?mb_id={$mb_id}");
}


$sql = "select * from g5_member where mb_id = '{$mb_id}'";
$rtn = sql_fetch($sql);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Hello World!</title>
  <style>
	h1 { text-align:center;}
	table { border: 1px solid #444444; border-collapse: collapse; margin:0 auto; width:50%;}
	th, td { height:50px;  border: 1px solid #444444;}
	td { border-left: none;}
	th { border-right:none;}
	input { font-size:19px;}
	.btn_wrap { width:50%; margin:0 auto; text-align:center; margin-top:20px;}
  </style>


</head>
<body>
<h1>회원상세페이지</h1>
<form action="./member_info.php" method="post">
<input type="hidden" value="u" name="w">
<div class="tbl_head01 tbl_wrap">
    <table>
		<tr>
			<th>가입일시</th>
			<td><input type="text" name="mb_datetime" value="<?php echo $rtn['mb_datetime']; ?>"></td>
		</tr>
		<tr>
			<th>아이디</th>
			<td><input type="text"  name="mb_id" value="<?php echo $rtn['mb_id']; ?>"></td>
		</tr>
		<tr>
			<th>비밀번호</th>
			<td><input type="text"  name="mb_password" value=""></td>
		</tr>
		<tr>
			<th>이름</th>
			<td><input type="text" name="mb_name" value="<?php echo $rtn['mb_name']; ?>"></td>
		</tr>
		<tr>
			<th>휴대폰번호</th>
			<td><input type="text" name="mb_hp" value="<?php echo $rtn['mb_hp']; ?>"></td>
		</tr>
		<tr>
			<th>이메일</th>
			<td><input type="text" name="mb_email" value="<?php echo $rtn['mb_email']; ?>"></td>
		</tr>
		<tr>
			<th>동부증권ID</th>
			<td><input type="text" name="mb_2" value="<?php echo $rtn['mb_2']; ?>"></td>
		</tr>
		<tr>
			<th>이베스트ID</th>
			<td><input type="text" name="mb_3" value="<?php echo $rtn['mb_3']; ?>"></td>
		</tr>
    </table>
</div>
<div class="btn_wrap">
	<input type="submit" value="저장하기">
</div>
</form>

</body>
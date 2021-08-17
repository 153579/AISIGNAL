<?
include_once('./_common.php');

$mb_password    = isset($_POST['mb_password']) ? trim($_POST['mb_password']) : "";;
$mb_id = trim($_POST['mb_id']);
$mb_2 = isset($_POST['mb_2']) ? trim($_POST['mb_2']) : "";;
$mb_3 = isset($_POST['mb_3']) ? trim($_POST['mb_3']) : "";;

$sql = "update g5_member set mb_2 = '{$mb_2}' , mb_3 = '{$mb_3}' ";
if( ! empty($mb_password)) 
{
	$sql .= ", mb_password = '".get_encrypt_string($mb_password)."'";
}

$sql .= "where mb_id = '{$mb_id}'";
$rtn = sql_query($sql);

alert_url("정상처리 되었습니다.","./content.php?co_id=mypage");

?>
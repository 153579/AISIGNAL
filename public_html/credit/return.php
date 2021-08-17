<?php
header('Content-Type: text/html; charset=euc-kr');
@extract($_REQUEST);

//---------------------------------------
// Include Class(don't modify)
//---------------------------------------
include "config.php";
include "class/Message.php";
include "class/MessageTag.php";
include "class/ServiceCode.php";
include "class/Command.php";
include "class/ServiceBroker.php";

//---------------------------------------
// Create Instance
//---------------------------------------
$reqMsg = new Message(); // Request Message 
$resMsg = new Message(); //Response Message 
$tag = new MessageTag(); 
$svcCode = new ServiceCode(); //Service Code
$cmd = new Command(); //Command
//---------------------------------------
// Create Service Broker
//---------------------------------------
$broker = new ServiceBroker($ENCRYPT_COMMAND, $CONFIG_FILE); //communication module
//---------------------------------------
//Set Header 
//---------------------------------------
$reqMsg->setVersion("0100"); //version (0100)
$reqMsg->setMerchantId($SERVICE_ID); 
$reqMsg->setServiceCode($svcCode->CREDIT_CARD); //Service Code
$reqMsg->setCommand($cmd->ID_AUTH_REQUEST); //authentication request Command 
$reqMsg->setOrderId($ORDER_ID); 
$reqMsg->setOrderDate($ORDER_DATE); //(YYYYMMDDHHMMSS)

//---------------------------------------
//Check RESPONSE_CODE
//---------------------------------------
$isSuccess = false;
if(!strcmp($RESPONSE_CODE, "0000")) { // If authentication is successful, the payment request
	
	//Check Sum
	$temp = $SERVICE_ID.$ORDER_ID.$ORDER_DATE;
	$cmd = sprintf("%s \"%s\" \"%s\" \"%s\"", $COM_CHECK_SUM, "DIFF", $CHECK_SUM, $temp);
	$checkSum = exec($cmd) or die("ERROR:899900");	
	
	if($checkSum == 'SUC'){
		//---------------------------------------
		// Request
		//---------------------------------------
		$broker->invokeMessage($svcCode->CREDIT_CARD, $MESSAGE); //authentication request 
		$resMsg = $broker->getResMsg(); //Get response request
	
		//---------------------------------------
		// Response 
		//---------------------------------------
		$RESPONSE_CODE = $resMsg->get($tag->RESPONSE_CODE);
		$RESPONSE_MESSAGE = $resMsg->get($tag->RESPONSE_MESSAGE);
		$DETAIL_RESPONSE_CODE = $resMsg->get($tag->DETAIL_RESPONSE_CODE);
		$DETAIL_RESPONSE_MESSAGE = $resMsg->get($tag->DETAIL_RESPONSE_MESSAGE);
	
		if(!strcmp($resMsg->get($tag->RESPONSE_CODE), "0000")) {
			$AUTH_AMOUNT = $resMsg->get($tag->AUTH_AMOUNT);
			$TRANSACTION_ID = $resMsg->get($tag->TRANSACTION_ID);
			$AUTH_DATE = $resMsg->get($tag->AUTH_DATE);
		
			$isSuccess = true;
		}
	}else{
?>
	<script type="text/javascript">
		alert("에러 코드 : " +<?php echo $checkSum ?> +"\n에러 메시지 : 결제정보오류(return)! 관리자에게 문의 하세요!");
		window.close();
	</script>
<?php
	}
}else{
	$AUTH_AMOUNT 		= "";
	$AUTH_DATE 			= "";
}

if($isSuccess == true){
//---------------------------------------
// 가맹점 수정 - 성공 시 가맹점 결과 처리 
// 1. 가맹점 주문번호 및 갤럭시아 거래번호로 성공 결과 DB 저장
// 2. 결제 성공 페이지 호출
//---------------------------------------
?>
<html> 
<head> 
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/css_admin.css" rel="stylesheet" type="text/css">
<link href="css/css_01.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="500" border="0" cellpadding="0"	cellspacing="0">
	<tr> 
	  <td height="25" background="images/top_bg02.gif" style="padding-left:10px" class="title01"><img src="images/top_icon01.gif"> 카드결제 &gt; <b>가맹점 결제 성공 페이지</b></td>
	</tr>
	<!--title-->
	<tr>
		<td height="54" background="images/manager_title01.gif"
			style="padding-left: 65px; padding-top: 18px"><font size="3"><strong>가맹점 결제 성공 페이지</strong></font></td>
	</tr>
	<!--title-->
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><!--본문테이블 시작--->
		<table width="450" border="0" cellpadding="4" cellspacing="1" bgcolor="#B0B0B0">	
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>가맹점 아이디</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $SERVICE_ID ?></b></td>								
			</tr>
				<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>주문번호</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $ORDER_ID ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>주문 일시</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $ORDER_DATE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>거래번호</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $TRANSACTION_ID ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>승인금액</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $AUTH_AMOUNT ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>승인일시</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $AUTH_DATE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>응답코드</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $RESPONSE_CODE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>응답메시지</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $RESPONSE_MESSAGE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>상세응답코드</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $DETAIL_RESPONSE_CODE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>상세응답메시지</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $DETAIL_RESPONSE_MESSAGE ?></b></td>								
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>

<?php
}else {
//---------------------------------------
// 가맹점 수정 - 실패 시 가맹점 결과 처리 
// 1. 가맹점 주문번호 및 갤럭시아 거래번호로 실패 결과 DB 저장
// 2. 결제 실패 페이지 호출
//---------------------------------------
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/css_admin.css" rel="stylesheet" type="text/css">
<link href="css/css_01.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="500" border="0" cellpadding="0"	cellspacing="0">
	<tr> 
	  <td height="25" background="images/top_bg02.gif" style="padding-left:10px" class="title01"><img src="images/top_icon01.gif">카드결제 &gt; <b>가맹점 실패 페이지</b></td>
	</tr>
	<!--히스토리-->
	<!--title-->
	<tr>
		<td height="54" background="images/manager_title01.gif"
			style="padding-left: 65px; padding-top: 18px"><font size="3"><strong>가맹점 실패 페이지</strong></font></td>
	</tr>
	<!--title-->
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><!--본문테이블 시작--->
		<table width="450" border="0" cellpadding="4" cellspacing="1" bgcolor="#B0B0B0">	
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>가맹점 아이디</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $SERVICE_ID ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>주문번호</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $ORDER_ID ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>주문 일시</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $ORDER_DATE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>거래번호</b></td> 
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $TRANSACTION_ID ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>응답코드</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $RESPONSE_CODE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>응답메시지</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $RESPONSE_MESSAGE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>상세응답코드</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $DETAIL_RESPONSE_CODE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>상세응답메시지</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $DETAIL_RESPONSE_MESSAGE ?></b></td>								
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
<?php
}
?>


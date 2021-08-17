<?php
header('Content-Type: text/html; charset=euc-kr');
@extract($_REQUEST);
//---------------------------------------
// API 클래스 Include
//---------------------------------------
include "./config.php";
include "./class/Message.php";
include "./class/MessageTag.php";
include "./class/ServiceCode.php";
include "./class/Command.php";
include "./class/ServiceBroker.php";

//시간 관련 변수
$today			= mktime(); 
$today_time = date('YmdHis', $today);


//취소 요청 파라메터
$serviceId	= "glx_api";					//테스트 아이디 일반결제 : glx_api
$orderId = "test_20120910101756";	// 취소건의 주문번호
$orderDate 	= $today_time; 			 	// 취소 요청일시

//---------------------------------------
// API 인스턴스 생성
//---------------------------------------
$reqMsg = new Message(); //요청 메시지
$resMsg = new Message(); //응답 메시지
$tag = new MessageTag(); //태그
$svcCode = new ServiceCode(); //서비스 코드
$cmd = new Command(); //Command
$broker = new ServiceBroker($COMMAND, $CONFIG_FILE); //통신 모듈

//---------------------------------------
//Header 설정
//---------------------------------------
$reqMsg->setVersion("0100"); //버전 (0100)
$reqMsg->setMerchantId($serviceId); //가맹점 아이디
$reqMsg->setServiceCode($svcCode->ACCOUNT_TRANSFER); //서비스코드
$reqMsg->setCommand($cmd->NETWORK_CANCEL_REQUEST); //망 취소 요청 Command
$reqMsg->setOrderId($orderId); //승인요청 시 주문번호
$reqMsg->setOrderDate($orderDate); //주문일시(YYYYMMDDHHMMSS)

//---------------------------------------
// 요청 전송
//---------------------------------------
$broker->setReqMsg($reqMsg); //요청 메시지 설정
$broker->invoke($svcCode->ACCOUNT_TRANSFER); //응답 요청
$resMsg = $broker->getResMsg(); //응답 메시지 확인

//---------------------------------------
//요청 결과 Alert 처리
//---------------------------------------
$RESPONSE_CODE = $resMsg->get($tag->RESPONSE_CODE);
$RESPONSE_MESSAGE = $resMsg->get($tag->RESPONSE_MESSAGE);
$DETAIL_RESPONSE_CODE = $resMsg->get($tag->DETAIL_RESPONSE_CODE);
$DETAIL_RESPONSE_MESSAGE = $resMsg->get($tag->DETAIL_RESPONSE_MESSAGE);
$transactionId = $resMsg->get($tag->TRANSACTION_ID);
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
	  <td height="25" background="images/top_bg02.gif" style="padding-left:10px" class="title01"><img src="images/top_icon01.gif">신용카드 &gt; <b>가맹점 망취소 페이지</b></td>
	</tr>
	<!--히스토리-->
	<!--title-->
	<tr>
		<td height="54" background="images/manager_title01.gif"
			style="padding-left: 65px; padding-top: 18px"><font size="3"><strong>가맹점 망취소 페이지</strong></font></td>
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
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $serviceId ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>주문번호</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $orderId ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>주문 일시</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $orderDate ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>거래번호</b></td> 
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $transactionId ?></b></td>								
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

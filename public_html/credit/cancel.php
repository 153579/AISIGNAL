<?php
header('Content-Type: text/html; charset=euc-kr');
@extract($_REQUEST);

//---------------------------------------
// Include
//---------------------------------------
include "./config.php";
include "./class/Message.php";
include "./class/MessageTag.php";
include "./class/ServiceCode.php";
include "./class/Command.php";
include "./class/ServiceBroker.php";


$today			= mktime(); 
$today_time = date('YmdHis', $today);

//parameter
$serviceId	= "glx_api";					
$orderDate 	= $today_time; 			 	
$orderId 		= "test_".$orderDate;	    
$transactionId = "2012100915TT004026";	//��Ұ��� �ŷ���ȣ

//---------------------------------------
//Create Instance
//---------------------------------------
$reqMsg = new Message(); 
$resMsg = new Message(); 
$tag = new MessageTag();
$svcCode = new ServiceCode(); 
$cmd = new Command(); 
$broker = new ServiceBroker($COMMAND, $CONFIG_FILE);

//---------------------------------------
//Header 
//---------------------------------------
$reqMsg->setVersion("0100"); 
$reqMsg->setMerchantId($serviceId); 
$reqMsg->setServiceCode($svcCode->CREDIT_CARD); 
$reqMsg->setCommand($cmd->CANCEL_SMS_REQUEST); 
$reqMsg->setOrderId($orderId); 
$reqMsg->setOrderDate($orderDate);

//---------------------------------------
//Body 
//---------------------------------------
if($transactionId != NULL) 
	$reqMsg->put($tag->TRANSACTION_ID, $transactionId);                              

//---------------------------------------
//Request
//---------------------------------------
$broker->setReqMsg($reqMsg); 
$broker->invoke($svcCode->CREDIT_CARD); 
$resMsg = $broker->getResMsg();

//---------------------------------------
//Response 
//---------------------------------------
$msg = $resMsg->get($tag->RESPONSE_MESSAGE); 

$RESPONSE_CODE = $resMsg->get($tag->RESPONSE_CODE);
$RESPONSE_MESSAGE = $resMsg->get($tag->RESPONSE_MESSAGE);
$DETAIL_RESPONSE_CODE = $resMsg->get($tag->DETAIL_RESPONSE_CODE);
$DETAIL_RESPONSE_MESSAGE = $resMsg->get($tag->DETAIL_RESPONSE_MESSAGE);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/css_admin.css" rel="stylesheet" type="text/css">
<link href="css/css_01.css" rel="stylesheet" type="text/css">
<head>
<!-- Ű ��� �ڵ� -->
<script type="text/javascript" src="js/comm.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">	
<table width="500" border="0" cellpadding="0"	cellspacing="0">
	<tr> 
	  <td height="25" style="padding-left:10px" class="title01">�ſ�ī�� &gt; <b>������ Return Url</b></td>
	</tr>
	<!--title-->
	<tr>
		<td height="54" background="images/manager_title01.gif" style="padding-left: 65px; padding-top: 18px"><font size="3"><strong>������ Return Url</strong></font></td>
	</tr>
	<!--title-->
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><!--�������̺� ����--->
		<table width="450" border="0" cellpadding="4" cellspacing="1" bgcolor="#B0B0B0">	
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>������ ���̵�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $serviceId ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ֹ���ȣ</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $orderId ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ֹ� �Ͻ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $orderDate ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ŷ���ȣ</b></td> 
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $transactionId ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�����ڵ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $RESPONSE_CODE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>����޽���</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $RESPONSE_MESSAGE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�������ڵ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $DETAIL_RESPONSE_CODE ?></b></td>								
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>������޽���</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?php echo $DETAIL_RESPONSE_MESSAGE ?></b></td>								
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
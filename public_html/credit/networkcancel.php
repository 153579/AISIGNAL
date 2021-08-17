<?php
header('Content-Type: text/html; charset=euc-kr');
@extract($_REQUEST);
//---------------------------------------
// API Ŭ���� Include
//---------------------------------------
include "./config.php";
include "./class/Message.php";
include "./class/MessageTag.php";
include "./class/ServiceCode.php";
include "./class/Command.php";
include "./class/ServiceBroker.php";

//�ð� ���� ����
$today			= mktime(); 
$today_time = date('YmdHis', $today);


//��� ��û �Ķ����
$serviceId	= "glx_api";					//�׽�Ʈ ���̵� �Ϲݰ��� : glx_api
$orderId = "test_20120910101756";	// ��Ұ��� �ֹ���ȣ
$orderDate 	= $today_time; 			 	// ��� ��û�Ͻ�

//---------------------------------------
// API �ν��Ͻ� ����
//---------------------------------------
$reqMsg = new Message(); //��û �޽���
$resMsg = new Message(); //���� �޽���
$tag = new MessageTag(); //�±�
$svcCode = new ServiceCode(); //���� �ڵ�
$cmd = new Command(); //Command
$broker = new ServiceBroker($COMMAND, $CONFIG_FILE); //��� ���

//---------------------------------------
//Header ����
//---------------------------------------
$reqMsg->setVersion("0100"); //���� (0100)
$reqMsg->setMerchantId($serviceId); //������ ���̵�
$reqMsg->setServiceCode($svcCode->ACCOUNT_TRANSFER); //�����ڵ�
$reqMsg->setCommand($cmd->NETWORK_CANCEL_REQUEST); //�� ��� ��û Command
$reqMsg->setOrderId($orderId); //���ο�û �� �ֹ���ȣ
$reqMsg->setOrderDate($orderDate); //�ֹ��Ͻ�(YYYYMMDDHHMMSS)

//---------------------------------------
// ��û ����
//---------------------------------------
$broker->setReqMsg($reqMsg); //��û �޽��� ����
$broker->invoke($svcCode->ACCOUNT_TRANSFER); //���� ��û
$resMsg = $broker->getResMsg(); //���� �޽��� Ȯ��

//---------------------------------------
//��û ��� Alert ó��
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
	  <td height="25" background="images/top_bg02.gif" style="padding-left:10px" class="title01"><img src="images/top_icon01.gif">�ſ�ī�� &gt; <b>������ ����� ������</b></td>
	</tr>
	<!--�����丮-->
	<!--title-->
	<tr>
		<td height="54" background="images/manager_title01.gif"
			style="padding-left: 65px; padding-top: 18px"><font size="3"><strong>������ ����� ������</strong></font></td>
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

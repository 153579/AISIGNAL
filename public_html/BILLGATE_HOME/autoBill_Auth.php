<?php
	header('Content-Type: text/html; charset=euc-kr');
	@extract($_REQUEST);

	// ���� ��û �� ���� ó�� ������

	// Include Class(don't modify)
	include "config.php";
	include "class/Message.php";
	include "class/MessageTag.php";
	include "class/ServiceCode.php";
	include "class/Command.php";
	include "class/ServiceBroker.php";

	// Parameter Setting
	$today=time(); 
	$today_time = date('YmdHis', $today);

	$SERVICE_ID = "test" ; // �� �ڵ� �׽�Ʈ ���̵�
	$ORDER_DATE = $today_time;
	$ORDER_ID = "test_".$ORDER_DATE ;  // ������ �� �ֹ� ��ȣ
	$USER_ID = "test_userId";
	$USER_NAME = "ȫ�浿";
	$ITEM_CODE = "itemCode";
	$ITEM_NAME = "��ǰ��";
	$USER_EMAIL = "test@test.com";
	$USER_IP = "127.0.0.1";
	$CVC2 = "";
	$SOCIAL_NUMBER = ""; // DEAL_TYPE �� ��0011�� �� ���� ����("") ó��, ��0013��, ��0014�� �� �� ���� �ѱ�� ���� ��û �ÿ� ����� ���� ���ϸ�, ���� ó���� �Ͽ��ٸ� �� ���� �ʴ´�.
	$QUOTA = ""; // �Һΰ����� ex) 00 : �Ͻú� / 03 or 04 ���
	$DEAL_AMOUNT = "1000"; // ���� �ݾ�
	$DEAL_TYPE = ""; // 0011, 0013, 0014 ������ ���� �Ǹ�, ��� ���� ���� �Ǵ����� ���� Ȯ���� ���� ����ڸ� ���� Ȯ�� �� �� �ִ�.
	$USING_TYPE = "0000"; // ����
	$CURRENCY = "0000"; // ����
	$EXTRA_DATA = ""; // �ΰ� ����(���� �Ķ���� �� �߰��� Ȯ�� �����Ͱ� �ʿ� �� ��� ���)
	$SESSION_KEY = ""; // ���� ���� ��, �߱� �� ����Ű�� �Է�

	// Create Instance
	$reqMsg = new Message();
	$resMsg = new Message();
	$tag = new MessageTag(); 
	$svcCode = new ServiceCode();
	$cmd = new Command();

	// Create Service Broker
	$broker = new ServiceBroker($COMMAND, $CONFIG_FILE);

	// Set Header 
	$reqMsg->setVersion("0100");
	$reqMsg->setMerchantId($SERVICE_ID); 
	$reqMsg->setServiceCode($svcCode->CREDIT_CARD);
	$reqMsg->setCommand("3070"); 
	$reqMsg->setOrderId($ORDER_ID); 
	$reqMsg->setOrderDate($ORDER_DATE);

	// Set Body 
	if($USER_ID != null)					$reqMsg->put($tag->USER_ID, $USER_ID);
	if($USER_NAME != null)			$reqMsg->put($tag->USER_NAME, $USER_NAME);
	if($ITEM_CODE != null) 			$reqMsg->put($tag->ITEM_CODE, $ITEM_CODE);
	if($ITEM_NAME != null)			$reqMsg->put($tag->ITEM_NAME, $ITEM_NAME);
	if($USER_EMAIL != null)			$reqMsg->put($tag->USER_EMAIL, $USER_EMAIL);
	if($USER_IP != null)					$reqMsg->put($tag->USER_IP, $USER_IP);
	if($CVC2 != null)						$reqMsg->put($tag->CVC2, $CVC2);
	if($SOCIAL_NUMBER != null)		$reqMsg->put($tag->SOCIAL_NUMBER, $SOCIAL_NUMBER);
	if($QUOTA != null)					$reqMsg->put($tag->QUOTA, $QUOTA);
	if($DEAL_AMOUNT != null)		$reqMsg->put($tag->DEAL_AMOUNT, $DEAL_AMOUNT);
	if($DEAL_TYPE != null)				$reqMsg->put($tag->DEAL_TYPE, $DEAL_TYPE);
	if($USING_TYPE != null)			$reqMsg->put($tag->USING_TYPE, $USING_TYPE);
	if($CURRENCY != null)				$reqMsg->put($tag->CURRENCY, $CURRENCY);
	if($EXTRA_DATA != null)			$reqMsg->put("5015", $EXTRA_DATA);
	if($SESSION_KEY != null)			$reqMsg->put($tag->SESSION_KEY, $SESSION_KEY);

	$broker->setReqMsg($reqMsg);						//��û �޽��� ����
	$broker->invoke($svcCode->CREDIT_CARD);	// ���� ��û
	$resMsg = $broker->getResMsg(); 

	$SESSION_KEY 						= $resMsg->get($tag->SESSION_KEY); 
	$EXTRA_DATA							= $resMsg->get("5015"); 
	$TRANSACTION_ID					= $resMsg->get($tag->TRANSACTION_ID); 
	$ISSUE_COMPANY_CODE			= $resMsg->get($tag->ISSUE_COMPANY_CODE); 
	$ISSUE_COMPANY_NAME			= $resMsg->get("5009"); 
	$BUY_COMPANY_CODE			= $resMsg->get($tag->BUY_COMPANY_CODE); 
	$BUY_COMPANY_NAME			= $resMsg->get("5010"); 
	$AUTH_NUMBER						= $resMsg->get($tag->AUTH_NUMBER);
	$AUTH_DATE							= $resMsg->get($tag->AUTH_DATE); // ���� �Ͻ� YYYYMMDDHHMMSS
	$AUTH_AMOUNT					= $resMsg->get($tag->AUTH_AMOUNT);
	$RESPONSE_CODE					= $resMsg->get($tag->RESPONSE_CODE);
	$RESPONSE_MESSAGE				= $resMsg->get($tag->RESPONSE_MESSAGE);
	$DETAIL_RESPONSE_CODE		= $resMsg->get($tag->DETAIL_RESPONSE_CODE);
	$DETAIL_RESPONSE_MESSAGE	= $resMsg->get($tag->DETAIL_RESPONSE_MESSAGE);

	if(!strcmp($RESPONSE_CODE, "0000") && !strcmp($DETAIL_RESPONSE_CODE, "00")) { // ���� ������ ���
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/css_admin.css" rel="stylesheet" type="text/css">
<link href="css/css_01.css" rel="stylesheet" type="text/css">
<head>
<!-- Ű ��� �ڵ� -->
<!--<script type="text/javascript" src="./js/comm.js"></script>-->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">	
<table width="500" border="0" cellpadding="0"	cellspacing="0">
	<tr> 
		<td height="25" style="padding-left:10px" class="title01"># ������ġ &gt;&gt; �ſ�ī�� &gt; <b>���� ���� view ������</b></td>
	</tr>
	<!--title-->
	<tr>
		<td height="54" background="images/manager_title01.gif" style="padding-left: 65px; padding-top: 18px"><font size="3"><strong>���� ���� view ������</strong></font></td>
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
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $SERVICE_ID?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ֹ���ȣ</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $ORDER_ID?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ŷ���ȣ</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $TRANSACTION_ID?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>���ι�ȣ</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $AUTH_NUMBER?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�����Ͻ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $AUTH_DATE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�����ݾ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $AUTH_AMOUNT?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�����ڵ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $RESPONSE_CODE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>����޽���</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $RESPONSE_MESSAGE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�������ڵ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $DETAIL_RESPONSE_CODE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>������޽���</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $DETAIL_RESPONSE_MESSAGE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>����Ű</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $SESSION_KEY?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ΰ�����</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $EXTRA_DATA?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�߱޻� �ڵ� / ��Ī</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $ISSUE_COMPANY_CODE?> / <?PHP echo $ISSUE_COMPANY_NAME?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>���Ի� �ڵ� / ��Ī</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $BUY_COMPANY_CODE?> / <?PHP echo $BUY_COMPANY_NAME?></b></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
<?	
	} else { // ���� ������ ���
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/css_admin.css" rel="stylesheet" type="text/css">
<link href="css/css_01.css" rel="stylesheet" type="text/css">
<head>
<!-- Ű ��� �ڵ� -->
<!--<script type="text/javascript" src="./js/comm.js"></script>-->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">	
<table width="500" border="0" cellpadding="0"	cellspacing="0">
	<tr> 
	  <td height="25" style="padding-left:10px" class="title01"># ������ġ &gt;&gt; �ſ�ī�� &gt; <b>���� ���� view ������</b></td>
	</tr>
	<!--title-->
	<tr>
		<td height="54" background="images/manager_title01.gif" style="padding-left: 65px; padding-top: 18px"><font size="3"><strong>���� ���� view ������</strong></font></td>
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
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $SERVICE_ID?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ֹ���ȣ</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $ORDER_ID?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ŷ���ȣ</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $TRANSACTION_ID?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�����ڵ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $RESPONSE_CODE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>����޽���</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $RESPONSE_MESSAGE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�������ڵ�</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $DETAIL_RESPONSE_CODE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>������޽���</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $DETAIL_RESPONSE_MESSAGE?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>����Ű</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $SESSION_KEY?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�ΰ�����</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $EXTRA_DATA?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>�߱޻� �ڵ� / ��Ī</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $ISSUE_COMPANY_CODE?> / <?PHP echo $ISSUE_COMPANY_NAME?></b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6"><b>���Ի� �ڵ� / ��Ī</b></td>
				<td width="200" align="left" bgcolor="#FFFFFF">&nbsp;<b><?PHP echo $BUY_COMPANY_CODE?> / <?PHP echo $BUY_COMPANY_NAME?></b></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
<?	
	}
?>

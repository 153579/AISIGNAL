<?php 
header('Content-Type: text/html; charset=euc-kr'); 

include "config.php";

$today=mktime(); 
$today_time = date('YmdHis', $today);

//parameter
$serviceId = "glx_api" ;   //�׽�Ʈ���� : glx_api
$orderDate = $today_time ; //(YYYYMMDDHHMMSS)
$orderId = "test_".$orderDate ;  
$userId = "testid" ; 
$userName = "honggildong";
$itemName = "test_itemname";
$itemCode = "TEST_CD1";
$amount = "1000";
$userIp = "127.0.0.1";
$returnUrl = "http://59.10.125.162/leech/credit-php-link/return.php";

//checksum
$temp = $serviceId.$orderId.$amount;
$cmd = sprintf("%s \"%s\" \"%s\"", $COM_CHECK_SUM, "GEN", $temp);
$checkSum = exec($cmd) or die("ERROR:899900");

if ($checkSum == '8001'||$checkSum == '8003'||$checkSum == '8009'){
?>
<script type="text/javascript">
	alert("error code : " +<?php echo $checkSum ?> +"\nError Message : make checksum error! Please contact your system administrator!");
	window.close();
</script>
<?php
}else{
?>
<html>
<head>
<title>������û</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/css_admin.css" rel="stylesheet" type="text/css">
<link href="css/css_01.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkSubmit(){
	var HForm = document.payment;
	HForm.target = "payment";
	
	//�׽�Ʈ URL 
	HForm.action = "http://tpay.billgate.net/credit/certify.jsp";
	//��� URL 
	//HForm.action = "https://pay.billgate.net/credit/certify.jsp";

	var option ="width=500,height=477,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,left=150,top=150";
	var objPopup = window.open("", "payment", option);

	if(objPopup == null){	//�˾� ���ܿ��� Ȯ��
		alert("�˾��� ���ܵǾ� �ֽ��ϴ�.\n�˾������� �����Ͻ� �� �ٽ� �õ��Ͽ� �ֽʽÿ�.");
	}

	HForm.submit();
}
</script>
</head>
<!--Header��-->
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="payment" method="post">
<table width="500" border="0" cellpadding="0" cellspacing="0">
	<tr> 
	  <td height="25" background="images/top_bg02.gif" style="padding-left:10px" class="title01"><img src="images/top_icon01.gif" align="absmiddle">�ſ�ī�� ���� &gt; <b>������û �׽�Ʈ</b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">
		<!--�������̺� ����--->
		<table width="450" border="0" cellpadding="5" cellspacing="1" bgcolor="#B0B0B0">
			<tr>
				<td colspan="2" height="30" align="left" bgcolor="#F6F6F6"><b>�������� �����Է�</b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">���񽺾��̵�</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $serviceId ?><input type="hidden" name="SERVICE_ID" value="<?PHP echo $serviceId ?>"></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">���� �ݾ�</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $amount ?><input type="hidden"	name="AMOUNT" value="<?PHP echo $amount ?>"></td>
			</tr>	
			<tr>						
				<td width="100" align="center" bgcolor="#F6F6F6">�ֹ���ȣ</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $orderId ?><input type="hidden" name="ORDER_ID" class="input" value="<?PHP echo $orderId ?>"></td>
			</tr>				
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">�ֹ��Ͻ�</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="ORDER_DATE" size=20 class="input" value="<?PHP echo $orderDate ?>"></td>
			</tr>				
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">�� IP</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="USER_IP" size=20 class="input" value="<?PHP echo $userIp ?>"></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">��ǰ��</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="ITEM_NAME" size=20 class="input" value="<?PHP echo $itemName ?>"></td>
			</tr>				
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">��ǰ�ڵ�</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="ITEM_CODE" size=20 class="input" value="<?PHP echo $itemCode ?>"></td>	
			</tr>
		  <tr>
		  	<td width="100" align="center" bgcolor="#F6F6F6">�� ���̵�</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="USER_ID" size=20 class="input" value="<?PHP echo $userId ?>"></td>
			</tr>				
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">����</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="USER_NAME" size=20 class="input" value="<?PHP echo $userName ?>"></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">�Һΰ�����</td>
				<td bgcolor="#FFFFFF" colspan="3">&nbsp;<input type="text"	name="INSTALLMENT_PERIOD" size=30 class="input" value="0:3:6:9:12"></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">ī��缱��</td>
				<td bgcolor="#FFFFFF">&nbsp; 
					<select name="CARD_TYPE" >
						<option value="0000">---ī��� ����---</option>
							<option value="0052">��ī��</option>
							<option value="0050">����ī��</option>
							<option value="0073">����ī��</option>
							<option value="0054">�Ｚī��</option>
							<option value="0053">����(LG)ī��</option>
							<option value="0055">�Ե�ī��</option>
							<option value="0089">��������</option>
							<option value="0051">��ȯī��</option>
							<option value="0076">�ϳ�</option>
							<option value="0079">����</option>
							<option value="0080">����</option>
							<option value="0073">����(����)</option>
							<option value="0075">����</option>
							<option value="0081">����</option>
							<option value="0078">����</option>
							<option value="0084">��Ƽ</option>
					</select>
				</td>
			</tr>							
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">Return Url</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="RETURN_URL" size=50 class="input" value="<?PHP echo $returnUrl ?>"></td>
			</tr>				
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">Check Sum</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $checkSum ?><input type="hidden" name="CHECK_SUM" class="input" value="<?PHP echo $checkSum ?>"></td>
			</tr>				
		</table>
		<table width="450" border="0" cellpadding="5" cellspacing="1" bgcolor="#B0B0B0">	
			<tr>
				<td align="center" bgcolor="#FFFFFF" colspan="2"><img src="images/bt_submit01.gif" OnClick="javascript:checkSubmit();" style="cursor: hand;"></td>
			</tr>
		</table>
		<!--�������̺� ��--->
		</td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
</table>
</form>
</body>
</html>
<?php
}
?>
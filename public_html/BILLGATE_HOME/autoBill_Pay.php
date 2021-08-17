<?php
	header('Content-Type: text/html; charset=euc-kr'); 

	include "config.php";

	$today=time(); 
	$today_time = date('YmdHis', $today);

	// ���� ��û �Ķ����
	$SERVICE_ID = "test" ; // �� �ڵ� �׽�Ʈ ���̵�
	$ORDER_DATE = $today_time; // �ֹ��Ͻ�, YYYYMMDDHHMMSS
	$USER_ID = "test_userId";
	$USER_NAME = "ȫ�浿";
	$ITEM_CODE = "itemCode";
	$ITEM_NAME = "��ǰ��";
	$USER_IP = "127.0.0.1";
	$PIN_NUMBER = ""; // ī���ȣ
	$EXPIRE_DATE = ""; // ��ȿ��� YYMM
	$PASSWORD = ""; // ī�� ��й�ȣ �� ���ڸ�, DEAL_TYPE �� 0014 �϶��� ���� �Ѱܾ� �ϸ� 0011 �϶��� ����("")���� �Ѱܾ� �Ѵ�.
	$CVC2 = "";
	$SOCIAL_NUMBER = ""; // DEAL_TYPE �� 0013, 0014 �϶��� ���� �Ѱܾ� �ϸ� 0011 �϶��� ����("")���� �Ѱܾ� �Ѵ�.
	$DEAL_AMOUNT = "1000"; // ���� �ݾ�(���� ��û �ÿ��� �ݾ��� 0 ���� ���� ��)
	$DEAL_TYPE = ""; // 0011, 0013, 0014 ������ ���� �Ǹ�, ��� ���� ���� �Ǵ����� ���� Ȯ���� ���� ����ڸ� ���� Ȯ�� �� �� �ִ�.
	$USING_TYPE = "0000"; // ����
	$CURRENCY = "0000"; // ����
	$EXTRA_DATA = ""; // �ΰ� ����(���� �Ķ���� �� �߰��� Ȯ�� �����Ͱ� �ʿ� �� ��� ���)
?>
<html>
<head>
<title>�� �ڵ� ���� �׽�Ʈ</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/css_admin.css" rel="stylesheet" type="text/css">
<link href="css/css_01.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkSubmit() {
	var HForm = document.payment;
	var dealType = HForm.DEAL_TYPE.options[HForm.DEAL_TYPE.selectedIndex].value;
	var orderDate = HForm.ORDER_DATE.value;
	var itemCode = HForm.ITEM_CODE.value;
	var pinNumber = HForm.PIN_NUMBER.value;
	var expireDate = HForm.EXPIRE_DATE.value;
	var passWord = HForm.PASSWORD.value;
	var socialNumber = HForm.SOCIAL_NUMBER.value;
	
	if (orderDate == "" || orderDate == null) { // ORDER_DATE üũ
		alert("ORDER_DATE �� �Է� �ϼ���.");
		return false;
	} else if (orderDate.length != "14") {
		alert("ORDER_DATE �� YYYYMMDDHHMMSS �������� ���� �ϼ���.");
		return false;
	}

	if (itemCode == "" || itemCode == null) { // ITEM_CODE üũ
		alert("ITEM_CODE �� �Է� �ϼ���.");
		return false;
	} else if (itemCode.length > "10") {
		alert("ITEM_CODE �� ���̴� 10 �Դϴ�.");
		return false;
	}
	
	if (pinNumber == "" || pinNumber == null) { // PIN_NUMBER üũ
		alert("PIN_NUMBER �� �Է� �ϼ���.");
		return false;
	} else if (pinNumber.length < "15" || pinNumber.length > "16") {
		alert("PIN_NUMBER �� Ȯ�� ���ּ���.");
		return false;
	}

	if (expireDate == "" || expireDate == null) { // EXPIRE_DATE üũ
		alert("EXPIRE_DATE �� �Է� �ϼ���.");
		return false;
	} else if (expireDate.length != "4") {
		alert("EXPIRE_DATE �� YYMM �������� ���� �ϼ���.");
		return false;
	}

	if (dealType=="") { // DEAL_TYPE üũ
		alert("DEAL_TYPE �� ���� �ϼ���.");
		return false;
	} else if (dealType=="0011") {
		if (passWord != "") {
			alert("DEAL_TYPE 0011 �̸� PASS_WORD ���� ���� ó�� �ؾ� �մϴ�.");
			return false;
		} else if (socialNumber != "") {
			alert("DEAL_TYPE 0011 �̸� SOCIAL_NUMBER ���� ���� ó�� �ؾ� �մϴ�.");
			return false;
		}
	} else if (dealType=="0013") {
		if (passWord != "") {
			alert("DEAL_TYPE 0013 �̸� PASS_WORD ���� ���� ó�� �ؾ� �մϴ�.");
			return false;
		} else if (socialNumber == "" || socialNumber == null) {
			alert("DEAL_TYPE 0013 �̸� SOCIAL_NUMBER ���� �Է� �ؾ� �մϴ�.");
			return false;
		}
	} else if (dealType=="0014") {
		if (passWord == "" || passWord == null) {
			alert("DEAL_TYPE 0014 �̸� PASS_WORD ���� �Է� �ؾ� �մϴ�.");
			return false;
		} else if (socialNumber == "" || socialNumber == null) {
			alert("DEAL_TYPE 0014 �̸� SOCIAL_NUMBER ���� �Է� �ؾ� �մϴ�.");
			return false;
		}
	}

	HForm.action = "autoBill_Certify.php";
	HForm.submit();
}

function remakeParameter(){
	var HForm = document.payment;
	var dealType = HForm.DEAL_TYPE.options[HForm.DEAL_TYPE.selectedIndex].value;
	if (dealType=="0011") {
		HForm.PASSWORD.value = "";
		HForm.SOCIAL_NUMBER.value = "";
	} else if (dealType=="0013") {
		HForm.PASSWORD.value = "";
	} 
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="payment" method="post">
<table width="500" border="0" cellpadding="0" cellspacing="0">
	<tr> 
		<td height="25" background="images/top_bg02.gif" style="padding-left:10px" class="title01"><img src="images/top_icon01.gif" align="absmiddle"> 
		# ���� ��ġ &gt;&gt; �ſ�ī�� &gt; <b>�� �ڵ� ���� �׽�Ʈ</b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">
		<table width="550" border="0" cellpadding="5" cellspacing="1" bgcolor="#B0B0B0">
			<tr>
				<td colspan="2" height="30" align="center" bgcolor="#F6F6F6"><b>���� �Է�</b></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">���񽺾��̵�(SERVICE_ID)</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $SERVICE_ID?><input type="hidden" name="SERVICE_ID" value="<?PHP echo $SERVICE_ID?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">�ֹ��Ͻ�(ORDER_DATE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $ORDER_DATE?><input type="hidden"	name="ORDER_DATE" size=20 class="input" value="<?PHP echo $ORDER_DATE?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">�� ���̵�(USER_ID)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="USER_ID" size=20 class="input" value="<?PHP echo $USER_ID?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">����(USER_NAME)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="USER_NAME" size=20 class="input" value="<?PHP echo $USER_NAME?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">��ǰ�ڵ�(ITEM_CODE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="ITEM_CODE" size=20 class="input" value="<?PHP echo $ITEM_CODE?>"></td>	
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">��ǰ��(ITEM_NAME)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="ITEM_NAME" size=20 class="input" value="<?PHP echo $ITEM_NAME?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">�� IP(USER_IP)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="USER_IP" size=20 class="input" value="<?PHP echo $USER_IP?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">ī���ȣ(PIN_NUMBER)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="PIN_NUMBER" size=20 class="input" value="<?PHP echo $PIN_NUMBER?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">��ȿ����(EXPIRE_DATE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="EXPIRE_DATE" size=20 class="input" value="<?PHP echo $EXPIRE_DATE?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">��й�ȣ(PASSWORD)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="PASSWORD" size=20 class="input" value="<?PHP echo $PASSWORD?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">CVC2(CVC2)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="CVC2" size=20 class="input" value="<?PHP echo $CVC2?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">�ֹι�ȣ or ���ι�ȣ(SOCIAL_NUMBER)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="SOCIAL_NUMBER" size=20 class="input" value="<?PHP echo $SOCIAL_NUMBER?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">�����ݾ�(DEAL_AMOUNT)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="DEAL_AMOUNT" size=20 class="input" value="<?PHP echo $DEAL_AMOUNT?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">�������(DEAL_TYPE)</td>
				<td bgcolor="#FFFFFF">&nbsp;
				<select name="DEAL_TYPE" Onchange = "remakeParameter();">
					<option value="" >���� �ϼ���</option>
					<option value="0011">0011(ī���ȣ+��ȿ����)</option>
					<option value="0013">0013(ī���ȣ+��ȿ����+�������)</option>
					<option value="0014">0014(ī���ȣ+��ȿ����+�������+��й�ȣ)</option>
				</select>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">����/�ؿ�ī�屸��(USING_TYPE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="USING_TYPE" size=20 class="input" value="<?PHP echo $USING_TYPE?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">������ȭ����(CURRENCY)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="CURRENCY" size=20 class="input" value="<?PHP echo $CURRENCY?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">�ΰ�����(EXTRA_DATA)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="EXTRA_DATA" size=20 class="input" value="<?PHP echo $EXTRA_DATA?>"></td>
			</tr>
		</table>
		<table width="550" border="0" cellpadding="5" cellspacing="1" bgcolor="#B0B0B0">	
			<tr>
				<td align="center" bgcolor="#FFFFFF" colspan="2"><img src="images/bt_submit01.gif" OnClick="javascript:checkSubmit();" style="cursor: hand;"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
</table>
</form>
</body>
</html>
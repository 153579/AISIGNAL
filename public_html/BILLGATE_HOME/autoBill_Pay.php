<?php
	header('Content-Type: text/html; charset=euc-kr'); 

	include "config.php";

	$today=time(); 
	$today_time = date('YmdHis', $today);

	// 인증 요청 파라미터
	$SERVICE_ID = "test" ; // 월 자동 테스트 아이디
	$ORDER_DATE = $today_time; // 주문일시, YYYYMMDDHHMMSS
	$USER_ID = "test_userId";
	$USER_NAME = "홍길동";
	$ITEM_CODE = "itemCode";
	$ITEM_NAME = "상품명";
	$USER_IP = "127.0.0.1";
	$PIN_NUMBER = ""; // 카드번호
	$EXPIRE_DATE = ""; // 유효년월 YYMM
	$PASSWORD = ""; // 카드 비밀번호 앞 두자리, DEAL_TYPE 이 0014 일때만 값을 넘겨야 하며 0011 일때는 공백("")으로 넘겨야 한다.
	$CVC2 = "";
	$SOCIAL_NUMBER = ""; // DEAL_TYPE 이 0013, 0014 일때만 값을 넘겨야 하며 0011 일때는 공백("")으로 넘겨야 한다.
	$DEAL_AMOUNT = "1000"; // 결제 금액(인증 요청 시에는 금액이 0 으로 고정 됨)
	$DEAL_TYPE = ""; // 0011, 0013, 0014 값으로 설정 되며, 어떠한 값이 셋팅 되는지에 대한 확인은 영업 담당자를 통해 확인 할 수 있다.
	$USING_TYPE = "0000"; // 고정
	$CURRENCY = "0000"; // 고정
	$EXTRA_DATA = ""; // 부가 정보(결제 파라미터 외 추가로 확인 데이터가 필요 한 경우 사용)
?>
<html>
<head>
<title>월 자동 과금 테스트</title>
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
	
	if (orderDate == "" || orderDate == null) { // ORDER_DATE 체크
		alert("ORDER_DATE 를 입력 하세요.");
		return false;
	} else if (orderDate.length != "14") {
		alert("ORDER_DATE 는 YYYYMMDDHHMMSS 형식으로 구성 하세요.");
		return false;
	}

	if (itemCode == "" || itemCode == null) { // ITEM_CODE 체크
		alert("ITEM_CODE 를 입력 하세요.");
		return false;
	} else if (itemCode.length > "10") {
		alert("ITEM_CODE 의 길이는 10 입니다.");
		return false;
	}
	
	if (pinNumber == "" || pinNumber == null) { // PIN_NUMBER 체크
		alert("PIN_NUMBER 를 입력 하세요.");
		return false;
	} else if (pinNumber.length < "15" || pinNumber.length > "16") {
		alert("PIN_NUMBER 를 확인 해주세요.");
		return false;
	}

	if (expireDate == "" || expireDate == null) { // EXPIRE_DATE 체크
		alert("EXPIRE_DATE 를 입력 하세요.");
		return false;
	} else if (expireDate.length != "4") {
		alert("EXPIRE_DATE 는 YYMM 형식으로 구성 하세요.");
		return false;
	}

	if (dealType=="") { // DEAL_TYPE 체크
		alert("DEAL_TYPE 을 선택 하세요.");
		return false;
	} else if (dealType=="0011") {
		if (passWord != "") {
			alert("DEAL_TYPE 0011 이면 PASS_WORD 값을 공백 처리 해야 합니다.");
			return false;
		} else if (socialNumber != "") {
			alert("DEAL_TYPE 0011 이면 SOCIAL_NUMBER 값을 공백 처리 해야 합니다.");
			return false;
		}
	} else if (dealType=="0013") {
		if (passWord != "") {
			alert("DEAL_TYPE 0013 이면 PASS_WORD 값을 공백 처리 해야 합니다.");
			return false;
		} else if (socialNumber == "" || socialNumber == null) {
			alert("DEAL_TYPE 0013 이면 SOCIAL_NUMBER 값을 입력 해야 합니다.");
			return false;
		}
	} else if (dealType=="0014") {
		if (passWord == "" || passWord == null) {
			alert("DEAL_TYPE 0014 이면 PASS_WORD 값을 입력 해야 합니다.");
			return false;
		} else if (socialNumber == "" || socialNumber == null) {
			alert("DEAL_TYPE 0014 이면 SOCIAL_NUMBER 값을 입력 해야 합니다.");
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
		# 현재 위치 &gt;&gt; 신용카드 &gt; <b>월 자동 과금 테스트</b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">
		<table width="550" border="0" cellpadding="5" cellspacing="1" bgcolor="#B0B0B0">
			<tr>
				<td colspan="2" height="30" align="center" bgcolor="#F6F6F6"><b>정보 입력</b></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">서비스아이디(SERVICE_ID)</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $SERVICE_ID?><input type="hidden" name="SERVICE_ID" value="<?PHP echo $SERVICE_ID?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">주문일시(ORDER_DATE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<?PHP echo $ORDER_DATE?><input type="hidden"	name="ORDER_DATE" size=20 class="input" value="<?PHP echo $ORDER_DATE?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">고객 아이디(USER_ID)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="USER_ID" size=20 class="input" value="<?PHP echo $USER_ID?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">고객명(USER_NAME)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="USER_NAME" size=20 class="input" value="<?PHP echo $USER_NAME?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">상품코드(ITEM_CODE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="ITEM_CODE" size=20 class="input" value="<?PHP echo $ITEM_CODE?>"></td>	
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">상품명(ITEM_NAME)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="ITEM_NAME" size=20 class="input" value="<?PHP echo $ITEM_NAME?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">고객 IP(USER_IP)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="USER_IP" size=20 class="input" value="<?PHP echo $USER_IP?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">카드번호(PIN_NUMBER)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="PIN_NUMBER" size=20 class="input" value="<?PHP echo $PIN_NUMBER?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">유효년일(EXPIRE_DATE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="EXPIRE_DATE" size=20 class="input" value="<?PHP echo $EXPIRE_DATE?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">비밀번호(PASSWORD)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="PASSWORD" size=20 class="input" value="<?PHP echo $PASSWORD?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">CVC2(CVC2)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="CVC2" size=20 class="input" value="<?PHP echo $CVC2?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">주민번호 or 법인번호(SOCIAL_NUMBER)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="SOCIAL_NUMBER" size=20 class="input" value="<?PHP echo $SOCIAL_NUMBER?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">결제금액(DEAL_AMOUNT)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text" name="DEAL_AMOUNT" size=20 class="input" value="<?PHP echo $DEAL_AMOUNT?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">인증방식(DEAL_TYPE)</td>
				<td bgcolor="#FFFFFF">&nbsp;
				<select name="DEAL_TYPE" Onchange = "remakeParameter();">
					<option value="" >선택 하세요</option>
					<option value="0011">0011(카드번호+유효년일)</option>
					<option value="0013">0013(카드번호+유효년일+생년월일)</option>
					<option value="0014">0014(카드번호+유효년일+생년월일+비밀번호)</option>
				</select>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">국내/해외카드구분(USING_TYPE)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="USING_TYPE" size=20 class="input" value="<?PHP echo $USING_TYPE?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">승인통화구분(CURRENCY)</td>
				<td bgcolor="#FFFFFF">&nbsp;<input type="text"	name="CURRENCY" size=20 class="input" value="<?PHP echo $CURRENCY?>"></td>
			</tr>
			<tr>
				<td width="250" align="center" bgcolor="#F6F6F6">부가정보(EXTRA_DATA)</td>
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
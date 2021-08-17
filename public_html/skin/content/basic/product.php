<div class="top_heading  style_heading_2_out">
    <div class="top_site_main style_heading_2" style="color: #ffffff;">
        <img src="<?php echo G5_IMG_URL?>/top-banner.jpg" alt="">
        <span class="overlay-top-header"></span>
        <div class="page-title-wrapper">
            <div class="banner-wrapper container">
            </div>
        </div>
        <div class="breadcrumbs-wrapper">
            <div class="container">
            </div>
        </div>
    </div>
</div>

<?php

	$BANK_NUM = "301-0206-5475-11";
	$BANK_NAME = "농협";
	$BANK_ME = "뉴비코 주식회사";
	$BANK_STR = "계좌번호 : ".$BANK_NUM." , 은행명 : ".$BANK_NAME." , 예금주명 : ".$BANK_ME;

	//라이센스
	$sql = "select * from g5_order where mb_id = '{$member['mb_id']}' and ls_type = '1'";
	$PC = sql_fetch($sql);

	$sql = "select * from g5_order where mb_id = '{$member['mb_id']}' and ls_type = '2'";
	$MB = sql_fetch($sql);

	$sql = "select * from g5_order where mb_id = '{$member['mb_id']}' and ls_type = '3'";
	$PMB = sql_fetch($sql);

	$sql = "select * from g5_order where mb_id = '{$member['mb_id']}' and ls_type = '4'";
	$TEST = sql_fetch($sql);

	$sql = "select * from g5_order where mb_id = '{$member['mb_id']}' and ls_type != '4'";
	$rtn = sql_query($sql);

	$is_ls = ($rtn->num_rows >= 0 ) ? true : false;

	$PC['ls_type'] = isset($PC['ls_type']) ? trim($PC['ls_type']) : "";
	$MB['ls_type'] = isset($MB['ls_type']) ? trim($MB['ls_type']) : "";
	$PMB['ls_type'] = isset($PMB['ls_type']) ? trim($PMB['ls_type']) : "";
	$TEST['ls_type'] = isset($TEST['ls_type']) ? trim($TEST['ls_type']) : "";
	$TEST['ls_type'] = isset($TEST['ls_type']) ? trim($TEST['ls_type']) : "";
	
	//모든결제가 된것
	$ndate = date("Y-m-d H:i:s");
	$sql = "select * from g5_payment where mb_id = '{$member['mb_id']}' and pm_next_dttm < '{$ndate}' and pm_use_yn = 'Y' and pm_del_yn = 'N' "; 
	$pm_rtn1 = sql_query($sql);
	$pm_ing1 = sql_fetch_array($pm_rtn1);
	
	//결제중인것
	$sql = "select * from g5_payment where mb_id = '{$member['mb_id']}' and pm_use_yn = 'N' and pm_del_yn = 'N'"; 
	$pm_rtn2 = sql_query($sql);
	$pm_ing2 = sql_fetch_array($pm_rtn2);


	//월정액
	if($pm_rtn1->num_rows <= 0 && $pm_rtn2->num_rows <= 0){
		$month_str = "결제하신 정액권이 없습니다. 에이아이시그널은 정액권 결제후 사용가능합니다.";
	}else if($pm_rtn1->num_rows <= 0 && $pm_rtn2->num_rows > 0){
		$month_str = $BANK_STR." ".number_format($pm_ing2['pm_price'])."원";		
	}else if($pm_rtn1->num_rows > 0 && $pm_ing1['pm_payment'] == 'iche'){
		$month_str = "월정액권 : ".$pm_ing1['pm_iche_month']."월권 / 다음 결제일 :". $pm_ing1['pm_next_dttm'];		
	}else if($pm_rtn1->num_rows > 0 && $pm_rtn1['pm_payment'] == 'card'){
		$month_str = "월정액권 : 카드 / 다음 결제일 :". $pm_ing1['pm_next_dttm'];
	}
	
?>

<div id="mypage_product">
    <h1 class="pu_title" style="margin-bottom:30px">패키지</h1>
    <table border="1" bordercolor="" width="600" height="300" align="center" style="margin-bottom:22px;">
        <tr bgcolor="#fccf00" align="center">
            <p>
                <td colspan="2" class="top_text_name"></td>
            </p>
        </tr>
        <tr>
            <td class="bd-left">PC+MOBILE 패키지</td>
            <td class="bd-right">
				<?php if( $PMB['ls_type'] == "" && (($PC['ls_type'] == "") && ($PMB['ls_type'] == ""))){ ?>
					<p></p>
					<button class="product_choice_btn" onclick="license_buy('3');">구매하기</button>					
				<?php }else if( ($PMB['ls_type'] != "") && $PMB['ls_use'] == 'N') { ?>
					<P><?php echo $BANK_STR. "입금액 : 4,500,000원"; ?></P>
					<button class="product_choice_btn1">입금 대기중</button>
					<button class="product_choice_btn1" onclick="license_cancel('3');">취소</button>	
				<?php }else if( $PMB['ls_use'] == 'Y') { ?>
					<P>라이센스 구매가 완료되었습니다. <?php if($pm_rtn1->num_rows <= 0) { echo "하단의 월회비를 결제해주세요."; }?></P>
					<button class="product_choice_btn">입금완료</button>	
				<?php }?>
            </td>
        </tr>
        <tr>
            <td class="bd-left">PC 패키지</td>
            <td class="bd-right">
				<?php if( $PMB['ls_type'] == "" && $PC['ls_type'] == ""){ ?>
					<p></p>
					<button class="product_choice_btn" onclick="license_buy('1');">구매하기</button>					
				<?php }else if( ($PC['ls_type'] != "") && $PC['ls_use'] == 'N') { ?>
					<P><?php echo $BANK_STR. "입금액 : 3,000,000원"; ?></P>
					<button class="product_choice_btn1">입금 대기중</button>	
					<button class="product_choice_btn1" onclick="license_cancel('1');">취소</button>	
				<?php }else if( $PC['ls_use'] == 'Y') { ?>
					<P>라이센스 구매가 완료되었습니다. <?php if($pm_rtn1->num_rows <= 0) { echo "하단의 월회비를 결제해주세요."; }?></P>
					<button class="product_choice_btn">입금완료</button>	
				<?php }?>
            </td>
        </tr>
        <tr>
            <td class="bd-left">MOBILE 패키지</td>
            <td class="bd-right">
				<?php if( $PMB['ls_type'] == "" && $MB['ls_type'] == ""){ ?>
					<p></p>
					<button class="product_choice_btn" onclick="license_buy('2');">구매하기</button>					
				<?php }else if( ($MB['ls_type'] != "") && $MB['ls_use'] == 'N') { ?>
					<P><?php echo $BANK_STR. "입금액 : 3,000,000원"; ?></P>
					<button class="product_choice_btn1">입금 대기중</button>
					<button class="product_choice_btn1" onclick="license_cancel('2');">취소</button>	
				<?php }else if( $MB['ls_use'] == 'Y') { ?>
					<P>라이센스 구매가 완료되었습니다. <?php if($pm_rtn1->num_rows <= 0) { echo "하단의 월회비를 결제해주세요."; }?></P>
					<button class="product_choice_btn">입금완료</button>	
				<?php }?>
            </td>
        </tr>
        <tr border="1">
            <td class="bd-left">체험하기(7일)</td>
            <td class="bd-right">
                <!-- <P>구입일 : YYYY-MM-DD</P>-->
				<?php if( $PMB['ls_type'] == "" && $TEST['ls_type'] == ""){ ?>
					<button class="product_choice_btn" onclick="license_buy('4');">구매하기</button>					
				<?php }else if( ($TEST['ls_type'] == '4') && $TEST['ls_use'] == 'Y') { 
						if(strtotime($TEST['ls_dttm']) > strtotime(date('Y-m-d H:i:s'))){?>
							<P><?php echo $TEST['ls_dttm']." 까지 사용가능"; ?></P>
							<button class="product_choice_btn">사용가능</button>	
				<?php }else{ ?>
							<P><?php echo $TEST['ls_dttm']." 까지 사용가능"; ?></P>
							<button class="product_choice_btn">사용종료</button>	
				<?php } }?>
				
            </td>
        </tr>
    </table>

    <h1 class="pu_title" style="margin-bottom:30px">월정액</h1>
    <table border="1" bordercolor="" width="600" height="150" align="center" style="margin-bottom:22px;">
        <tr bgcolor="#fccf00" align="center">
            <p>
                <td colspan="2" class="top_text_name"></td>
            </p>
        </tr>
        <tr>
            <td class="bd-left">월정액 상태</td>
            <td class="bd-right">
				<p><?php echo $month_str;?> </p>
            </td>
        </tr>
		<tr>
            <td class="bd-left">월정액 신청하기</td>
            <td class="bd-right">
				<?php if($pm_rtn2->num_rows <= 0) { ?>
                <button class="product_choice_btn" onclick="payment_iche('12');" >1년권 계좌이체</button>
                <button class="product_choice_btn" onclick="payment_iche('6');" >6개월권 계좌이체</button>
                <!-- <button class="product_choice_btn">휴대폰 정기결제</button> -->
                <button class="product_choice_btn" onclick="msg_alert();">신용카드 정기결제</button>
				<?php }else if($pm_rtn1->num_rows > 0) { ?>
				<button class="product_choice_btn">구독중</button>
                <button class="product_choice_btn" onclick="payment_cancel();">구독취소</button>
				<?php }else if($pm_rtn2->num_rows > 0) { ?>
				<button class="product_choice_btn">결제대기중</button>
                <button class="product_choice_btn" onclick="payment_cancel();">결제취소</button>
				<?php }?>
            </td>
        </tr>
    </table>
</div>




<script>

	var is_ls = "<?php echo $is_ls; ?>";

	console.log(is_ls);

	function license_buy(type){

		var form = document.createElement("form");
		form.setAttribute("charset", "UTF-8");
		form.setAttribute("method", "Post");
		form.setAttribute("action", "http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/order_update.php");

		var hiddenField = document.createElement("input");
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", "type");
		hiddenField.setAttribute("value", type);
		
		form.appendChild(hiddenField);

		document.body.appendChild(form);
		form.submit();
	}

	function license_cancel(type){

		var form = document.createElement("form");
		form.setAttribute("charset", "UTF-8");
		form.setAttribute("method", "Post");
		form.setAttribute("action", "http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/order_cancel.php");

		var hiddenField = document.createElement("input");
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", "type");
		hiddenField.setAttribute("value", type);
		
		form.appendChild(hiddenField);

		document.body.appendChild(form);
		form.submit();
	}

	function payment_iche(p_month){
		if(is_ls == 1 || is_ls == true){
			$.ajax({
				type : "post",
				url : "http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/ajax.iche.php",
				data : { month : p_month},
				dataType :"json",
				success : function(data) {
					if(data.result == "00"){
						alert("신청완료. 계좌 정보가 문자로 발송되었습니다.");
						location.href = "./content.php?co_id=product";
					}else if(data.result == "405"){
						alert("이미 신청한 데이터가 있습니다.");
					}else if(data.result == "406") {
						alert("라이센스를 보유하셔야 월회비 결제가 가능합니다.");
					}else {
						alert("신청실패. 관리자에게 문의해주세요.");
					}
				},
				error : function(xhr, textStaus, errorThrown) {
					console.log(xhr);
					console.log(textStaus);
					console.log(errorThrown);
				}
			});
		}else {
			alert("최소 한개 이상의 라이센스를 취득하셔야 결제 가능합니다.");
		}
	}

	// 구독취소
	function payment_cancel() {

		if(confirm("결제 취소 진행하시겠습니까?")){
			$.ajax({
				type : "post",
				url : "http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/ajax.payment_cancel.php",
				data : { type : "iche"},
				dataType :"json",
				success : function(data) {
					if(data.result == "00"){
						alert("신청하신 회비 결제가 취소 되었습니다.");
						location.href = "./content.php?co_id=product";
					}else {
						alert("신청실패. 관리자에게 문의해주세요.");
					}
				},
				error : function(xhr, textStaus, errorThrown) {
					console.log(xhr);
					console.log(textStaus);
					console.log(errorThrown);
				}
			});
		}		
	}

	// 구독취소
	function payment_all_cancel() {

		if(confirm("구독 취소 진행하시겠습니까?")){
			$.ajax({
				type : "post",
				url : "http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/ajax.payment_cancel.php",
				data : { type : "all"},
				dataType :"json",
				success : function(data) {
					if(data.result == "00"){
						alert("신청하신 회비 결제가 취소 되었습니다.");
						location.href = "./content.php?co_id=product";
					}else {
						alert("신청실패. 관리자에게 문의해주세요.");
					}
				},
				error : function(xhr, textStaus, errorThrown) {
					console.log(xhr);
					console.log(textStaus);
					console.log(errorThrown);
				}
			});
		}		
	}
	

	function msg_alert() {
		alert("개발중입니다.");
	}
</script>




<!-- <div id="mypage_popup">
    <h1 class="pu_title">패키지 구매</h1>
    <div id="mypage_cont">
        <div class="cont_product">
            <p class="mp_pu_title">PC버전</p>
            <p>가격 : 3,000,000원</p>
            <p>DB증권 API 사용</p>
            <p class="mp_pu_red">구입일 : yyyy-mm-dd</p>
            <button type="button" class="bt_product">구매하기</button>
        </div>
        <div class="cont_product">
            <p class="mp_pu_title">MOBILE버전</p>
            <p>가격 : 3,000,000원</p>
            <p>이베스트 API 사용</p>
            <p class="mp_pu_red">구입일 : yyyy-mm-dd</p>
            <button type="button" class="bt_product">구매하기</button>
        </div>
        <div class="cont_product">
            <p class="mp_pu_title">PC+MOBILE</p>
            <p>가격 : 4,500,000원</p>
            <P>DB증권, 이베스트 API 사용</P>
            <p class="mp_pu_red">구입일 : yyyy-mm-dd</p>
            <button type="button" class="bt_product">구매하기</button>
        </div>
        <div class="cont_product">
            <p class="mp_pu_title">무료체험(7일)</p>
            <p>일주일 무료체험</p>
            <P>DB증권, 이베스트 API 사용</P>
            <p class="mp_pu_red">남은기간 : yyyy-mm-dd</p>
            <button type="button" class="bt_product">신청하기</button>
        </div>
    </div>
    <h1 class="pu_title1">월정액 결제</h1>
    <div id="mypage_cont1">
        <div class="cont_product">
            <p class="mp_pu_title">1년권 계좌이체</p>
            <p>가격 : 1,200,000원</p>
            <p>월정액 1년권 결제</p>
            <button type="button" class="bt_product">선택하기</button>
        </div>
        <div class="cont_product">
            <p class="mp_pu_title">6개월 계좌이체</p>
            <p>가격 : 600,000원</p>
            <p>월정액 6개월권 결제</p>
            <button type="button" class="bt_product">선택하기</button>
        </div>
        <div class="cont_product">
            <p class="mp_pu_title">휴대폰 정기결제</p>
            <p>가격 : 100,000/달</p>
            <P>매 달 휴대폰 자동결제</P>
            <button type="button" class="bt_product">선택하기</button>
        </div>
        <div class="cont_product">
            <p class="mp_pu_title">신용카드 정기결제</p>
            <p>가격 : 100,000/달</p>
            <P>매 달 신용카드 자동결제</P>
            <button type="button" class="bt_product">선택하기</button>
        </div>
    </div>
    <div id="cs_bt">
        <button type="button" class="cs_bt">취소하기</button>
    </div>
</div> -->
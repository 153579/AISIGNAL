<?php
$sub_menu = '900100';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '회원관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from g5_member ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 100;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * {$sql_common} {$sql_search} {$sql_order} limit $from_record, {$config['cf_page_rows']} ";
$result = sql_query($sql);
?>

<div class="local_ov01 local_ov">
    <?php if ($page > 1) {?><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">처음으로</a><?php } ?>
    <span class="btn_ov01"><span class="ov_txt">전체 내용</span><span class="ov_num"> <?php echo $total_count; ?>건</span></span>
	<span class="btn_ov01 btn_excel"><a href="./excel_member.php">엑셀 다운로드</a></span>
	<span class="btn_ov01 btn_excel"><a href="./member_insert_form.php">회원추가</a></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>이메일</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="btn_fixed_top">
    <!--<a href="./contentform.php" class="btn btn_01">내용 추가</a>-->
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col"><?php echo subject_sort_link('mb_datetime') ?>가입일시</a></th>
        <th scope="col"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
        <th scope="col"><?php echo subject_sort_link('mb_hp') ?>전화번호</a></th>
        <th scope="col"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th scope="col"><?php echo subject_sort_link('mb_email') ?>이메일</a></th>
        <th scope="col">라이센스종류</th>
        <th scope="col">구입일자</th>
        <th scope="col">구입금액<br>(라이센스 / 월회비)</th>
        <th scope="col">결재구분 (월회비)</th>
		<th scope="col">종료일<br>(월회비 / 다음결제일)</th>
        <th scope="col">AI시그널 상태</th>
		<th scope="col"><?php echo subject_sort_link('mb_email') ?>최근접속일</a></th>
		<!--
        <th scope="col">ID</th>
		<th scope="col">이름</th>
		<th scope="col">결제상태</th>
		<th scope="col">결제타입</th>
		<th scope="col">첫결제일</th>
		<th scope="col">다음결제일</th>
		<th scope="col">테스트날짜</th>
		-->
		<!--
		<th scope="col">결제기능(카드))</th>
		<th scope="col">결제기능(현금))</th>
		-->
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
		if($row['mb_id'] == "admin") continue;

		$sql = "select * from g5_order where ls_type = '1' and mb_id = '{$row['mb_id']}'";
		$type1 = sql_fetch($sql);

		$sql = "select * from g5_order where ls_type = '2' and mb_id = '{$row['mb_id']}'";
		$type2 = sql_fetch($sql);

		$sql = "select * from g5_order where ls_type = '3' and mb_id = '{$row['mb_id']}'";
		$type3 = sql_fetch($sql);

		$sql = "select * from g5_order where ls_type = '4' and mb_id = '{$row['mb_id']}'";
		$type4 = sql_fetch($sql);

		$ls_type = "";
		$ls_dttm = "";
		$ls_price = "";

		if($type3['ls_use'] == 'Y' || ($type1['ls_use'] == 'Y' && $type2['ls_use'] == 'Y')){
			$ls_type = "PC+Mobile";
			$ls_dttm = $type3['ls_dttm'];
			$ls_price = $type3['ls_use'] == 'Y' ? $type3['ls_price'] : ($type1['ls_price'] + $type2['ls_price']);
		}else if($type1['ls_use'] == 'Y'){
			$ls_type = "PC";
			$ls_dttm = $type1['ls_dttm'];
			$ls_price = $type1['ls_price'];
		}else if($type2['ls_use'] == 'Y'){
			$ls_type = "Mobile";
			$ls_dttm = $type2['ls_dttm'];
			$ls_price = $type2['ls_price'];
		}else if($type4['ls_use'] == 'Y'){
			$ls_type = "TEST";
			$ls_dttm = $type4['ls_dttm'];
			$ls_price = $type4['ls_price'];
		}else {
			$ls_type = "미구매";
		}
		
		$ls_price = number_format($ls_price);

		$pm_rtn = "";
		if($ls_type != "미구매"){
			$sql = "select * from g5_payment where mb_id = '{$row['mb_id']}' and pm_del_yn = 'N' and pm_use_yn = 'Y'";
			$rtn = sql_query($sql);
			if($rtn->num_rows > 0){
				$pm_rtn = sql_fetch_array($rtn);
				$ls_price .= " / ".$pm_rtn['pm_price'];
				if($pm_rtn['pm_payment'] == "iche" ){
					$pm_rtn['pm_payment'] = "계좌이체";
				}else if($pm_rtn['pm_payment'] == "card" ){
					$pm_rtn['pm_payment'] = "카드";
				}
			}
		}

		if($row['mb_9'] == 'iche'){
			$row['mb_9'] = "계좌이체(".$row['mb_4']."개월)";
		}else if($row['mb_9'] == 'card'){
			$row['mb_9'] = "카드";
		}

		$ndate = strtotime(date('Y-m-d H:i:s'));
		$check = "";
		if($ndate < strtotime($row['mb_8'])){
			$check = "사용중";
		}else {
			$check = "미사용";
		}


		
    ?>
    <tr class="<?php echo $bg; ?>">
		<td class="td_id"><?php echo $row['mb_datetime']; ?></td>
		<td class="td_id"><?php echo $row['mb_name']; ?></td>
		<td class="td_id"><?php echo $row['mb_hp']; ?></td>
		<td class="td_id"><button onclick="member_info('<?php echo $row['mb_id']; ?>');" style="padding:3px;"><?php echo $row['mb_id']; ?></button></td>
		<td class="td_id"><?php echo $row['mb_email']; ?></td>
		<td class="td_id"><?php echo $ls_type; ?></td>
		<td class="td_id"><?php echo $ls_dttm; ?></td>
		<td class="td_id"><?php echo $ls_price; ?></td>
		<td class="td_id"><?php echo $pm_rtn['pm_payment'] ?></td>
		<td class="td_id"><?php echo $pm_rtn['pm_next_dttm'] ?></td>
		<td class="td_id"><?php echo $check; ?></td>
		<td class="td_id"><?php echo $row['mb_today_login']; ?></td>
		<!--
        <td class="td_id"><?php echo $row['mb_id']; ?></td>
		<td class="td_id"><?php echo $row['mb_name']; ?></td>
		<td class="td_id">
			<?php if($row['mb_6'] == 'N') { ?>
			<span>미확인</span>
			<?php }else { ?>
			<span>확인</span>
			<?php } ?>
		</td>
		<td class="td_id">
			<?php if($row['mb_9'] == 'iche') { ?>
			<span>현금 (<?php echo $row['mb_4']."개월";?>)</span>
			<?php }else { ?>
			<span>카드</span>
			<?php } ?>
		</td>
		
		<td class="td_id"><?php echo $row['mb_7']; ?></td>
		<td class="td_id"><?php echo $row['mb_8']; ?></td>
		<td class="td_id"><?php echo $row['mb_10']; ?></td>
		-->
		<!--
		<td class="td_id">
			<?php if($row['mb_6'] == 'N') { ?>
			<button type="button" class="btn_pay1" onclick="payment('ok','card','<?php echo $row['mb_id']; ?>');">카드결제</button>
			<?php }else { ?>
			<button type="button" class="btn_pay3" onclick="payment('cancel','card','<?php echo $row['mb_id']; ?>');">카드취소</button>		
			<?php }?>
		</td>
		<td class="td_id">
			<?php if($row['mb_6'] == 'N') { ?>
			<button type="button" class="btn_pay2" onclick="payment('ok','iche','<?php echo $row['mb_id']; ?>');">입금확인</button>
			<?php }else { ?>
			<button type="button" class="btn_pay4" onclick="payment('cancel','iche','<?php echo $row['mb_id']; ?>');">입금취소</button>
			<?php }?>
		</td>
		-->
    </tr>
    <?php
    }
    if ($i == 0) {
        echo '<tr><td colspan="3" class="empty_table">자료가 한건도 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>

<script>

	function payment(type , paymethod, mb_id){
		
		if(confirm("정말 결제하시겠습니까?")){
			location.href = "./member_pay_update.php?paymethod="+paymethod+"&type="+type+"&mb_id="+mb_id;
		}

	}

	function member_info(mb_id){
		var win = window.open("./member_info.php?mb_id="+mb_id, "MemberPopup", "width:800, height=800");
	}

</script>



<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>

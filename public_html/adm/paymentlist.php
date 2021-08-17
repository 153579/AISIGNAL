<?php
$sub_menu = '900400';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '월회비 관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from g5_payment ";

$sql_search = " where (1) and pm_del_yn = 'N'";
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
    $sql_search .= " )";
}

if (!$sst) {
    $sst = "pm_dttm";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";

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
	<!--<span class="btn_ov01 btn_excel"><a href="./excel_order.php">엑셀 다운로드</a></span>-->
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
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
        <th scope="col"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th scope="col"><?php echo subject_sort_link('ls_type') ?>결제타입</a></th>
		<th scope="col"><?php echo subject_sort_link('ls_use') ?>현금(월)</a></th>
		<th scope="col"><?php echo subject_sort_link('ord_dttm') ?>결제금액</a></th>
		<th scope="col"><?php echo subject_sort_link('ls_dttm') ?>결제신청일</a></th>
		<th scope="col"><?php echo subject_sort_link('ord_dttm') ?>결제승인일</a></th>
		<th scope="col"><?php echo subject_sort_link('ord_dttm') ?>다음결제일</a></th>
		<th scope="col"><?php echo subject_sort_link('ord_dttm') ?>승인여부(결제여부)</a></th>

	</tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);

		switch($row['pm_payment']){
			case 'iche' :
				$row['pm_payment'] = "현금";
				$row['pm_iche_month'] = $row['pm_iche_month']."개월";
				if($row['pm_use_yn'] == 'N'){
					$row['pm_use_yn'] = '<button class="btn btn_01" onclick="payment_update('.$row['pm_id'].', `payment`);">입금처리</button>';
				}
			break;
			case 'card' :
				$row['pm_payment'] = "카드";
			break;
			case 'mobile' :
				$row['pm_payment'] = "모바일";
			break;
		}

    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_id"><?php echo $row['mb_id']; ?></td>
		<td class="td_id"><?php echo $row['pm_payment']; ?></td>
		<td class="td_id"><?php echo $row['pm_iche_month']; ?></td>
		<td class="td_id"><?php echo $row['pm_price']; ?></td>
		<td class="td_id"><?php echo $row['pm_dttm']; ?></td>
		<td class="td_id"><?php echo $row['pm_start_dttm']; ?></td>
		<td class="td_id"><?php echo $row['pm_next_dttm']; ?></td>
		<td class="td_id"><?php if($row['pm_use_yn'] == 'Y') { echo "결제완료"; }else { echo $row['pm_use_yn']; } ?></td>
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
	function payment_update(idx , type) {
	
		var check = false;
		if(type == "payment"){
			check = confirm("입금 확인 시키겠습니까?");
		}else {
			check = confirm("입금 취소 시키겠습니까?");
		}
		
		if(check){
			location.href = "./payment_update.php?pm_id="+idx+"&type="+type;
		}
		console.log(check);
	}
</script>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>

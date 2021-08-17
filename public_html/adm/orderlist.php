<?php
$sub_menu = '900300';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '라이센스 관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from g5_order ";

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
    $sst = "ord_dttm";
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
	<span class="btn_ov01 btn_excel"><a href="./excel_order.php">엑셀 다운로드</a></span>
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
		<th scope="col"><?php echo subject_sort_link('ls_type') ?>타입</a></th>
		<th scope="col"><?php echo subject_sort_link('ls_use') ?>입금상태</a></th>
		<th scope="col"><?php echo subject_sort_link('ls_dttm') ?>입금일</a></th>
		<th scope="col"><?php echo subject_sort_link('ord_dttm') ?>신청일</a></th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);

		switch($row['ls_type']){
			case '1' :
				$row['ls_type'] = "PC";
			break;
			case '2' :
				$row['ls_type'] = "Mobile";
			break;
			case '3' :
				$row['ls_type'] = "PC + Mobile";
			break;
			case '4' :
				$row['ls_type'] = "TEST";
			break;
		}

		switch($row['ls_use']){
			case 'Y':;
				$ls_use = '<button class="btn btn_01" onclick="license_update('.$row['ord_id'].', `N`);">입금완료</button>';
			break;
			case 'N':
				$ls_use = '<button class="btn btn_01" onclick="license_update('.$row['ord_id'].', `Y`);">미확인</button>';
			break;
		}

    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_id"><?php echo $row['mb_id']; ?></td>
		<td class="td_id"><?php echo $row['ls_type']; ?></td>
		<td class="td_id"><?php echo $ls_use; ?></td>
		<td class="td_id"><?php echo $row['ls_dttm']; ?></td>
		<td class="td_id"><?php echo $row['ord_dttm']; ?></td>
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
	function license_update(idx , type) {
	
		var check = false;
		if(type == "Y"){
			check = confirm("입금 확인 시키겠습니까?");
		}else {
			check = confirm("입금 취소 시키겠습니까?");
		}
		
		if(check){
			location.href = "./order_update.php?ord_id="+idx+"&type="+type;
		}
		console.log(check);
	}
</script>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>

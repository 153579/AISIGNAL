<?php
include_once('./_common.php');
include_once(G5_LIB_PATH."/PHPExcel/Classes/PHPExcel.php");

//엑셀 객체 생성
$objPHPExcel = new PHPExcel();

//회원 정보 불러오기

$sql = "select * from g5_member where mb_id != 'admin'";
$rtn = sql_query($sql);

$arrMember = array();

while($row = sql_fetch_array($rtn)){

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
		$row['ls_type'] = "PC+Mobile";
		$row['ls_dttm'] = $type3['ls_dttm'];
		$row['ls_price'] = $type3['ls_use'] == 'Y' ? $type3['ls_price'] : ($type1['ls_price'] + $type2['ls_price']);
	}else if($type1['ls_use'] == 'Y'){
		$row['ls_type'] = "PC";
		$row['ls_dttm'] = $type1['ls_dttm'];
		$row['ls_price'] = $type1['ls_price'];
	}else if($type2['ls_use'] == 'Y'){
		$row['ls_type'] = "Mobile";
		$row['ls_dttm'] = $type2['ls_dttm'];
		$row['ls_price'] = $type2['ls_price'];
	}else if($type4['ls_use'] == 'Y'){
		$row['ls_type'] = "TEST";
		$row['ls_dttm'] = $type4['ls_dttm'];
		$row['ls_price'] = $type4['ls_price'];
	}else {
		$row['ls_type'] = "미구매";
	}
	
	if($row['mb_9'] == 'iche'){
		$row['mb_9'] = "계좌이체(".$row['mb_4']."개월)";
	}else if($row['mb_9'] == 'card'){
		$row['mb_9'] = "카드";
	}

	$ndate = strtotime(date('Y-m-d H:i:s'));
	$check = "";
	if($ndate < strtotime($row['mb_8'])){
		$row['check'] = "사용중";
	}else {
		$row['check'] = "미사용";
	}

	$arrMember[] = $row;
}


//엑셀 첫 테이블 정의
$objPHPExcel -> setActiveSheetIndex(0)

-> setCellValue("A1", "NO")

-> setCellValue("B1", "가입일시")

-> setCellValue("C1", "이름")

-> setCellValue("D1", "전화번호")

-> setCellValue("E1", "아이디")

-> setCellValue("F1", "이메일")

-> setCellValue("G1", "라이센스종류")

-> setCellValue("H1", "구입일자")

-> setCellValue("I1", "구입금액")

-> setCellValue("J1", "결재구분")

-> setCellValue("K1", "종료일")

-> setCellValue("L1", "AI시그널상태")

-> setCellValue("M1", "최근접속일");



$count = 1;

foreach($arrMember as $key => $val) {

	$num = 2 + $key;

	$objPHPExcel -> setActiveSheetIndex(0)

	-> setCellValue(sprintf("A%s", $num), ($key+1))

	-> setCellValue(sprintf("B%s", $num), $val['mb_datetime'])

	-> setCellValueExplicit(sprintf("C%s", $num), $val['mb_name'])

	-> setCellValue(sprintf("D%s", $num), $val['mb_hp'])

	-> setCellValue(sprintf("E%s", $num), $val['mb_id'])

	-> setCellValue(sprintf("F%s", $num), $val['mb_email'])	

	-> setCellValue(sprintf("G%s", $num), $val['ls_type'])

	-> setCellValue(sprintf("H%s", $num), $val['ls_dttm'])

	-> setCellValue(sprintf("I%s", $num), $val['ls_price'])

	-> setCellValue(sprintf("J%s", $num), $val['mb_9'])

	-> setCellValue(sprintf("K%s", $num), $val['mb_8'])

	-> setCellValue(sprintf("L%s", $num), $val['check'])

	-> setCellValue(sprintf("M%s", $num), $val['mb_today_login']);

	$count++;

}

// 가로 넓이 조정

$objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setWidth(6);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("B") -> setWidth(22);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("C") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("D") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("E") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("F") -> setWidth(22);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("G") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("H") -> setWidth(22);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("I") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("J") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("K") -> setWidth(22);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("L") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("M") -> setWidth(22);



// 전체 세로 높이 조정

$objPHPExcel -> getActiveSheet() -> getDefaultRowDimension() -> setRowHeight(15);



// 전체 가운데 정렬

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:M%s", $count)) -> getAlignment()

-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



// 전체 테두리 지정

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:M%s", $count)) -> getBorders() -> getAllBorders()

-> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);



// 타이틀 부분

$objPHPExcel -> getActiveSheet() -> getStyle("A1:M1") -> getFont() -> setBold(true);

$objPHPExcel -> getActiveSheet() -> getStyle("A1:M1") -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID)

-> getStartColor() -> setRGB("CECBCA");



// 내용 지정

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A2:M%s", $count)) -> getFill()

-> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("F4F4F4");



// 시트 네임

$objPHPExcel -> getActiveSheet() -> setTitle("회원정보");



// 첫번째 시트(Sheet)로 열리게 설정

$objPHPExcel -> setActiveSheetIndex(0);



// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.

$filename = iconv("UTF-8", "EUC-KR", "회원테이블");



// 브라우저로 엑셀파일을 리다이렉션

header("Content-Type:application/vnd.ms-excel");

header("Content-Disposition: attachment;filename=".$filename.".xls");

header("Cache-Control:max-age=0");



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");

$objWriter -> save("php://output");


?>
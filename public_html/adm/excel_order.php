<?php
include_once('./_common.php');
include_once(G5_LIB_PATH."/PHPExcel/Classes/PHPExcel.php");

//엑셀 객체 생성
$objPHPExcel = new PHPExcel();

//회원 정보 불러오기

$sql = "select * from g5_order where mb_id != 'admin'";
$rtn = sql_query($sql);

$arrMember = array();

while($row = sql_fetch_array($rtn)){
	
	if($row['ls_type'] == '1') $row['ls_type'] = 'PC';
	if($row['ls_type'] == '2') $row['ls_type'] = 'Mobile';
	if($row['ls_type'] == '3') $row['ls_type'] = 'PC+Mobile';
	if($row['ls_type'] == '4') $row['ls_type'] = 'TEST';

	if($row['ls_use'] == 'Y') $row['ls_use'] = '입금완료';
	if($row['ls_use'] == 'N') $row['ls_use'] = '입금대기';

	$arrMember[] = $row;
}


//엑셀 첫 테이블 정의
$objPHPExcel -> setActiveSheetIndex(0)

-> setCellValue("A1", "NO")

-> setCellValue("B1", "아이디")

-> setCellValue("C1", "타입")

-> setCellValue("D1", "신청일")

-> setCellValue("E1", "입금일")

-> setCellValue("F1", "금액")

-> setCellValue("G1", "상태");



$count = 1;

foreach($arrMember as $key => $val) {

	$num = 2 + $key;

	$objPHPExcel -> setActiveSheetIndex(0)

	-> setCellValue(sprintf("A%s", $num), ($key+1))

	-> setCellValue(sprintf("B%s", $num), $val['mb_id'])

	-> setCellValueExplicit(sprintf("C%s", $num), $val['ls_type'])

	-> setCellValue(sprintf("D%s", $num), $val['ord_dttm'])

	-> setCellValue(sprintf("E%s", $num), $val['ls_dttm'])

	-> setCellValue(sprintf("F%s", $num), $val['ls_price'])	

	-> setCellValue(sprintf("G%s", $num), $val['ls_use']);

	$count++;

}

// 가로 넓이 조정

$objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setWidth(6);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("B") -> setWidth(22);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("C") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("D") -> setWidth(25);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("E") -> setWidth(25);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("F") -> setWidth(18);

$objPHPExcel -> getActiveSheet() -> getColumnDimension("G") -> setWidth(15);



// 전체 세로 높이 조정

$objPHPExcel -> getActiveSheet() -> getDefaultRowDimension() -> setRowHeight(15);



// 전체 가운데 정렬

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:G%s", $count)) -> getAlignment()

-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



// 전체 테두리 지정

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:G%s", $count)) -> getBorders() -> getAllBorders()

-> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);



// 타이틀 부분

$objPHPExcel -> getActiveSheet() -> getStyle("A1:G1") -> getFont() -> setBold(true);

$objPHPExcel -> getActiveSheet() -> getStyle("A1:G1") -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID)

-> getStartColor() -> setRGB("CECBCA");



// 내용 지정

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A2:G%s", $count)) -> getFill()

-> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("F4F4F4");



// 시트 네임

$objPHPExcel -> getActiveSheet() -> setTitle("라이센스정보");



// 첫번째 시트(Sheet)로 열리게 설정

$objPHPExcel -> setActiveSheetIndex(0);



// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.

$filename = iconv("UTF-8", "EUC-KR", "라이센스정보");



// 브라우저로 엑셀파일을 리다이렉션

header("Content-Type:application/vnd.ms-excel");

header("Content-Disposition: attachment;filename=".$filename.".xls");

header("Cache-Control:max-age=0");



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");

$objWriter -> save("php://output");


?>
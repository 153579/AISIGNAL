<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

include_once(G5_THEME_PATH.'/head.php');
?>

<!-- mypage 시작 { -->
<h1><?php echo $g5['title'] ?></h1>
<p>asdasdasdasdasd</p>
<!-- } mypage 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
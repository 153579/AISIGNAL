<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>



</div>
<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div id="footer">
    <div id="footer-cont" class="container">
        <div id="footer-logo">
            <img src="<?php echo G5_IMG_URL?>/aisignal-logo-footer.png" alt="">
        </div>
        <ul>
            <li>회사명 : 뉴비코(주) ㅣ 대표자 : 장승호 ㅣ 주소 : 서울 구로구 디지털로 288 대륭포스트타워 1차 2층 207호 ㅣ
            </li>
            <li>전화 : 070-8666-0607 팩스 : 050-4314-1333 ㅣ 이메일 : sis3719@naver.com ㅣ ‌사업자등록번호 : 729-88-00526 ㅣ</li>
            <li>통신판매업신고번호 : 제 2017-전남목포-0024호 ㅣ 개인정보책임자 : 신일식</li>
            <li>Copyright&copy; 뉴비코(주). All Rights Reserved.</li>
        </ul>
    </div>
</div>
<?php 

$index = $index ? true : false;
if($index) { ?>
<div id="footer-nav">
    <a href="http://pf.kakao.com/_xmJxcNxb/chat" class="kakao"><img
            src="<?php echo G5_IMG_URL?>/consult_small_yellow_pc.png" alt=""></a>
    <div id="footer-nav-container">
        <ul>
            <li><a class="jump" href="#title">소개</a></li>
            <li><a class="jump" href="#title2">기능</a></li>
            <li><a class="jump" href="#title3">인공지능기법</a></li>
            <li><a class="jump" href="#title4">커리큘럼</a></li>
            <li><a class="jump" href="#title4">공지사항</a></li>
        </ul>
        <div class="button1">
            <?php if( !empty($member['mb_id'])) { ?>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=mypage">1개월 무료사용 신청하기</a>
            <?php }else{ ?>
                <a href="<?php echo G5_BBS_URL ?>/register.php">1개월 무료사용 신청하기</a>
            <?php } ?>
        </div>
    </div>
</div>
<?php }else {?>

<script>
    $('#footer').css('margin-bottom', '0px');
    $('#footer').css('position', 'absolute');
</script>

<?php }?>
</div>

<!-- } 하단 끝 -->


<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>
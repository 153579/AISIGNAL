<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->

<div id="wrapper">
    <header>
        <h5 class="none">헤더영역</h5>
        <div id="header">
            <div id="header-cont" class="container">
                <div id="logo">
                    <a href="http://xn--2i0bs2dqwxnic8tam0fba.com/"><img src="<?php echo G5_IMG_URL?>/aisignal-logo.png" alt=""></a>
                </div>
                <ul id="nav">
                    <!-- <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=notice">공지사항</a></li> -->
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gallery">수익률</a></li>
                    <?php if( ! empty($member['mb_id'])) { ?>

                    <?php $obj = new module(); ?>

                    <?php if($obj -> PCvsMOBILE() == "mobile") { ?>

                    <li class="top_nav_gnb"><a href="#" class="red">MENU</a>
                        <ul class="top_nav_lnb none">
                            <li><?php echo $member['mb_id']; ?>님<BR>AISIGNAL 방문을 환영합니다.</li>
                            <div class="bd_lnb lnb_top_mg"></div>
                            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=mypage">마이페이지</a></li>
                            <div class="bd_lnb"></div>
                            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
                            <div class="bd_lnb"></div>
                            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
                            <div class="bd_lnb"></div>
                            <li><a href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a></li>
                        </ul>
                    </li>
                    <?php } else { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
                        <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=mypage">마이페이지</a></li>
                        <li><a href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a></li>
                    <?php } ?>
                    <?php }else { ?>
                    <li><a href="<?php echo G5_BBS_URL; ?>/login.php">로그인</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </header>

    <script>
        $(".top_nav_gnb").mouseover(function () {
            $(".top_nav_lnb").removeClass("none");
        })
        $(".top_nav_gnb").mouseleave(function () {
            $(".top_nav_lnb").addClass("none");
        })
    </script>


<?php
class module {

    function PCvsMOBILE() {

        $mobileArray = array(
              "iphone"
            , "lgtelecom"
            , "skt"
            , "mobile"
            , "samsung"
            , "nokia"
            , "blackberry"
            , "android"
            , "sony"
            , "phone"
        );

        $checkCount = 0;
        for($num = 0; $num < sizeof($mobileArray); $num++) {

            if(preg_match("/$mobileArray[$num]/", strtolower($_SERVER['HTTP_USER_AGENT']))) {

                                    $checkCount++;
                                    break;
            }
        }
        return ($checkCount >= 1) ? "mobile" : "computer";
    }
}
?>
    <!-- } 상단 끝 -->
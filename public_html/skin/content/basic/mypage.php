<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

include_once(G5_THEME_PATH.'/head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/mypage_update.php';
?>

<!-- mypage 시작  -->
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

<div id="layout">
    <div id="wrap" class="_layout">
        <div id="container">
            <div id="contents">
                <div class="titleArea">
                    <h2>마이페이지</h2>
                </div>
                <div id="cont-wrapper-mypage">
                    <div id="mypage-left">
                        <div id="mypage-left-top">
                            <button type="button" onclick="location.href='http://xn--2i0bs2dqwxnic8tam0fba.com/bbs/content.php?co_id=product'" class="rs_btn"><img src="<?php echo G5_IMG_URL?>/click_img.gif" alt=""></button>

                            <form action="<?php echo $register_action_url; ?>" method="post" class="form_wrapper">
							<!--
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">가입일시</label>
                                    <input type="text" name="#" id="login_user_id" style="width: 100%;">
                                </div>
							-->
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">아이디</label>
                                    <input type="text" name="mb_id" value="<?php echo $member['mb_id']; ?>" id="login_user_id" style="width: 100%;" readonly>
                                </div>
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">비밀번호</label><br>
                                    <input type="password" name="mb_password"
                                        style="vertical-align:middle; width: 100%;">
                                </div>
								<!--
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">이름</label>
                                    <input type="text" name="mb_name" id="login_user_id" style="width: 100%;">
                                </div>
								-->
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">전화번호</label><br>
                                    <input type="text" name="mb_hp" value="<?php echo $member['mb_hp']; ?>" style="vertical-align:middle; width: 100%;" readonly>
                                </div>
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">이메일주소</label><br>
                                    <input type="text" value="<?php echo $member['mb_email']; ?>" name="mb_email" style="vertical-align:middle; width: 100%;" readonly>
                                </div>
								<!--
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">월 회비 결제일</label>
                                    <input type="text" name="#" id="login_user_id" style="width: 100%;">
                                </div>
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">무료체험기간</label>
                                    <input type="text" name="#" id="login_user_id" style="width: 100%;">
                                </div>
								-->
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">DB증권 아아디</label><br>
                                    <input type="text" name="mb_2" value="<?php echo $member['mb_2']; ?>" style="vertical-align:middle; width: 100%;">
                                </div>
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">이베스트 아이디</label><br>
                                    <input type="text" name="mb_3" value="<?php echo $member['mb_3']; ?>" style="vertical-align:middle; width: 100%;">
                                </div>
								<!--
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">구매한 라이센스</label>
                                    <input type="text" name="#" id="login_user_id" style="width: 100%;">
                                </div>
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">라이센스 구매일(PC)</label>
                                    <input type="text" name="#" id="login_user_id" style="width: 100%;">
                                </div>
                                <div class="input-box1 register-box pdtop">
                                    <label class="input-name">라이센스 구매일(모바일)</label>
                                    <input type="text" name="#" id="login_user_id" style="width: 100%;">
                                </div>
								-->
                                <div class="bt-wraper pdtop">
                                    <button type="submit" class="mypage-btn" id="">
                                        저장하기
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!--  mypage 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>

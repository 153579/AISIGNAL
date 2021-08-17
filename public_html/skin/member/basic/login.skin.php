<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

include_once(G5_THEME_PATH.'/head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
?>

<!-- 로그인 시작 { -->
<h1><?php echo $g5['title'] ?></h1>
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

<section class="sub-section content-wrap">
    <div class="container1 login-form">
        <h1 class="text-center section-title">로그인</h1>
        <form class="input-wrap" action="<?php echo $login_action_url ?>" method="post" id="frmlogin">
            <div class="sign-wrap">
                <div class="input-box register-box">
                    <label class="input-name">아이디</label>
                    <input type="text" name="mb_id" id="login_user_id" style="width: 100%;">
                </div>
                <div class="input-box register-box">
                    <label class="input-name">비밀번호</label>
                    <input type="password" name="mb_password" id="login_user_password" style="width: 100%;">
                </div>
                <div class="register-btn-wrap">
                    <button type="submit" class="register-btn" id="btnLogin">
                        로그인
                    </button>
                </div>
                <p style="text-align: center; margin: 25px 0; font-size: 18px;">비밀번호를 잊으셨나요? <span><a
                            href="<?php echo G5_BBS_URL ?>/password_lost.php" style="color: red" ;>비밀번호 찾기</a></span>
                </p>
                <p style="text-align: center; margin: 25px 0; font-size: 18px;">계정이 없으신가요? <span><a
                            href="<?php echo G5_BBS_URL ?>/register.php" style="color: red" ;>회원가입 하기</a></span>
                </p>
            </div>
        </form>
    </div>
</section>
<!-- } 로그인 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
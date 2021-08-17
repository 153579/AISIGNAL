<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

include_once(G5_THEME_PATH.'/head.php');
?>

<!-- 회원정보 찾기 시작 { -->

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

<div class="sub-section content-wrap">
    <div id="find_info" class="new_win">
        <h1 class="text-center section-title">회원정보 찾기</h1>
        <div class="new_win_con">
            <form name="fpasswordlost" class="input-wrap" action="<?php echo $action_url ?>"
                onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
                <fieldset id="info_fs" class="sign-wrap input-box register-box">
                    <p>
                        회원가입 시 등록하신 이메일 주소를 입력해 주세요.<br>
                        해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.
                    </p>
                    <label for="mb_email" class="sound_only">E-mail 주소<strong class="sound_only">필수</strong></label>
                    <input type="text" name="mb_email" id="mb_email" required
                        class="required frm_input full_input email" size="30" placeholder="E-mail 주소" style="width:100%">
                    <?php echo captcha_html();  ?>
                </fieldset>

                <div class="win_btn">
                    <button type="submit" class="btn_submit">확인</button>
                    <button type="button" onclick="window.close();" class="btn_close">창닫기</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function fpasswordlost_submit(f) {
        <
        ? php echo chk_captcha_js(); ? >

        return true;
    }

    $(function () {
        var sw = screen.width;
        var sh = screen.height;
        var cw = document.body.clientWidth;
        var ch = document.body.clientHeight;
        var top = sh / 2 - ch / 2 - 100;
        var left = sw / 2 - cw / 2;
        moveTo(left, top);
    });
</script>
<!-- } 회원정보 찾기 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
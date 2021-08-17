<?php
define('_INDEX_', true);
$index = true;
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<section>
    <h5 class="none">본문파트</h5>
    <div id="cont-wrapper" class="container">
        <section id="first1">
            <h5 class="none">본문파트1</h5>
            <img src="<?php echo G5_IMG_URL?>/img.png" alt="">
        </section>
        <div id="right">
            <div id="right-cont-wrapper">
                <div id="right-cont">
                    <div id="right-cont-text">
                        <p>AISIGNAL</p>
                        <h5>이제는 주식도 인공지능시대</h5>
                        <div id="right-cont-text-hash">
                            <ul>
                                <li><a href="#">#인공지능 주식거래</a></li>
                                <li><a href="#">#주식거래 자동매매</a></li>
                                <li><a href="#">#AISIGNAL</a></li>
                                <li><a href="#">#주식으로 두번째 월급</a></li>
                            </ul>
                        </div>
                        <p id="ricens">라이센스 가격 (50% 할인)</p>
                        <p class="bold"><span>&#8361;6,000,000</span>&#8361;3,000,000</p>
                        <div id="month">
                            <h2>월회비 <span>100,000원</span></h2>
                        </div>

                        <?php if( !empty($member['mb_id'])) { ?>
                        <div class="button"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=mypage">1개월 무료사용
                                신청하기</a></div>
                        <?php }else{ ?>
                        <div class="button"><a href="<?php echo G5_BBS_URL ?>/register.php">1개월 무료사용 신청하기</a></div>
                        <?php } ?>

                        <div class="hart">
                            <span>
                                <a href="#a">♡</a>
                                <a href="#a" style="display:none; color: red;">♥</a>
                            </span>
                            <span>
                                <a href="#" id="number">275</a>
                            </span>
                        </div>
                    </div>
                    <div id="right-cont-text-footer">
                        <h5>공유하기</h5>
                        <div id="icon">
                            <a href="javascript:sharefacebook('http://xn--2i0bs2dqwxnic8tam0fba.com/')"><img
                                    src="<?php echo G5_IMG_URL?>/facebook.png" alt=""></a>
                            <!-- <a id="kakao-link-btn" href="javascript:sendLink();"><img src="<?php echo G5_IMG_URL?>/kakao.png"
                                    alt=""></a> -->
                            <a href="javascript:sharetwitter('http://xn--2i0bs2dqwxnic8tam0fba.com/')"><img
                                    src="<?php echo G5_IMG_URL?>/twt.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div id="footer-cupon">
                    <a href="#"><img src="<?php echo G5_IMG_URL?>/cupon2.png" alt=""></a>
                </div>
            </div>
        </div>
        <div id="left">
            <section id="first">
                <h5 class="none">본문파트왼쪽</h5>
                <img src="<?php echo G5_IMG_URL?>/img.png" alt="">
            </section>
            <section>
                <h5 class="none">본문파트왼쪽</h5>
                <img src="<?php echo G5_IMG_URL?>/cupon.png" alt="">
            </section>
            <section id="aisignal">
                <h2 id="title">AISIGNAL 소개</h2>
                <img src="<?php echo G5_IMG_URL?>/img1.png" alt="">
                <div id="rate-wrapper">
                    <h2 style="font-size: 28px !important; text-align: center; margin: 10px 0;">수익률 인증</h2>
                    <ul id="rate-wrapper-cont">
                        <li data-aos="fade-left" data-aos-offset="400" data-aos-easing="ease-in-sine">
                            <video autoplay controls loop muted preload="none" style="width: 100%;">
                                <source src="<?php echo G5_IMG_URL?>/video/video1.mp4" type="video/mp4">
                            </video>
                        </li>
                        <li data-aos="fade-right" data-aos-offset="400" data-aos-easing="ease-in-sine"><img
                                src="<?php echo G5_IMG_URL?>/signal722.png" alt=""></li>
                        <li data-aos="fade-left" data-aos-offset="400" data-aos-easing="ease-in-sine"><img
                                src="<?php echo G5_IMG_URL?>/signal722.png" alt=""></li>
                    </ul>
                </div>
                <img src="<?php echo G5_IMG_URL?>/img2.png" alt="">
                <div id=img2-1>
                    <img src="<?php echo G5_IMG_URL?>/img2-1.png" alt="">
                    <div id="img2-1-cont1">
                        <div class="cont1-top">
                            <span class="counter toptext1">20</span>
                            <span class="toptext1">%</span>
                        </div>
                        <div class="cont1-bottom">
                            <span class="counter bttext">2005</span>
                            <span class="bttext">년</span>
                        </div>
                    </div>
                    <div id="img2-1-cont2">
                        <div class="cont1-top">
                            <span class="counter1 toptext">85</span>
                            <span class="toptext">%</span>
                        </div>
                        <div class="cont1-bottom">
                            <span class="counter1 bttext">2020</span>
                            <span class="bttext">년</span>
                        </div>
                    </div>
                </div>
                <img src="<?php echo G5_IMG_URL?>/img3.png" alt="">
                <h2 id="title2">AISIGNAL기능</h2>
                <img src="<?php echo G5_IMG_URL?>/img4.png" alt="">
                <img src="<?php echo G5_IMG_URL?>/img4-1.png" alt="">
                <img src="<?php echo G5_IMG_URL?>/img4-2.png" alt="">
                <h2 id="title3">인공지능기법</h2>
                <img src="<?php echo G5_IMG_URL?>/ann1.png" alt="">
                <img src="<?php echo G5_IMG_URL?>/ann2.png" alt="">
                <img src="<?php echo G5_IMG_URL?>/img4-3.png" alt="">
                <img src="<?php echo G5_IMG_URL?>/img5.png" alt="">
            </section>
            <h2 id="title4">Curriculum</h2>
            <section id="curriculum">
                <ul id="curriculum-nav">
                    <li>
                        <h4 style="color: red;">PC버전과 모바일버전의 차이</h4>
                        <h4>* PC버전은 DB증권 API기반으로 설계</h4>
                        <h4>* 모바일버전은 이베스트 API기반으로 설계</h4>
                    </li>
                    <li>
                        <h4 style="color: red;">1. PC버전 AISIGNAL이용하기</h4>
                        <div class="outline">
                            <h2>- 개요</h2>
                            <h4>1. AISIGNAL 회원가입하기 <a href="<?php echo G5_BBS_URL ?>/register.php"
                                    style="color:orange;">이곳을
                                    클릭하세요</a></h4>
                            <h4>2. DB증권 계좌 개설 <a href="https://www.db-fi.com/main/main.do" style="color:orange;">이곳을
                                    클릭하세요</a></h4>
                            <h4>3. DB증권 API 신청하기</h4>
                            <h4>4. AISIGNAL 프로그램 설치(원격지원가능)</h4>
                            <h4>5. AISIGNAL 프로그램에 계정 연결하기</h4>
                        </div>
                    <li>
                        <h4 class="click">* DB증권 계좌 개설하기(PC 홈페이지)</h4>
                        <ul class="curriculum-lnv none">
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db1.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db2.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db3.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db4.PNG" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db4-2.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db5.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db6.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db8.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db9.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/db10.png" alt=""></a></li>
                        </ul>
                    </li>
                    <li>
                        <h4 class="click">* DB증권 계좌 개설하기(MOBILE)</h4>
                        <ul class="curriculum-lnv none">
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm1.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm2.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm3.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm4.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm5.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm6.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm7.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm8.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm9.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm10.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm11.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm12.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm13.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/dbm14.png" alt=""></a></li>
                        </ul>
                    </li>
                    <li>
                        <h4 class="click">* API 연동하여 AISIGNAL 사용하기(PC)</h4>
                        <ul class="curriculum-lnv none">
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/SIGNAL1.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/signal2.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/signal3.png" alt=""></a></li>
                        </ul>
                    </li>
                    <li>
                        <h4 style="color: red;">2. MOBILE버전 AISIGNAL이용하기</h4>
                        <div class="outline">
                            <h2>- 개요</h2>
                            <h4>1. 이베스트 마인설치(<a
                                    href="https://play.google.com/store/apps/details?id=com.ebest.mine&hl=ko"
                                    style="color:red">플레이스토어</a>,<a
                                    href="https://apps.apple.com/kr/app/%EB%B9%85%EB%8D%B0%EC%9D%B4%ED%84%B0-%EC%A3%BC%EC%8B%9D%EC%95%B1-mine-%EB%A7%88%EC%9D%B8-%EA%B3%84%EC%A2%8C%EA%B0%9C%EC%84%A4-%EA%B2%B8%EC%9A%A9/id1467719339?l=en"
                                    style="color:red">앱스토어</a>)</h4>
                            <h4>2. 비대면통장 개설 - 회원가입</h4>
                            <h4>3. 범용공인인증서 설치</h4>
                            <h4>4. 이베스트증권 API 신청하기</h4>
                            <h4>5. AISIGNAL 회원가입하기 <a href="<?php echo G5_BBS_URL ?>/register.php"
                                    style="color:orange;">이곳을
                                    클릭하세요</a></h4>
                            <h4>6. AISIGNAL 프로그램 설치</h4>
                            <h4>7. AISIGNAL 프로그램에 계정 연결하기</h4>
                        </div>
                    <li>
                        <h4 class="click">* 이베스트 계좌 개설하기(MOBILE)</h4>
                        <ul class="curriculum-lnv none">
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest1.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest2.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest3.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest4.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest5.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest6.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest7.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest8.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest9.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest10.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/ebest11.png" alt=""></a></li>

                        </ul>
                    </li>
                    <li>
                        <h4 class="click">* 이베스트 공인인증서 발급</h4>
                        <ul class="curriculum-lnv none">
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/EBEST_GONGIN.jpg" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/EBEST_GONGIN_1.jpg" alt=""></a></li>
                        </ul>
                    </li>
                    <li>
                        <h4 class="click">* 이베스트 API 신청하기</h4>
                        <ul class="curriculum-lnv none">
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/EBEST_API.jpg" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/EBEST_API_1.jpg" alt=""></a></li>
                        </ul>
                    </li>
                    <li>
                        <h4 class="click">* API 연동하여 AISIGNAL 사용하기(MOBILE)</h4>
                        <ul class="curriculum-lnv none">
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/signalm1.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/signalm2.png" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo G5_IMG_URL?>/signalm3.png" alt=""></a></li>
                        </ul>
                    </li>
                </ul>
                <h2 id="title5">공지사항</h2>
                <div id="notice">
                    <?php
							$sql = "select * from g5_write_notice order by wr_datetime limit 3";
							$rtn = sql_query($sql);
						?>
                    <ul>
                        <?php while($row = sql_fetch_array($rtn)) {?>
                        <li><a
                                href="/bbs/board.php?bo_table=notice&wr_id=<?php echo $row['wr_id']; ?>"><?php echo $row['wr_subject']; ?></a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</section>

<script>
    $('.counter, .counter1').countUp();
</script>
<!-- 페이지 점프 스크립트 입니다 -->
<script>
    $(document).ready(function () {
        $(".jump").on("click", function (e) {

            e.preventDefault();

            $("body, html").animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 600);

        });
    });
</script>

<script>
    var a = $("a#number");

    var check = JSON.parse(localStorage.getItem("Seconddayofshoveling"));
    
    if(check == "1"){
        $(".hart > span:nth-child(1) > a:nth-child(1)").addClass("none")
        $(".hart > span:nth-child(1) > a:nth-child(2)").css("display", "block")
        a.text(parseInt($('a#number').text()) + 1 + "+")
    }
    
    $(".hart > span:nth-child(1) > a:nth-child(1)").click(function () {
        $(".hart > span:nth-child(1) > a:nth-child(1)").addClass("none")
        $(".hart > span:nth-child(1) > a:nth-child(2)").css("display", "block")
        a.text(parseInt($('a#number').text()) + 1 + "+")
        localStorage.setItem("Seconddayofshoveling", JSON.stringify("1"));
    })

    $(".hart > span:nth-child(1) > a:nth-child(2)").click(function () {
        $(".hart > span:nth-child(1) > a:nth-child(1)").removeClass("none")
        $(".hart > span:nth-child(1) > a:nth-child(2)").css("display", "none")
        a.text(parseInt($('a#number').text()) - 1)
        localStorage.setItem("Seconddayofshoveling", JSON.stringify("0"));
    })
        // localStorage.clear();
</script>

<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>

<script type="text/javascript">

function sendLink() {
    kakao.init('b2e95b15f768345d017e2c31175b6ea9');
    kakao.Link.createDefaultButton({
        container:'#kakao-link-btn',
        objectType:"feed",
        content:{
            title:$("meta[property='og:title'").attr("content"),
            description:$("meta[property='og:description").attr('content'),
            imageUrl:$("meta[property='og:image'").attr("content"),
            link:{
                mobileWebUrl: "http://xn--2i0bs2dqwxnic8tam0fba.com"
                webUrl: "http://xn--2i0bs2dqwxnic8tam0fba.com"
            }
        },

        button:[
            {
                title:'웹으로 보기',
                link:{
                    mobileWebUrl: "http://xn--2i0bs2dqwxnic8tam0fba.com"
                    webUrl: "http://xn--2i0bs2dqwxnic8tam0fba.com"
                }
            }
        ]
    })
}
</script>


<!-- 수익률인증 애니 스크립트 입니다 -->
<script>
    AOS.init();
</script>


<!-- 페아스북 공유하기 스크립트 입니다 -->
<script>
    function sharefacebook(url) {
        window.open("http://www.facebook.com/sharer/sharer.php?u=" + url);
    }
</script>


<!-- 트위터 공유하기 스크립트 입니다 -->
<script>
    function sharetwitter(url, text) {
        window.open("https://twitter.com/intent/tweet?text=" + text + "&url=http://xn--2i0bs2dqwxnic8tam0fba.com/" +
            url);
    }
</script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
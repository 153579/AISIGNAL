$(document).ready(function () {

		
    $(".menu-trigger, .on").click(function(){
        $(".menu-trigger").toggleClass('active');
        $('.mb_nav_btn_wrap').slideToggle('opened');
    });
});
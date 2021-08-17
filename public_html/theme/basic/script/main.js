$(document).ready(function () {
    lnb();

})


var scrollableElement = document.getElementById('wrapper');
var $floater = $('#right #right-cont-wrapper');
var lastScrollTop = 0;
var bwidth = window.innerWidth;;
var styleadd = {};

scrollableElement.addEventListener('wheel', findScrollDirectionOtherBrowsers);
$(this).on('resize', function () {
    bwidth = window.innerWidth;
    if (!screenCheck()) {
        styleType2()
        $floater.css(styleadd);
    }
});


function styleType1() {
    styleadd = {
        'margin-top': '3px',
        'width': '366px',
        'position': 'fixed',
        'top': '20px'
    };
}

function styleType2() {
    styleadd = {
        'margin-top': '0px',
        'position': 'static',
        'width': '100%'
    };
}

function screenCheck() {
    if (bwidth < 1100) {
        return false;
    }
    return true;
}

function findScrollDirectionOtherBrowsers(event) {

    var delta;
    var st = window.pageYOffset || document.documentElement.scrollTop;

    if (event.wheelDelta) {
        delta = event.wheelDelta;
    } else {
        delta = -1 * event.deltaY;
    }

    console.log(screenCheck());
    if (screenCheck()) {
        console.log("width: " + bwidth);
        if (delta < 0) {
            styleType1();
        } else if (delta > 0) {
            if (st <= 200) {
                styleType2();
            }
        }
    } else {
        styleType2();
    }

    $floater.css(styleadd);
}

function lnb() {
    $("#curriculum-nav > li > h4").click(function () {
        var sub = $(this).next(".curriculum-lnv");

        if (sub.is(":visible")) {
            sub.slideUp()
        } else {
            sub.slideDown()
        }
    })

}

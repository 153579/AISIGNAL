<!--
function goUrl(url) {
	window.location=url;
}

function openPopup(popUrl, width, height) {
	window.open(popUrl, '', 'fullscreen=no,toolbar=no,location=no,menubar=no,scrollbars=no,status=yes,width='+width+',height='+height+'');
}

function unLoadAction() {
	if( document.readyState == "complete" ) {
		//새로 고침 또는 창 닫기 
		alert("결제를 취소 하셨습니다!\n결제를 처음부터 다시 시도해 주세요!");
	}
}

function processKey() 
{ 
	if( 
		(event.ctrlKey == true && (event.keyCode == 78 || event.keyCode == 82)) 
		|| (event.keyCode >= 112 && event.keyCode <= 123) 
		|| (event.ctrlKey)  
	) 
	{ 
		event.keyCode = 505;
		alert('Ctrl/Function 키를 사용 할 수 없습니다.');
		event.returnValue = false; 
	} 
} 
document.onkeydown = processKey;
document.onmousedown=processKey; 
document.oncontextmenu = function () {
	alert("마우스 오른쪽버튼을 이용할 수 없습니다!");
	return false;
}
//-->

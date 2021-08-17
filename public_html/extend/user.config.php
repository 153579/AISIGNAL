<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function funcTest(){
	echo "function test";
}

// 원하는 길이의 랜덤 문자열 추출
function GenerateString($length)  
{  
    $characters  = "0123456789";  
    //$characters .= "abcdefghijklmnopqrstuvwxyz";  
    //$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
    //$characters .= "_";  
      
    $string_generated = "";  
      
    $nmr_loops = $length;  
    while ($nmr_loops--)  
    {  
        $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];  
    }  
      
    return $string_generated;  
}  

function miriMms($text, $number){

	$postData = array(
		'callback' => '15227968',
		'contents' => $text,
		'receiverTelNo' => $number,
		'userKey' => $number.'|'.mktime(date("Y-m-d H:i:s")).'|'.mt_rand(1, 10000)
	);

	//$url = "https://api-dev.wideshot.co.kr";
	$url = "https://api.wideshot.co.kr";

	$url .= "/api/v1/message/mms";

	$request_headers = array();
	$request_headers[] = 'sejongApiKey: QjA1bGVXUnA5ZzNyeHZ3ZzVzb0F2elJUVW5hKzFMS2hxa1ZOdHVzczdCdFkza245NGw1ZHNqYkNXaFIzNWtLZUdDcHFDNzRPYkRiaFJIOWRFVFVIelE9PQ==';


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	curl_setopt($ch, CURLOPT_POST, true);

	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}



function miriSms($text, $number){
	$postData = array(
		'callback' => '15227968',
		'contents' => $text,
		'receiverTelNo' => $number,
		'userKey' => $number.'|'.mktime(date("Y-m-d H:i:s")).'|'.mt_rand(1, 10000)
	);

	//$url = "https://api-dev.wideshot.co.kr";
	$url = "https://api.wideshot.co.kr";

	$url .= "/api/v1/message/sms";

	$request_headers = array();
	$request_headers[] = 'sejongApiKey: QjA1bGVXUnA5ZzNyeHZ3ZzVzb0F2elJUVW5hKzFMS2hxa1ZOdHVzczdCdFkza245NGw1ZHNqYkNXaFIzNWtLZUdDcHFDNzRPYkRiaFJIOWRFVFVIelE9PQ==';


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	curl_setopt($ch, CURLOPT_POST, true);

	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}

function alert_url($str , $url) {
	echo "<script>
		alert('".$str."');
		location.href = '".$url."';
	</script>";
}







?>
<?php 
class Message 
{
	//----------------------------
	//Define Header valiable
	//----------------------------
	var $version;  
	var $merchantId;                                                          
	var $serviceCode;            
	var $command;                
	var $orderId;                
	var $orderDate;              
	var $data;
	
	function Message() 
	{    
		$this->data = array();
	}

	function setHeader($version, $merchantId, $serviceCode, $command, $orderId, $orderDate) {
		$this->version = $version;
		$this->merchantId = $merchantId;
		$this->serviceCode = $serviceCode;
		$this->command = $command;
		$this->orderId = $orderId;
		$this->orderDate = $orderDate;
	}
	
	function setData($b) 
	{
		//----------------------------
		// Define Header Length 
		//----------------------------
		$VERSION_LENGTH = 10 ;
		$MERCHANT_ID_LENGTH = 20 ;
		$SERVICE_CODE_LENGTH = 4 ;
		$COMMAND_LENGTH = 4;
		$ORDER_ID_LENGTH = 64 ;
		$DATE_LENGTH = 14 ;
		$TAG_LENGTH = 4 ;
		$COUNT_LENGTH = 4 ;
		$VALUE_LENGTH = 4 ;
	  
		//----------------------------
		//Define Header Index
		//----------------------------
		$VERSION_INDEX = 0 ;  
		$MERCHANT_ID_INDEX = 10;  
		$SERVICE_CODE_INDEX = 30;                                                         
	                                                                                    
		//---------------------------- 
		//decrypt 된 data를 가지고 parsing해야 하므로 COMMAND_INDEX를 0으로 해야 한다.
		//----------------------------
		$COMMAND_INDEX = 0;                                        
		$ORDER_ID_INDEX = 4;          
		$ORDER_DATE_INDEX = 68;
		$DATA_INDEX = 82;      
		
		$this->version = trim(substr($b, $VERSION_INDEX, $VERSION_LENGTH));
		$this->merchantId = trim(substr($b, $MERCHANT_ID_INDEX, $MERCHANT_ID_LENGTH));
		$this->serviceCode = trim(substr($b, $SERVICE_CODE_INDEX, $SERVICE_CODE_LENGTH));
		
		$decrypted = substr($b, $VERSION_LENGTH + $MERCHANT_ID_LENGTH + $SERVICE_CODE_LENGTH, strlen($b));
		
		$this->command = trim(substr($decrypted, $COMMAND_INDEX, $COMMAND_LENGTH));
		$this->orderId = trim(substr($decrypted, $ORDER_ID_INDEX,	$ORDER_ID_LENGTH));
		$this->orderDate = trim(substr($decrypted, $ORDER_DATE_INDEX, $DATE_LENGTH));
		
		$bodyStr =substr($decrypted, $DATA_INDEX, strlen($decrypted));
		$this->parseData($bodyStr);
	}
	
	function setVersion($version) {
		$this->version = $version;
	}
	
	function setMerchantId($merchantId) {
		$this->merchantId = $merchantId;
	}

	function setServiceCode($serviceCode) {
		$this->serviceCode = $serviceCode;
	}

	function setCommand($command) {
		$this->command = $command;
	}

	function setOrderId($orderId) {
		$this->orderId = $orderId;
	}

	function setOrderDate($orderDate) {
		$this->orderDate = $orderDate;
	}
	
	function getVersion() {
		return $this->version;
	}
	
	function getMerchantId() {
		return $this->merchantId;
	}

	function getServiceCode() {
		return $this->serviceCode;
	}
	
	function getCommand() {
		return $this->command;
	}

	function getOrderId() {
		return $this->orderId;
	}

	function getOrderDate() {
		return $this->orderDate;
	}


	//----------------------------
	//tag에 해당하는 value를 set하기 위한 method. 같은 tag로 n번 invoke하면 n개의 value가 set된다.
	//----------------------------
	function put($tag, $value) {
		$vt = null;
		if($this->data != null) {
			if(array_key_exists($tag, $this->data)) {
				$vt = $this->data[$tag];
			}
		}
		
		if($vt != null) {
			array_push($vt, $value);
		}
		else {
			$vt = array(0 => $value);
		}
		
		if($this->data != null) {
			$this->data[$tag] = $vt ;
		}else {
			$this->data = array($tag => $vt);
		}

	}

	//----------------------------
	//tag에 해당하는 value를 String으로 return한다. array로 저장된 tag는 index가 0 인 값을
	//return한다. 하나의 tag에 하나의 value를 가지는 경우에 사용한다.
	//----------------------------
	function get($tag) {
		$vt;
		if(array_key_exists($tag, $this->data)) {
			$vt = $this->data[$tag];
		}
		else  {
			return "";
		}

		return $vt[0];
	}

	//----------------------------
	//tag에 해당하는 value를 array 로 return 한다. 하나의 tag에 여러개의 value를 가지는 경우에 사용한다.
	//----------------------------
	function gets($tag) {
		$vt;
		if(array_key_exists($tag, $this->data)) {
			$vt = $this->data[$tag];
		}
		else  {
			return "";
		}	
		
		return $vt;
	}

	function getBody() {
		$vt = null;
		$v = ""; 
		$tag = ""; 
		$body = ""; 
	      
		foreach($this->data as $tag => $vt) {
			for($i=0; $i<count($vt); $i++) {
				$v = $vt[$i];
				$body = $body.$tag."=".$v."|";
			}   
		}   
		
		return $body;
	}  


	function parseData($b) {
		$arrData = explode ("|", $b);	
		
		for($i=0; $i<count($arrData); $i++) {
			if(strlen($arrData[$i]) != 0) {
				$arrValueData = explode ("=", $arrData[$i]);
				$tag = $arrValueData[0];
				$value = $arrValueData[1];
								
				if(array_key_exists($tag, $this->data)) {
					$vt = $this->data[$tag];
				} else {
					$vt = array();
				}
				
				$index = count($vt);
				$vt[$index] = $value ;
				
				$this->data[$tag] = $vt ;  
			}
		}
	}

	function toString() {
		$header = sprintf("%-10s", $this->version)
							.sprintf("%-20s", $this->merchantId)
							.sprintf("%-4s", $this->serviceCode)
							.sprintf("%-4s", $this->command)
							.sprintf("%-64s", $this->orderId)
							.sprintf("%-14s", $this->orderDate) ;
							
		return $header.$this->getBody();
	}
}
?>

<?php
/*version 1.1*/
/*JAVA_HOME, BILLGATE_HOME ���� ����ȯ�濡 �°� ���� */
/*BillgateAPI.jar : 123,566 ����Ʈ*/
/*JAVA HOME PATH (Modify)*/

// MID : M1713934

$JAVA_HOME="/usr";

/*BILLGATE HOME PATH (Modify)*/
$BILLGATE_HOME="/home/aisignal/public_html/BILLGATE_HOME";

/*JAVA_BIN*/
$JAVA=$JAVA_HOME."/bin/java";

/*JARS*/
$JARS=$BILLGATE_HOME."/jars";

/*CLASS PASS INFO*/
$CP=$JARS."/billgateAPI.jar";

/*Charset (not modify) */
$CHARSET="euc-kr";

/*Command*/
$COMMAND=$JAVA." -Dfile.encoding=".$CHARSET." -cp ".$CP." com.galaxia.api.PHPServiceBroker ";
$ENCRYPT_COMMAND=$JAVA." -Dfile.encoding=".$CHARSET." -cp ".$CP." com.galaxia.api.EncryptServiceBroker ";

/*CONFIG FILE*/
$CONFIG_FILE=$BILLGATE_HOME."/config/config.ini";

/*CHECKSUM*/
$COM_CHECK_SUM = $JAVA." -cp ".$CP." com.galaxia.api.util.ChecksumUtil ";
?>
<?php
    include "TopSdk.php";
    date_default_timezone_set('Asia/Shanghai'); 

    $c = new TopClient;
$c ->appkey = '23644224' ;
$c ->secretKey = 'bb98851b47e3f0de635d8ab15e530efb' ;
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req ->setExtend( "" );
$req ->setSmsType( "normal" );
$req ->setSmsFreeSignName( "企业订餐" );
$req ->setSmsParam( "{number:'123456'}" );
$req ->setRecNum( "15168365220" );
$req ->setSmsTemplateCode( "SMS_48070170" );
$resp = $c ->execute( $req );
?>
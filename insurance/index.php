<?php
// change the following paths if necessary
error_reporting(E_ALL);
error_reporting(E_NOTICE);
// error_reporting(E_STRICT);
session_start();
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
if(strstr($_SERVER['HTTP_HOST'],"localhost")){
	$config=dirname(__FILE__).'/protected/config/local.php';
}else{
	$config=dirname(__FILE__).'/protected/config/main.php';
}


// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();

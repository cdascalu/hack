<?php
// Include the configuration file
include_once '../wurfl/examples/demo/inc/wurfl_config_standard.php';

$wurflInfo = $wurflManager->getWURFLInfo();


$ua = $_SERVER['HTTP_USER_AGENT'];
	
$requestingDevice = $wurflManager->getDeviceForHttpRequest($_SERVER);


$os=$requestingDevice->getCapability("device_os");
$type=$requestingDevice->getCapability('model_name');
$useragent = htmlspecialchars($ua);
$width = $requestingDevice->getCapability('resolution_width');
$height= $requestingDevice->getCapability('resolution_height');


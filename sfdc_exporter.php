<?php
require_once "config.php";
require_once GOTEO_PATH . "/core/model.php";
require_once GOTEO_PATH . "/core/db.php";
require_once GOTEO_PATH . "/core/controller.php";
require_once GOTEO_PATH . "/controller/sfdc.php";

define("CMD_MSG_SUCCEED","Data Export Succeed : ");
define("CMD_MSG_FAILED","FAILED!! Data Export Error : ");

$sfdc = new \Goteo\Controller\SFDC();

if (!isset($argv[1])){
    echo "err \n";
    exit;
}

$ret = 0;

if ($argv[1] == "project" ){
    $ret = $sfdc->get_project_master();
} elseif ($argv[1] == "donation" ){
    $ret = $sfdc->get_donate_info();
} elseif ($argv[1] == "user" ){
    $ret = $sfdc->get_user_info();
} else {
    echo CMD_MSG_FAILED . "'{$argv[1]}' is invalid argument\n";
    exit;
}

if ($ret > 0 && ($ret !== false)){
    echo CMD_MSG_SUCCEED . "$ret bytes written\n";
} else {
    if ($ret === false){
        echo CMD_MSG_FAILED . "file write error";
    } else {
        echo CMD_MSG_FAILED . "unknown error";
    }
}
exit;

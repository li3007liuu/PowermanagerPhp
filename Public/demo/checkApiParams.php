<?php
/**
 * 工具 - 查看接口参数规则
 */

require_once dirname(__FILE__) . '/../init.php';

//装载你的接口
DI()->loader->addDirs(array('Demo', 'Library'));
DI()->userLite = new User_Lite();

$apiDesc = new PhalApi_Helper_ApiDesc();
$apiDesc->render();


<?php
foreach (glob("../config/*.php",GLOB_BRACE) as $filename)
{
    require $filename;
}

foreach (glob(__DIR__."/App/Helpers/*.php",GLOB_BRACE) as $filename)
{
    require $filename;
}

use Mvc\Core\Routing;

$routing = new Routing;
$routing->handle()->call();



/**/
//use Mvc\Core\Error;
//$x = Error::getInstance();
//print_r($x);exit;
//echo $x->error;exit;
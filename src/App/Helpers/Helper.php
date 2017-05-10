<?php

function config($key) {
    global $config;
    if (preg_match("/^([a-z]+)\.([a-z\_]+)$/", $key, $params)) {
        return $config[$params[1]][$params[2]];
    } else {
        return null;
    }
}
/**
 * Absoulte Url'e çevirir
 * @param type $relative
 */
function url($relative){
    return Mvc\Core\Request::getInstance()->httpProtocol().config("app.base_url").$relative;
}

function asset($asset){
    return "/public/assets/".$asset;
}

function date_format1($str) {
    
      $date = DateTime::createFromFormat("Y-m-d H:i:s", $str);
      
      $getErrors = DateTime::getLastErrors();
      
      if($getErrors['warning_count'] > 0){
          return "";
      }
      else{
          return $date->format('d/m/Y H:i');
      }
 
}
?>
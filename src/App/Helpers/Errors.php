<?php

use Mvc\Core\Errors\error404;

function error404() {
    $error = new error404();
    
    foreach($error->getHeaders() as $header){
        header($header);
    }
    
    return blockView("layouts/Error", "Errors/404",["messages" => $error->getMessages()]);
}

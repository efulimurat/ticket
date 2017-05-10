<?php

namespace Mvc\Core\Views;

class Plain extends viewBase implements hasData {

    public function __construct() {
        
    }

    public function setData($data) {
        $view = parent::getInstance();
        $view->data = $data;
        return true;
    }

}

<?php

namespace Mvc\Core\Views;

class Block extends viewBase implements hasLayout, hasTemplate, hasData {

    public function __construct() {
        
    }

    public function setLayout($layout) {
        $view = parent::getInstance();
        $view->layout = $layout;
        return true;
    }

    public function setTemplate($template) {
        $view = parent::getInstance();
        $view->template = $template;
        return true;
    }

    public function setData($data) {
        $view = parent::getInstance();
        $view->setData($data);
        return true;
    }

}

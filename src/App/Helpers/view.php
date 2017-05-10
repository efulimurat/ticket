<?php

use Mvc\Core\Views\Block;
use Mvc\Core\Views\Simple;
use Mvc\Core\Views\Plain;
use Mvc\Core\View;

function blockView($layout, $template, $data = []) {
    $Block = new Block;
    $Block->setLayout($layout);
    $Block->setTemplate($template);
    $Block->setData($data);

    $View = View::getInstance();
    $View->render();
}

function jsonView($data = []) {
    $Block = new Plain();
    $Block->setData($data);

    $View = View::getInstance();
    $View->render();
}

function setTitle($title){
    $View = View::getInstance();
    $View->setTitle($title);
}
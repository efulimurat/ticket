<?php

namespace Mvc\Core;

class View {

    public $layout = "";
    public $template = "";
    public $data = [];
    private static $ins;

    private function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$ins)) {
            self::$ins = new View;
        }
        return self::$ins;
    }

    public function render() {

        if ($this->layout) {
            $this->addBlock($this->layout);
        } elseif ($this->template) {
            $this->addBlock($this->template);
        } else {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
    }

    private function addBlock($view) {
        $filePath = config("app.root_path") . "views/" . $view . ".php";

        if (file_exists($filePath)) {
            extract($this->data);
            include($filePath);
        }
    }

    public function setTitle($title) {
        $this->setData(["MetaTitle" => $title]);
    }

    public function setData($data) {
        $this->data = array_merge($this->data, $data);
    }

}

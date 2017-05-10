<?php

namespace Mvc\Core;

use Mvc\Core\Request;

class Routing {

    private $controller;
    private $method;
    private $params;

    public function handle() {

        $request = Request::getInstance();
        $request = Request::getInstance();
        $request = Request::getInstance();

        $url = $request->parsedUrl();

        if (!empty($url)) {
            $this->controller = $url[0];
            $this->method = $url[1];
            $this->params = array_slice($url, 2);
        }

        return $this;
    }

    public function call() {
        $_class = "App\\Controllers\\" . ucfirst($this->controller);
        if (class_exists($_class)) {
            $_cls = new $_class;

            if (is_callable([$_cls, $this->method])) {
                call_user_func_array([$_class, $this->method], $this->params);
                return true;
            } else {
                if (config("app.debug") == true) {
                    throw new \Exception("Controller route methodu yok", 404);
                } else {
                    return error404();
                }
                return false;
            }
        } else {
            return error404();
        }
    }

}
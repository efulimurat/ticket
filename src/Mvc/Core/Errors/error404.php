<?php

namespace Mvc\Core\Errors;

class error404 extends errorBase {

    public function __construct() {
        $error = parent::getInstance();
        $error->error = true;
        $this->setMessage();
        $this->setHeader();
    }

    public function setMessage() {
        
        $error = parent::getInstance();
        $error->messages[] = "Sayfa Bulunamadı";
        $error->messages[] = "Ulaşmaya çalıştığınız sayfa geçersiz";
        return true;
    }

    public function setHeader() {
        $error = parent::getInstance();
        $error->headers[] = "HTTP/1.0 404 Not Found";
        return true;
    }

}

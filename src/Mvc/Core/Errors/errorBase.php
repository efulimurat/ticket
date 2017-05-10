<?php

namespace Mvc\Core\Errors;

use Mvc\Core\Error;

abstract class errorBase extends Error {

    abstract public function setMessage();

    abstract public function setHeader();

    public function getMessages() {
        $error = parent::getInstance();
        return $error->messages;
    }

    public function getHeaders() {
        $error = parent::getInstance();
        return $error->messages;
    }

}

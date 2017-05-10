<?php

namespace Mvc\Core;

class Error {

    protected $messages = [];
    protected $headers = [];
    protected $error = false;
    private static $ins;

    private function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$ins)) {
            self::$ins = new Error;
        }
        return self::$ins;
    }

}
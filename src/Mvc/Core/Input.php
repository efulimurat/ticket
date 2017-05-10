<?php

namespace Mvc\Core;

class Input {

    public static function integer($str) {
        if (!preg_match("/^[0-9]+$/", $str)) {
            return false;
        }
        return true;
    }

    public static function text($str) {
        if (preg_match("/\<[^<>]+\>/", $str)) {
            return false;
        } elseif (preg_match("/\<\/[^<>]+\>/", $str)) {
            return false;
        } elseif (preg_match("/(.)/", $str)) {
            return true;
        } else {
            return false;
        }
    }

    public static function file($str) {
        if (!preg_match("/^[a-zA-Z0-9+(\.\,-_\?\:\/)]+$/", $str)) {
            return false;
        }
        return true;
    }

    public static function datetime($str) {
        if (!preg_match("/^(19|20)[0-9]{2}-(0[0-9]|1[0-2])-([012][0-9]|3[01])\s([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $str)) {
            return false;
        }
        return true;
    }

}

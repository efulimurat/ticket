<?php

namespace Mvc\Core;

class Request {

    private static $ins;

    private function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$ins)) {
            self::$ins = new Request;
        }
        return self::$ins;
    }

    public function httpProtocol() {
        if (isset($_SERVER["HTTPS"])) {
            return "https://";
        } else {
            return "http://";
        }
    }

    public function httpHost() {
        return $_SERVER["HTTP_HOST"];
    }

    public function getUrl() {
        return substr($_SERVER["REQUEST_URI"], 1);
    }

    public function parsedUrl() {
        $url = $this->getUrl();
        $routeUrl = $this->getRoute($url);

        if ($this->isValidUrl($routeUrl)) {
            return explode("/", $routeUrl);
        } else {
            //hata
        }
    }

    private function getRoute($url) {
        $route = parse_url($url);
        return $route["path"];
    }

    public function fullUrl() {
        return $this->httpProtocol() . $this->httpHost() . "/" . $this->getUrl();
    }

    private function isValidUrl($url) {

        if (!preg_match('/^[a-zA-Z0-9-\/]+$/', $url)) {
            return false;
        } else {
            return true;
        }
    }

}

<?php

namespace Mvc\Core;

class Model {

    private static $ignoreRequired;
    private static $invalidCols = [];
    private static $validationFailed = false;
    private static $model;

    public function bind() {

        foreach ($this->alias() as $col => $alias) {
            if (isset($_POST[$alias["input"]]))
                $this->$col = $_POST[$alias["input"]];
        }
        return $this;
    }

    public function save() {
        self::$model = $this;
        self::$ignoreRequired = false;

        if (!self::validateModel()) {
            return self::showValidationErrors();
        } else {
            if($save = \Mvc\Core\Data::Insert($this)){
                $this->id = $save["id"];
                return true;
            }
        }
    }

    private static function validateModel() {

        self::validateRequired(self::$model);

        self::validateRegex(self::$model);

        self::validateLength(self::$model);

        if (self::$validationFailed == true) {
            return false;
        } else {
            return true;
        }
    }

    private static function validateRequired($model) {
        foreach ($model->validation() as $col => $validation) {
            if ((isset($validation["required"]) && $validation["required"] == true)) {

                if (self::$ignoreRequired == false && strlen($model->$col) == 0) {
                    self::$validationFailed = true;
                    self::$invalidCols[$col]["msg"][] = "Bu alan zorunludur.";
                }
            }
        }
    }

    private static function validateRegex($model) {
        foreach ($model->validation() as $col => $validation) {
            if ((isset($validation["regex"]))) {

                if ($model->$col && !call_user_func(["Mvc\Core\Input", $validation["regex"]], $model->$col)) {
                    self::$validationFailed = true;
                    self::$invalidCols[$col]["msg"][] = "Geçerli değer giriniz.";
                }
            }
        }
    }

    private static function validateLength($model) {
        foreach ($model->validation() as $col => $validation) {
            if ($model->$col && isset($validation["max"]) && strlen($model->$col) > $validation["max"]) {
                self::$validationFailed = true;
                self::$invalidCols[$col]["msg"][] = "En fazla " . $validation["max"] . " karakter uzunluğunda olmalıdır.";
            }
        }
    }

    private static function showValidationErrors() {

        $responseData = [];

        $responseData["success"] = false;
        $responseData["messages"] = self::aliases();
  
        return jsonView($responseData);
    }

    private static function aliases() {
        $converted = [];

        foreach (self::$invalidCols as $key => $item) {
            if (isset(self::$model->alias()[$key])) {

                $new = self::$model->alias()[$key];
                $newKey = $new["input"];

                $converted[$newKey] = $item;
                $converted[$newKey]["title"] = $new["title"];
            }
        }
        return $converted;
    }

}

<?php

namespace Mvc\Core;

use Mvc\Core\Models\ModelBase;
use Mvc\Core\Database;

class Data {

    private static $ins;
    private static $query;
    private static $query_params = [];
    private static $limit = 10;

    public static function Select(ModelBase $Model, $select = NULL) {

        if (is_null($select)) {
            $select = "*";
        }
        $Data = new Data;
        $Data::$query = "SELECT " . $select . " FROM " . $Model->table;

        return $Data;
    }

    public static function Insert(ModelBase $Model) {

        $cols = [];
        $vals = [];
        foreach ($Model as $col => $val) {
            if (in_array($col, ["table", "id"])) {
                continue;
            }
            if ($val != "") {
                $cols[] = $col;
                $vals[] = ":" . $col;
                self::$query_params[":" . $col] = $val;
            }
        }

        $Data = new Data;
        $Data::$query = "INSERT INTO " . $Model->table . " ( " . implode(",", $cols) . ") VALUES ( " . implode(",", $vals) . ")";

        return $Data->executeInsert();
    }

    public static function Delete(ModelBase $Model) {

        $Data = new Data;
        $Data::$query = "DELETE FROM " . $Model->table;

        return $Data;
    }

    public function where($col, $val = NULL) {

        $where = [];
        if (is_array($col)) {
            foreach ($col as $_k => $_v) {
                $where[] = $_k . " = :" . $_k;
                self::$query_params[":" . $_k] = $_v;
            }
        } else {
            $where[] = $col . "=" . $val;
        }

        if (!empty($where)) {
            self::$query = self::$query . " WHERE " . implode(" AND ", $where);
        }

        return $this;
    }

    public function whereIn($col, $val = []) {

        if (!empty($val)) {
            $where = $col . " IN (" . substr(str_repeat(',?', count($val)), 1) . ")";
            foreach ($val as $_k => $_v) {
                self::$query_params[$_k] = $_v;
            }
            self::$query = self::$query . " WHERE " . $where;
        }
        return $this;
    }

    public function orderby($col, $dir = "ASC") {

        self::$query = self::$query . " ORDER BY  " . $col . " " . $dir;

        return $this;
    }

    public function limit($page, $limit = NULL) {

        if (is_null($limit)) {
            $limit = self::$limit;
        }

        $start = ($page - 1) * $limit;

        self::$query = self::$query . " LIMIT  " . $start . "," . $limit;

        return $this;
    }

    private function executeSelect() {
        $c = Database::getInstance();
        $connection = $c->getConnection();

        $statement = $connection->prepare(self::$query);
        $statement->execute(self::$query_params);
        self::$query_params = [];
        $c->closeConnection();
        return $statement;
    }

    private function executeInsert() {
        $c = Database::getInstance();
        $connection = $c->getConnection();
        try {
            $statement = $connection->prepare(self::$query);
            $statement->execute(self::$query_params);
            self::$query_params = [];
            $insertId = $connection->lastInsertId();
            return ["id" => $insertId];
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $c->closeConnection();
    }
    
    public function executeDelete() {
        $c = Database::getInstance();
        $connection = $c->getConnection();

        $statement = $connection->prepare(self::$query);
        foreach(self::$query_params as $index=> $query_param){
            $statement->bindValue($index+1, $query_param);
        }
        $statement->execute();
        self::$query_params = [];
        $c->closeConnection();
        return $statement;
    }

    public function fetchAll() {
        $statement = $this->executeSelect();
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

    public function fetch() {
        $statement = $this->executeSelect();
        $rows = $statement->fetch();

        return $rows;
    }

}

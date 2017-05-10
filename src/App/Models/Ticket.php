<?php

namespace App\Models;

use Mvc\Core\Models\ModelBase;
use Mvc\Core\Model;

class Ticket extends Model implements ModelBase {

    public $table = "tickets";
    public $id;
    public $title;
    public $content;
    public $attachment;
    public $status;
    public $created_at;
    public $closed_at;

    public function validation() {
        return [
            "title" => ["required" => true, "regex" => "text", "max" => 255],
            "content" => ["required" => true, "regex" => "text"],
            "attachment" => [ "regex" => "file"],
            "status" => [ "regex" => "integer", "max" => 3],
            "created_at" => [ "regex" => "datetime"],
            "closed_at" => [ "regex" => "datetime"],
        ];
    }

    public function alias() {

        return [
            "title" => ["input" => "baslik", "title" => "Başlık"],
            "content" => ["input" => "aciklama", "title" => "Açıklama"],
            "attachment" => ["input" => "dosya", "title" => "Resim"],
            "status" => ["input" => "durum", "title" => "Durum"],
        ];
    }

}

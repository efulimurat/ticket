<?php

namespace Mvc\Lib;

use Mvc\Core\Data;
use App\Models\Ticket as TicketModel;

class Ticket {

    public function getTicketDetail($id) {

        $TicketModel = new TicketModel;

        $getTicket = Data::Select($TicketModel)->where(["id" => $id])->fetch();

        return $getTicket;
    }

    public function getTickets($page) {

        $TicketModel = new TicketModel;

        $getTicket = Data::Select($TicketModel)->orderby("id", "desc")->limit($page)->fetchAll();

        return $getTicket;
    }

    public function deleteTickets($idList) {

        $TicketModel = new TicketModel;

        if ($deleteTickets = Data::Delete($TicketModel)->whereIn("id", $idList)->executeDelete()) {
            return true;
        }

        return false;
    }

    public function exportTickets() {

        /**
         * Son 100 satır diyelim...
         */
        $TicketModel = new TicketModel;

        $getTickets = Data::Select($TicketModel, "id,title,content,status,created_at")->orderby("id", "desc")->limit(1, 100)->fetchAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        $output = fopen('php://output', 'w');

        fputcsv($output, array('ID', 'Title', 'Content', 'Status','Datetime'));

        foreach ($getTickets as $ticket) {
            fputcsv($output, $ticket);
        }

        return true;
    }

}

<?php

namespace App\Controllers;

use Mvc\Lib\Ticket as TicketRepo;
use App\Models\Ticket as TicketModel;

class Ticket {

    public function detail($ticket_id) {

        if ((int) $ticket_id == 0) {
            return error404();
        }

        $TicketRepo = new TicketRepo;
        $getTicket = $TicketRepo->getTicketDetail($ticket_id);

        $layout = "layouts/Main";
        $template = "Ticket/Detail";
        $data = ["TicketDetails" => $getTicket];

        setTitle($getTicket["id"] . " Ticket Detayları");

        return blockView($layout, $template, $data);
    }

    public function lists($page = 1) {

        if ((int) $page < 1) {
            $page = 1;
        }

        $TicketRepo = new TicketRepo;
        $getTickets = $TicketRepo->getTickets($page);

        $layout = "layouts/Main";
        $template = "Ticket/Lists";
        $data = ["Tickets" => $getTickets];

        setTitle("Ticket Listesi");
        return blockView($layout, $template, $data);
    }

    public function add() {

        $layout = "layouts/Main";
        $template = "Ticket/Add";

        setTitle("Ticket Ekle");
        return blockView($layout, $template);
    }

    public function save() {
        $Ticket = new TicketModel;
        $Ticket->bind();
        $Ticket->status = 1;
        $Ticket->created_at = date('Y-m-d H:i:s');

        if ($Ticket->save()) {
            $responseData = [];

            $responseData["success"] = true;
            $responseData["message"] = $Ticket->id . " Numaralı Ticket Kaydedilmiştir!";

            return jsonView($responseData);
        }
    }

    public function delete() {

        $TicketRepo = new TicketRepo;

        $idList = $_POST["id"];

        if (empty($idList)) {
            return false;
        }

        foreach ($idList as $key => $id) {
            if ((int) $id < 1) {
                unset($idList[$key]);
            }
        }
        if ($deleteTickets = $TicketRepo->deleteTickets($idList)) {
            $responseData = [];

            $responseData["success"] = true;
            $responseData["message"] = "ticket'lar silinmiştir";

            return jsonView($responseData);
        }
    }

    public function exportAll() {
        $TicketRepo = new TicketRepo;
        $TicketRepo->exportTickets();
        return true;
    }

}

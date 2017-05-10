<div class="container">
    <div class="row">
        <?php if (!empty($Tickets)) { ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Başlık</th>
                        <th>Açıklama</th>
                        <th>Eklenme Tarihi</th>
                        <th>Durum</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($Tickets as $key => $Ticket) { ?>
                        <tr>
                            <td><input type="checkbox" name="ticketSelection[]" value="<?= $Ticket["id"] ?>"/></td>
                    <td><?= $Ticket["title"] ?></td>
                    <td><?= $Ticket["content"] ?></td>
                    <td><?= date_format1($Ticket["created_at"]) ?></td>
                    <td><?= $Ticket["status"] == 1 ? "Açık" : "Kapalı" ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <ul class="pagination pull-right">
                <?php for ($i = 1; $i < 10; $i++) { ?>
                    <li><a href="<?=url("ticket/lists/$i")?>"><?=$i?></a></li>
                <?php } ?>
            </ul>
            <button type="button" class="btn btn-danger deleteTickets" data-url="<?= url("ticket/delete") ?>">Seçilileri Sil</button>

            <?php
        } else {
            ?>
            <div class="col-md-12">Kayıt Bulunamadı</div> 
        <?php }
        ?>
    </div>
</div>
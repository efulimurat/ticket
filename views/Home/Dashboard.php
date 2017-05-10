<div class="container">
    <div class="row">
        <form name="submit" action="<?=url("ticket/save")?>">
            <div class="form-group">
                <label for="baslik">Başlık</label>
                <input class="form-control"  name="baslik" placeholder="Ticket Başlığı">
            </div>
            
            <div class="form-group">
                <label for="aciklama">Açıklama</label>
                <textarea class="form-control" name="aciklama" placeholder="Ticket Açıklaması"></textarea>
            </div>
            
           
            <div class="form-group">
                <label for="dosya">Ekran Görüntüsü</label>
                <input type="file" name="dosya">
                    <p class="help-block">Ekran görüntüsü resmi ekleyebilirsiniz</p>
            </div>
            
            <button type="submit" class="btn btn-default">Kaydet</button>
        </form>
    </div>
</div>
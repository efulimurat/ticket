$(function () {
    $("form[name='submit']").submit(function (e) {
        var form = $(this);
        e.preventDefault();
        var url = $(this).attr("action");

        if (!url) {
            alert("Form Hatası: adres eksik");
            return false;
        }

        form.find(".errorMessage").remove();
        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            dataType: "json",
            async: false,
            success: function (e) {
                if (e.success == false) {
                    $.each(e.messages, function (k, v) {
                        $("label[for='" + k + "']").after("<span class='errorMessage'>&nbsp" + v.msg + "</span>");
                    })
                }
                else if (e.success == true) {
                    alert(e.message);
                    window.location.reload();
                }
            }
        })
    })

    $(".deleteTickets").click(function () {
        var checkedIds = [];
        if (confirm("Seçili ticket'ları silmek istediğinize emin misiniz?")) {
            $("[name='ticketSelection[]']:checked").each(function () {
                checkedIds.push($(this).val());
            })

            deleteEvent($(this).data("url"), checkedIds);


        }
    })

})

function deleteEvent(url, checkedIds) {
    $.ajax({
        url: url,
        type: "POST",
        data: {"id": checkedIds},
        dataType: "json",
        async: false,
        success: function (e) {
            if (e.success == false) {
                alert("Bir Hata meydana geldi");
            }
            else if (e.success == true) {
                alert("Ticketlar silindi");
                window.location.reload();
            }
        }
    })
}
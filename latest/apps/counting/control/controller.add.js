fn.app.counting.dialog_add = function () {
    var item_selected = $("#tblCounting").data("selected");
    $.ajax({
        url: "apps/counting/view/dialog.add.php",
        type: "POST",
        data: {item: item_selected},
        dataType: "html",
        success: function (html) {
            $("body").append(html);
            fn.ui.modal.setup({dialog_id: "#dialog_add_counting"});
        }
    });
};

fn.app.counting.add = function () {
    $.post("apps/counting/xhr/action-add.php", $("form[name=form_add_counting]").serialize(), function (response) {
        if (response.success) {
            $("#tblCounting").data("selected", []);
            $("#tblCounting").DataTable().draw();
            $("#dialog_add_counting").modal("hide");
        } else {
            fn.notify.warnbox(response.msg, "Oops...");
        }
    }, "json");
    return false;
};

fn.app.counting.report = function (type) {
    var item_selected = $("#tblCounting").data("selected");
    if(item_selected.length<1){
        fn.notify.warnbox('Please select items', "Oops...");
    }else {
        $.ajax({
            type: "POST",
            dataType: "html",
            success: function (html) {
                var s = '';
                window.location = '#apps/counting/index.php?view=' + type+'&id='+item_selected;
                // for (i in json) {
                //     s += json;
                // }
                // $("#report tbody").html(s);
            }
        });
    }

};



	fn.app.counting.dialog_close = function() {
		var item_selected = $("#tblCounting").data("selected");
		$.ajax({
			url: "apps/counting/view/dialog.close.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_close_counting"});
			}
		});
	};

	fn.app.counting.close = function(){
		$.post("apps/counting/xhr/action-close.php",$("form[name=form_close_counting]").serialize(),function(response){
			if(response.success){
				$("#tblCounting").data("selected",[]);
				$("#tblCounting").DataTable().draw();
				$("#dialog_close_counting").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

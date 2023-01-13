	fn.app.counter.dialog_cancel = function() {
		var item_selected = $("#tblCounter").data("selected");
		$.ajax({
			url: "apps/counter/view/dialog.cancel.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_cancel_counter"});
			}
		});
	};

	fn.app.counter.cancel = function(){
		$.post("apps/counter/xhr/action-cancel.php",$("form[name=form_cancel_counter]").serialize(),function(response){
			if(response.success){
				$("#tblCounter").data("selected",[]);
				$("#tblCounter").DataTable().draw();
				$("#dialog_cancel_counter").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

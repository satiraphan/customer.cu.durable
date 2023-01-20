	fn.app.validator.dialog_close = function() {
		var item_selected = $("#tblValidator").data("selected");
		$.ajax({
			url: "apps/validator/view/dialog.close.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_close_validator"});
			}
		});
	};

	fn.app.validator.close = function(){
		$.post("apps/validator/xhr/action-close.php",$("form[name=form_close_validator]").serialize(),function(response){
			if(response.success){
				$("#tblValidator").data("selected",[]);
				$("#tblValidator").DataTable().draw();
				$("#dialog_close_validator").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

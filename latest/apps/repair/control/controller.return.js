	fn.app.repair.dialog_return = function() {
		var item_selected = $("#tblRepair").data("selected");
		$.ajax({
			url: "apps/repair/view/dialog.return.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_return_repair"});
			}
		});
	};

	fn.app.repair.return = function(){
		$.post("apps/repair/xhr/action-return.php",$("form[name=form_return_repair]").serialize(),function(response){
			if(response.success){
				$("#tblRepair").data("selected",[]);
				$("#tblRepair").DataTable().draw();
				$("#dialog_return_repair").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

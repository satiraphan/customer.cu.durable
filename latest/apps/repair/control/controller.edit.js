	fn.app.repair.dialog_edit = function(id) {
		$.ajax({
			url: "apps/repair/view/dialog.edit.php",
			type: "POST",
			data: {id:id},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_repair"});
			}
		});
	};

	fn.app.repair.edit = function(){
		$.post("apps/repair/xhr/action-edit.php",$("form[name=form_edit_repair]").serialize(),function(response){
			if(response.success){
				$("#tblRepair").data("selected",[]);
				$("#tblRepair").DataTable().draw();
				$("#dialog_edit_repair").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

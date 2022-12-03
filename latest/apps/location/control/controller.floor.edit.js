	fn.app.location.floor.dialog_edit = function(id) {
		$.ajax({
			url: "apps/location/view/dialog.floor.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_floor"});
			}
		});
	};

	fn.app.location.floor.edit = function(){
		$.post("apps/location/xhr/action-edit-floor.php",$("form[name=form_editfloor]").serialize(),function(response){
			if(response.success){
				$("#tblFloor").DataTable().draw();
				$("#dialog_edit_floor").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	fn.app.location.room.dialog_edit = function(id) {
		$.ajax({
			url: "apps/location/view/dialog.room.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_room"});
			}
		});
	};

	fn.app.location.room.edit = function(){
		$.post("apps/location/xhr/action-edit-room.php",$("form[name=form_editroom]").serialize(),function(response){
			if(response.success){
				$("#tblRoom").DataTable().draw();
				$("#dialog_edit_room").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

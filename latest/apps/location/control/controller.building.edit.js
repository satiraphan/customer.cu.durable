	fn.app.location.building.dialog_edit = function(id) {
		$.ajax({
			url: "apps/location/view/dialog.building.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_building"});
			}
		});
	};

	fn.app.location.building.edit = function(){
		$.post("apps/location/xhr/action-edit-building.php",$("form[name=form_editbuilding]").serialize(),function(response){
			if(response.success){
				$("#tblBuilding").DataTable().draw();
				$("#dialog_edit_building").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

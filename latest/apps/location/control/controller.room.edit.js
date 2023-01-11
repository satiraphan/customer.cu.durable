	fn.app.location.room.dialog_edit = function(id) {
		$.ajax({
			url: "apps/location/view/dialog.room.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_room"});

				$("form[name=form_editroom] select[name=building]").change(function(){
					$("form[name=form_editroom] select[name=parent]").html("");
					$.post("apps/location/xhr/action-list-building.php",{building_id:$(this).val()},function(json){
						for(i in json){
							let s = '<option value="'+json[i][0]+'">'+json[i][1]+'</option>';
							$("form[name=form_editroom] select[name=parent]").append(s);
						}
					},"json");
				});
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

	fn.app.location.room.dialog_add = function() {
		$.ajax({
			url: "apps/location/view/dialog.room.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_room"});

				$("form[name=form_addroom] select[name=building]").change(function(){
					$("form[name=form_addroom] select[name=parent]").html("");
					$.post("apps/location/xhr/action-list-building.php",{building_id:$(this).val()},function(json){
						for(i in json){
							let s = '<option value="'+json[i][0]+'">'+json[i][1]+'</option>';
							$("form[name=form_addroom] select[name=parent]").append(s);
						}
					},"json");
				}).change();

			}
		});
	};

	fn.app.location.room.add = function(){
		$.post("apps/location/xhr/action-add-room.php",$("form[name=form_addroom]").serialize(),function(response){
			if(response.success){
				$("#tblRoom").DataTable().draw();
				$("#dialog_add_room").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "add_circle_outline",
		onclick : "fn.app.location.room.dialog_add()",
		caption : "Add"
	}));

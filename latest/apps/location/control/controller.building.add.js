	fn.app.location.building.dialog_add = function() {
		$.ajax({
			url: "apps/location/view/dialog.building.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_building"});
			}
		});
	};

	fn.app.location.building.add = function(){
		$.post("apps/location/xhr/action-add-building.php",$("form[name=form_addbuilding]").serialize(),function(response){
			if(response.success){
				$("#tblBuilding").DataTable().draw();
				$("#dialog_add_building").modal("hide");
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
		onclick : "fn.app.location.building.dialog_add()",
		caption : "Add"
	}));

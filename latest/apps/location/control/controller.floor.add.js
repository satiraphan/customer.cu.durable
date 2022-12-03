	fn.app.location.floor.dialog_add = function() {
		$.ajax({
			url: "apps/location/view/dialog.floor.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_floor"});
			}
		});
	};

	fn.app.location.floor.add = function(){
		$.post("apps/location/xhr/action-add-floor.php",$("form[name=form_addfloor]").serialize(),function(response){
			if(response.success){
				$("#tblFloor").DataTable().draw();
				$("#dialog_add_floor").modal("hide");
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
		onclick : "fn.app.location.floor.dialog_add()",
		caption : "Add"
	}));

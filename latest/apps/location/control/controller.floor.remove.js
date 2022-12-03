	fn.app.location.floor.dialog_remove = function() {
		var item_selected = $("#tblFloor").data("selected");
		$.ajax({
			url: "apps/location/view/dialog.floor.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_floor").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_floor").modal("show");
				$("#dialog_remove_floor .btnConfirm").click(function(){
					fn.app.location.floor.remove();
				});
			}
		});
	};

	fn.app.location.floor.remove = function(){
		var item_selected = $("#tblFloor").data("selected");
		$.post("apps/location/xhr/action-remove-floor.php",{items:item_selected},function(response){
			$("#tblFloor").data("selected",[]);
			$("#tblFloor").DataTable().draw();
			$("#dialog_remove_floor").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.location.floor.dialog_remove()",
		caption : "Remove"
	}));

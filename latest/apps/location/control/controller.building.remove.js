	fn.app.location.building.dialog_remove = function() {
		var item_selected = $("#tblBuilding").data("selected");
		$.ajax({
			url: "apps/location/view/dialog.building.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_building").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_building").modal("show");
				$("#dialog_remove_building .btnConfirm").click(function(){
					fn.app.location.building.remove();
				});
			}
		});
	};

	fn.app.location.building.remove = function(){
		var item_selected = $("#tblBuilding").data("selected");
		$.post("apps/location/xhr/action-remove-building.php",{items:item_selected},function(response){
			$("#tblBuilding").data("selected",[]);
			$("#tblBuilding").DataTable().draw();
			$("#dialog_remove_building").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.location.building.dialog_remove()",
		caption : "Remove"
	}));

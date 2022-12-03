	fn.app.location.room.dialog_remove = function() {
		var item_selected = $("#tblRoom").data("selected");
		$.ajax({
			url: "apps/location/view/dialog.room.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_room").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_room").modal("show");
				$("#dialog_remove_room .btnConfirm").click(function(){
					fn.app.location.room.remove();
				});
			}
		});
	};

	fn.app.location.room.remove = function(){
		var item_selected = $("#tblRoom").data("selected");
		$.post("apps/location/xhr/action-remove-room.php",{items:item_selected},function(response){
			$("#tblRoom").data("selected",[]);
			$("#tblRoom").DataTable().draw();
			$("#dialog_remove_room").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.location.room.dialog_remove()",
		caption : "Remove"
	}));

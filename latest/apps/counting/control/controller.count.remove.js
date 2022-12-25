	fn.app.counting.count.dialog_remove = function() {
		var item_selected = $("#tblCount").data("selected");
		$.ajax({
			url: "apps/counting/view/dialog.count.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_count").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_count").modal("show");
				$("#dialog_remove_count .btnConfirm").click(function(){
					fn.app.counting.count.remove();
				});
			}
		});
	};

	fn.app.counting.count.remove = function(){
		var item_selected = $("#tblCount").data("selected");
		$.post("apps/counting/xhr/action-remove-count.php",{items:item_selected},function(response){
			$("#tblCount").data("selected",[]);
			$("#tblCount").DataTable().draw();
			$("#dialog_remove_count").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.counting.count.dialog_remove()",
		caption : "Remove"
	}));

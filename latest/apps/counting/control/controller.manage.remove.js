	fn.app.counting.manage.dialog_remove = function() {
		var item_selected = $("#tblManage").data("selected");
		$.ajax({
			url: "apps/counting/view/dialog.manage.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_manage").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_manage").modal("show");
				$("#dialog_remove_manage .btnConfirm").click(function(){
					fn.app.counting.manage.remove();
				});
			}
		});
	};

	fn.app.counting.manage.remove = function(){
		var item_selected = $("#tblManage").data("selected");
		$.post("apps/counting/xhr/action-remove-manage.php",{items:item_selected},function(response){
			$("#tblManage").data("selected",[]);
			$("#tblManage").DataTable().draw();
			$("#dialog_remove_manage").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.counting.manage.dialog_remove()",
		caption : "Remove"
	}));

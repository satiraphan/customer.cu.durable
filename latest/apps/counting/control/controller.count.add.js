	fn.app.counting.count.dialog_add = function() {
		$.ajax({
			url: "apps/counting/view/dialog.count.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_count"});
			}
		});
	};

	fn.app.counting.count.add = function(){
		$.post("apps/counting/xhr/action-add-count.php",$("form[name=form_addcount]").serialize(),function(response){
			if(response.success){
				$("#tblCount").DataTable().draw();
				$("#dialog_add_count").modal("hide");
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
		onclick : "fn.app.counting.count.dialog_add()",
		caption : "Add"
	}));

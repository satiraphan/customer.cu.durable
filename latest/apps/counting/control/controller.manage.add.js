	fn.app.counting.manage.dialog_add = function() {
		$.ajax({
			url: "apps/counting/view/dialog.manage.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_manage"});
			}
		});
	};

	fn.app.counting.manage.add = function(){
		$.post("apps/counting/xhr/action-add-manage.php",$("form[name=form_addmanage]").serialize(),function(response){
			if(response.success){
				$("#tblManage").DataTable().draw();
				$("#dialog_add_manage").modal("hide");
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
		onclick : "fn.app.counting.manage.dialog_add()",
		caption : "Add"
	}));

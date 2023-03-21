	fn.app.validator.validate = function(){
		$.post("apps/validator/xhr/action-validate.php",$("form[name=form_validate_validator]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	fn.ui.datatable.init();
	$("#tblValidate").data( "selected", [] );
	$("#tblValidate").DataTable({
		"bStateSave": true,
		"autoWidth" : true,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "apps/validator/store/store-item.php",	
			"data": function ( d ) {
				d.counting_id = $('#tblValidate').attr('counting-id');
			}
		},
		"aoColumns": [
			{"bSort":true					,"data":"code"	,"class":"text-center",	},
			{"bSort":true					,"data":"name"	,"class":"text-center",	},
			{"bSort":true					,"data":"serial"	,"class":"text-center",	},
			{"bSort":true					,"data":"asset_status"	,"class":"text-center",	},
			{"bSort":true					,"data":"validated"	,"class":"text-center",	},
			{"bSort":true					,"data":"username"	,"class":"text-center",	},
			{"bSort":true					,"data":"action"	,"class":"text-center",	},
			{"bSort":true					,"data":"detail"	,"class":"text-center",	},
			{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "120px"  }
		],"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var selected = false,checked = "",s = '';
			
			s = '';

			if(data.checked == null){
				s += fn.ui.button("btn btn-xs btn-outline-primary mr-1","fa fa-thumbs-up","fn.app.validator.checked("+data.id+")");
				s += fn.ui.button("btn btn-xs btn-outline-warning mr-1","fa fa-list-check","fn.app.validator.dialog_task("+data.id+")");
			}

			switch(data.status){
				case "0":$("td", row).eq(3).html("<span class='badge badge-danger'>ไม่พบ</span>");break;
				case "1":$("td", row).eq(3).html("<span class='badge badge-dark'>ปกติ</span>");break;
				case "2":$("td", row).eq(3).html("<span class='badge badge-warning'>กำลังซ่อม</span>");break;
			}

			switch(data.action){
				case "1":$("td", row).eq(6).html('<span class="badge badge-success">ข้อมูลถูกต้อง</span>');break;
				case "2":$("td", row).eq(6).html('<span class="badge badge-warning">พบความเสียหาย</span>');break;
				case "3":$("td", row).eq(6).html('<span class="badge badge-primary">ผิดตำแหน่ง</span>');break;
				case "4":$("td", row).eq(6).html('<span class="badge badge-danger">ไม่พบของ</span>');break;
				case "5":$("td", row).eq(6).html('<span class="badge badge-dark">อื่น ๆ</span>');break;
			}

			//s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-thumps-up","fn.navigate('validator','view=lookup&id="+data[0]+"')");
			$("td", row).eq(8).html(s);
		}
	});

	fn.app.validator.checked = function(id){
		$.post("apps/validator/xhr/action-checked.php",{id:id},function(response){
			if(response.success){
				$("#tblValidate").DataTable().draw();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	fn.app.validator.dialog_close = function() {
		var item_selected = $("#tblValidator").data("selected");
		$.ajax({
			url: "apps/validator/view/dialog.close.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_close_validator"});
			}
		});
	};

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
				d.show_all = $('#chk_showall').prop('checked');
			}
		},
		"aoColumns": [
			{"bSortable":false		,"data":"id"	,"class":"text-center", "sWidth": "10px"	},
			{"bSort":true				,"data":"code"	,"class":"text-center",	},
			{"bSort":true				,"data":"name"	,"class":"text-center",	},
			{"bSort":true				,"data":"serial"	,"class":"text-center",	},
			{"bSort":true				,"data":"asset_status"	,"class":"text-center",	},
			{"bSort":true				,"data":"validated"	,"class":"text-center",	},
			{"bSort":true				,"data":"username"	,"class":"text-center",	},
			{"bSort":true				,"data":"action"	,"class":"text-center",	},
			{"bSort":true				,"data":"detail"	,"class":"text-center",	},
			{"bSortable":false			,"data":"id"		,"class":"text-center" , "sWidth": "120px"  },
			{"bSort":true				,"data":"task_status"	,"class":"text-center",	}
		],"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var selected = false,checked = "",s = '';
			if ( $.inArray(data.DT_RowId, $("#tblValidate").data( "selected")) !== -1 ) {
				$(row).addClass("selected");
				selected = true;
			}
			$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_validate",data[0],selected));
			
			s = '';

			if(data.checked == null){
				s += fn.ui.button("btn btn-xs btn-outline-primary mr-1","fa fa-thumbs-up","fn.app.validator.checked("+data.id+")");
				s += fn.ui.button("btn btn-xs btn-outline-warning mr-1","fa fa-list-check","fn.app.validator.dialog_task("+data.id+")");
			}

			switch(data.status){
				case "0":$("td", row).eq(4).html("<span class='badge badge-danger'>ไม่พบ</span>");break;
				case "1":$("td", row).eq(4).html("<span class='badge badge-dark'>ปกติ</span>");break;
				case "2":$("td", row).eq(4).html("<span class='badge badge-warning'>กำลังซ่อม</span>");break;
			}

			switch(data.action){
				case "1":$("td", row).eq(7).html('<span class="badge badge-success">ข้อมูลถูกต้อง</span>');break;
				case "2":$("td", row).eq(7).html('<span class="badge badge-warning">พบความเสียหาย</span>');break;
				case "3":$("td", row).eq(7).html('<span class="badge badge-primary">ผิดตำแหน่ง</span>');break;
				case "4":$("td", row).eq(7).html('<span class="badge badge-danger">ไม่พบของ</span>');break;
				case "5":$("td", row).eq(7).html('<span class="badge badge-dark">อื่น ๆ</span>');break;
			}

			//s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-thumps-up","fn.navigate('validator','view=lookup&id="+data[0]+"')");
			$("td", row).eq(9).html(s);

			if(data.task_status != null){
				$("td", row).eq(10).html('<span class="badge badge-info p-2">เพิ่มงานแล้ว</span>');
			}
		}
	});

	fn.ui.datatable.selectable_custom('#tblValidate','chk_validate',true,function(){
		let s = '';
		$.each($("#tblValidate").data("selected"), function( index, value ) {
			s += '<span class="badge badge-dark">'+value+'</span>';
		});
		$("#selected_item").html(s);
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



	fn.app.validator.dialog_validate_all = function() {
		var item_selected = $("#tblValidate").data("selected");
		$.ajax({
			url: "apps/validator/view/dialog.validate_all.php",
			type: "POST",
			data: {items:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_validate_all"});
			}
		});
	};

	fn.app.validator.validate_all = function(){
		$.post("apps/validator/xhr/action-validate-all.php",$("form[name=form_validate_all]").serialize(),function(response){
			if(response.success){
				$("#tblValidate").data("selected",[]);
				$("#tblValidate").DataTable().draw();
				$("#dialog_validate_all").modal("hide");

			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};



	fn.app.validator.dialog_check_all = function() {
		var item_selected = $("#tblValidate").data("selected");
		$.ajax({
			url: "apps/validator/view/dialog.check_all.php",
			type: "POST",
			data: {items:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_check_all"});
			}
		});
	};

	fn.app.validator.check_all = function(){
		$.post("apps/validator/xhr/action-check-all.php",$("form[name=form_check_all]").serialize(),function(response){
			if(response.success){
				$("#tblValidate").data("selected",[]);
				$("#tblValidate").DataTable().draw();
				$("#dialog_check_all").modal("hide");

			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};


fn.ui.datatable.init();
$("#tblAsset").data( "selected", [] );
$("#tblAsset").DataTable({
	scrollX: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/counter/store/store-asset.php",	
		"data": function ( d ) {
			d.counting_id = $('#tblAsset').attr('data-counting-id');
			d.show_all = $('#chk_showall').prop('checked');

			
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center","width" : "120"  },
		{"bSort":true					,"data":"action_number"	,"class":"text-center",	},
		{"bSort":true					,"data":"code"	,"class":"text-center",	},
		{"bSort":true					,"data":"category"	,"class":"text-center",	},
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSort":true					,"data":"brand"	,"class":"text-center",	},
		{"bSort":true					,"data":"location"	,"class":"text-center",	},
		{"bSort":true					,"data":"status"	,"class":"text-center",	},
		{"bSort":true					,"data":"serial"	,"class":"text-center",	},
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		var counting_id = $('#tblAsset').attr('data-counting-id');

		switch(data.action_number){
			case "1":$("td", row).eq(1).html('<span class="badge badge-success">ข้อมูลถูกต้อง</span>');break;
			case "2":$("td", row).eq(1).html('<span class="badge badge-warning">พบความเสียหาย</span>');break;
			case "3":$("td", row).eq(1).html('<span class="badge badge-primary">ผิดตำแหน่ง</span>');break;
			case "4":$("td", row).eq(1).html('<span class="badge badge-danger">ไม่พบของ</span>');break;
			case "5":$("td", row).eq(1).html('<span class="badge badge-dark">ปัญหาอื่น ๆ</span>');break;
			default:$("td", row).eq(1).html('-');break;
		}

		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","fa fa-box-check","fn.navigate('counter','view=inspect&id="+data[0]+"&counting_id="+counting_id+"')","","ตรวจนับ");
		//s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('asset','view=edit&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('asset','view=lookup&id="+data[0]+"')","","ข้อมูล");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-images","fn.navigate('asset','view=gallery&id="+data[0]+"')","","รูปภาพ");
		$("td", row).eq(0).html(s);
	}
});


	
	
	fn.app.counter.count = function(){
		$.post("apps/counter/xhr/action-count.php",$("form[name=form_count_counter]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	fn.app.counter.dialog_location_lookup = function(counting_id,user_id) {
		var selected_member = [];
		$("tr[cname=tr-location]").each(function(){
			selected_member.push($(this).attr("data-id"));
		});
		$.ajax({
			url: "apps/counter/view/dialog.location.lookup.php",
			type: "POST",
			data : {
				counting_id : counting_id,
				user_id : user_id
			},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_location_lookup"});
				$("#tblLocationLookup").data( "selected",[]);
				$('#tblLocationLookup').DataTable({
					"bStateSave": true,
					"autoWidth" : true,
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "apps/counter/store/store-location.php",	
						"data": function ( d ) {
							d.counting_id = counting_id;
							d.user_id = user_id;
						}
					},
					"aoColumns": [
						{"bSortable": false	,"data":"id"		,"sWidth": "20px", "sClass" : "hidden-xs text-center"},
						{"bSortable": false	,"data":"code"		,"sClass" : "text-center"},
						{"bSortable": false	,"data":"name"	,"sClass" : "hidden-xs text-center"},
						{"bSortable" : true	,"data":"type"	,"sClass" : "text-center"}
					],"order": [[ 2, "desc" ]],
					"createdRow": function ( row, data, index ) {
						var selected = false,checked = "",s = '';
						if ( $.inArray(data.DT_RowId, selected_member) !== -1 ) {
							$(row).addClass('hidden');
							$('td', row).eq(0).html('<span class="badge badge-dark">Selected</span>');
						}else{
							if ( $.inArray(data.DT_RowId, $("#tblLocationLookup").data("selected")) !== -1 ) {
								$(row).addClass('selected');
								selected = true;
							}
							$('td', row).eq(0).html(fn.ui.checkbox("chk_location",data[0],selected,true));
						}
					}
				});
				fn.ui.datatable.selectable('#tblLocationLookup','chk_location',true);
			}	
		});
		return false;
	}

	fn.app.counter.select_location = function(counting_id,user_id) {
		var selected_member = $("#tblLocationLookup").data("selected");
		if(selected_member.length==0){
			fn.engine.alert("No selected","Please select item!");
		}else{
			$.post("apps/counter/xhr/action-append-location.php",{
				location:$("#tblLocationLookup").data("selected"),
				counting_id : counting_id,
				user_id : user_id
			},function(json){
				if(json.success){
					
					$("#dialog_location_lookup").modal('hide');
					window.location.reload();
				}
			},'json');
		}
	}


	fn.app.counter.dialog_search = function(counting_id,user_id) {
		$.ajax({
			url: "apps/counter/view/dialog.count.search.php",
			type: "POST",
			data : {
				counting_id : counting_id,
				user_id : user_id
			},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_count_search"});
				
			}	
		});
		return false;
	}

	fn.app.counter.search = function(){
		$.post("apps/counter/xhr/action-search.php",$("form[name=form-count-search]").serialize(),function(response){
			if(response.success){
				fn.navigate('counter','view=inspect&id='+response.asset_id+'&counting_id='+response.counting_id);
				//window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	
	$.qrCodeReader.jsQRpath = "plugins/qr-code/js/jsQR/jsQR.min.js";
	$.qrCodeReader.beepPath = "plugins/qr-code/audio/beep.mp3";
	
	$("#openreader-btn").qrCodeReader({
		callback : function(code){
			$.post("apps/counter/xhr/action-search.php",{
				"code" : code,
				"counting_id" : $("#openreader-btn").attr("data-counting-id")
			},function(response){
				if(response.success){
					fn.navigate('counter','view=inspect&id='+response.asset_id+'&counting_id='+response.counting_id);
					//window.history.back();
				}else{
					fn.notify.warnbox(response.msg,"Oops...");
				}
			},"json");
		}
	});
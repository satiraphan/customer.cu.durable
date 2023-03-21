fn.ui.datatable.init();
$("#tblValidator").data( "selected", [] );
$("#tblValidator").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/validator/store/store-validator.php",	
		"data": function ( d ) {
			d.account = $('#tblValidator').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSort":true					,"data":"date_start"	,"class":"text-center",	},
		{"bSort":true					,"data":"submitted"	,"class":"text-center",	},
		{"bSort":true					,"data":"submit_user_id"	,"class":"text-center",	},
		{"bSort":true					,"data":"status"	,"class":"text-center",	},
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "120px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblValidator").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_validator",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-warning mr-1","far fa-wrench","fn.navigate('validator','view=validate&id="+data[0]+"')","","จัดการงาน");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-archive","fn.app.validator.dialog_close("+data.id+")","","ปิดงาน");
		$("td", row).eq(6).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblValidator','chk_validator',true,function(){
	let s = '';
	$.each($("#tblValidator").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});

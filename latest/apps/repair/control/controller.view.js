fn.ui.datatable.init();
$("#tblRepair").data( "selected", [] );
$("#tblRepair").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/repair/store/store-repair.php",	
		"data": function ( d ) {
			d.account = $('#tblRepair').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "80px"  },
		{"bSort":true					,"data":"asset_id"	,"class":"text-center",	},
		{"bSort":true					,"data":"asset_name"	,"class":"text-center",	},
		{"bSort":true					,"data":"date_repair_plan"	,"class":"text-center",	},
		{"bSort":true					,"data":"date_repair_actual"	,"class":"text-center",	},
		{"bSort":true					,"data":"task_id"	,"class":"text-center",	}
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblRepair").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_repair",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.app.repair.dialog_edit("+data.id+")","","เปลี่ยนแปลงข้อมูล");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('repair','view=lookup&id="+data[0]+"')","","ดูรายละเอียด");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-check","fn.app.repair.return("+data.id+")","","ส่งมอบกลับ");

		
		$("td", row).eq(1).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblRepair','chk_repair',true,function(){
	let s = '';
	$.each($("#tblRepair").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});

fn.app.repair.report = function (type) {
	var item_selected = $("#tblRepair").data("selected");
	if(item_selected.length<1){
		fn.notify.warnbox('Please select items', "Oops...");
	}else {
		$.ajax({
			type: "POST",
			dataType: "html",
			success: function (html) {
				var s = '';
				window.location = '#apps/repair/index.php?view=' + type + '&id=' + item_selected;
				// for (i in json) {
				//     s += json;
				// }
				// $("#report tbody").html(s);
			}
		});
	}
}

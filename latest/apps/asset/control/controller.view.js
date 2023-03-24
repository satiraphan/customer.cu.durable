fn.ui.datatable.init();
$("#tblAsset").data( "selected", [] );
$("#tblAsset").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/asset/store/store-asset.php",	
		"data": function ( d ) {
			d.account = $('#tblAsset').attr('account');
			d.cat_id = $("select[name=filter-category]").val();
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSort":true					,"data":"code"	,"class":"text-center",	},
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSort":true					,"data":"serial"	,"class":"text-center",	},
		{"bSort":true					,"data":"year_purchase"	,"class":"text-center",	},
		{"bSort":true					,"data":"location"	,"class":"text-center",	},
		{"bSort":true					,"data":"status"	,"class":"text-center",	},
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "120px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblAsset").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_asset",data[0],selected));


		switch(data.status){
			case "0":$("td", row).eq(6).html("<span class='badge badge-danger'>ไม่พบ</span>");break;
			case "1":$("td", row).eq(6).html("<span class='badge badge-dark'>ปกติ</span>");break;
			case "2":$("td", row).eq(6).html("<span class='badge badge-warning'>กำลังซ่อม</span>");break;
		}


		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('asset','view=edit&id="+data[0]+"')","","แก้ไข");
		//s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-images","fn.app.asset.dialog_photo("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-images","fn.navigate('asset','view=gallery&id="+data[0]+"')","","รูปภาพ");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('asset','view=lookup&id="+data[0]+"')","","ข้อมูล");
		$("td", row).eq(7).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblAsset','chk_asset',true,function(){
	let s = '';
	$.each($("#tblAsset").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});

fn.app.asset.print_tag = function() {
	var item_selected = $("#tblAsset").data("selected");
	if(item_selected.length >0){
		fn.navigate('asset','view=tags&ids='+item_selected);
	}else{
		fn.notify.warnbox("โปรดเลือกรายการ","Oops...");
	}
};
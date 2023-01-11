$("#tblRoom").data( "selected", [] );
$("#tblRoom").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/location/store/store-room.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"name","sClass":"text-center" 	},
		{"bSort":true			,"data":"floor","sClass":"text-center" 	},
		{"bSort":true			,"data":"building","sClass":"text-center" 	},
		{"bSort":true			,"data":"status","sClass":"text-center" 	},
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblRoom").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_room",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark","far fa-pen","fn.app.location.room.dialog_edit("+data[0]+")");
		$("td", row).eq(5).html(s);
	}
});
fn.ui.datatable.selectable("#tblRoom","chk_room");

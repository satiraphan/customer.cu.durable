fn.ui.datatable.init();
$("#tblCounter").data( "selected", [] );
$("#tblCounter").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/counter/store/store-counter.php",	
		"data": function ( d ) {
			d.user_id = $('#tblCounter').attr('user-id');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "100px"  },
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSort":true					,"data":"date_start"	,"class":"text-center",	},
		{"bSort":true					,"data":"date_finish"	,"class":"text-center",	},
		{"bSort":true					,"data":"remark"	,"class":"text-center",	},
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-primary mr-1","far fa-play","fn.navigate('counter','view=count&id="+data[0]+"')");
		/*
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('counter','view=edit&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('counter','view=lookup&id="+data[0]+"')");
		*/
		$("td", row).eq(0).html(s);
	}
});

$("#tblIssue").data( "selected", [] );
$("#tblIssue").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/task/store/store-issue.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSortable":false		,"data":"id"		,"sClass":"text-center text-nowrap" , "sWidth": "120px"  },
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"type"			,class:"text-center"	},
		{"bSortable":false		,"data":"status"		,class:"text-center"	},
		{"bSort":true		,"data":"asset_code"	,class:"text-nowrap"				},
		{"bSort":true		,"data":"asset_name"					},
		{"bSort":true		,"data":"issued"		,class:"text-center text-nowrap"	},	
		{"bSort":true		,"data":"issuer"		,class:"text-center text-nowrap"	},
		{"bSort":true		,"data":"counting_item_id" ,class:"text-center"	},
		{"bSort":true		,"data":"current_location"			,class:"text-center "	},
		{"bSort":true		,"data":"title"			,class:"text-center "	},
		{"bSort":true		,"data":"detail"						}
	],"order": [[ 7, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblIssue").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_issue",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-rotate","fn.app.task.issue.dialog_action_relocation("+data[0]+")","","ย้ายสินค้า");
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-screwdriver-wrench","fn.app.task.issue.dialog_action_repair("+data[0]+")","","ส่งซ่อม");
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-empty-set","fn.app.task.issue.dialog_action_change_status_lost("+data[0]+")","","แจ้งหาย");
		$("td", row).eq(1).html(s);
		
		s = fn.ui.button("btn btn-xs btn-outline-dark mr-1","fa-solid fa-check-double","fn.app.task.issue.dialog_close("+data[0]+")","","ยินยันการแก้ไข");
		$("td", row).eq(2).html(s);

		switch(data.type){
			case "1":
				$("td", row).eq(3).html('<span class="badge badge-primary">เปลี่ยนต่ำแหน่ง</span>');
				if(data.current_location_id==data.new_location_id){
					$("td", row).eq(4).html('<span class="badge badge-success">ผ่าน</span>');
				}else{
					$("td", row).eq(4).html('<span class="badge badge-dark">'+data.current_location+'</span> => <span class="badge badge-dark">'+data.new_location+'</dark>' );
				}
				break;
			case "2":
				$("td", row).eq(3).html('<span class="badge badge-danger">ไม่พบของ</span>');
				if(data.asset_status=="0"){
					$("td", row).eq(4).html('<span class="badge badge-success">ผ่าน</span>');
				}else{
					$("td", row).eq(4).html('-');
				}
				break;
			case "3":
				$("td", row).eq(3).html('<span class="badge badge-warning">แจ้งซ่อม</span>');
				if(data.repair_id){
					$("td", row).eq(4).html('<span class="badge badge-success">ผ่าน</span>');
				}else{
					$("td", row).eq(4).html('-');
				}
				
				break;
			default:$("td", row).eq(3).html('-');break;
		}


		switch(data.counting_item_action){
			case "1":$("td", row).eq(9).html('<span title="'+data.counting_item_id+'" class="badge badge-success">ข้อมูลถูกต้อง</span>');break;
			case "2":$("td", row).eq(9).html('<span title="'+data.counting_item_id+'" class="badge badge-warning">พบความเสียหาย</span>');break;
			case "3":$("td", row).eq(9).html('<span title="'+data.counting_item_id+'" class="badge badge-primary">ผิดตำแหน่ง</span>');break;
			case "4":$("td", row).eq(9).html('<span title="'+data.counting_item_id+'" class="badge badge-danger">ไม่พบของ</span>');break;
			case "5":$("td", row).eq(9).html('<span title="'+data.counting_item_id+'" class="badge badge-dark">อื่น ๆ</span>');break;
		}
	}
});
fn.ui.datatable.selectable("#tblIssue","chk_issue");

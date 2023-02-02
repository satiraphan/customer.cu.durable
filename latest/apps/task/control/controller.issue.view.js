$("#tblIssue").data( "selected", [] );
$("#tblIssue").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/task/store/store-issue.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "120px"  },
		{"bSort":true		,"data":"type"			,class:"text-center"	},
		{"bSort":true		,"data":"status"		,class:"text-center"},
		{"bSort":true		,"data":"title"							},
		{"bSort":true		,"data":"asset_name"					},
		{"bSort":true		,"data":"issued"						},
		{"bSort":true		,"data":"issuer"						},
		{"bSort":true		,"data":"counting_item_id"	},
		{"bSort":true		,"data":"remark"						}
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblIssue").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_issue",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-rotate","fn.app.task.issue.dialog_action_relocation("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-screwdriver-wrench","fn.app.task.issue.dialog_action_repair("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-dark mr-1","fa fa-empty-set","fn.app.task.issue.dialog_action_change_status_lost("+data[0]+")");
		
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","fa-solid fa-check-double","fn.app.task.issue.dialog_close("+data[0]+")");
		$("td", row).eq(1).html(s);

		switch(data.type){
			case "1":
				$("td", row).eq(2).html('<span class="badge badge-primary">เปลี่ยนต่ำแหน่ง</span>');
				if(data.current_location_id==data.new_location_id){
					$("td", row).eq(3).html('<span class="badge badge-success">ผ่าน</span>');
				}else{
					$("td", row).eq(3).html('<span class="badge badge-dark">'+data.current_location_id+'</span> => <span class="badge badge-dark">'+data.new_location_id+'</dark>' );
				}
				break;
			case "2":
				$("td", row).eq(2).html('<span class="badge badge-danger">ไม่พบของ</span>');
				if(data.asset_status=="0"){
					$("td", row).eq(3).html('<span class="badge badge-success">ผ่าน</span>');
				}else{
					$("td", row).eq(3).html('-');
				}
				break;
			case "3":
				$("td", row).eq(2).html('<span class="badge badge-warning">แจ้งซ่อม</span>');
				if(data.repair_id){
					$("td", row).eq(3).html('<span class="badge badge-success">ผ่าน</span>');
				}else{
					$("td", row).eq(3).html('-');
				}
				
				break;
			default:$("td", row).eq(2).html('-');break;
		}
	}
});
fn.ui.datatable.selectable("#tblIssue","chk_issue");

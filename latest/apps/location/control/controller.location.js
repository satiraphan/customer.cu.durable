fn.app.location.change_status = function(id){
  $.post("apps/location/xhr/action-change-status.php",{id:id},function(response){
    if(response.success){
      $("#tblBuilding").DataTable().draw();
      $("#tblFloor").DataTable().draw();
      $("#tblRoom").DataTable().draw();
    }else{
      fn.notify.warnbox(response.msg,"Oops...");
    }
  },"json");
  return false;
};
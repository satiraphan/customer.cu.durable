
	fn.app.dashboard.loadData = function() {
		$.ajax({
			url: "apps/dashboard/xhr/action-load-data.php",
			type: "POST",
			dataType: "json",
			success: function(json){
			  monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July']
        data1 = [33, 79, 85, 54, 64, 97, 79]
        new Chart('bar-chart-horizontal',json.last_counting);
        new Chart('pie-basic', json.pie_category);
      
			}	
		});
	};
  
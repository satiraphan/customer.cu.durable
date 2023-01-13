	fn.app.counter.review = function(){
		$.post("apps/counter/xhr/action-review.php",$("form[name=form_review_counter]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};


	fn.app.counter.inspect = function(){
		$.post("apps/counter/xhr/action-inspect.php",$("form[name=form_inspect]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

$("button[xname=option]").click(function(){
	$("button[xname=option]").removeClass("btn-dark btn-outline-dark text-white").addClass("btn-outline-dark");
	$(this).addClass("btn-dark text-white");
	let option = $(this).attr("data-value");
	$("input[name=action]").val(option);

	if(option=="3"){
		$(".show_location").show();
	}else{
		$(".show_location").hide();

	}

});
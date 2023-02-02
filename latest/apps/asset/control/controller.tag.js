
	$(".qrcode").each(function(){
		new QRCode($(this)[0], $(this).attr("data-code"));

	})

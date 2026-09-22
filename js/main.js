jQuery(function($) {'use strict',

	//Ajax contact
	$(".contact-form").submit(function() {
		var rd = this;
		var url = "sendemail.php"; // the script where you handle the form input.
		$.ajax({
			type: "POST",
			url: url,
			data: $(".contact-form").serialize(), // serializes the form's elements.
			success: function(data)
			{
				//alert(data); // show response from the php script.
				$(rd).prev().text(data).fadeIn().delay(3000).fadeOut();
			}
		});
		return false; // avoid to execute the actual submit of the form.
	});

});
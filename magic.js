// magic.js
$(document).ready(function() {
	// Sleb form
	$(".slebForm").submit(function(){
		//event.preventDefault(); // Prevent from redirect
		location.reload();
	});

	$(document).on('click', '.sendRate', function(){
		// $('.form-group').removeClass('has-error'); // remove the error class
		$('.help-block').remove(); // remove the error text

		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			'id' 				: $(this).attr("id"),
			'rate' 			: $('#radio_'+$(this).attr("id")+':checked').val()
		};
		
		//console.log( $( this ).serialize() );
		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'process.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
		})
			// using the done promise callback
			.done(function(data) {

				// log data to the console so we can see
				console.log(data); 

				// here we will handle errors and validation messages
				if ( ! data.success) {
					
					// handle errors for name ---------------
					if (data.errors.rate) {
						// $('#rate-group').addClass('has-error'); // add the error class to show red input
						$('.rate-group'+formData.id).append('<div class="help-block">' + data.errors.rate + '</div>'); // add the actual error message under our input
					}

				} else {

					// ALL GOOD! just show the success message!
					$('#rate-group'+formData['id']).append('<div class="alert alert-success">' + data.message + '</div>');

					// usually after form submission, you'll want to redirect
					// window.location = '/thank-you'; // redirect a user to another page

				}
			})

			// using the fail promise callback
			.fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});

		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});
});

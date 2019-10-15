(function(){
	var validated = false;
	var submitButton = $('#show-success').attr('disabled', true);
	var firstName = $('#first-name').bind('keyup', validate);
	var lastName = $('#last-name').bind('keyup', validate);
	var email = $('#email').bind('keyup', validate);

	function validate(){
		// Check if field 1 is valid
		field1Check = firstName.val().length > 1;

		// Check if field 2 is valid
		field2Check = lastName.val().length > 1;

		// Check if field 3 is valid
		field3Check = email.val().length > 1;

		validated = field1Check & field2Check & field3Check;

		if(validated){
			submitButton.removeAttr('disabled')
		} else {
			submitButton.attr('disabled', true);
		}
	};


})()
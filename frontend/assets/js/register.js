function registerPartner() {
	var registerData = {};

	// if (_validateForm()) {
		if (true) {
		registerData.owner = document.forms[0].owner.value;
		registerData.company = document.forms[0].company.value;
		registerData.email = document.forms[0].email.value;
		registerData.city = document.forms[0].city.value;
		registerData.state = document.forms[0].state.value;

		$.ajax({
	    	type: "POST",
		    url: '../backend/public/index.php/partner/create',
		    data: registerData,
		    success: function(data){
		        swal({
						title: "Obrigado por entrar em contato!",
						text: "Em breve enviaremos um email de retorno :)",
						type: "success"
					},
					function() {
						// location.href = 'index.html';
					}
				);
		    }
		});
	}
};

var _validateForm = function() {
	if (isEmpty(document.forms[0].owner.value)) {
		swal('Preencha o nome');
		return false;
	} else if (isEmpty(document.forms[0].company.value)) {
		swal('Preencha a empresa');
		return false;
	} else if (isEmpty(document.forms[0].email.value)) {
		swal('Preencha o email');
		return false;
	} else if (isEmpty(document.forms[0].city.value)) {
		swal('Preencha a cidade');
		return false;
	} else if (isEmpty(document.forms[0].state.value)) {
		swal('Preencha o estado');
		return false;
	}

	return true;
};

function isEmpty(value) {
    return (value === undefined || value == null || value.length <= 0 || value == "") ? true : false;
}
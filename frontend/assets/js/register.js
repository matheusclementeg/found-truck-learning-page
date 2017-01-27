function registerPartner() {
	var registerData = {};

	if (_validateForm()) {
		registerData.owner = document.forms[0].owner.value;
		registerData.company = document.forms[0].company.value;
		registerData.email = document.forms[0].email.value;
		registerData.city = document.forms[0].city.value;
		registerData.state = document.forms[0].owner.value;

		$.ajax({
	    	type: "POST",
		    url: '../backend/partner.php',
		    data: registerData,
		    success: function(data){
		        swal('Obrigado por entrar em contato! Em breve enviaremos um email de retorno :)');
		        window.location = 'index.html';
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
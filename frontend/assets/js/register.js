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
		    url: '../backend/public/index.php/partner/create',
		    data: registerData,
		    success: function(data){
		        alert('Obrigado por entrar em contato! Em breve enviaremos um email de retorno :)');
		        window.location = 'index.html';
		    }
		});
	}
};

var _validateForm = function() {
	if (isEmpty(document.forms[0].owner.value)) {
		alert('Preencha o nome');
		return false;
	} else if (isEmpty(document.forms[0].company.value)) {
		alert('Preencha a empresa');
		return false;
	} else if (isEmpty(document.forms[0].email.value)) {
		alert('Preencha o email');
		return false;
	} else if (isEmpty(document.forms[0].city.value)) {
		alert('Preencha a cidade');
		return false;
	} else if (isEmpty(document.forms[0].state.value)) {
		alert('Preencha o estado');
		return false;
	}

	return true;
};

function isEmpty(value) {
    return (value === undefined || value == null || value.length <= 0 || value == "") ? true : false;
}
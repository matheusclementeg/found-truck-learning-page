foundtruck.factory('LoadTrucksService', function($http) {
	var requestData = {};
	var httpRequest = $http({method  : 'POST',
        url     : '../backend/public/index.php/truck/getAll',
        data    :  JSON.stringify(requestData),  
        dataType: 'json'
    })
    .success(function(data) {
	 	return data;
	})
	.error(function(error) {
	 	return error;
	});
	return httpRequest;	
});
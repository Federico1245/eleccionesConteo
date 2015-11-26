'use strict';

/**
 * EnterValuesController
 * @constructor
 */
var StadisticsController = function($scope, $http, $routeParams, $rootScope, localStorageService) {
	
	analitics();

	var ratings = null;
	loadRatings();

	if (ratings == null) ratings = new Array();

	$http.get('backendServices/getStadistics.php').success(function(response){
		$scope.total = response.total;
		$scope.entered = response.entered;
		$scope.differences = response.differences;

		$scope.polls = response.polls;
		buildReasons();
    });

	$scope.rateAdd = function(id) {
		if (ratings[id] == 1)
			return;

		$http.get('backendServices/ratePoll.php?id=' + id + "&action=add").success(function(response){});
		updatePollRating(id, 1);

		if (ratings[id] == -1)
			ratings[id] = 0;
		else
			ratings[id] = 1;
		saveRatings();
	}

	$scope.rateSubstract = function(id) {
		if (ratings[id] == -1)
			return;

		$http.get('backendServices/ratePoll.php?id=' + id + "&action=substract").success(function(response){});
		updatePollRating(id, -1);

		if (ratings[id] == 1)
			ratings[id] = 0;
		else
			ratings[id] = -1;
		saveRatings();
	}

    function buildReasons() {
    	for (var i = 0; i < $scope.polls.length; i++) {
    		var poll = $scope.polls[i];

    		if (poll['votos_cambiemos_real'] != poll['votos_cambiemos_entry'])
    			poll['razon'] = "No coincide cantidad votos cambiemos.";
    		else if (poll['votos_fpv_real'] != poll['votos_fpv_entry'])
    			poll['razon'] = "No coincide cantidad votos fpv.";
    		else if (poll['votos_nulos_real'] != poll['votos_nulos_entry'])
    			poll['razon'] = "No coincide cantidad votos nulos.";
    		else if (poll['votos_blancos_real'] != poll['votos_blancos_entry'])
    			poll['razon'] = "No coincide cantidad votos blancos.";
    		else if (poll['votos_recurridos_real'] != poll['votos_recurridos_entry'])
    			poll['razon'] = "No coincide cantidad votos recurridos.";
    		else if (parseInt(poll['votos_nulos_real']) + parseInt(poll['votos_blancos_real']) + parseInt(poll['votos_recurridos_real']) + parseInt(poll['votos_impugnados_real']) + parseInt(poll['votos_fpv_real']) + parseInt(poll['votos_cambiemos_real']) != parseInt(poll['total']))
    			poll['razon'] = "La suma de votos no coincide con el total";
    		else
				poll['razon'] = poll['comentarios']
		}
    }

    function updatePollRating(id, toAdd) {
		for (var i = 0; i < $scope.polls.length; i++) {
    		var poll = $scope.polls[i];

    		if (poll['poll_entered_id'] == id) {
    			poll['rating'] = parseInt(poll['rating']) + toAdd;
    			break;
    		}
    	}
    }

    function saveRatings() {
		localStorageService.set("ratings", JSON.stringify(ratings));
    }

    function loadRatings() {
    	var ratingsJSON = localStorageService.get("ratings");
    	ratings = JSON.parse(ratingsJSON);
    }
};
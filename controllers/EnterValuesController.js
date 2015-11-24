'use strict';

/**
 * EnterValuesController
 * @constructor
 */
var EnterValuesController = function($scope, $http, $routeParams, $rootScope) {
	$scope.poll = null;
	$scope.loading = false;

	analitics();

	$scope.reloadPoll = function() {
		$http.get('backendServices/getRandomPoll.php').success(function(response){
			$scope.loading = true;
			$scope.poll = response[0];

			$scope.votos_nulos = 0;
			$scope.votos_blancos = 0;
			$scope.votos_recurridos = 0;
			$scope.votos_impugnados = 0;
			$scope.votos_fpv = 0;
			$scope.votos_cambiemos = 0;
			$scope.total = 0;
			$scope.comentarios = "";
    	}).finally(function() {
		    $scope.loading = false;
		});
    }

	$scope.submitValues = function() {
		var url = 'backendServices/insertEnteredPoll.php?polling_id=' + $scope.poll.id + "&votos_nulos=" + $scope.votos_nulos + "&votos_blancos=" + $scope.votos_blancos + "&votos_recurridos=" + $scope.votos_recurridos + "&votos_impugnados=" + $scope.votos_impugnados + "&votos_fpv=" + $scope.votos_fpv + "&votos_cambiemos=" + $scope.votos_cambiemos + "&total=" + $scope.total + "&comentarios=" + $scope.comentarios;
		console.log(url);
		$http.get(url).success(function(response){
			$scope.loading = true;
    	}).finally(function() {
		    $scope.loading = false;
		});
	}

	$scope.next = function() {
		$scope.submitValues();
		$scope.reloadPoll();
	}

    $scope.reloadPoll();
};
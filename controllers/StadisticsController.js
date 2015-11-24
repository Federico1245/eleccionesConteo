'use strict';

/**
 * EnterValuesController
 * @constructor
 */
var StadisticsController = function($scope, $http, $routeParams, $rootScope) {
	
	analitics();

	$http.get('backendServices/getStadistics.php').success(function(response){
		$scope.total = response.total;
		$scope.entered = response.entered;
		$scope.differences = response.differences;

		$scope.polls = response.polls;
    });
};
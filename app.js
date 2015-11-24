'use strict';

var DelifyWebsite = {};

var App = angular.module('EleccionesWebsite', ['ngRoute', 'ui.bootstrap']).config(function($sceDelegateProvider) {
  $sceDelegateProvider.resourceUrlWhitelist([
    // Allow same origin resource loads.
    'self',
    // Allow loading from our assets domain.  Notice the difference between * and **.
    'http://www.resultados.gob.ar/**'
  ]);
});

// Declare app level module which depends on filters, and services
App.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
    
    $routeProvider.when('/elecciones', {
    	title: 'Ingreso',
        templateUrl: '/elecciones/enterValues.html',
        controller: EnterValuesController
    });

    $routeProvider.when('/estadisticas', {
    	title: 'Estadisticas',
        templateUrl: '/elecciones/estadisticas.html',
        controller: StadisticsController
    });
    
    $routeProvider.otherwise({redirectTo: '/elecciones'});
}]);

App.controller('MainController', MainController);
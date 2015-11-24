'use strict';

var DelifyWebsite = {};

var App = angular.module('EleccionesWebsite', ['ngRoute', 'ui.bootstrap', 'LocalStorageModule']).config(function($sceDelegateProvider) {
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

function analitics() {
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70615430-1', 'auto');
  ga('send', 'pageview');
}
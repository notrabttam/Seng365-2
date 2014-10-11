(function () {
    'use strict';

    /* App Module */

    var pollsApp = angular.module('pollsApp', [
      'ngRoute',
      'pollsController'
    ]);

    pollsApp.config(['$routeProvider',
      function($routeProvider) {
        $routeProvider.
          when('/polls', {
            templateUrl: 'index.php/views/pollsView',
            controller: 'PollsCtrl'
          }).
          when('/polls/:pollid', {
            templateUrl: 'index.php/views/pollView',
            controller: 'PollCtrl'
          }).
          when('/results/:pollid', {
            templateUrl: 'index.php/views/resultsView',
            controller: 'ResultsCtrl'
          }).
          when('/about', {
            templateUrl: 'index.php/views/about',
            controller: 'AboutCtrl'
          }).
          otherwise({
            redirectTo: '/about'
          });
      }]);
}())

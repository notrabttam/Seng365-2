(function () {
    'use strict';

    /* App Module */

    var itemsApp = angular.module('itemsApp', [
      'ngRoute',
      'itemsControllers'
    ]);

    pollsApp.config(['$routeProvider',
      function($routeProvider) {
        $routeProvider.
          when('/polls', {
            templateUrl: 'partials/item-list.html',
            controller: 'allPollsController'
          }).
          when('/polls/id', {
            templateUrl: 'partials/item-detail.html',
            controller: 'pollViewController'
          }).
          when('/votes/id/vote', {
            templateUrl: 'partials/item-detail.html',
            controller: 'votingController'
          }).
          when('/votes/id', {
            templateUrl: 'partials/item-detail.html',
            controller: 'votesController'
          }).
          when('votes/id', {
            templateUrl: 'partials/item-detail.html',
            controller: 'votesController'
          }).
          otherwise({
            redirectTo: '/404'
          });
      }]);
}())

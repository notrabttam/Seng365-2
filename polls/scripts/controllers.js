(function () {
    'use strict';
    
    var pageTitle = "Polls App";
    var baseUrl = "http://csse-studweb3.canterbury.ac.nz/~mgb71/Assignment/polls/index.php";
    
    /* Controllers */
    var pollsController = angular.module('pollsController', []);
    
    pollsController.controller('PollsCtrl', ['$scope', '$http',
            function ($scope, $http) {
        var getUrl = baseUrl + '/services/polls';
        $http.get(getUrl).success(function (response) {
            $scope.polls = response;
        });
        
        changeTitle("Polls");
    }]);
    
    pollsController.controller('PollCtrl', ['$scope', '$routeParams', '$http',
            function($scope, $routeParams, $http) {
        var getUrl = baseUrl + '/services/polls/' + $routeParams.pollid;
        $http.get(getUrl).success(function (response) {
            $scope.poll = response;
            $scope.vote = (function(poll, vote) {
                var url = baseUrl + '/services/votes/' + poll + "/" + vote;
                $http.post(url).success(function(response) {
                    displayToast("Success!",
                            "Successfully voted for \"" + $scope.poll.answers[vote] + "\".");
                });
            });
        });
        
        changeTitle("Vote");
    }]);
    
    pollsController.controller('ResultsCtrl', ['$scope', '$routeParams', '$http',
            function($scope, $routeParams, $http) {
        var getUrl = baseUrl + '/services/votes/' + $routeParams.pollid;
        $http.get(getUrl).success(function (response) {
            $scope.results = response.results;
            
            // Generates a list of indexes as ng-repeat requires 'unique' keys to loop over
            $scope.indexes = Array.apply(null, {length: response.results.length}).map(Number.call, Number);
        });
          
        getUrl = baseUrl + '/services/polls/' + $routeParams.pollid;
        $http.get(getUrl).success(function (response) {
            $scope.poll = response;
        });
        
        $scope.reset = (function(pollid) {
            var deleteUrl = baseUrl + "/services/votes/" + pollid;
            $http.delete(deleteUrl).success(function(response) {
                displayToast("Success!",
                        "Successfully deleted responses to " + $scope.poll.title);
            });
        });
        
        $scope.fontSize = (function(voteCount) {
            var size = 15;
            size = size + voteCount;
            if (size > 30) {
                return 30;
            }
            else {
                return size;
            }
        });
        
        changeTitle("Results");
    }]);
    
    pollsController.controller('AboutCtrl', ['$scope',
            function($scope) {
        
        changeTitle("About");
    }]);
    
    
    /* Helpful functions */
    
    /**
     * Displays a toast confirmation message to the user.
     * 
     * @param {type} title The title of the toast message.
     * @param {type} message The message displayed to the user.
     */
    function displayToast(title, message) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.success(message, title);
    }
    
    function changeTitle(newTitle) {
        document.title = newTitle + " | " + pageTitle;
    }
    
  }())

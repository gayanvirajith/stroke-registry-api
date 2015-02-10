'use strict';

var app = angular.module('stroke-registry.loginModule');

app.controller("LoginController",['$scope', '$http', '$sanitize','flash', 'authService', function($scope, $http, $sanitize, flash, authService) {

  $scope.credential = {
    username: '',
    password: ''
  };

  var sanitizeCredential = function(credential) {
    return {
      username: $sanitize($scope.credential.username),
      password: $sanitize($scope.credential.password)
    };
  };

  $scope.login = function() {
    var login = $http.post('/login', sanitizeCredential($scope.credential));
    
    login.success(function(response){
      flash.setMessage(response.message)
      authService.loginConfirmed(); 
    });

    login.error(function(response){
      flash.setMessage(response.message, 'danger');     
    });

  };

}]);
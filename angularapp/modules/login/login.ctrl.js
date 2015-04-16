'use strict';

var app = angular.module('stroke-registry.loginModule');

app.controller("LoginController",[
  '$location', 
  '$scope', 
  '$http', 
  '$sanitize',
  'flash', 
  'authService',
  '$mdToast',
  function($location, $scope, $http, $sanitize, flash, authService) {

    var config = {
      params: {
        'rows': 10,
        'id' : '{index}',
        'content': '{lorem|10}',
        'delay' : 1,
        'callback': "JSON_CALLBACK"
      }
    };
    $http.jsonp("http://www.filltext.com", config, {})
        .success(function(data) {
          $scope.rows = data;
        });

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
    
    login.success(function(data, status, headers, config){

      if (status === 200) {
        flash.setMessage(data.message)
        authService.loginConfirmed(); 
        $location.path('/dashboard');  
      }else {
        console.log("Failed");
        flash.setMessage(data.message, 'danger');
      }
      
    });

    login.error(function(data, status, headers, config){
      console.log(data);
      flash.setMessage(data.message, 'danger');
    });

  };

}]);
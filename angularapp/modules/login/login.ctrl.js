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

  $scope.login = function login() {
    var login = $http.post('/login', sanitizeCredential($scope.credential));
    
    $scope.loginFailed = false;
    
    login.success(function(data, status, headers, config){
      if (status === 200) {
        flash.setMessage(data.message)
        authService.loginConfirmed(); 
        $location.path('/dashboard');  
      }else {
        $scope.loginFailed = true;
        console.log("Failed");
        flash.setMessage(data.message, 'danger');
      }
      
    });

    login.error(function(data, status, headers, config){
      $scope.loginFailed = true;
      console.log(data);
      flash.setMessage(data.message, 'danger');
    });


  };


  $scope.logout = function logout() {
    var logout = $http.get('/logout');
    
    logout.success(function(data, status, headers, config){

      if (status === 200) {
        authService.loginCancelled(); 
        $location.path('/signin');  
      }else {
        console.log("Failed");
      }
      
    });

    logout.error(function(data, status, headers, config){
      console.log(data);
    });
  }

}]);



app.config(['$httpProvider', function($httpProvider){

  var logOutUserOn401 = function($location, $q, authService) {

    var success = function(response) {
      return response;
    };

    var error = function(response) {
      if (response.status === 401) {
        console.log("401 interceptor: " + response.data);
        return $q.reject(response);
      } else {
        return $q.reject(response);
      }
    };

    return function(promise) {
      return promise.then(success, error);
    }

  }
}]);


'use strict';

var app = angular.module('stroke-registry', [
  'underscore',
  'ui.router',
  'ngSanitize',
  'ExampleModule',
  'http-auth-interceptor',
  'stroke-registry.commonService',
  'stroke-registry.loginModule',

  
]);

app.controller('AppCtrl', ['$scope', '$location', 'flash', function ($scope, $location, flash) {
  
  $scope.$on('event:auth-loginRequired', function() {
    flash.setMessage('Login required');
  });

  $scope.$on('event:auth-loginConfirmed', function() {

  });
  
}]);

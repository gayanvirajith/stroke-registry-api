'use strict';

var app = angular
  .module('stroke-registry.loginModule', ['ui.router']);


app.config(function($stateProvider, $urlRouterProvider) {

  // For any unmatched url, redirect to /login
  $urlRouterProvider.otherwise("/login");

  // Now set up the states
  $stateProvider
    .state('login', {
      url: "/login",
      templateUrl: "angularapp/modules/login/login.html"
    })
    .state('dashboard', {
      url: "/dashboard",
      templateUrl: "angularapp/templates/dashboard.html",
      constroller: 'AppCtrl'
    })
});
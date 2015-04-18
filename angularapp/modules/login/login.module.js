'use strict';

var app = angular
  .module('stroke-registry.loginModule', ['ui.router']);


app.config(['$urlRouterProvider', '$locationProvider', '$stateProvider',  function($urlRouterProvider, $locationProvider, $stateProvider) {

  // For any unmatched url, redirect to /login
  $urlRouterProvider.otherwise("/signin");

  // Now set up the states
  $stateProvider
    .state('login', {
      url: "/signin",
      templateUrl: "angularapp/modules/login/login.html"
    })
    .state('dashboard', {
      url: "/dashboard",
      templateUrl: "angularapp/templates/dashboard.html",
      constroller: 'AppCtrl',
      resolve: {
        authExpiry: function(sessionexpiry, authService) {
          var exp = sessionexpiry.get();
          exp.success(function(data, status, headers, config){
            authService.loginConfirmed(); 
          });
          exp.error(function(data, status, headers, config){
            // console.log(data);
          });
        } 
      }
    });

    
    $locationProvider.html5Mode({
      enabled: true,
      requireBase: true,
      rewriteLinks: true
    }).hashPrefix('!');

  }]);

app.run(['$rootScope', '$location', 'flash', function($rootScope, $location, flash) {

  $rootScope.$on('event:auth-loginRequired', function() {
    $location.path('/signin');
  });  

}]);


/*
 * Acoount toggle directive
 * Attributes:
 *  name - User's name
 *  title - User's title
 *  profileImg - Profile image url
 *
 */
app.directive('account', function() {
    return {
        restrict: 'E',
        transclude: true,
        scope: {
            name: '@',
            signOut: '&onLogout'
        },
        // template: "<h1></h1>",
        templateUrl: 'angularapp/modules/login/user-account-info.directive.html',
        link: function(scope, elements, attrs){
            scope.isContentVisible = false;
            scope.toggleContent = function() {
                scope.isContentVisible = ! scope.isContentVisible; 
            };
        }
    };
});
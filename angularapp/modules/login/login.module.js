'use strict';

var app = angular
  .module('stroke-registry.loginModule', ['ui.router']);

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
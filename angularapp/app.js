'use strict';

var app = angular.module('stroke-registry', [
  'underscore',
  'ui.router',
  'ngSanitize',
  'ngAnimate',
  'ngAria',
  'ngMaterial',
  'ngMessages',
  'ExampleModule',
  'http-auth-interceptor',
  'stroke-registry.commonService',
  'stroke-registry.loginModule',

  
]);

app.controller('AppCtrl', ['$scope', '$location', 'flash', function ($scope, $location, flash) {
  
  
}]);

app.config(function($httpProvider) {
  $httpProvider.interceptors.push(function($q, $rootScope) {
    return {
      'request': function(config) {
        $rootScope.$broadcast('loading-started');
        return config || $q.when(config);
      },
      'response': function(response) {
        $rootScope.$broadcast('loading-complete');
        return response || $q.when(response);
      }
    };
  });
});
app.directive("loadingIndicator", function($mdToast) {
  return {
    restrict : "A",
    template: "<div>Loading...</div>",
    link : function(scope, element, attrs) {
      scope.$on("loading-started", function(e) {
        //element.css({"display" : ""});
        $mdToast.show(
            $mdToast.simple()
                .content('Loading')
        );
      });
      scope.$on("loading-complete", function(e) {
        $mdToast.hide();
      });
    }
  };
});

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
  'stroke-registry.patientSignup',  
]);


app.controller('AppCtrl', [
  '$rootScope', '$mdDialog', 'PatientSignupService', 
  function ($rootScope, $mdDialog, PatientSignupService) {
  
  var self = this;

  $rootScope.$on('event:auth-loginConfirmed', function(event, data){
    $rootScope.isLoggedin = true;
  });


  $rootScope.$on('event:auth-loginCancelled', function(event, data){
    $rootScope.isLoggedin = false;
  });

  self.patientRegistrationPopup = function patientRegistrationPopup($event) {
    var parentEl = angular.element(document.body);
    
    $mdDialog.show({
      parent: parentEl,
      targetEvent: $event,
      templateUrl: 'angularapp/modules/patient-signup/patient-registration-form.html',
      bindToController: false,
      locals: {
        item: 'asdf'
      },
      clickOutsideToClose: false,
      escapeToClose: false,
      controller: patientSignupController
    });
    
    function patientSignupController(scope, $mdDialog, $rootScope, PatientSignupService) {

      scope.patient = {
        name: '',
        nic: ''
      };


      scope.closeDialog = function closeDialog() {
        $mdDialog.hide();
      };

      scope.saveForm = function saveForm() {
        console.log(scope.patient);

        PatientSignupService.create(scope.patient).success(function(data) {
          console.log("Success: " + data.data.id);
        }).error(function(data){
          console.log("Error: " + data);
        });
      };

    }

  };

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
    restrict : "E",
    template: "",
    link : function(scope, element, attrs) {
      scope.$on("loading-started", function(e) {
       var preset = $mdToast.simple().content("Loading...");
              // console.log(preset);
              preset._options.parent = angular.element( document.querySelector( '#toastContent' ) );
              $mdToast.show(preset);
      });
      scope.$on("loading-complete", function(e) {
        $mdToast.hide();
      });
    }
  };
});

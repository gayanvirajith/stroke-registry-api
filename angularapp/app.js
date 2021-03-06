'use strict';

var   app = angular.module('stroke-registry', [
  'underscore',
  'ui.router',
  'ui.bootstrap',
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
  'stroke-registry.patientModule',  
]);

app.run(['$rootScope', '$state', '$stateParams', function ($rootScope,   $state, $stateParams) {

    // It's very handy to add references to $state and $stateParams to the $rootScope
    // so that you can access them from any scope within your applications.For example,
    // <li ng-class="{ active: $state.includes('contacts.list') }"> will set the <li>
    // to active whenever 'contacts.list' or one of its decendents is active.
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
    }
]);


app.config(['$urlRouterProvider', '$locationProvider', '$stateProvider',  function($urlRouterProvider, $locationProvider, $stateProvider) {

  // For any unmatched url, redirect to /login
  $urlRouterProvider.otherwise("/signin");

  // Now set up the states
  $stateProvider
    .state('login', {
      url: "/signin",
      templateUrl: "angularapp/modules/login/login.html"
    })
    .state('patient', {
      url: "/dashboard/patient/:patientId",
      templateUrl: "angularapp/modules/patient/patient.html",
      controller: 'PatientController',
      controllerAs: 'p',
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
    })
    .state('patient-event-details', {
      url: "/dashboard/patient-event-details/:patientId",
      templateUrl: "angularapp/modules/patient/patient-event-details.html",
      controller: 'PatientEventController',
      controllerAs: 'p',
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
    })
    .state('patient-risk-factors', {
      url: "/dashboard/patient-risk-factors/:patientId",
      templateUrl: "angularapp/modules/patient/patient-risk-factors.html",
      controller: 'PatientRiskFactorsController',
      controllerAs: 'p',
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
    })
    .state('directory', {
      url: "/directory",
      templateUrl: "angularapp/modules/patient/patient-directory.html",
      controller: 'PatientDirectoryController',
      controllerAs: 'p',
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
  
app.controller('AppCtrl', [
  '$rootScope', '$mdDialog', 'PatientSignupService', '$stateParams', '$state', 
  function ($rootScope, $mdDialog, PatientSignupService, $stateParams, $state) {
  
  var self = this;
  $rootScope.successNotice = null;

  $rootScope.$on('event:auth-loginConfirmed', function(event, data){
    $rootScope.isLoggedin = true;
  });


  $rootScope.$on('event:auth-loginCancelled', function(event, data){
    $rootScope.isLoggedin = false;
  });

  self.closeNotice = function closeNotice() {
    $rootScope.successNotice = null;
  }
  
  self.goTo = function goTo(routName, paramObject) {
    if (paramObject === undefined) { 
        paramObject = {}
    }
    $state.go(routName, paramObject);
  }


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
    
    function patientSignupController(scope, $mdDialog, $rootScope, PatientSignupService, $stateParams, $state) {

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
          // console.log("Success: " + data.data.id);
          $mdDialog.hide();
          $state.go('patient', {patientId: data.data.id});
          $rootScope.successNotice = 'Patient has been successfully added!';
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

app.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('deep-purple', {
      'default': '400', // by default use shade 400 from the pink palette for primary intentions
      'hue-1': '100', // use shade 100 for the <code>md-hue-1</code> class
      'hue-2': '600', // use shade 600 for the <code>md-hue-2</code> class
      'hue-3': 'A100' // use shade A100 for the <code>md-hue-3</code> class
    })
   
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

/*
 * Disable button on $http/$q calls
 * - Accepts an option, passed by attribute, of a 
 *   function in the scope that must return a promise
 * - On click of the button, calls this function, and disables the button
 * - On finally of the promise, it re-enables the button
 *
 */
app.directive('clickAndDisable', function() {
  return {
    scope: {
      clickAndDisable: '&'
    },
    link: function(scope, iElement, iAttrs) {
      iElement.bind('click', function() {
        iElement.prop('disabled',true);
        scope.clickAndDisable().finally(function() {
          iElement.prop('disabled',false);
        })
      });
    }
  };
});
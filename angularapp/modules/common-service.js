'use strict';

var app = angular
  .module('stroke-registry.commonService', []);

app.factory('flash',['$rootScope', function($rootScope) {

  // supports boostrap alert types. e.g: success, info, warning, danger
  $rootScope.flashMessage =  { type: 'info', msg: '' };

  // $rootScope.$on("$routeChangeSuccess", function() {
  //   $rootScope.flashMessage = { type: 'danger', msg: '' };
  // });

  $rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams, error){ 
    $rootScope.flashMessage = { type: 'danger', msg: '' };
  });

  return {
    setMessage: function(message, t) {
      t = typeof t !== 'undefined' ? t : 'info';
      $rootScope.flashMessage = { type: t, msg: message};
    }
  };
}]);

app.factory('sessionexpiry', ['$http', function($http){
  return {
    get: function() {
      return $http.get('/expiry');
    }
  };
}]);


app.factory('PatientSignupService', ['$http', '$sanitize', 'CSRF_TOKEN', function($http, $sanitize, CSRF_TOKEN){

  var sanitizePatientData = function sanitizePatientData(patient) {
    return {
      name: $sanitize(patient.name),
      nic: $sanitize(patient.nic),
      csrf_token: CSRF_TOKEN
    };
  };

  return {
    create: function createPatient(patient) {
      var patient = $http.post('/patient/generate-profile', sanitizePatientData(patient));
      return patient;
    }
  };

}]);


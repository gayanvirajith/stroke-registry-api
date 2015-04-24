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

app.factory('PatientService', ['$http', '$filter', '$sanitize', 'CSRF_TOKEN', function($http, $filter, $sanitize, CSRF_TOKEN){

  var sanitizePatientProfileData = function sanitizePatientProfileData(patient) {
    return {
      health_care_number: $sanitize(patient.health_care_number),
      nic: $sanitize(patient.nic),
      name: $sanitize(patient.name),
      sex: $sanitize(patient.sex),
      dob: $sanitize(patient.dob),
      hospital_id: $sanitize(patient.hospital_id),
      admitted_to: $sanitize(patient.admitted_to),
      address_1: $sanitize(patient.address_1),
      contact_no_1: $sanitize(patient.contact_no_1),
      contact_no_2: $sanitize(patient.contact_no_2),
      guardian_name: $sanitize(patient.guardian_name),
      guardian_contact_no_1: $sanitize(patient.guardian_contact_no_1),
      guardian_contact_no_2: $sanitize(patient.guardian_contact_no_2),
    };
  }
  return {
    getPatientProfile: function getPatientProfile(id) {
      return $http.get('/patient/'+id);
    },
    updatePatientProfile: function getPatientProfile(patient, id) {
      var patient = $http.post('/patient/update-profile/' + id, sanitizePatientProfileData(patient));
      return patient;
    }
  };

}]);




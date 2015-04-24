'use strict';

var app = angular
  .module('stroke-registry.patientModule', ['ui.router']);


app.controller('PatientController', ['$filter', '$rootScope', '$stateParams', '$state', 'PatientService', function ($filter, $rootScope, $stateParams, $state, PatientService) {
  
  var self = this;
  self.patientId = $stateParams.patientId;
  var patientProfile = PatientService.getPatientProfile(self.patientId);
  self.patient = {};

  var calculateAge = function(birthday) { // pass in player.dateOfBirth
    var ageDifMs = Date.now() - new Date(birthday);
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }

  patientProfile.success(function(data, status, headers, config){
    self.patient.id = data.data.id;
    self.patient.health_care_number = data.data.health_care_number;
    self.patient.nic = data.data.nic;
    self.patient.name = data.data.name;
    self.patient.dob = new Date(data.data.dob);
    self.patient.age = calculateAge(data.data.dob);
    self.patient.address_1 = data.data.address_1;
    self.patient.contact_no_1 = data.data.contact_no_1;
    self.patient.contact_no_2 = data.data.contact_no_2;
    self.patient.guardian_name = data.data.guardian_name;
    self.patient.guardian_contact_no_1 = data.data.guardian_contact_no_1;
    self.patient.guardian_contact_no_2 = data.data.guardian_contact_no_2;
    self.patient.sex = data.data.sex;
    self.patient.admitted_to = data.data.admitted_to;
    self.patient.hospital = data.data.hospital.name;
    self.patient.hospital_id = data.data.hospital.id;
  });
  patientProfile.error(function(data, status, headers, config){
    console.log(data.data);
  });


  self.updateProfile = function updateProfile() {

    console.log(self.patient.dob);
    if (self.patient.dob) self.patient.dob = $filter('date')(self.patient.dob, 'yyyy-MM-dd');

    var patientProfileUpdate = PatientService.updatePatientProfile(self.patient, self.patientId);
    patientProfileUpdate.success(function(data, status, headers, config){
      $rootScope.successNotice = 'Patient profile has been successfully updated!';
      $state.go('patient', {patientId: self.patientId});
    });
    patientProfileUpdate.error(function(data, status, headers, config){
      console.log(data.data);
    });

  };
  
}]);


app.controller('PatientProfileController', ['$stateParams', '$state', function ($stateParams, $state) {
  console.log("patient controller");

  var self = this;
  self.patientId = $stateParams.patientId;


}]);
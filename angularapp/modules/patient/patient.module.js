'use strict';

var app = angular
  .module('stroke-registry.patientModule', ['ui.router']);


app.controller('PatientController', ['$scope', '$filter', '$rootScope', '$stateParams', '$state', 'PatientService', function ($scope, $filter, $rootScope, $stateParams, $state, PatientService) {
  
  var self = this;
  $rootScope.successNotice = '';
  self.isDisabled = false;
  self.patientId = $stateParams.patientId;
  self.patient = {};
  var patientProfile = PatientService.getPatientProfile(self.patientId);

  var calculateAge = function(birthday) { // pass in player.dateOfBirth
    var ageDifMs = Date.now() - new Date(birthday);
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }


  $scope.$watch('p.patient.dob', function() {    
    if (self.patient.dob) {
      self.patient.age = calculateAge(self.patient.dob.getTime());      
    }
  }, true); // <-- objectEquality


  patientProfile.success(function(data, status, headers, config) {

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
    self.isDisabled = true;
    $rootScope.successNotice = '';
    if (self.patient.dob) self.patient.dob = $filter('date')(self.patient.dob, 'yyyy-MM-dd');

    var patientProfileUpdate = PatientService.updatePatientProfile(self.patient, self.patientId);
    patientProfileUpdate.success(function(data, status, headers, config){
      $rootScope.successNotice = 'Patient profile has been successfully updated!';
      self.isDisabled = false;
    });
    patientProfileUpdate.error(function(data, status, headers, config){
      //todo handle errors
      self.isDisabled = false;
    });
    return patientProfileUpdate;
  };
  
}]);


app.controller('PatientEventController', ['$rootScope', '$filter', '$stateParams', '$state', '$scope', 'PatientService', function ($rootScope, $filter, $stateParams, $state, $scope, PatientService) {
  
  var self = this;
  self.patientId = $stateParams.patientId;
  self.isDisabled = false;
  
  self.patient = {}; 
  $rootScope.successNotice  = ''; 

  self.patient.symptoms = [
    { id: 1, name: 'Weakness', status: false},
    { id: 2, name: 'Speech disturbance', status: false},
    { id: 3, name: 'Sensory symptoms', status: false},
    { id: 4, name: 'Dysphagia', status: false},
    { id: 5, name: 'Monocular blindness', status: false},
    { id: 6, name: 'Field defect', status: false},
    { id: 7, name: 'Brainstem', status: false},
    { id: 8, name: 'Cerebellar', status: false},
    { id: 9, name: 'Cognitive symptoms', status: false},
    { id: 10, name: 'Seizure', status: false},
    { id: 11, name: 'Headache', status: false}
  ];


  var patientEventDetail = PatientService.getPatientEventDetail(self.patientId);

  /*
   * Returns date diff between two dates
   */
  var datetimeDiff = function datetimeDiff(timeEnd, timeStart) {
    var hourDiff = timeEnd - timeStart; //in ms
    var secDiff = hourDiff / 1000; //in s
    // return millisecondsToStr(hourDiff);
    return secondsToString(secDiff);
  };
  
  var secondsToString = function secondsToString(seconds) {
    var numyears = Math.floor(seconds / 31536000);
    var numdays = Math.floor((seconds % 31536000) / 86400); 
    var numhours = Math.floor(((seconds % 31536000) % 86400) / 3600);
    var numminutes = Math.floor((((seconds % 31536000) % 86400) % 3600) / 60);
    var numseconds = (((seconds % 31536000) % 86400) % 3600) % 60;
    // if (numyears != 0)
    //   return numyears + " years " +  numdays + " days " + numhours + " hours " + numminutes + " minutes " + numseconds + " seconds";
    // else if (numdays != 0)
    //   return numdays + " days " + numhours + " hours " + numminutes + " minutes " + numseconds + " seconds";
    // else if (numhours != 0)
    //   return numhours + " hours " + numminutes + " minutes " + numseconds + " seconds";
    // else if (numminutes != 0) 
    //   return numminutes + " minutes " + numseconds + " seconds";
    // else 
    //   return numseconds + " seconds";

    var str  = '';
    if (numyears != 0) str = str + ' ' + numyears + ' year(s)';
    if (numdays != 0) str = str + ' ' + numdays + ' day(s)';
    if (numhours != 0) str = str + ' ' + numhours + ' hour(s)';
    if (numminutes != 0) str = str + ' ' + numminutes + ' minute(s)';
    return str;
  }

  var millisecondsToStr = function millisecondsToStr (milliseconds) {
    // TIP: to find current time in milliseconds, use:
    // var  current_time_milliseconds = new Date().getTime();

    function numberEnding (number) {
        return (number > 1) ? 's' : '';
    }

    var temp = Math.floor(milliseconds / 1000);
    var years = Math.floor(temp / 31536000);
    if (years) {
        return years + ' year' + numberEnding(years);
    }
    //TODO: Months! Maybe weeks? 
    var days = Math.floor((temp %= 31536000) / 86400);
    if (days) {
        return days + ' day' + numberEnding(days);
    }
    var hours = Math.floor((temp %= 86400) / 3600);
    if (hours) {
        return hours + ' hour' + numberEnding(hours);
    }
    var minutes = Math.floor((temp %= 3600) / 60);
    if (minutes) {
        return minutes + ' minute' + numberEnding(minutes);
    }
    var seconds = temp % 60;
    if (seconds) {
        return seconds + ' second' + numberEnding(seconds);
    }
    return 'less than a second'; //'just now' //or other string you like;
  }

  var getDatetimeAsString = function getDatetimeAsString(datetime) {
    console.log(datetime);
    var date = null;
    if (datetime != '' || datetime != '0000-00-00 00:00:00') {
      // Split timestamp into [ Y, M, D, h, m, s ]
      var t = datetime.split(/[- :]/);
      // Apply each element to the Date function
      date = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
    }
    return date;
  };

  patientEventDetail.success(function(data, status, headers, config){
    self.patient.id = data.data.id;
    self.patient.episode_id = data.data.episode_id;
    self.patient.modified_rankin_scale = data.data.modified_rankin_scale;

    var t = new Date();
    if (data.data.onset_of_stroke_at != '0000-00-00 00:00:00') {
      // Split timestamp into [ Y, M, D, h, m, s ]
      var t = data.data.onset_of_stroke_at.split(/[- :]/);
      // Apply each element to the Date function
      var onsetSetAt = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
      self.patient.onset_of_stroke_at = onsetSetAt;
    }
    if (data.data.admission_time != '0000-00-00 00:00:00') {
      t = data.data.admission_time.split(/[- :]/);
      var admissionAt = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
      self.patient.admission_time = admissionAt;
    }

    if (admissionAt && onsetSetAt) {
      self.patient.onset_to_admission_time = datetimeDiff(admissionAt.getTime(), onsetSetAt.getTime());
    }

    data.data.symptoms.forEach(function(entry) {
        self.patient.symptoms.forEach(function(i){
            if (entry.id == i.id)
            {
              i.status = true;
            }
        });
    });


  });

  patientEventDetail.error(function(data, status, headers, config){

  });

  $scope.$watch('p.patient.onset_of_stroke_at', function() {    
    if (self.patient.admission_time && self.patient.onset_of_stroke_at) {
      self.patient.onset_to_admission_time = datetimeDiff(self.patient.admission_time.getTime(), self.patient.onset_of_stroke_at.getTime());
    }else {
      self.patient.onset_to_admission_time = '';
    }
  }, true); // <-- objectEquality

  $scope.$watch('p.patient.admission_time', function() {    
    if (self.patient.admission_time && self.patient.onset_of_stroke_at) {
      self.patient.onset_to_admission_time = datetimeDiff(self.patient.admission_time.getTime(), self.patient.onset_of_stroke_at.getTime());      
    }else {
      self.patient.onset_to_admission_time = '';
    }
  }, true); // <-- objectEquality


  self.updateDetails = function updateDetails() {
    self.isDisabled = true;

    $rootScope.successNotice = '';
    var eventData =  angular.copy(self.patient);
    var admission_time,onset_of_stroke_at = '';
    var symptoms = [];

    if (eventData.admission_time) 
      admission_time = $filter('date')(eventData.admission_time, 'yyyy-MM-dd HH:mm:ss');
    if (eventData.onset_of_stroke_at)
      onset_of_stroke_at = $filter('date')(eventData.onset_of_stroke_at, 'yyyy-MM-dd HH:mm:ss'); 
    

    if (admission_time != '' && onset_of_stroke_at){
      eventData.onset_of_stroke_at = onset_of_stroke_at;
      eventData.admission_time = admission_time;
    }

    self.patient.symptoms.forEach(function(symtom){
        if (symtom.status) symptoms.push(symtom.id);
    });

    eventData.symptoms = symptoms;

    var patientEventData = PatientService.updatePatientEvent(eventData, self.patientId);
    patientEventData.success(function(data, status, headers, config){
      $rootScope.successNotice = 'Patient event details has been successfully updated!';
      self.isDisabled = false;

    });
    patientEventData.error(function(data, status, headers, config){
      self.isDisabled = false;
      //todo handle errors
    });

  };

}]);


app.controller('PatientRiskFactorsController', ['$filter', '$rootScope', '$stateParams', '$state', 'PatientService', function ($filter, $rootScope, $stateParams, $state, PatientService) {

  var self = this;
  $rootScope.successNotice = '';
  self.isDisabled = false;
  self.patientId = $stateParams.patientId;
  self.patient = {};

  self.patient.otherHeartDiseases = [
    { id: 1, name: 'Atrial fibrillation', status: false},
    { id: 2, name: 'Prosthetic valve', status: false},
    { id: 3, name: 'ASD/PFO', status: false},
    { id: 4, name: 'Heart failure', status: false},
    { id: 5, name: 'Rheumatic valvular disease', status: false},
    { id: 6, name: 'VSD', status: false},
  ];

   var patientRiskFactors = PatientService.getPatientRiskFactors(self.patientId);

   patientRiskFactors.success(function(data, status, headers, config) {

    self.patient.antiplatelet_drug_at_the_time_of_stroke = data.data.antiplatelet_drug_at_the_time_of_stroke;
    self.patient.warfarin_at_the_time_of_stroke = data.data.warfarin_at_the_time_of_stroke;
    self.patient.past_history_of_stroke = data.data.past_history_of_stroke;
    self.patient.hypertension = data.data.hypertension;
    self.patient.diabetes_mellitus = data.data.diabetes_mellitus;
    self.patient.ischaemic_heart_disease = data.data.ischaemic_heart_disease;
    self.patient.current_smoker = data.data.current_smoker;
    self.patient.unsafe_alcohol_intake = data.data.unsafe_alcohol_intake;

    data.data.otherHeartDiseases.forEach(function(entry) {
      self.patient.otherHeartDiseases.forEach(function(i){
          if (entry.id == i.id)
          {
            i.status = true;
          }
      });
    });

   });

  self.updateDetails = function updateDetails() {
    self.isDisabled = true;
    var riskFactors =  angular.copy(self.patient);
    $rootScope.successNotice = '';
    var diseases = [];

    self.patient.otherHeartDiseases.forEach(function(d){
        if (d.status) diseases.push(d.id);
    });

    riskFactors.otherHeartDiseases = diseases;
    var patientRiskFactorsResponse = PatientService.updateRiskFactors(riskFactors, self.patientId);

    patientRiskFactorsResponse.success(function(data, status, headers, config){
      $rootScope.successNotice = 'Patient risk factors have been successfully updated!';
      self.isDisabled = false;
    });
    patientRiskFactorsResponse.error(function(data, status, headers, config){
      self.isDisabled = false;
      //todo handle errors
    });
  };

}]);


app.controller('PatientDirectoryController', ['$filter', '$rootScope', '$stateParams', '$state', 'PatientService', function ($filter, $rootScope, $stateParams, $state, PatientService) {

  var self = this;
  $rootScope.successNotice = '';
  self.patients = [];

  var directoryList = PatientService.getPatientDirectory();

  directoryList.success(function(data, status, headers, config) {
      self.patients = data.data;
  });

  self.calculateAge = function(birthday) { // pass in player.dateOfBirth
    var ageDifMs = Date.now() - new Date(birthday);
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }

  //getPatientDirectory

}]);

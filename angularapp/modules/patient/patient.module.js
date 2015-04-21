'use strict';

var app = angular
  .module('stroke-registry.patientModule', ['ui.router']);


app.controller('PatientController', ['$stateParams', '$state', function ($stateParams, $state) {
  console.log("patient controller");
  
  $scope.patientId = $stateParams.patientId;

  
}]);


app.controller('PatientProfileController', ['$stateParams', '$state', function ($stateParams, $state) {
  console.log("patient controller");
  
  $scope.patientId = $stateParams.patientId;


}]);
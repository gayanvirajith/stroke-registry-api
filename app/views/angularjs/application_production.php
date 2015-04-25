    <!DOCTYPE html>
<html lang="en" ng-app="stroke-registry">
  <head>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stroke registry</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/styles.css">

    <script src="/vendors.js"></script>

    <script src="/angularapp.js"></script>

    <script type="text/javascript">
      angular.module('stroke-registry').constant('CSRF_TOKEN', '<?php echo csrf_token(); ?>');
    </script>

  </head>
  <body layout="row" ng-controller="AppCtrl as appCtrl">

   <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <md-sidenav class="md-sidenav-left nsr-sidebar-left md-whiteframe-z2" md-component-id="left"
          md-is-locked-open="$mdMedia('gt-md')" ng-if="$state.current.name == 'patient' || $state.current.name == 'patient-event-details'">
    <md-toolbar class="md-default-theme">
        <h1 class="md-toolbar-tools">
            <a ng-href="/" layout="row" flex="" href="/">
                <div class="docs-logotype">NSR</div>
            </a>
        </h1>
    </md-toolbar>
    <md-content flex="" class="md-default-theme side-nav-md-content">
      <accordion close-others="oneAtATime">
        <accordion-group>
          <accordion-heading>
              On Admission <i class="pull-right fa" ng-class="{'fa-chevron-up': status.open, 'fa-chevron-down': !status.open}"></i>
          </accordion-heading>
          <div class="sidebar-common-actions">
            <md-button ng-click="appCtrl.goTo('patient', {patientId: $stateParams.patientId})">Registration Details</md-button>
            <md-button ng-click="appCtrl.goTo('patient-event-details', {patientId: $stateParams.patientId})">Event Details</md-button>
            <md-button>Risk Factors</md-button>
          </div>
        </accordion-group>


        <accordion-group>
          <accordion-heading>
              At Discharge <i class="pull-right fa" ng-class="{'fa-chevron-up': status.open, 'fa-chevron-down': !status.open}"></i>
          </accordion-heading>
          <div class="sidebar-common-actions">
            <md-button>Investigation</md-button>
            <md-button>Management</md-button>
            <md-button>Diagnosis</md-button>
            <md-button>Final Disposition</md-button>
          </div>
        </accordion-group>



      </accordion>
      <div class="sidebar-common-actions">
        <md-button ng-href="dashboard">Back to Dashboard</md-button>    
      </div>
    </md-content>
  </md-sidenav> 

  <div layout="column" tabindex="-1" role="main" flex="">
   <md-toolbar class="md-default-theme">
     <div class="md-toolbar-tools"  tabindex="0">

       <div layout="row" flex class="fill-height" ng-if="$state.current.name != 'patient'">
        <h1>NSR</h1>
       </div>

       <div layout="row" flex class="fill-height" ng-if="$state.current.name == 'patient'">
        <h1></h1>
       </div>

       <div ng-show="isLoggedin" class="account-toggle" ng-controller="LoginController">
         <account name="NHS Admin" on-logout="logout()"> </account>
       </div>
     </div>
   </md-toolbar>
   <md-content md-scroll-y="" flex=""
               class="md-default-theme nsr-main-content md-padding">
      <div class="message-notice" ng-show="successNotice">
        {{successNotice}}
        <span class="close-icon" ng-click="appCtrl.closeNotice();">x</span>
      </div>

      <div ui-view></div>
      <!-- {{$stateParams}} -->
      <!-- {{$state.current}} -->
   </md-content>
  </div>

    <div id="toastContent">
      <loading-indicator></loading-indicator>
    </div>       
  </body>
</html>

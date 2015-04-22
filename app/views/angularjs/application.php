    <!DOCTYPE html>
<html lang="en" ng-app="stroke-registry">
  <head>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stroke registry</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- build:css(assets/) /styles.css -->
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/vendor/angular-material/angular-material.css" rel="stylesheet"/>

    <link href="/css/animate.css" rel="stylesheet"/>
    <link href="/css/screen.css" rel="stylesheet"/>
    <!-- endbuild -->

    <!-- build:js(assets/) /vendors.js -->
    <script src="/vendor/angular/angular.js"></script>
    <script src="/vendor/underscore/underscore.js"></script>
    <script src="/vendor/angular-underscore-module/angular-underscore-module.js"></script>
    <script src="/vendor/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
    <script src="/vendor/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="/vendor/angular-http-auth/src/http-auth-interceptor.js"></script>
    <script src="/vendor/angular-sanitize/angular-sanitize.js"></script>
    <script src="/vendor/angular-animate/angular-animate.js"></script>
    <script src="/vendor/angular-aria/angular-aria.js"></script>
    <script src="/vendor/angular-material/angular-material.js"></script>
    <script src="/vendor/angular-messages/angular-messages.js"></script>
    <!-- endbuild -->

    <!-- build:js /angularapp.js -->
    <script src="/angularapp/app.js"></script>
    <script src="/angularapp/config.js"></script>
    <script src="/angularapp/routes.js"></script>

    <script src="/angularapp/modules/example/example.module.js"></script>
    <script src="/angularapp/modules/example/example.ctrl.js"></script>
    <script src="/angularapp/modules/example/example.srv.js"></script>

    <!-- login module -->
    <script src="/angularapp/modules/login/login.module.js"></script>
    <script src="/angularapp/modules/login/login.ctrl.js"></script>

    <!-- patient signup module -->
    <script src="/angularapp/modules/patient-signup/patient-signup.module.js"></script>
    <script src="/angularapp/modules/patient-signup/patient-signup.ctrl.js"></script>

    <!-- patient module -->
    <script src="/angularapp/modules/patient/patient.module.js"></script>


    <!-- common service  -->
    <script src="/angularapp/modules/common-service.js"></script>
    <!-- endbuild -->

    <script type="text/javascript">
      angular.module('stroke-registry').constant('CSRF_TOKEN', '<?php echo csrf_token(); ?>');
    </script>

  </head>
  <body layout="row" ng-controller="AppCtrl as appCtrl">

   <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <md-sidenav class="md-sidenav-left md-whiteframe-z2" md-component-id="left"
          md-is-locked-open="$mdMedia('gt-md')" ng-if="$state.current.name == 'patient' || $state.current.name == 'patient-profile'">
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
            <md-button ng-click="appCtrl.goTo('patient-profile', {patientId: $stateParams.patientId})">Event Details</md-button>
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

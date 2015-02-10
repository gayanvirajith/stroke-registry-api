<!DOCTYPE html>
<html lang="en" ng-app="stroke-registry">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stroke registry</title>

    <!-- build:css(assets/) /styles.css -->
    <link href="/css/screen.css" rel="stylesheet"/>
    <link href="/css/simple-sidebar.css" rel="stylesheet"/>

    <link href="/vendor/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>
    <link href="/vendor/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet"/>

    <!-- endbuild -->

    <!-- build:js(assets/) /vendors.js -->
    <script src="/vendor/jquery/dist/jquery.js"></script>
    <script src="/vendor/angular/angular.js"></script>
    <script src="/vendor/underscore/underscore.js"></script>
    <script src="/vendor/angular-underscore-module/angular-underscore-module.js"></script>
    <script src="/vendor/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
    <script src="/vendor/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="/vendor/angular-http-auth/src/http-auth-interceptor.js"></script>
    <script src="/vendor/angular-sanitize/angular-sanitize.js"></script>
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

    <!-- common service  -->
    <script src="/angularapp/modules/common-service.js"></script>
    <!-- endbuild -->
  </head>
  <body>

   <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#/">
                        App
                    </a>
                </li>
               <li>
                 <a ui-sref="home">Home</a>
               </li>
               <li>
                 <a ui-sref="page">Page</a>
               </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <div ng-show="flashMessage.msg" class="alert alert-{{flashMessage.type}}">
              {{ flashMessage.msg }}
            </div>
               <div ui-view></div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    

  </body>
</html>

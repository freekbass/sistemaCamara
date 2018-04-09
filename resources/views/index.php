<html>
    <head>
        <title>Registro de Câmara</title>
        <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
        <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
        <!-- Angular -->
        <script type="text/javascript" src="node_modules/angular/angular.js"></script>
        <script type="text/javascript" src="node_modules/angular-route/angular-route.js"></script>
        <!-- App -->
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/homeController.js"></script>
        <script type="text/javascript" src="js/login/login.js"></script>
        <script type="text/javascript" src="js/user/userController.js"></script>
        <script type="text/javascript" src="js/vereador/vereadorController.js"></script>
        <script type="text/javascript" src="js/lei/leiController.js"></script>
        <script type="text/javascript" src="js/sessao/sessaoController.js"></script>
        <script type="text/javascript" src="js/registro_sessao/registroSessaoController.js"></script>
        <script type="text/javascript" src="js/diretiva/file/file_model_diretiva.js"></script>
    </head>
    <body >
        <div ng-app="camaraSistema">
            <nav class="navbar navbar-default" style="background-color: black;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#/home">
                            <img alt="Brand" src="image/logo.png" width="50" height="50">
                        </a>
                        <label style="color: white;">Registro de Câmara</label>
                    </div>
                    <div class="navbar-header" ng-controller="loginController">
                        <a style="color: white;" ng-click="sair()" href="" ng-if="logado">Sair</a>
                    </div>
                </div>
            </nav>
            <div ng-view></div>
        </div>
    </body>
</html>
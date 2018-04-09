'use strict';
var app = angular.module('camaraSistema', ['ngRoute']);

app.factory('acessoService', function ($http) {
    return {
        validar_acesso: function () {
            return $http.get('/api/autenticacao/validar');
        },
    }
});

var validaAcesso = function (acessoService, $location) {
    acessoService.validar_acesso().then(function (ret) {
        if (ret.data == 1) {
        } else {
            $location.path('/');
            alert("Nenhum Usuário Logado");
        }
    });
}


app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
            .when('/', {
                templateUrl: 'view/login.html',
                controller: 'loginController',
                resolve: {
                    check: function (acessoService, $location, $rootScope) {
                        acessoService.validar_acesso().then(function (ret) {
                            if (ret.data == 1) {
                                $rootScope.logado = true;
                                $location.path('/home');
                            } else {
                                $rootScope.logado = false;
                                $location.path('/');
                                alert("Nenhum Usuário Logado");
                            }
                        });
                    }
                },
            })
            .when('/home', {
                templateUrl: 'view/home.php',
                controller: 'homeController',
                resolve: {
                    check: function (acessoService, $location) {
                        validaAcesso(acessoService, $location);
                    }
                }
            })
            .when('/user', {
                templateUrl: 'view/user/user.html',
                controller: 'userController',
                resolve: {
                    check: function (acessoService, $location) {
                        validaAcesso(acessoService, $location);
                    }
                }
            })
            .when('/vereador', {
                templateUrl: 'view/vereador/vereador.html',
                controller: 'vereadorController',
                resolve: {
                    check: function (acessoService, $location) {
                        validaAcesso(acessoService, $location);
                    }
                }
            })
            .when('/lei', {
                templateUrl: 'view/lei/lei.html',
                controller: 'leiController', resolve: {
                    check: function (acessoService, $location) {
                        validaAcesso(acessoService, $location);
                    }
                }
            })
            .when('/sessao', {
                templateUrl: 'view/sessao/sessao.html',
                controller: 'sessaoController', resolve: {
                    check: function (acessoService, $location) {
                        validaAcesso(acessoService, $location);
                    }
                }
            })
            .when('/registro_sessao', {
                templateUrl: 'view/registro_sessao/registro_sessao.html',
                controller: 'registroSessaoController',
                resolve: {
                    check: function (acessoService, $location) {
                        validaAcesso(acessoService, $location);
                    }
                }
            })
            .otherwise({
                redirectTo: '/'
            });
    $locationProvider.hashPrefix('');
});
'use strict';
var app = angular.module('camaraSistema');

app.factory('loginService', function ($http) {
    return {
        login: function (data) {
            return $http.post('/api/login', data);
        },
        logout: function () {
            return $http.post('/api/logout');
        },
    }
});

app.controller('loginController', ['$scope', 'loginService', '$rootScope', function ($scope, loginService, $rootScope) {
        $scope.logar = function () {
            var dados = {
                email: $scope.email,
                password: $scope.senha,
            }
            loginService.login(dados).then(function (res) {
                $rootScope.logado = true;
                window.location.replace('#/home');
            }, function (res) {
                alert(res.data[0].message ? res.data[0].message : "Erro");
            });
        }

        $scope.sair = function () {
            loginService.logout().then(function (res) {
                $rootScope.logado = false;
                window.location.replace('#/');
            }, function (res) {
                alert(res.data.message ? res.data.message : "Erro");
            });
        }

    }]);
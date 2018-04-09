'use strict';
var app = angular.module('camaraSistema');

app.factory('userService', function ($http) {
    return {
        lista: function () {
            return $http.get('/api/user');
        },
        cadastra: function (data) {
            return $http.post('/api/user', data);
        },
        edita: function (data) {
            var id = data.id;
            delete data.id;
            return $http.put('/api/user/' + id, data);
        },
        exclui: function (id) {
            return $http.delete('/api/user/' + id)
        }
    }
});

app.controller('userController', ['$scope', 'userService', function ($scope, userService) {
        $scope.listar = function () {
            userService.lista().then(function (ret) {
                $scope.users = ret.data;
            });
        }

        $scope.editar = function (data) {
            $scope.user = data;
            $('#myModal').modal('show');
        }

        $scope.salvar = function () {
            if ($scope.user && $scope.user.id) {
                userService.edita($scope.user).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            } else {
                userService.cadastra($scope.user).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }

        $scope.excluir = function (data) {
            if (confirm("Tem certeza que deseja excluir?")) {
                userService.exclui(data.id).then(function (res) {
                    $scope.listar();
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }
    }]);
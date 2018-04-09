'use strict';
var app = angular.module('camaraSistema');

app.factory('VereadorService', function ($http) {
    return {
        lista: function () {
            return $http.get('/api/vereador');
        },
        cadastra: function (data) {
            return $http.post('/api/vereador', data);
        },
        edita: function (data) {
            var id = data.id;
            delete data.id;
            return $http.put('/api/vereador/' + id, data);
        },
        exclui: function (id) {
            return $http.delete('/api/vereador/' + id)
        }
    }
});

app.controller('vereadorController', ['$scope', 'VereadorService', function ($scope, VereadorService) {
        $scope.listar = function () {
            VereadorService.lista().then(function (ret) {
                $scope.vereadores = ret.data;
            });
        }

        $scope.editar = function (data) {
            $scope.vereador = data;
            $('#myModal').modal('show');
        }

        $scope.salvar = function () {
            if ($scope.vereador.id) {
                VereadorService.edita($scope.vereador).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                });
            } else {
                VereadorService.cadastra($scope.vereador).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                });
            }
        }

        $scope.excluir = function (data) {
            if (confirm("Tem certeza que deseja excluir?")) {
                VereadorService.exclui(data.id).then(function () {
                    $scope.listar();
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }
    }]);
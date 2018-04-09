'use strict';
var app = angular.module('camaraSistema');

app.factory('leiService', function ($http) {
    return {
        lista: function () {
            return $http.get('/api/lei');
        },
        get_tipo: function () {
            return $http.get('/api/lei/get_tipo');
        },
        cadastra: function (data) {
            return $http.post('/api/lei', data);
        },
        edita: function (data) {
            var id = data.id;
            delete data.id;
            return $http.put('/api/lei/' + id, data);
        },
        exclui: function (id) {
            return $http.delete('/api/lei/' + id)
        }
    }
});

app.controller('leiController', ['$scope', 'leiService', 'VereadorService', function ($scope, leiService, VereadorService) {
        
        leiService.get_tipo().then(function (ret) {
            $scope.tipos = ret.data;
        });
        VereadorService.lista().then(function (ret) {
            $scope.vereadores = ret.data;
        });

        $scope.listar = function () {
            leiService.lista().then(function (ret) {
                $scope.leis = ret.data;
            }, function (res) {
                alert(res.data.message ? res.data.message : "Erro");
            });
        }

        $scope.editar = function (data) {
            $scope.lei = data;
            $('#myModal').modal('show');
        }

        $scope.salvar = function () {
            if ($scope.lei.id) {
                leiService.edita($scope.lei).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            } else {
                leiService.cadastra($scope.lei).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }

        $scope.excluir = function (data) {
            if (confirm("Tem certeza que deseja excluir?")) {
                leiService.exclui(data.id).then(function (res) {
                    $scope.listar();
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }
    }]);

$(document).ready(function () {
    $(window).on('shown.bs.modal', function () {
        $('#tipo').trigger('change');
        $('#vereador').trigger('change');
    });
});
'use strict';
var app = angular.module('camaraSistema');

app.factory('sessaoService', function ($http) {
    return {
        lista: function () {
            return $http.get('/api/sessao');
        },
        get: function (id) {
            return $http.get('/api/sessao/get', {params: {sessao_id: id}});
        },

        cadastra: function (data) {
            return $http.post('/api/sessao', data);
        },
        edita: function (data) {
            var id = data.id;
            delete data.id;
            return $http.put('/api/sessao/' + id, data);
        },
        exclui: function (id) {
            return $http.delete('/api/sessao/' + id)
        }
    }
});

app.controller('sessaoController', ['$scope', 'sessaoService', function ($scope, sessaoService) {
        $scope.listar = function () {
            sessaoService.lista().then(function (ret) {
                $scope.sessoes = ret.data;
            });
        }

        $scope.editar = function (data) {
            $scope.sessao = data;
            $('#myModal').modal('show');
        }

        $scope.salvar = function () {
            if ($scope.sessao && $scope.sessao.id) {
                sessaoService.edita($scope.sessao).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            } else {
                sessaoService.cadastra($scope.sessao).then(function (res) {
                    $scope.listar();
                    $('#myModal').modal('hide');
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }

        $scope.excluir = function (data) {
            if (confirm("Tem certeza que deseja excluir?")) {
                sessaoService.exclui(data.id).then(function (res) {
                    $scope.listar();
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }
    }]);
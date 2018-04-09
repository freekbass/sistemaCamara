'use strict';
var app = angular.module('camaraSistema');

app.factory('registroSessaoService', function ($http) {
    return {
        iniciar_sessao: function (sessao) {
            return $http.get('/api/registro_sessao/iniciar_sessao', {params: {sessao_id: sessao}});
        },
        vincular_lei: function (sessao_id, lei_id) {
            return $http.post('/api/registro_sessao/vincular_lei',
                    {
                        sessao_id: sessao_id,
                        lei_id: lei_id,
                    });
        },
        registrar_presenca: function (sessao_id, vereador_id, presenca, motivo) {
            return $http.post('/api/registro_sessao/registrar_presenca',
                    {
                        sessao_id: sessao_id,
                        vereador_id: vereador_id,
                        presenca: presenca,
                        motivo: motivo,
                    });
        },
        registrar_voto: function (sessao_id, vereador_id, lei_id, aprovado) {
            return $http.post('/api/registro_sessao/registrar_voto',
                    {
                        sessao_id: sessao_id,
                        vereador_id: vereador_id,
                        lei_id: lei_id,
                        aprovado: aprovado,
                    });
        },
        desvincular_lei: function (sessao_id, lei_id) {
            return $http.post('/api/registro_sessao/desvincular_lei',
                    {
                        sessao_id: sessao_id,
                        lei_id: lei_id,
                    });
        },
        get_votos: function (sessao_id, lei_id) {
            return $http.get('/api/registro_sessao/get_votos', {params:
                        {
                            sessao_id: sessao_id,
                            lei_id: lei_id,
                        }});
        },
        remover_presenca: function (sessao_id, vereador_id) {
            return $http.post('/api/registro_sessao/remover_presenca',
                    {
                        sessao_id: sessao_id,
                        vereador_id: vereador_id,
                    });
        },
    }
});

app.controller('registroSessaoController', [
    '$scope',
    'registroSessaoService',
    'sessaoService',
    'leiService',
    'VereadorService',
    function ($scope, registroSessaoService, sessaoService, leiService, VereadorService) {

        $scope.sessao = {};

        $scope.carregarDados = function () {
            leiService.get_tipo().then(function (ret) {
                $scope.tipos = ret.data;
            });
            sessaoService.lista().then(function (ret) {
                $scope.sessoes = ret.data;
            }, function () {
                alert(res.data.message ? res.data.message : "Erro");
            });
        };

        $scope.iniciarSessao = function () {
            registroSessaoService.iniciar_sessao($scope.sessaoSelecionada)
                    .then(function (ret) {
                        $scope.setSessao($scope.sessaoSelecionada);
                    }, function (res) {
                        alert(res.data.message ? res.data.message : "Erro");
                    });
        }

        $scope.setSessao = function (sessao) {
            sessaoService.get(sessao).then(function (ret) {
                $scope.sessao = ret.data;
            }, function () {
                alert(res.data.message ? res.data.message : "Erro");
            });
        }

        $scope.abrirModalLei = function () {
            leiService.lista().then(function (ret) {
                $scope.leis = ret.data;
            }, function () {
                alert(res.data.message ? res.data.message : "Erro");
            });
        }

        $scope.vincularLei = function () {
            registroSessaoService.vincular_lei($scope.sessaoSelecionada, $scope.leiSelecionada)
                    .then(function () {
                        $scope.setSessao($scope.sessaoSelecionada);
                    }, function () {
                        alert(res.data.message ? res.data.message : "Erro");
                    });
        }

        $scope.abrirModalRegistrarPresenca = function () {
            VereadorService.lista().then(function (ret) {
                $scope.is_presenca = true;
                $scope.titulo_modal_vereador = 'Registrar Presença';
                $('#modal-vereador').modal('show');
                $scope.vereadores = ret.data;
            }, function () {
                alert(res.data.message ? res.data.message : "Erro");
            });
        }

        $scope.abrirModalRegistrarVoto = function (lei) {
            $scope.leiSelecionada = lei;
            VereadorService.lista().then(function (ret) {
                $scope.is_presenca = false;
                $scope.titulo_modal_vereador = 'Registrar Voto';
                $('#modal-vereador').modal('show');
                $scope.vereadores = ret.data;
            }, function (res) {
                alert(res.data.message ? res.data.message : "Erro");
            });
        }

        $scope.registrarVoto = function (voto) {
            if ($scope.validarVereador()) {
                registroSessaoService.registrar_voto($scope.sessaoSelecionada, $scope.vereadorSelecionado, $scope.leiSelecionada, voto).then(function (ret) {
                    $scope.setSessao($scope.sessaoSelecionada);
                    $('#modal-vereador').modal('hide');
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }

        $scope.registrarPresenca = function () {
            if ($scope.validarVereador()) {
                registroSessaoService.registrar_presenca($scope.sessaoSelecionada, $scope.vereadorSelecionado, true, null)
                        .then(function () {
                            $scope.setSessao($scope.sessaoSelecionada);
                            $('#modal-vereador').modal('hide');
                        }, function (res) {
                            alert(res.data.message ? res.data.message : "Erro");
                        });
            }
        }

        $scope.registrarAusencia = function () {
            if ($scope.validarVereador() && $scope.validarMotivo()) {
                registroSessaoService.registrar_presenca($scope.sessaoSelecionada, $scope.vereadorSelecionado, false, $scope.motivo)
                        .then(function () {
                            $scope.setSessao($scope.sessaoSelecionada);
                            $('#modal-vereador').modal('hide');
                        }, function (res) {
                            alert(res.data.message ? res.data.message : "Erro");
                        });
            }
        }

        $scope.validarMotivo = function () {
            if ($scope.motivo == undefined) {
                alert('Em caso de ausencia, justificar o motivo da mesma.');
                return false;
            }
            return true;
        }

        $scope.validarVereador = function () {
            if ($scope.vereadorSelecionado == undefined) {
                alert('Obrigatorio Informar o Verador');
                return false;
            }
            return true;
        }

        $scope.desvincularLei = function (lei_id) {
            var confirmacao = confirm('Se desvincular, todos os dados referentes a essa lei, sobre essa sessão serão removidos.\n Deseja Continuar?');
            if (confirmacao) {
                registroSessaoService.desvincular_lei($scope.sessaoSelecionada, lei_id).then(function () {
                    $scope.setSessao($scope.sessaoSelecionada);
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }

        $scope.vizualizarVotos = function (lei_id) {
            registroSessaoService.get_votos($scope.sessaoSelecionada, lei_id).then(function (ret) {
                $scope.votos = ret.data;
                $('#modal-votos').modal('show');
            }, function (res) {
                alert(res.data.message ? res.data.message : "Erro");
            });
        }

        $scope.removerPresenca = function (vereador_id) {
            var confirmacao = confirm('Se remover a presença do vereador, os votos computados até o momento serão desconsiderados.\n Deseja Continuar?');
            if (confirmacao) {
                registroSessaoService.remover_presenca($scope.sessaoSelecionada, vereador_id).then(function () {
                    $scope.setSessao($scope.sessaoSelecionada);
                }, function (res) {
                    alert(res.data.message ? res.data.message : "Erro");
                });
            }
        }

    }]);
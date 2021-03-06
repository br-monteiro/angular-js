<!DOCTYPE html>
<html ng-app="myPizza">
    <head ng-controller="appCtrl">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ url("vendor/bootstrap/dist/css/bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ url("vendor/font-awesome/css/font-awesome.min.css") }}">
        <title>Seja Bem - @{{appName}} @{{appVersion}}</title>
    </head>
    <body>
    <div class="container">
        <h3 class="text-center" ng-controller="appCtrl">
            @{{appName}} @{{appVersion}}
        </h3>

        <div class="row" ng-controller="clientesCtrl">

            <div class="modal fade modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirm">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="modalForm">Deseja excluir?</h4>
                        </div>
                        <div class="modal-body">
                            Excluir <strong>@{{nomeRegistro}}</strong>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Não
                            </button>
                            <button class="btn btn-success" data-dismiss="modal" ng-click="excluir()">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Sim
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="modalForm">Adicionando cliente</h4>
                        </div>

                        <div class="modal-body">
                            <form name="formCliente">
                                <div ng-class="{'has-error' : formCliente.nome.$invalid && formCliente.nome.$dirty, 'has-success' : formCliente.nome.$valid, 'form-group' : true}">
                                    <label for="nome">Nome</label>
                                    <input type="text"
                                           name="nome"
                                           class="form-control"
                                           ng-model="cliente.nome"
                                           ng-required="true"
                                           placeholder="Nome">
                                </div>

                                <div ng-class="{'has-error' : formCliente.telefone.$invalid && formCliente.nome.$dirty, 'has-success' : formCliente.telefone.$valid, 'form-group' : true}">
                                    <label for="telefone">Telefone</label>
                                    <input type="text"
                                           name="telefone"
                                           class="form-control"
                                           ng-model="cliente.telefone"
                                           ng-required="true" ng-pattern="/^\d{2} \d{4,5}-\d{4}$/"
                                           id="telefone"
                                           placeholder="Telefone: (##) ####-####">
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text"
                                           class="form-control"
                                           ng-model="cliente.email"
                                           placeholder="E-mail">
                                </div>

                                <div ng-class="{'has-error' : formCliente.endereco.$invalid && formCliente.endereco.$dirty, 'has-success' : formCliente.nome.$valid, 'form-group' : true}">
                                    <label for="endereco">Enederoço</label>
                                    <input type="text"
                                           name="endereco"
                                           class="form-control"
                                           ng-model="cliente.endereco"
                                           ng-required="true"
                                           placeholder="Endereço">
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal" ng-click="clearForm(cliente)">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
                            </button>
                            <button class="btn btn-success" data-dismiss="modal" ng-hide="editando" ng-click="add(cliente)" ng-disabled="formCliente.$invalid">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Adicionar
                            </button>
                            <button class="btn btn-primary" data-dismiss="modal" ng-show="editando" ng-click="salvar(cliente)" ng-disabled="formCliente.$invalid">
                                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Salvar
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    <input type="text" placeholder="Procurar" ng-model="filtro">
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <button type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target=".modalForm"
                                ng-click="clearForm(clente)">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar
                        </button>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th ng-click="orderBy('nome')" style="cursor: pointer;">
                            Nome
                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" ng-hide="ordem && campo == 'nome'"></span>
                            <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" ng-show="ordem && campo == 'nome'"></span>
                        </th>
                        <th ng-click="orderBy('telefone')" style="cursor: pointer;">
                            Telefone
                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" ng-hide="ordem && campo == 'telefone'"></span>
                            <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" ng-show="ordem && campo == 'telefone'"></span>
                        </th>
                        <th ng-click="orderBy('endereco')" style="cursor: pointer;">
                            Endereço
                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" ng-hide="ordem && campo == 'endereco'"></span>
                            <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" ng-show="ordem && campo == 'endereco'"></span>
                        </th>
                        <th ng-click="orderBy('email')" style="cursor: pointer;">
                            E-mail
                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" ng-hide="ordem && campo == 'email'"></span>
                            <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" ng-show="ordem && campo == 'email'"></span>
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="cliente in clientes | filter:filtro | orderBy:campo:ordem">
                        <td>@{{cliente.nome}}</td>
                        <td>@{{cliente.telefone}}</td>
                        <td>@{{cliente.endereco}}</td>
                        <td>@{{cliente.email}}</td>
                        <td>
                            <button ng-click="editar(cliente)" class="btn btn-default" data-toggle="modal" data-target=".modalForm">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
                            </button>
                            <button ng-click="confirmExcluir(cliente)" class="btn btn-danger"  data-toggle="modal" data-target=".modalConfirm">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <script src="{{ url("vendor/jquery/dist/jquery.min.js") }}"></script>
    <script src="{{ url("vendor/bootstrap/dist/js/bootstrap.min.js") }}"></script>
    <script src="{{ url("vendor/jquery-mask-plugin/dist/jquery.mask.min.js") }}"></script>
    <script src="{{ url("vendor/angular/angular.min.js") }}"></script>
    <script src="{{ url("app/modules.js") }}"></script>
    <script src="{{ url("app/app.js") }}"></script>
    <script>
        var SPMaskBehavior = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '00 00000-0000' : '00 0000-00009';
        },
        spOptions = {
          onKeyPress: function(val, e, field, options) {
              field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('#telefone').mask(SPMaskBehavior, spOptions);
    </script>
</html>

'use strict';
var app = angular.module('camaraSistema');

app.directive('file-model', function ($parse) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var model = $parse(attrs.demoFileModel),
                    modelSetter = model.assign; //define a setter for demoFileModel
            element.bind('change', function () {
                scope.$apply(function () {
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
});
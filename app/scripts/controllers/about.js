'use strict';

/**
 * @ngdoc function
 * @name babyappApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the babyappApp
 */
angular.module('babyappApp')
  .controller('AboutCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });

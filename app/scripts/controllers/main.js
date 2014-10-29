'use strict';

/**
 * @ngdoc function
 * @name babyappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the babyappApp
 */
angular.module('babyappApp')
  .controller('MainCtrl', function ($scope) {
     $scope.list1 = {title: 'AngularJS - Drag Me'};
  	 $scope.list2 = {};

  	 $scope.test = function(){
  	 	//alert('are you there');
  	 }
});

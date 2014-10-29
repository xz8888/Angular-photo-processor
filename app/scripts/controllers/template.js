'use strict';

/**
 * @ngdoc function
 * @name babyappApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the babyappApp
 */
angular.module('babyappApp')
  .controller('TemplateCtrl', ['$scope', 'templateService', '$state', function($scope, templateService, $state) {
  	var templatePromise = templateService.getTemplates();

  	templatePromise.then(function(result){
  		$scope.templates = result;
      var indicator_width = 0;
      //getting the width
      angular.forEach($scope.templates, function(value, key){
     
        indicator_width += value.thumbnail_width + 10;
  
      });

      $scope.indicator_width = indicator_width;
      console.log(indicator_width);
  		
  	});

  	$scope.select = function(id){
  		 $state.go('upload', {'template_id': id})
  	}

  }]);

'use strict';

/**
 * @ngdoc function
 * @name babyappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the babyappApp
 */
angular.module('babyappApp')
	.controller('ShareCtrl', ['$scope', '$stateParams', '$http', 'imageService', '$state',
       function($scope, $stateParams, $http, imageService, $state) {
          
          var image_id = $stateParams.image_id;

          var imagePromise = imageService.getImage(image_id);
          imagePromise.then(function(result){
              $scope.image = result;
       	  });

       }
    ]);
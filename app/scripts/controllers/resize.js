'use strict';

/**
 * @ngdoc function
 * @name babyappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the babyappApp
 */
angular.module('babyappApp')

  .controller('ResizeCtrl', ['$scope', '$stateParams', '$http', 'imageService', '$state',
       function($scope, $stateParams, $http, imageService, $state) {
         $scope.list1 = {title: 'Resize me'};
      	 $scope.list2 = {};
         
         var image_id = $stateParams.image_id;
         var template_id = $stateParams.template_id;

         $scope.image = {};
         $scope.image.resultImage = {};

         var imagePromise = imageService.getImage(image_id);

         imagePromise.then(function(result){
            $scope.image.uploadedImage = result.url;
         })
     
        $scope.$watch('image.resultImage', function(newValue, oldValue){
            if (newValue != oldValue){
                //call backend to process the image
                newValue.image_id = image_id;

                var cropPromise = imageService.crop(newValue);

                cropPromise.then(function(result){
                  if(result.success)
                      $state.go('editor', {'image_id': result.image_id, 'template_id': template_id})
                    else
                      alert('image can\'t be cropped');
                });

              
            }
        })
  }
]);
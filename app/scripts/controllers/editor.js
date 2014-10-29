'use strict';

/**
 * @ngdoc function
 * @name babyappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the babyappApp
 */
angular.module('babyappApp')
  .controller('EditorCtrl', ['$scope', '$stateParams', '$state', '$http', '$modal', 'templateService', 'imageService', function($scope, $stateParams, $state, $http, $modal, templateService, imageService) {
     $scope.list1 = {title: 'Edit me'};
  	 $scope.list2 = {};
     
     var image_id = $stateParams.image_id;
     var template_id = $stateParams.template_id;
     var templatePromise = templateService.getTemplate(template_id);

     templatePromise.then(function(result){
       $scope.template = result.template;
       
       //setting the template default value

       var imagePromise = imageService.getImage(image_id);

       imagePromise.then(function(result){
          $scope.image = result;
       });
     });

    /** save function **/
    $scope.save = function(){
      //send the template to the server
      var theTemplate = JSON.stringify($scope.template);
      var imagePromise = imageService.process(image_id, theTemplate);

      imagePromise.then(function(result){
          if(result.success)
            $state.go('share', {'image_id': result.image_id})
           else
            alert('image can\'t be proccessed');
         })
    }

    /** open dialog **/
    $scope.open = function($index){

      $scope.template.selected = $index;

      var modalInstance = $modal.open({
        templateUrl: 'editorModal.html', 
        controller: 'FormModalCtrl', 
        resolve:{
           template: function(){
              return $scope.template
           }
        }
      });
      
      $scope.selected = $index;

      modalInstance.result.then(function(){
          //copy over the value
          angular.forEach($scope.template.blocks, function(value, i){
             angular.forEach(value.elements, function(element, j){

                 $scope.template.blocks[i].elements[j].value = element.temp;
             })
          })
      }, function(){
         $log.info('Modal dismissed at: ' + new Date());
      });
    };
  }
]);

angular.module('babyappApp')
  .controller('FormModalCtrl', ['$scope', '$modalInstance', 'template',  function($scope, $modalInstance, template){

    $scope.template = template;
    $scope.selected = template.selected;

    $scope.ok = function(){
      $modalInstance.close();
    };

    $scope.cancel = function(){
      $modalInstance.dismiss('cancel');
    }
  }])
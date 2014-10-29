'use strict';

var babyApp = angular.module('babyappApp');

babyApp.directive('imgCrop', function(){
   return {
   	restrict: 'E', 
   	scope:{
   		image: '=', 
   		result: '=', 
   		canvasWidth: '=', 
   		canvasHeight: '='	
   	}, 

    templateUrl: 'scripts/templates/canvas.html', 

	  link: function(scope, element){
	    
       scope.$watch('image', function(newValue, oldValue){

          if (newValue != oldValue){
           var cropper = new CropBox({
              imageBox: '.imageBox',
              thumbBox: '.thumbBox', 
              spinner: '.spinner', 
              imgSrc: newValue, 
           });

           scope.enlarge = function(){
             cropper.zoomIn();
           }

           scope.shrink = function(){
             cropper.zoomOut();
           }

           scope.crop = function(){
              var positions = cropper.getCropPosition();
              scope.result = positions;
           }
          } 
       });
	  }
   };
})
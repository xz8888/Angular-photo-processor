'use strict';

/**
 * @ngdoc function
 * @name babyappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the babyappApp
 */
angular.module('babyappApp')
  .controller('UploaderCtrl', ['$scope', '$rootScope',  'Global', '$timeout', '$state', '$stateParams',function ($scope, $rootScope, Global, $timeout, $state, $stateParams) {
     $scope.list1 = {title: 'Uploader'};
  	 $scope.list2 = {};
     $scope.server_url = Global.server_url;
     
     var template_id = $stateParams.template_id;

     $scope.$on('flow::filesSubmitted', function (event, $flow, flowFile) {

     $scope.progress = "uploading...";
   
     $rootScope.toggle('myOverlay', 'on');
     $flow.upload();
    
  		event.preventDefault();//prevent file from uploading
	 });

	 $scope.$on('flow::fileSuccess', function(event, $flow, flowFile, data){

    var data = angular.fromJson(data);

	 	$timeout(function(){
	 	    $rootScope.toggle('myOverlay', 'off');
        $scope.progress = "Complete";
        if (data.image_id)
          $state.go('resize', {'image_id': data.image_id, 'template_id': template_id})
        else 
            alert('upload failed');
        //transit to another page
	 	}, 2000)
	 	  
  		event.preventDefault();//prevent file from uploading
	 })
}]);

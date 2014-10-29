  angular.module('babyappApp')
  .factory('imageService', ['$http', '$q', 'Global', function($http, $q, Global){

      var server_url = Global.server_url;
      var getImage = function(image_id){
        var deferred = $q.defer();

        $http({method: "GET", url: server_url + "api/index.php?action=get_image&id=" + image_id})
           .success(function(result){
            deferred.resolve(result);
        });
        
        return deferred.promise;
     };

     var crop = function(theData){
        var deferred = $q.defer();

       $http({
            method: 'post',
            url: server_url + 'api/index.php?action=crop',
            data: theData
          }).success(function(result){
              deferred.resolve(result);
        });

        return deferred.promise;
     };

     var process = function(image_id, theData){
         var deferred = $q.defer();
         
         $http({
            method: 'post',
            url: server_url + 'api/index.php?action=process&image_id=' + image_id,
            data: {template: theData}
          }).success(function(result){
              deferred.resolve(result);
        });

        return deferred.promise;
     };

     return {getImage: getImage, crop: crop, process: process}
  }])
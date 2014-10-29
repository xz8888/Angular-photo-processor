angular.module('babyappApp')
  .factory('templateService', ['$http', '$q', 'Global', function($http, $q, Global){
  
     
     var server_url = Global.server_url;
     var getTemplates = function(){
     	var deferred = $q.defer();

     	$http({method: "GET", url: server_url + "api/index.php?action=templates"})
     	   .success(function(result){
     	   	deferred.resolve(result);
     	});

     	   return deferred.promise;
     }

      var getTemplate = function(template_id){
        var deferred = $q.defer();

        $http({method: "GET", url: server_url + "api/index.php?action=template&template_id=" + template_id})
           .success(function(result){
            deferred.resolve(result);
        });

           return deferred.promise;
     }

     return {getTemplates: getTemplates, getTemplate: getTemplate}
  }])
'use strict';

/**
 * @ngdoc overview
 * @name babyappApp
 * @description
 * # babyappApp
 *
 * Main module of the application.
 */
angular
  .module('babyappApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'ui.bootstrap',
    'ui.router',
    'mobile-angular-ui',
    'flow',
    'angular-carousel',
    'angular-momentum-scroll'
  ])
  .config(function ($stateProvider, $urlRouterProvider, flowFactoryProvider, $httpProvider) {
    $urlRouterProvider.otherwise("/");

    $stateProvider
      .state('home', {
        url: '/',
        templateUrl: 'views/flow.html'
      })
      .state('upload', {
        url: '/upload/:template_id', 
        templateUrl: 'views/upload.html'
      })
      .state('resize', {
         url: '/resize/:image_id/:template_id',
         templateUrl: 'views/resize.html'
      })
      .state('editor', {
         url: '/editor/:image_id/:template_id', 
         templateUrl: 'views/edit.html'
      })
      .state('templates', {
         url: '/templates',
         templateUrl: 'views/template.html'
      })
      .state('share', {
        url: '/share/:image_id', 
        templateUrl: 'views/share.html'
      })

    flowFactoryProvider.factory = fustyFlowFactory;
    flowFactoryProvider.defaults = {
      permanentErrors: [404, 500, 501],
      maxChunkRetries: 1,
      chunkRetryInterval: 5000,
      simultaneousUploads: 4
    };

    //fix for php not getting post issue
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    var param = function(obj) {
        var query = '',
            name, value, fullSubName, subName, subValue, innerObj, i;

        for (name in obj) {
            value = obj[name];

            if (value instanceof Array) {
                for (i = 0; i < value.length; ++i) {
                    subValue = value[i];
                    fullSubName = name + '[' + i + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value instanceof Object) {
                for (subName in value) {
                    subValue = value[subName];
                    fullSubName = name + '[' + subName + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value !== undefined && value !== null) query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
        }

        return query.length ? query.substr(0, query.length - 1) : query;
    };

    $httpProvider.defaults.transformRequest = [function(data) {
        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }]; 
  })
  .run(function(){
     FastClick.attach(document.body);
  });

'use strict';

//Global service for global variables
angular.module('babyappApp').factory('Global', [

    function() {
        var _this = this;
        _this._data = {
           'server_url' : 'http://test.dev/babyapp/'
        };
        return _this._data;
    }
]);

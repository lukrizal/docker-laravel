window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.angular = require('angular');

const app = angular.module('todoApp', []);

app.config ['$interpolateProvider', ($interpolateProvider)=> {
    $interpolateProvider.startSymbol('%%')
    $interpolateProvider.endSymbol('%%')
}]

const todoCtrl = function($scope, api) {
    $scope.list = [];
    $scope.form = false;
    $scope.data = { task: '', done: false, id: null };

    api.get((res)=> {
        $scope.list = [];
        if (res.status === 200) {
            $scope.list = res.data.collection;
        }
    }, (res)=> {
        console.dir(res);
    });

    $scope.add = function addItem() {
        api.add($scope.data, (res)=> {
            if (res.status === 200) {
                $scope.list.push(res.data.item);
            }
        }, (res)=> {
            console.dir(res);
        });
    };

    $scope.update = function updateItem(id, data) {
        api.update(id, data, (res)=> {
            if (res.status === 200) {
                item = _.find($scope.list, { id })
                angular.extend(item, data);
            }
        }, (res)=> {
            console.dir(res);
        });
    };
};

const apiService = function($http) {
    return {
        url: '/api/todos',
        request(opts, successCallback, errorCallback) {
            return $http(opts).then((resp)=> {
                successCallback(resp)
            }, (resp)=> {
                errorCallback(resp)
            });
        },
        update(id, data, successCallback=_.noop, errorCallback=_.noop) {
            const opts = {
                url: `${this.url}/${id}`,
                method: 'PUT',
                data,
            };
            return this.request(opts, successCallback, errorCallback);
        },
        add(data, successCallback=_.noop, errorCallback=_.noop) {
            const opts = {
                url: this.url,
                method: 'POST',
                data,
            };
            return this.request(opts, successCallback, errorCallback);
        },
        get(successCallback=_.noop, errorCallback=_.noop) {
            const opts = {
                url: this.url,
                method: 'GET',
            };
            return this.request(opts, successCallback, errorCallback);
        },
    };
};

app.controller('todoCtrl', ['$scope', 'api', todoCtrl])

app.service('api', ['$http', apiService])

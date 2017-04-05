<!DOCTYPE html>
<html ng-app="todoApp">
    <head>
        <meta charset="utf-8">
        <title>TODO App</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div ng-controller="todoCtrl">
            <h1 class="text-center">TO DO LIST</h1>
            <div class="new-wrapper">
                <input type="text" value="New task" ng-model="data.task">
                <button class="btn btn-circle btn-info" ng-click="add()">+</button>
            </div>

            <ul class="list-group list-group-flush tasks">
                <li class="list-group-item" ng-class="{ done: item.done }" ng-repeat="item in list">
                    <span ng-bind="item.task"></span>
                    <a href="#" ng-click="update(item.id, { done: !item.done })" class="btn btn-done glyphicon" ng-class="{ 'glyphicon-check': item.done, 'glyphicon-unchecked': !item.done }"></a>
                </li>
            </ul>
        </div>

        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>

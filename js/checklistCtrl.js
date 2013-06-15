'use strict';

function ChecklistCtrl($scope, $http) {
  $http.get('list/checklist.json').success(function(data) {
    $scope.checklist = data;
  });

  $scope.orderProp = 'name';
}
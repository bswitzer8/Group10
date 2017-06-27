(function () {
    /* global angular */
    var app = angular.module("Listastic");

    app.controller("mainController", function ($scope, $location, $http, $window) {

        $scope.priorities = {
            5: "Urgent",
            4: "High",
            3: "Medium",
            2: "Low",
            1: "None"
        };

        $scope.checked = {};

        $scope.tagIt = function (tag) {
            $scope.todo = $scope.rawTodo;

            if ($scope.checked[tag]) $scope.checked[tag] = false;
            else $scope.checked[tag] = true;

            $scope.flag = false;
            for (var c in $scope.checked) {
                if ($scope.checked[c]) {
                    $scope.flag = true;
                    break;
                }
            }


            $scope.filtered = [];

            angular.forEach($scope.todo, function (t) {
                if (t.tags != undefined)
                    for (var c in $scope.checked)
                        if ($scope.checked[c] && t.tags.indexOf(c) >= 0)
                            $scope.filtered.push(t);

            });


            $scope.todo = $scope.flag ? angular.copy($scope.filtered) : $scope.rawTodo;
        }

        $http.get('backend/getUser.php')
            .then(function (res) {
                $scope.user = res.data;
            });


        $scope.init = function () {
            $scope.todo = [];
            $scope.rawTodo;


            $http.get('backend/getListItems.php')
                .then(function (res) {


                    if (res.data.records.length == 0) return; // NO POINT


                    $scope.tags = [];

                    var associate = {};
                    angular.forEach(res.data.filters, function (t) {

                        if ($scope.tags.indexOf(t.name) == -1) $scope.tags.push(t.name);

                        if (associate[t.list_id] == undefined) associate[t.list_id] = [];

                        associate[t.list_id].push(t.name);
                    });

                    angular.forEach(res.data.records, function (r) {
                        r.priority_name = $scope.priorities[r.priority];
                        r.tags = associate[r.id]
                    })

                    $scope.todo = $scope.todo.concat(res.data.records);
                    $scope.rawTodo = $scope.todo;

                });

            $http.get('backend/getListItemsSharedWithUser.php')
                .then(function (res) {


                    angular.forEach(res.data.records, function (r) {
                        r.shared = true;
                        r.priority_name = $scope.priorities[r.priority];
                    })

                    $scope.todo = $scope.todo.concat(res.data.records);
                });
        }


        $scope.share = function (item) {
            item.sharing = true;

            // pull all the users that are currently shared.
            var sh = [];
            $http.get('backend/getUsers.php')
                .then(function (res) {

                    $scope.usersToShare = res.data;

                    $http({
                        method: "post",
                        url: "backend/getSharedWith.php",
                        data: {'list_id': item.id},
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    })
                        .then(function (res) {
                            $scope.sharedUsers = res.data;

                            if ($scope.sharedUsers.length > 0) {
                                angular.forEach($scope.usersToShare, function (f) {
                                    for (var i = 0; i < res.data.length; ++i) {
                                        if (f.id != $scope.sharedUsers[i].id) {

                                            sh.push(f);
                                            break;
                                        }
                                    }
                                    $scope.usersToShare = sh;
                                });
                            }


                        }); // end of getSharedWith
                }); // end of thenGet


            $scope.sharing = item;
        }

        $scope.saveShare = function () {


            function handleError(data) {
                console.log(data);
                console.log("Err!");

            }

            function handleSuccess(data) {
                $scope.sharing = false;
                console.log(data);
            }


            var request = $http({
                method: "post",
                url: "backend/shareListItem.php",
                data: {'list_id': $scope.sharing.id, 'user_id': $scope.sharedUser},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
            return ( request.then(handleSuccess, handleError) );
        }

        $scope.removeShare = function (yep) {

            $http({
                method: "post",
                url: "backend/unshareListItem.php",
                data: {'list_id': $scope.sharing.id, 'user_id': yep},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(
                function (dat) {
                    for (var i = 0; i < $scope.sharedUsers.length; ++i) {
                        if ($scope.sharedUsers[i].id == yep) {

                            $scope.share($scope.sharing);
                            break;
                        }
                    }
                    console.log(dat);
                },

                function (dat) {
                    console.log(dat);
                });
        }


        $scope.delete = function (itemID) {
            function handleError(data) {
                console.log(data);
                console.log("Err!");
            }

            function handleSuccess(data) {
                console.log(data);
                $scope.init();
            }

            var request = $http({
                method: "post",
                url: "backend/deleteListItem.php",
                data: {'id': itemID},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
            return ( request.then(handleSuccess, handleError) );
        }


        $scope.logout = function () {
            function handleError(data) {
                console.log(data);
                console.log("!!!Errror");
            }

            function handleSuccess(data) {

                $window.location.replace('../cop4813/index.php');
            }

            var request = $http({
                method: "post",
                url: "backend/logout.php",
                data: {name: "surprise"},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
            return ( request.then(handleSuccess, handleError));

        }

        $scope.init(); // callem!
    });

})();
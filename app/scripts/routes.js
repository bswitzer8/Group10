(function(){
	/* global angular */
	var app = angular.module("Listastic"); 
	
	app.config(["$routeProvider", function($routeProvider) {
		$routeProvider.
		when("/login", {
			title: "Login",
			templateUrl: "app/views/login.html",
			controller: "loginController"
		})
		.when("/logout", {
			title: "Logout",
			templateUrl: "app/views/login.html",
			controller: "logoutController"
		})
		.when("/register", {
			title: "Register",
			templateUrl: "app/views/register.html",
			controller: "registerController"
		})
		.when("/forgetpassword", {
			title: "Forgot Password",
			templateUrl: "app/views/forgetpassword.html",
			controller: "forgotController"
		})
		.when("/main", {
			title: "Listastic!",
			templateUrl: "app/views/index.html",
			controller: "mainController"
		})
		.when("/add", {
			title: "Listastic - Add Item!",
			templateUrl: "app/views/add.html",
			controller: "addItemController"
		})
		.when("/update:id", {
			title: "Listastic - Update Item!",
			templateUrl: "app/views/update.html",
			controller: "updateItemController"
		})
		.when("/", {
			title: "Login",
			templateUrl: "app/views/login.html",
			controller: "loginController",
			role: "0"
		})
		.otherwise({
			redirectTo: "/login"
		});
	}]);
	/*
    .run(["$rootScope", "$location", "Data", function ($rootScope, $location, Data) {
        $rootScope.$on("$routeChangeStart", function (event, next, current) {
            $rootScope.authenticated = false;
            Data.get("session").then(function (results) {
                if (results.uid) {
                    $rootScope.authenticated = true;
                    $rootScope.uid = results.uid;
                    $rootScope.name = results.name;
                    $rootScope.email = results.email;
                } else {
                    var nextUrl = next.$$route.originalPath;
                    if (nextUrl == "/signup" || nextUrl == "/login") {

                    } else {
                        $location.path("/login");
                    }
                }
            });
        });
	}]);*/
})();
	
	
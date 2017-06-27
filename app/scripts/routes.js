(function(){
	/* global angular */
	var app = angular.module("Listastic"); 
	
	app.config(["$routeProvider", function($routeProvider) {
		$routeProvider
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
		.when("/update/:id", {
			title: "Listastic - Update Item!",
			templateUrl: "app/views/update.html",
			controller: "updateItemController"
		})
		.when("/", {
			title: "Listastic!",
			templateUrl: "app/views/index.html",
			controller: "mainController",
			role: 0
		})
		.otherwise({
			redirectTo: "/index"
		});
	}]);

})();
	
	
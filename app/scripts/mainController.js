(function(){
	/* global angular */
	var app = angular.module("Listastic"); 

	app.controller("mainController", function($scope, $http){
		console.log("testing from main");
		
		// we would get the user like the data
		$scope.user = { name: "bob"};
			// this needs to be changed to get from a php source
			$http.get('backend/getListItems.php')
			.then(function(res){
				console.log(res);
				
			 //	$scope.todo = angular.copy($scope.raw);
		});

		$scope.tags = ["school", "fitness", "work"];         


	});

})();
(function(){
	/* global angular */
	var app = angular.module("Listastic"); 
	
	app.controller("loginController", ["$scope", "$http", "$location", function($scope, $http, $location){
	 
		console.log("testing frmo login");
		
		//$http.get("currentUser.php")
	 
		// we would get the user like the data
		$scope.user = { name: "bob"};
			// this needs to be changed to get from a php source
			$http.get('app/content/json/dumby_data.json')
			.then(function(res){
				$scope.raw = res.data;  
				$scope.todo = angular.copy($scope.raw);
		});

		$scope.go = function()
		{
			$location.path("main");
			console.log($scope.login);
			/*
			$http.post('app/content/json/login.php', $scope.login)
			.then(function(res){
				if(res.data)
				{
					redirect to main
				}
				else
				{
					$scope.error = res.data.error;
				}

				
			*/
		};

	}]);
})();
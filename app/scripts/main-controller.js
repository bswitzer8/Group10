app.controller("mainController", function($scope, $http){
 
	// we would get the user like the data
	$scope.user = { name: "bob"};
		// this needs to be changed to get from a php source
		$http.get('app/content/json/dumby_data.json')
   		.then(function(res){
      		$scope.raw = res.data;  
      		$scope.todo = angular.copy($scope.raw);
    });

   	$scope.tags = ["school", "fitness", "work"];         
		


});
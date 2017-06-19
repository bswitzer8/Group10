(function(){
	/* global angular */
	var app = angular.module("Listastic"); 
	
	app.controller("addItemController", function($scope, $location, $routeParams, $http){
	 
	 
		if($routeParams.id)
		{
			function handleError(data)
			{
				console.log(data);
				console.log("Err!");
				// redirect?
			}
			
			 var request = $http({
	            method: "post",
	            url: "backend/getListItem.php",
	            data: { id: $routeParams.id },
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        	return( request.then( function(data){ $scope.list = data; }, handleError ) );
		
			
		}
		else {
			console.log("No valid id provided!");
			// redirect?
		}
		
	    $scope.priorities = [
	         { numeric: 5, name: "Urgent" },
             { numeric: 4, name: "High" },
             { numeric: 3, name: "Medium" },
             { numeric: 2, name: "Low" },
             { numeric: 1, name: "None" }
	    ];
	 
		console.log("testing from add item");
		
	
		$scope.go = function()
		{
		    console.log($scope.list);
		    
		    function handleError(argument) {
			    console.log(argument);
	        }
		
		    function handleSuccess(argument){
			    console.log(argument);
			
		        // redirect
		        $location.path("main");
		    }
		    
		    var request = $http({
	            method: "post",
	            url: "backend/addListItem.php",
	            data: { data: $scope.list },
	           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        return( request.then( handleSuccess, handleError ) );
		    
		};

	});
})();
(function(){
	/* global angular */
	/* global moment */
	var app = angular.module("Listastic"); 
	
	app.controller("updateItemController", function($scope, $filter, $location, $routeParams, $http){
	 
		console.log($routeParams.id);
		
		  $scope.priorities = [
	         { numeric: "5", name: "Urgent" },
             { numeric: "4", name: "High" },
             { numeric: "3", name: "Medium" },
             { numeric: "2", name: "Low" },
             { numeric: "1", name: "None" }
	    ];
			
		$scope.cancel = function(){
			  $location.path("main");
		}
		
			$scope.go = function()
		{
			console.log("test");
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
	            url: "backend/updateListItem.php",
	            data: { data: $scope.list },
	           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        	return( request.then( handleSuccess, handleError ) );
		    
		}
		
		if($routeParams.id != null && $routeParams.id != undefined)
		{
			function handleError(data)
			{
				console.log(data);
				console.log("Err!");
				// redirect?
			}
			
			function handleSuccess(data){ 
				console.log(data.data.records);
				$scope.list = data.data.records[0];
				$scope.list.due_date = moment($scope.list.dueDate);
			}
			
			console.log("get?");
			
			 var request = $http({
	            method: "post",
	            url: "backend/getListItem.php",
	            data: { id: $routeParams.id },
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        	return( request.then( handleSuccess, handleError ) );
		
			
		}
		else {
			console.log("No valid id provided!");
			// redirect?
		}
		
	   
	
	

	});
})();
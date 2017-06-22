(function(){
	/* global angular */
	var app = angular.module("Listastic"); 
	
	app.controller("addItemController", function($scope, $location, $http){
	    
	    	$scope.cancel = function(){
			  $location.path("main");
		}
		
		// moment picker: https://embed.plnkr.co/P48UnN
		
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
	            data: $scope.list,
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        return( request.then( handleSuccess, handleError ) );
		    
		};

	});
})();
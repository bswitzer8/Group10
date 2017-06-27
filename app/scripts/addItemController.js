(function(){
	/* global angular */
	var app = angular.module("Listastic"); 
	
	app.controller("addItemController", function($scope, $location, $http){
	    
	    	$scope.cancel = function(){
			  $location.path("main");
		}
		
		$http.get('backend/getUser.php')
			.then(function(res){
				$scope.user = res.data;
		});
		
		// moment picker: https://embed.plnkr.co/P48UnN
		$scope.filters = [{ name: "" }];
		
	    $scope.priorities = [
	         { numeric: 5, name: "Urgent" },
             { numeric: 4, name: "High" },
             { numeric: 3, name: "Medium" },
             { numeric: 2, name: "Low" },
             { numeric: 1, name: "None" }
	    ];

		
		$scope.addFilter = function()
		{
			$scope.filters.push({ name: ""});
		}
			
		$scope.go = function()
		{
		    console.log($scope.list);
		    
		    $scope.list.filters = [];
		    angular.forEach($scope.filters, function(f){
		  
		    	$scope.list.filters.push(f.name);
		    })
		    
		    function handleError(argument) {
			    console.log(argument);
			    
			    $location.path("main");
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
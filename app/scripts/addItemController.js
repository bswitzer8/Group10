(function(){
	/* global angular */
	var app = angular.module("Listastic"); 
	
	app.controller("addItemController", function($scope, $location, $http){
	    
	    	$scope.cancel = function(){
			  $location.path("main");
		}
		
		$scope.user = { name: "bob"};
		
		// moment picker: https://embed.plnkr.co/P48UnN
		$scope.filters = [{ name: "" }];
		
	    $scope.priorities = [
	         { numeric: 5, name: "Urgent" },
             { numeric: 4, name: "High" },
             { numeric: 3, name: "Medium" },
             { numeric: 2, name: "Low" },
             { numeric: 1, name: "None" }
	    ];
	 
		console.log("testing from add item");
		
		$scope.addFilter = function()
		{
			$scope.filters.push({ name: ""});
		}
			
		$scope.go = function()
		{
		    console.log($scope.list);
		    
		    $scope.list.filters = [];
		    angular.forEach($scope.filters, function(f){
		    	console.log(f.name);
		    	$scope.list.filters.push(f.name);
		    })
		    
		    function handleError(argument) {
			    console.log(argument);
	        }
		
		    function handleSuccess(argument){
			    console.log(argument);
			    /*
			    var e = angular.fromJson(argument);
			    console.log(e.id);


				var filter = $scope.filters.pop();
				
				if(filter != null) return;
				do
				{
					$http({
			            method: 	"post",
			            url:		"backend/addListItem.php",
			            data:		{ filter: filter.name, id: e.id },
			            headers:	{ 'Content-Type': 'application/x-www-form-urlencoded' }
			        }).then(
			        	function(success){ console.log(success); }, 
			        	function(error){ console.log(error); }
		        	);
			        
			        
				} while($scope.filters.length > 0);
				
				*/
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
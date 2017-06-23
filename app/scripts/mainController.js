(function(){
	/* global angular */
	var app = angular.module("Listastic"); 

	app.controller("mainController", function($scope, $http){
		console.log("testing from main");
		
		  $scope.priorities = {
	         5: "Urgent" ,
             4: "High" ,
             3: "Medium" ,
             2: "Low" ,
             1: "None" 
	    };
	
		// we would get the user like the data
		$scope.user = { name: "bob"};
	
		$scope.init = function(){
			$scope.todo = [];
			console.log("hellu");
		
			// this needs to be changed to get from a php source
			$http.get('backend/getListItems.php')
				.then(function(res){
					console.log(res);
				 
				 if(res.data.records.length == 0) return; // NO POINT
				 
				 angular.forEach(res.data.records, function(r){
				 	r.priority =   $scope.priorities[r.priority];
				 })
				 	
				 $scope.todo = $scope.todo.concat(res.data.records);
				 console.log($scope.todo);
			});
		
			$http.get('backend/getListItemsSharedWithUser.php')
				.then(function(res){
					console.log(res);
				 
				 angular.forEach(res.data.records, function(r){
				 	r.shared = true;
				 	r.priority =   $scope.priorities[r.priority];
				 })
				 	
				 $scope.todo = $scope.todo.concat(res.data.records);
				 console.log($scope.todo);
			});
		}
		
	
		
		$scope.tags = ["school", "fitness", "work"];         

	
		$scope.delete = function(itemID)
		{
			function handleError(data)
			{
				console.log(data);
				console.log("Err!");
				
			}
			
			function handleSuccess(data){ 
				console.log(data);
				$scope.init();
				// update
			}
			
			console.log("get?=" + itemID);
			
			 var request = $http({
	            method: "post",
	            url: "backend/deleteListItem.php",
	            data: { 'id': itemID },
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        	return( request.then( handleSuccess, handleError ) );
		}
		
		$scope.init(); // callem!
	});

})();
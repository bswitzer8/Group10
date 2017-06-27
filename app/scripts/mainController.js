(function(){
	/* global angular */
	var app = angular.module("Listastic"); 

	app.controller("mainController", function($scope, $location, $http){
		
		  $scope.priorities = {
	         5: "Urgent" ,
             4: "High" ,
             3: "Medium" ,
             2: "Low" ,
             1: "None" 
	    };
		
		$scope.checked = {};
		$scope.tagIt = function(tag)
		{
			$scope.todo = $scope.rawTodo;
		
			if($scope.checked[tag]) $scope.checked[tag] = false;
			else $scope.checked[tag] = true;
			
			$scope.flag = false;
			for(var c in $scope.checked)
			{
				if($scope.checked[c])
				{
					$scope.flag = true;
					break;
				}
			}
			
			
			$scope.filtered = [];
			
			angular.forEach($scope.todo, function(t){
				if(t.tags != undefined)
					for(var c in $scope.checked)
						if($scope.checked[c] && t.tags.indexOf(c) >= 0)
							$scope.filtered.push(t);
				
			});
			
			
			$scope.todo = $scope.flag ? angular.copy($scope.filtered) : $scope.rawTodo;
		}
		
		// we would get the user like the data
		$scope.user = { name: "bob"};
	
		$scope.init = function(){
			$scope.todo = [];
			$scope.rawTodo;		

		
			// this needs to be changed to get from a php source
			$http.get('backend/getListItems.php')
				.then(function(res){
					console.log(res);
				 
				 if(res.data.records.length == 0) return; // NO POINT
				 

				  $scope.tags =  [];
				  
				 var associate = {};
				 angular.forEach(res.data.filters, function(t){
		
				 	$scope.tags.push(t.name);
				 	
				 	if(associate[t.list_id] == undefined) associate[t.list_id] = [];
				 
				 	associate[t.list_id].push(t.name);
				 });
			
				 angular.forEach(res.data.records, function(r){
				 	r.priority_name =   $scope.priorities[r.priority];
				 	r.tags = associate[r.id]
				 })
				 	
				 $scope.todo = $scope.todo.concat(res.data.records);
				 $scope.rawTodo = $scope.todo;

			});
		
			$http.get('backend/getListItemsSharedWithUser.php')
				.then(function(res){

				 
				 angular.forEach(res.data.records, function(r){
				 	r.shared = true;
				 	r.priority_name =   $scope.priorities[r.priority];
				 })
				 	
				 $scope.todo = $scope.todo.concat(res.data.records);
			});
		}
		

		$scope.share = function(item)
		{
			item.sharing = true;
			
			// pull all the users that are currently shared.
			$http.get('backend/getUsers.php')
				.then(function(res){
			 
					$scope.usersToShare = res.data;
			});
			
			$http({
			    url: 'backend/getSharedWith.php',
			    method: "GET",
			    params: {'list_id': item.id}
			 })
				.then(function(res){

					$scope.sharedUsers = res.data;
			});
			
			$scope.sharing = item;
		}
		
		$scope.saveShare = function(){
			
			
			function handleError(data)
			{
				console.log(data);
				console.log("Err!");
				
			}
			
			function handleSuccess(data){ 
				console.log(data);
			}

			
			 var request = $http({
	            method: "post",
	            url: "backend/shareListItem.php",
	            data: { 'id': $scope.sharing.itemID, 'user_id': $scope.sharing.user_id },
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        	return( request.then( handleSuccess, handleError ) );
		}
	
	
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
			}
			
			var request = $http({
	            method: "post",
	            url: "backend/deleteListItem.php",
	            data: { 'id': itemID },
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        	return( request.then( handleSuccess, handleError ) );
		}
		
		
		$scope.logout = function()
		{
			function handleError(data){
				console.log(data);
				console.log("!!!Errror");
			}
			function handleSuccess(data)
			{
				console.log(data);
				$location.path("login");
			}
			var request = $http({
	            method: "post",
	            url: "backend/logout.php",
	            data: { name: "surprise" },
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	        });
        	return( request.then( handleSuccess, handleError ));
        	
		}
		
		$scope.init(); // callem!
	});

})();
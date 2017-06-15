<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Listastic!</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<!-- include angular js -->
		<link rel="stylesheet" href="app/content/css/login.css"></link>
		<link rel="stylesheet" href="app/content/css/main.css"></link>
	</head>
	<body ng-app="Listastic">
			<div class="container">
				<div data-ng-view="" id="ng-view">
					
	
			</div>


		</div>
	</body>
	
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-route.js"></script>
	<script type="text/javascript" src="app/app.js"></script>
	<script type="text/javascript" src="app/scripts/mainController.js"></script>
	<script type="text/javascript" src="app/scripts/loginController.js"></script>
	<script type="text/javascript" src="app/scripts/registerController.js"></script>
	<script type="text/javascript" src="app/scripts/forgotController.js"></script>

	<script type="text/javascript" src="app/scripts/routes.js"></script>
</html>



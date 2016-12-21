<?php require_once "projects.php"; ?>

<!DOCTYPE html>
<html lang="pl" ng-app="myApp" ng-controller="AppCtrl">
<head>
 	<!-- <base href="/"> -->
	<meta charset="utf-8">
	<title>Pracownia architektoniczna</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/ideal-image-slider.css">
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/controller.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
	<script src="js/ideal-image-slider.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 content">
			<div ng-view></div>
		</div>
		<div class="col-sm-3"></div>
	</div>
</body>
</html>
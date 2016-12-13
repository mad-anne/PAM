<!DOCTYPE html>
<html lang="pl" ng-app="myApp" ng-controller="AppCtrl">
<head>
	<meta charset="utf-8">
	<title>Wyszukiwarka projektów</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/ideal-image-slider.css">
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/controller.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/ideal-image-slider.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 content">
			<input type="text" name="inputSearch" id="search" ng-model="search" class="form-control input-lg" placeholder="wyszukaj projekt..." />
			<ul class="list-group">
				<li data-toggle="modal" data-target="#myModal" class="list-group-item" ng-repeat="project in projects | filter: projectSearch | orderBy:'year':'true'" ng-click="showMoreInfo(project.id)">
					<div class="media-left">
						<img ng-src="{{project.img[0]}}" height="40" width="40">
					</div>
					<div class="media-body">
						<span class="text-uppercase"><strong>{{project.name || 'Brak tytułu'}}</strong></span><br>
						<span><small>{{project.yardage}} m<sup>2</sup></small></span>, <span><small>{{project.year}}</small></span>, <span><small>{{project.price}} zł</small></span>
					</div>
				</li>
			</ul>
		</div>
		</div>
</body>
</html>
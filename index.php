<?php require_once "php/projects.php"; ?>

<!DOCTYPE html>
<html lang="pl" ng-app="myApp" ng-controller="AppCtrl">
<head>
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
	<script src="js/ideal-image-slider.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 content">
			<h3>Pracownia architektoniczna <span id="subtitle">| projekty</span></h3> 
			<div class="text-right">
				<a href="add_project.php"><button class="btn btn-success" type="submit">nowy</button></a>
			</div>
			<input type="text" name="inputSearch" id="search" ng-model="search" class="form-control input-lg" placeholder="wyszukaj projekt..." />
			<ul class="list-group">
				<li data-toggle="modal" data-target="#myModal" class="list-group-item" ng-repeat="project in projects | filter: projectSearch | orderBy:'year':'true'" ng-click="showMoreInfo(project.id)">
					<div class="media-left">
						<img ng-src="{{project.images[0].path}}" height="40" width="40">
					</div>
					<div class="media-body">
						<span class="text-uppercase"><strong>{{project.name || 'Brak tytułu'}}</strong></span><br>
						<span><small>{{project.yardage}} m<sup>2</sup></small></span>, <span><small>{{project.year}}</small></span>, <span><small>{{project.price}} zł</small></span>
					</div>
				</li>
			</ul>
		</div>

		<div class="modal fade" id="myModal" role="dialog">

   			<div class="modal-dialog modal-dialog">

     			<div class="modal-content">

        			<div class="modal-header">
          				<button type="button" class="close" data-dismiss="modal">&times;</button>
          				<h4 class="modal-title" id="moreInfoTitle">Tytuł</h4>
        			</div>

	        		<div class="modal-body">

	          			<div id="slider">
	          				<img src="images/img010.png" alt="">
	          			</div>
	      
	          			<div class="moreInfo">
							<dl class="row">
		          				<dt class="col-sm-6">architekt</dt><dd class="" id="moreInfoArchitect"></dd>
		          				<dt class="col-sm-6">rok powstania</dt><dd class="col-sm-6" id="moreInfoYear">year</dd>
		          				<dt class="col-sm-6">miejsce</dt><dd class="col-sm-6" id="moreInfoPlace">place</dd>
		          				<dt class="col-sm-6">metraż</dt><dd class="col-sm-6" id="moreInfoYardage">yardage</dd>
		          				<dt class="col-sm-6">cena</dt><dd class="col-sm-6" id="moreInfoPrice">price</dd>
		          				<dt class="col-sm-6">typ</dt><dd class="col-sm-6" id="moreInfoType">type</dd>
		          				<dt class="col-sm-6">wykonawca</dt><dd class="col-sm-6" id="moreInfoExecutor">executor</dd>
		          				<dt class="col-sm-6">typ obiektu</dt><dd class="col-sm-6" id="moreInfoObjectType">objectType</dd>
		          				<dt class="col-sm-6">styl</dt><dd class="col-sm-6" id="moreInfoStyle">style</dd>
		          			</dl>
		          		</div>

	        		</div>

	        		<div class="modal-footer">
	          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        		</div>

      			</div>

    		</div>

    	</div>
		<div class="col-sm-3"></div>
	</div>
</body>
</html>
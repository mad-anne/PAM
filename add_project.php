<?php require_once "php/projects.php"; ?>

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
			<h3>Dodaj projekt</h3>
			<form class="form-horizontal" method="post" action="php/add_new_project.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="projectName" class="col-sm-2 control-label">nazwa</label>
					<div class="col-sm-8">
    					<input type="text" class="form-control" id="projectName" placeholder="nazwa" maxlength="150" name="projectName" required>
    				</div>
				</div>
				<div class="form-group">
					<label for="projectYear" class="col-sm-2 control-label">rok</label>
					<div class="col-sm-2">
						<select class="form-control" id="projectYear" ng-model="selectedName" ng-options="x for x in years" name="projectYear"></select>
    				</div>
				</div>
				<div class="form-group">
					<label for="projectPlace" class="col-sm-2 control-label">miejsce</label>
					<div class="col-sm-5">
    					<input type="text" class="form-control" id="projectPlace" placeholder="miejsce" maxlength="45" name="projectPlace">
    				</div>
				</div>
				<div class="form-group">
					<label for="projectExecutor" class="col-sm-2 control-label">wykonawca</label>
					<div class="col-sm-5">
    					<input type="text" class="form-control" id="projectExecutor" placeholder="wykonawca" maxlength="45" name="projectExecutor">
    				</div>
				</div>
				<div class="form-group">
					<label for="projectArchitect" class="col-sm-2 control-label">architekt</label>
					<div class="col-sm-5">
    					<input type="text" class="form-control" id="projectArchitect" placeholder="architekt" maxlength="45" name="projectArchitect">
    				</div>
				</div>
				<div class="form-group">
					<label for="projectType" class="col-sm-2 control-label">typ</label>
					<div class="col-sm-5">
    					<input type="text" class="form-control" id="projectType" placeholder="typ" maxlength="45" name="projectType">
    				</div>
				</div>
				<div class="form-group">
					<label for="projectStyle" class="col-sm-2 control-label">styl</label>
					<div class="col-sm-5">
    					<input type="text" class="form-control" id="projectStyle" placeholder="styl" maxlength="45" name="projectStyle">
    				</div>
				</div>
				<div class="form-group">
					<label for="projectYardage" class="col-sm-2 control-label">metraż</label>
					<div class="col-sm-3">
						<div class="input-group">
	    					<input type="text" class="form-control" id="projectYardage" placeholder="metraż" pattern="^(\d+((,|\.)\d{1,2})?)?$" name="projectYardage">
	    					<div class="input-group-addon">m<sup>2</sup></div>
	    				</div>
    				</div>
				</div>
				<div class="form-group">
					<label for="projectPrice" class="col-sm-2 control-label">cena</label>
					<div class="col-sm-3">
						<div class="input-group">
	    					<input type="text" class="form-control" id="projectPrice" placeholder="cena" pattern="^(\d+((,|\.)\d{1,2})?)?$" name="projectPrice">
	    					<div class="input-group-addon">zł</div>
	    				</div>
    				</div>
				</div>
				<div class="form-group">
					<label for="projectTags" class="col-sm-2 control-label">tagi</label>
					<div class="col-sm-8">
    					<input type="text" class="form-control" id="projectTags" placeholder="tagi" name="projectTags">
    				</div>
    			</div>
				<div class="form-group">
					<label for="projectFiles" class="col-sm-2 control-label">zdjęcia</label>
					<div class="col-sm-8">
    					<input type="file" id="projectFiles" name="projectFiles" multiple>
    				</div>
    			</div>
				<div class="row">
					<div class="col-sm-10"></div>
					<div class="col-sm-2">
						<input class="btn btn-success" type="submit" value="Dodaj">
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</body>
</html>
<?php
	require_once "php/validate_form.php";
	
	if ($isCorrectForm)
		require_once "php/add_new_project.php";
?>

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
			<h3>Dodaj projekt</h3>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<div class="form-group">
					<div class="row">
						<label for="name" class="col-sm-2 control-label">nazwa</label>
						<div class="col-sm-8">
	    					<input type="text" class="form-control" id="name" placeholder="nazwa" maxlength="150" name="name" <?php echo 'value="'.$name.'"'; ?>>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="nameErr"><?php echo $nameErr; ?></span>
	    			</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="year" class="col-sm-2 control-label">rok</label>
						<div class="col-sm-2">
							<select class="form-control" id="year" ng-model="selectedName" ng-options="x for x in years" name="year"></select>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="yearErr"><?php echo $yearErr; ?></span>
	    			</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="place" class="col-sm-2 control-label">miejsce</label>
						<div class="col-sm-5">
	    					<input type="text" class="form-control" id="place" placeholder="miejsce" maxlength="45" name="place" <?php echo 'value="'.$place.'"'; ?>>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="placeErr"><?php echo $placeErr; ?></span>
	    			</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="executor" class="col-sm-2 control-label">wykonawca</label>
						<div class="col-sm-5">
	    					<input type="text" class="form-control" id="executor" placeholder="wykonawca" maxlength="45" name="executor" <?php echo 'value="'.$executor.'"'; ?>>
	    				</div>
					</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="executorErr"><?php echo $executorErr; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="architect" class="col-sm-2 control-label">architekt</label>
						<div class="col-sm-5">
	    					<input type="text" class="form-control" id="architect" placeholder="architekt" maxlength="45" name="architect" <?php echo 'value="'.$architect.'"'; ?>>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="architectErr"><?php echo $architectErr; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="type" class="col-sm-2 control-label">typ</label>
						<div class="col-sm-5">
	    					<input type="text" class="form-control" id="type" placeholder="typ" maxlength="45" name="type" <?php echo 'value="'.$type.'"'; ?>>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="typeErr"><?php echo $typeErr; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="style" class="col-sm-2 control-label">styl</label>
						<div class="col-sm-5">
	    					<input type="text" class="form-control" id="style" placeholder="styl" maxlength="45" name="style" <?php echo 'value="'.$style.'"'; ?>>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="styleErr"><?php echo $styleErr; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="objectType" class="col-sm-2 control-label">typ obiektu</label>
						<div class="col-sm-5">
	    					<input type="text" class="form-control" id="objectType" placeholder="styl" maxlength="45" name="objectType" <?php echo 'value="'.$objectType.'"'; ?>>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="objectTypeErr"><?php echo $objectTypeErr; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="yardage" class="col-sm-2 control-label">metraż</label>
						<div class="col-sm-3">
							<div class="input-group">
		    					<input type="text" class="form-control" id="yardage" placeholder="metraż" name="yardage" <?php echo 'value="'.$yardage.'"'; ?>>
		    					<div class="input-group-addon">m<sup>2</sup></div>
		    				</div>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="yardageErr"><?php echo $yardageErr; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="price" class="col-sm-2 control-label">cena</label>
						<div class="col-sm-3">
							<div class="input-group">
		    					<input type="text" class="form-control" id="price" placeholder="cena"	 name="price" <?php echo 'value="'.$price.'"'; ?>>
		    					<div class="input-group-addon">zł</div>
		    				</div>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="priceErr"><?php echo $priceErr; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="tags" class="col-sm-2 control-label">tagi</label>
						<div class="col-sm-8">
	    					<input type="text" class="form-control" id="tags" placeholder="tagi" name="tags" <?php echo 'value="'.implode(", ", $tags).'"'; ?>>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="tagsErr"><?php echo $tagsErr; ?></span>
					</div>
    			</div>
				<div class="form-group">
					<div class="row">
						<label for="files" class="col-sm-2 control-label">zdjęcia</label>
						<div class="col-sm-10">
	    					<input type="file" id="files" name="files[]" multiple>
	    				</div>
	    			</div>
	    			<div class="row">
						<div class="col-sm-2"></div>
						<span class="col-sm-10 error" id="filesErr"><?php echo $filesErr; ?></span>
					</div>
    			</div>
				<div class="row">
					<div class="col-sm-10"></div>
					<div class="col-sm-2">
						<input class="btn btn-success" type="submit" name="submit" value="Dodaj">
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</body>
</html>
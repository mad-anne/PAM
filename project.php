<a href="#/">Wróć</a>
<h3>Pracownia architektoniczna <span id="subtitle">| szczegóły projektu</span></h3>
<div class="pre-scrollable" ng-init="startSlider()">
	<h4>{{current.name}}</h4>
		<div id="slider">
			<img src="images/img00000100.png" alt="">
		</div>
	<div class="moreInfo">
		<dl class="row">
				<dt class="col-sm-6">architekt</dt><dd class="" id="moreInfoArchitect">{{current.architect}}</dd>
				<dt class="col-sm-6">rok powstania</dt><dd class="col-sm-6" id="moreInfoYear">{{current.year}}</dd>
				<dt class="col-sm-6">miejsce</dt><dd class="col-sm-6" id="moreInfoPlace">{{current.place}}</dd>
				<dt class="col-sm-6">metraż</dt><dd class="col-sm-6" id="moreInfoYardage">{{current.yardage}}</dd>
				<dt class="col-sm-6">cena</dt><dd class="col-sm-6" id="moreInfoPrice">{{current.price}}</dd>
				<dt class="col-sm-6">typ</dt><dd class="col-sm-6" id="moreInfoType">{{current.type}}</dd>
				<dt class="col-sm-6">wykonawca</dt><dd class="col-sm-6" id="moreInfoExecutor">{{current.executor}}</dd>
				<dt class="col-sm-6">typ obiektu</dt><dd class="col-sm-6" id="moreInfoObjectType">{{current.objectType}}</dd>
				<dt class="col-sm-6">styl</dt><dd class="col-sm-6" id="moreInfoStyle">{{current.style}}</dd>
			</dl>
		</div>
</div>
<h3>Pracownia architektoniczna <span id="subtitle">| projekty</span></h3>
<div class="text-right">
	<a href="#new"><button class="btn btn-success">nowy</button></a>
</div>
<input type="text" name="inputSearch" id="search" ng-model="search" class="form-control input-lg" placeholder="wyszukaj projekt..." />
<ul class="list-group pre-scrollable">
	<a href="#project">
	<li class="list-group-item" ng-repeat="project in projects | filter: projectSearch | orderBy:'year':'true'" ng-click="setCurrentProject(project.id)">
		<div class="media-left">
			<img ng-src="{{project.images[0]}}" height="40" width="40">
		</div>
		<div class="media-body">
			<span class="text-uppercase"><strong>{{project.name || 'Brak tytułu'}}</strong></span><br>
			<span><small>{{project.yardage}} m<sup>2</sup></small></span>, <span><small>{{project.year}}</small></span>, <span><small>{{project.price}} zł</small></span>
		</div>
	</li>
	</a>
</ul>
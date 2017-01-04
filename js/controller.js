var app = angular.module('myApp', ['ngRoute', 'searchEngine']);
var app_searchEngine = angular.module('searchEngine', []);

app.config(function($routeProvider, $locationProvider) {
		$routeProvider
		.when(	'/',
				{ templateUrl : 'main.php',
				controller: 'projectsLoad'})
		.when(	'/project',
				{ templateUrl : 'project.php',
				controller: 'detailsCtrl'})
		.when(	'/new',
				{ templateUrl : 'add_project.php',
				controller: 'addProjectCtrl'});
});

app.service('globalProjects', function($http) {
	_projects = null;
	_current = null;

	this.async = function() {
		var promise = $http.get('projects.php')
		.then(function(response) {
			_projects = response.data
			return _projects;
		});
		return promise;
	};

	this.setCurrent = function(id) {
		var index = getIndexById(id);
		_current = index != -1 ?  _projects[index] : null;
	};

	this.getCurrent = function() {
		return _current;
	}

	getIndexById = function (id)
	{
		var index = -1;
		if (_projects != null)
		{
			for (var i = 0; i < _projects.length; ++i)
			{
				if (_projects[i].id == id)
				{
					index = i;
					break;
				}
			}
		}

		return index;
	}
});

app.controller('detailsCtrl', function($scope, $http, $location, globalProjects) {
	$scope.current = globalProjects.getCurrent();
	startSlider();

	function startSlider()
	{
		attachGallery($scope.current);
		var slider = new IdealImageSlider.Slider('#slider');
		slider.start();
	}

	function attachGallery(current)
	{
		var images = "";

		angular.forEach(current.images, function(value, key)
		{
			images += "<img src=\"" + value + "\">";
		});

		document.getElementById("slider").innerHTML = images;
	}

	$scope.removeProject = function(id) {

		$http.delete('php/remove_project.php?id=' + id)
		.success(function(data) {
			console.log(data);
		})
		.error(function(data) {
			console.log(data);
		});

		$location.path('/');
	}

	$scope.modifyProject = function()
	{
		$location.path('new');
	}
});

app.controller('projectsLoad', function($scope, $http, globalProjects) {
	globalProjects.async().then(function(d) {
		$scope.projects = d;
	});

	$scope.setCurrentProject = function(id)
	{
		globalProjects.setCurrent(id);
	}

	$scope.projectSearch = function(project)
	{
		if ($scope.search && $scope.search.length > 0)
		{
			var searchWithoutSpacesAndCommas = $scope.search.replace(/,/g,' ').replace(/\s\s+/g, ' ');
			var searchArray = searchWithoutSpacesAndCommas.split(' ');
			var saLen = searchArray.length;

			var counter = 0;
			for (var i = 0; i < saLen; ++i)
			{
				var word = searchArray[i];

				if 	(containsKeyword(project, word)
					|| containsKeywordOneLetterTypos(project, word))
					++counter;
			}

			return 	(counter == saLen) ?
					project
					: null;
		}
		return project;
	};

	function containsKeywordOneLetterTypos(project, word)
	{
		return (containsKeywordWithUncorrectLetter(project, word)
				|| containsKeywordWithInsufficiencyLetter(project, word)
				|| containsKeywordWithExcessLetter(project, word));
	}

	function containsKeywordWithUncorrectLetter(project, word)
	{
		var characters = 'aąbcćdeęfghijklłmnńoóprsśtuvwxyzźż';

		for (var i = 0; i < word.length; ++i)
		{
			for (var j = 0; j <= characters.length; ++j)
			{
				var currentWord = word.substr(0, i) + characters[j] + word.substr(i + 1);

				var removedChar = 0;
				while (removedChar <= word.length && ! containsKeyword(project, currentWord))
					++removedChar;

				if (removedChar < word.length + 1)
					return true;
			}
		}
		return false;
	}

	function containsKeywordWithInsufficiencyLetter(project, word)
	{
		var characters = 'aąbcćdeęfghijklłmnńoóprsśtuvwxyzźż';

		for (var i = 0; i < word.length; ++i)
		{
			for (var j = 0; j <= characters.length; ++j)
			{
				var currentWord = word.substr(0, i) + characters[j] + word.substr(i);

				var removedChar = 0;
				while (removedChar <= word.length && ! containsKeyword(project, currentWord))
					++removedChar;

				if (removedChar < word.length + 1)
					return true;
			}
		}
		return false;
	}

	function containsKeywordWithExcessLetter(project, word)
	{
		for (var i = 0; i <= word.length; ++i)
		{
			var currentWord = word.substr(0, i) + word.substr(i + 1);

			var removedChar = 0;
			while (removedChar <= word.length && ! containsKeyword(project, currentWord))
				++removedChar;

			if (removedChar < word.length + 1)
				return true;
		}
		return false;
	}

	function containsKeyword(project, keyword)
	{
		return (project.name.toLowerCase().search(keyword.toLowerCase()) != -1
				|| project.year.toString().search(keyword) != -1
				|| project.place.toLowerCase().search(keyword.toLowerCase()) != -1
				|| project.type.toLowerCase().search(keyword.toLowerCase()) != -1
				|| project.executor.toLowerCase().search(keyword.toLowerCase()) != -1
				|| project.architect.toLowerCase().search(keyword.toLowerCase()) != -1
				|| project.objectType.toLowerCase().search(keyword.toLowerCase()) != -1
				|| project.style.toLowerCase().search(keyword.toLowerCase()) != -1
				|| project.yardage.toString().search(keyword) != -1
				|| project.price.toString().search(keyword) != -1
				|| searchTags(project, keyword));
	}

	function searchTags(project, keyword)
	{
		var existsTag = false;
		angular.forEach(project.tags, function(value, key) {
			if (value.tag.toLowerCase().search(keyword.toLowerCase()) != -1)
				existsTag = true;
		});
		return existsTag;
	}
});

app.controller('addProjectCtrl', ['$scope', '$http', '$location', 'globalProjects', function($scope, $http, $location, globalProjects) {
	$scope.numberRegex = "/^(\d+((,|\.)\d{1,2})?)?$/";
	$scope.years = arrayInRange(1900, 2025).reverse();
	$scope.url = 'php/add_new_project.php';
	$scope.exists = false;
	$scope.current = globalProjects.getCurrent();
	$scope.selectedOption = $scope.years[$scope.years.indexOf(parseInt($scope.current.year))];

	function arrayInRange(start, end)
	{
   		var arr = [];
	    for (var i = start; i <= end; i++)
	        arr.push(i);
    	return arr;
	}

	$scope.addProject = function() {
		var addProjectForm = encodeFormToJSON();
		
		$http.post($scope.url, addProjectForm)
		.success(function(data) {
			if (data.length > 0)
				console.log(data);
			console.log('Successful insert of project to database');
			saveFiles();
		})
		.error(function(data) {
			console.log(data);
			console.log('Unsuccessful insert of project to database');
		});
	}

	function encodeFormToJSON()
	{
		var result = {};
		result.exists = false;
		result.name = document.querySelector('#name').value;
		var year = document.querySelector('#year')
		result.year = year.options[year.selectedIndex].text;
		result.place = document.querySelector('#place').value;
		result.executor = document.querySelector('#executor').value;
		result.architect = document.querySelector('#architect').value;
		result.type = document.querySelector('#type').value;
		result.style = document.querySelector('#style').value;
		result.objectType = document.querySelector('#objectType').value;
		result.yardage = document.querySelector('#yardage').value;
		result.price = document.querySelector('#price').value;
		result.tags = document.querySelector('#tags').value;
		return result;
	}

	function saveFiles()
	{
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/add_files.php', true);
		var fd = new FormData();

		var files = document.querySelector('#files').files;
		
		for (var i = 0; i < files.length; i++)
		{
			fd.append("files[]", files[i]);
		}

		xhr.onload = function() {
			if (this.status == 200)
			{
				console.log('Images upload status: OK');
			}
		};

		xhr.send(fd);
		$location.path('/');
	}
}]);

function readURL(input)
{
	removeExistingImages();
	
	var preview = document.querySelector('#preview');
    var files   = document.querySelector('input[type=file]').files;

    function readAndPreview(file) {
    	var reader = new FileReader();

        reader.addEventListener("load", function () {
			var image = new Image();
			image.src = this.result;
			image.name = file.name;
			image.class = "imagePreview";
	        preview.appendChild(image);
        }, false);

        reader.readAsDataURL(file);
	}

	if (files)
    	[].forEach.call(files, readAndPreview);
}

function removeExistingImages()
{
	var preview = document.querySelector('#preview');
	while (preview.firstChild)
	    preview.removeChild(preview.firstChild);
}
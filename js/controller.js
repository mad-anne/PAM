angular.module('myApp', ["ngRoute"]).controller('AppCtrl', function($scope)
{
	$scope.years = arrayInRange(1900, 2025).reverse();
	$scope.projects = (typeof(projects) !== 'undefined') ? projects : [];
	$scope.current = $scope.projects == [] ? [] : $scope.projects[0];

	function arrayInRange(start, end)
	{
   		var arr = [];
	    for (var i = start; i <= end; i++)
	        arr.push(i);
    	return arr;
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

	$scope.setCurrentProject = function(id)
	{
		$scope.current = getProjectById(id);
	}

	function getProjectById(id)
	{
		return $scope.projects[searchIndex(id)];
	}

	function searchIndex(id)
	{
		for (var i = 0; i < projects.length; ++i)
		{
			if(projects[i].id == id)
				return i;
		}

		return null;
	}

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
})
.controller('detailsCtrl', function($scope){
	
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
})
.controller('addProjectCtrl', ['$scope', '$http', function($scope, $http){
	$scope.numberRegex = "/^(\d+((,|\.)\d{1,2})?)?$/";
	$scope.years = arrayInRange(1900, 2025).reverse();
	$scope.url = 'php/add_new_project.php';

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
			console.log(data);
			console.log('Successful insert of project to database');
		})
		.error(function(data) {
			console.log(data);
			console.log('Unsuccessful insert of project to database');
		});

		saveFiles();
	}

	function encodeFormToJSON()
	{
		var result = {};
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
				console.log('Server response:', this.response);
		};

		xhr.send(fd);
	}
}])
.config(function($routeProvider, $locationProvider) {
		$routeProvider
		.when("/", { templateUrl : "main.php"})
		.when("/project", { templateUrl : "project.php",
		controller: "detailsCtrl"})
		.when("/new", { templateUrl : "add_project.php",
		controller: "addProjectCtrl"});

	// $locationProvider.html5Mode(true);
});

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
angular.module('myApp', []).controller('AppCtrl', function($scope)
{
	$scope.projects = projects;
	$scope.years = arrayInRange(1900, 2025).reverse();

	function arrayInRange(start, end)
	{
    var foo = [];
    for (var i = start; i <= end; i++) {
        foo.push(i);
    }
    return foo;
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

	$scope.showMoreInfo = function(id)
	{
		var current = getProjectById(id);

		addInfo(current);
		attachGallery(current);

		var slider = new IdealImageSlider.Slider('#slider');
		slider.start();
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

	function addInfo(current)
	{
		document.getElementById("moreInfoTitle").innerHTML = "<b>" + current.name.toUpperCase() + "</b>";
		document.getElementById("moreInfoArchitect").innerHTML = current.architect;
		document.getElementById("moreInfoYear").innerHTML = current.year;
		document.getElementById("moreInfoPlace").innerHTML = current.place;
		document.getElementById("moreInfoYardage").innerHTML = current.yardage + " m<sup>2</sup>";
		document.getElementById("moreInfoPrice").innerHTML = current.price + " zł";
		document.getElementById("moreInfoType").innerHTML = current.type;
		document.getElementById("moreInfoExecutor").innerHTML = current.executor;
		document.getElementById("moreInfoObjectType").innerHTML = current.objectType;
		document.getElementById("moreInfoStyle").innerHTML = current.style;
	}

	function attachGallery(current)
	{
		var images = "";

		angular.forEach(current.images, function(value, key) {
			console.log("Wartość: " + value.path);
			images += "<img src=\"" + value.path + "\">";
		});

		document.getElementById("slider").innerHTML = images;
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
});
angular.module('myApp', []).controller('AppCtrl', function($scope) {
	$scope.projects = [
	{
		id: 0,
		name: 'Marina III',
		tags: [ {value: 'Marina Topacz'},
				{value: 'dom na wodzie'},
				{value: 'restauracja'}],
		year: 2014,
		place: 'Wrocław',
		type: 'projekt',
		executor: 'Topacz Investment Sp. z o. o.',
		architect: 'Marcin Major',
		objectType: 'zabudowa mieszkalno-usługowa',
		style: 'nowoczesny',
		yardage: 5500,
		price: 80000,
		img: ['images/img010.png', 'images/img011.png', 'images/img012.png', 'images/img013.png', 'images/img014.png', 'images/img015.png']
	},
	{
		id: 1,
		name: 'Stacja narciarska w Beskidach',
		tags: [ {value: 'góry'},
				{value: 'narty'},
				{value: 'stacja'}],
		year: 2016,
		place: 'Polska',
		type: 'project',
		executor: 'beskid sp z o. o.',
		architect: 'Marcin Major',
		objectType: 'obiekt użytkowy',
		style: 'nowoczesny',
		yardage: 3810,
		price: 650000,
		img: ['images/img020.png', 'images/img021.png', 'images/img022.png']
	},
	{
		id: 2,
		name: 'Budynek wielofunkcyjny na osiedlu WUWA',
		tags: [	{value: 'konkurs'},
				{value: 'WUWA'},
				{value: 'budynek mieszkalny'}],
		year: 2016,
		place: 'Wrocław, Nowe Żerniki',
		type: 'projekt',
		executor: 'TBS Wrocław',
		architect: 'Paweł Major',
		objectType: 'budynek mieszkalny',
		style: 'nowoczesny',
		yardage: 11039,
		price: 1200000,
		img: ['images/img030.png', 'images/img031.png', 'images/img032.png', 'images/img033.png', 'images/img034.png']
	},
	{
		id: 3,
		name: 'Rozbudowa siedziby III LO we Wrocławiu',
		tags: [ {value: 'III LO'},
				{value: 'rozbudowa'},
				{value: 'szkoła'},
				{value: 'liceum'},
				{value: 'III Liceum Ogólnokształcące'}],
		year: 2015,
		place: 'Wrocław, Składowa 5',
		type: 'projekt',
		executor: 'Zarząd Inwestycji Miejskich',
		architect: 'Kamila Jacyniuk',
		objectType: 'budynek edukacyjny',
		style: 'nowoczesny',
		yardage: 3800,
		price: 1500000,
		img: ['images/img040.png', 'images/img041.png', 'images/img042.png', 'images/img043.png', 'images/img044.png']
	},
	{
		id: 4,
		name: 'Przebudowa Zamku Topacz na hotel pięciogwiazdkowy wraz z restauracją i basenem',
		tags: [ {value: 'hotel'},
				{value: 'restauracja'},
				{value: 'zamek'},
				{value: 'Ślęza'},
				{value: 'basen'}],
		year: 2014,
		place: 'Ślęza',
		type: 'realizacja',
		executor: 'Topacz Investment sp. z o. o.',
		architect: 'Anna Owsiany',
		objectType: 'zamek',
		style: 'restauracja',
		yardage: 2050,
		price: 750000,
		img: ['images/img050.png', 'images/img051.png', 'images/img052.png', 'images/img053.png', 'images/img054.png']
	},
	{
		id: 5,
		name: 'Budynek sportowo-rekreacyjny przy ZSO nr 3 oraz Zespole Szkół Plastycznych',
		tags: [ {value: 'sport'},
				{value: 'rekreacja'},
				{value: 'szkoła'}],
		year: 2007,
		place: 'Wrocław, ul. Piotra Skargi',
		type: 'realizacja',
		executor: 'ZIM Wrocław',
		architect: 'Kamila Jacyniuk',
		objectType: 'budynek edukacyjny',
		style: 'inudstrialny',
		yardage: 3145,
		price: 850000,
		img: ['images/img060.png', 'images/img061.png', 'images/img062.png', 'images/img063.png', 'images/img064.png']
	},
	{
		id: 6,
		name: 'Apartament na Krzykach',
		tags: [ {value: 'mieszkanie'},
				{value: 'luksus'},
				{value: 'apartament'}],
		year: 2010,
		place: 'Wrocław, Krzyki',
		type: 'realizacja',
		executor: 'major Architekci',
		architect: 'Marcin Major',
		objectType: 'mieszkanie',
		style: 'nowoczesny',
		yardage: 120,
		price: 350000,
		img: ['images/img070.png', 'images/img071.png', 'images/img072.png', 'images/img073.png']
	},
	{
		id: 7,
		name: 'Dom na wsi',
		tags: [ {value: 'dom jednorodzinny'},
				{value: 'zabudowa parterowa'},
				{value: 'letniskowy'}],
		year: 2017,
		place: 'Polska',
		type: 'realizacja',
		executor: 'brak',
		architect: 'Kamila Jacyniuk',
		objectType: 'dom',
		style: 'rustykalny',
		yardage: 166,
		price: 700000,
		img: ['images/img080.png', 'images/img081.png', 'images/img082.png', 'images/img083.png']
	}
	];

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
		var current = $scope.projects[id];

		addInfo(current);
		attachGallery(current);

		var slider = new IdealImageSlider.Slider('#slider');
		slider.start();
	}

	function addInfo(current)
	{
		document.getElementById("moreInfoTitle").innerHTML = current.name;
		document.getElementById("moreInfoArchitect").innerHTML = "architekt: " + current.architect;
		document.getElementById("moreInfoYear").innerHTML = "rok powstania: " + current.year;
		document.getElementById("moreInfoPlace").innerHTML = "miejsce: " + current.place;
		document.getElementById("moreInfoYardage").innerHTML = "metraż: " + current.yardage + " m<sup>2</sup>";
		document.getElementById("moreInfoPrice").innerHTML = "cena: " + current.price + " zł";
		document.getElementById("moreInfoType").innerHTML = "typ: " + current.type;
		document.getElementById("moreInfoExecutor").innerHTML = "wykonawca: " + current.executor;
		document.getElementById("moreInfoObjectType").innerHTML = "typ obiektu: " + current.objectType;
		document.getElementById("moreInfoStyle").innerHTML = "styl: " + current.style;
	}

	function attachGallery(current)
	{
		var images = "";

		angular.forEach(current.img, function(value, key) {
			images += "<img src=\"" + value + "\">";
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
			if (value.value.toLowerCase().search(keyword.toLowerCase()) != -1)
				existsTag = true;
		});
		return existsTag;
	}
});
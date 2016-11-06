angular.module('myApp', []).controller('AppCtrl', function($scope) {
	$scope.projects = [
	{
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
		img: 'images/img01.png'
	},
	{
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
		img: 'images/img02.png'
	},
	{
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
		img: 'images/img03.png'
	},
	{
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
		img: 'images/img04.png'
	},
	{
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
		img: 'images/img05.png'
	},
	{
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
		img: 'images/img06.png'
	},
	{
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
		img: 'images/img07.png'
	},
	{
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
		img: 'images/img08.png'
	}
	];

	$scope.projectSearch = function(project)
	{
		if ($scope.search && $scope.search.length > 0)
		{
			var searchWithoutSpacesAndCommas = $scope.search.replace(/\s\s+/g, ' ').replace(/,/g,'');
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
			if (value.value.toLowerCase().search(keyword.toLowerCase()) != -1)
				existsTag = true;
		});
		return existsTag;
	}
});
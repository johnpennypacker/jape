( function() {

	function changeRando() {
		document.querySelector(':root').style.setProperty('--random', Math.random());
		document.querySelector(':root').style.setProperty('--random2', Math.random());
	}

	setInterval(changeRando, 1000);


})();
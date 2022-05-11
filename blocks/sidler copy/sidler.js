( function() {

	let vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
	let elTop = vh;
	let els = document.querySelectorAll( ".wipe .line" );

	window.addEventListener( "load", lineNumbers );
	function lineNumbers() {
		els.forEach(function(el) {
			el.style.setProperty( "--line-width", el.getBoundingClientRect().width );
			el.style.setProperty( "--line-height", el.getBoundingClientRect().height );
		});
	}

	window.addEventListener( "scroll", calcTop );
	function calcTop(e) {
		els.forEach(function(el) {
			if( el.parentNode.dataset.isIntersecting == "true" ) {
				el.style.setProperty( "--top-percent", el.getBoundingClientRect().top / vh );
				el.style.setProperty( "--mid-percent", (el.getBoundingClientRect().bottom - (el.getBoundingClientRect().top/2)) / vh );
			} else {
				el.style.setProperty( "--top-percent", 1 );
				el.style.setProperty( "--mid-percent", 1 );
			}
		});
	}

})();
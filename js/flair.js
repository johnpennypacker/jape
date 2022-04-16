( function() {


	/** add hover x and y coordinates to links and buttons **/
	var links = document.querySelectorAll('a, button, .button');
	links.forEach(function(el) {
		el.addEventListener( 'mousemove', buttonFlair );
	});
	
	function buttonFlair(e) {
		const x = e.pageX - e.target.offsetX;
		const y = e.pageY - e.target.offsetY;
		e.target.style.setProperty( '--mouse-x', e.offsetX );
		e.target.style.setProperty( '--mouse-y', e.offsetY );

		e.target.style.setProperty( '--mouse-x-pct', e.offsetX / e.target.offsetWidth );
		e.target.style.setProperty( '--mouse-y-pct', e.offsetY / e.target.offsetHeight );

	}

	/** 
	 * Seeds random numbers to css vars
	 */
	function changeRando() {
		document.querySelector(':root').style.setProperty('--random', Math.random());
		document.querySelector(':root').style.setProperty('--random2', Math.random());
	}
	//setInterval(changeRando, 1000);



	//** add intersection data to images and major sections **/
	if('IntersectionObserver' in window){
		let options = {
			root: null,
			rootMargin: '0px',
			threshold: buildThreshold( 100 )
		}
		let observer = new IntersectionObserver(observerCallback, options);
		let els = document.querySelectorAll(".wp-block-cover, img, header, footer, nav, section");

		els.forEach(function(el) {
			observer.observe(el);
			el.dataset.wasVisible = false;
			el.style.setProperty( '--was-visible', 'false' );
		});
	}

	function observerCallback(entries, observer) {

		entries.forEach(function(entry) {
		
			var top = entry.boundingClientRect.top;
			var height = entry.boundingClientRect.height;
			var pct = 0;
			var vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0)


			// set the distance from the top of the element to the top of the viewport
			entry.target.style.setProperty( '--from-top', top );
			entry.target.style.setProperty( '--height', height );
			entry.target.dataset.isIntersecting = entry.isIntersecting;
			entry.target.style.setProperty( '--intersecting', entry.isIntersecting );
			
			if( entry.target.dataset.wasVisible == true || entry.isIntersecting ) {
				entry.target.dataset.wasVisible = true;
				entry.target.style.setProperty( '--was-visible', true );
			}
			
			entry.target.style.setProperty( '--intersection-ratio', entry.intersectionRatio );
		});
	}


	function buildThreshold(num) {
		let thresholds = [];

		for (let i=1.0; i<=num; i++) {
			let ratio = i/num;
			thresholds.push(ratio);
		}

		thresholds.push(0);
		return thresholds;
	}

})();
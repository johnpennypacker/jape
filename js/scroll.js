( function() {

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

	function observerCallback(entries, observer) {

		entries.forEach(function(entry) {
		
			var top = entry.boundingClientRect.top;
			var height = entry.boundingClientRect.height;
			var pct = 0;
			var vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0)


			// set the distance from the top of the element to the top of the viewport
			// on new page loads... can be wonky on refreshes with scroll depths)
			entry.target.dataset.top = top;
			entry.target.style.setProperty( '--from-top', top );
			entry.target.dataset.height = height;
			entry.target.style.setProperty( '--height', height );
			entry.target.dataset.isIntersecting = entry.isIntersecting;
			entry.target.style.setProperty( '--intersecting', entry.isIntersecting );
			
			if( entry.target.dataset.wasVisible == true || entry.isIntersecting ) {
				entry.target.dataset.wasVisible = true;
				entry.target.style.setProperty( '--was-visible', true );
			}

			if(entry.isIntersecting) {
				if( top > 0 ) {
					pct = (vh - top) / height;
				} else {
					pct = (height + top) / height;
				}
				if( pct > 1 ) { pct = 1 } // it happens
			}
			entry.target.dataset.percentVisible = pct;
			entry.target.style.setProperty( '--percent-visible', pct );

	 		//console.log(entry.isIntersecting, entry.boundingClientRect, entry.intersectionRect, entry.rootBounds);

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
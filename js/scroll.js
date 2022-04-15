( function() {

	let options = {
		root: null,
		rootMargin: '0px',
		threshold: buildThreshold(100)
	}
	let observer = new IntersectionObserver(observerCallback, options);
	let els = document.querySelectorAll("[class ^='wp-block']");

	els.forEach(function(el) {
		observer.observe(el);
	});

	function observerCallback(entries, observer) {

		entries.forEach(function(entry) {
			entry.target.dataset.isIntersecting = entry.isIntersecting;
			total = entry.boundingClientRect.height * 2;
			pct = (entry.boundingClientRect.height + entry.boundingClientRect.y) / total;
			entry.target.dataset.percent = pct;

//			console.log(entry.isIntersecting, entry.boundingClientRect, entry.intersectionRect, entry.rootBounds);
//	 		console.log( scrub );
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
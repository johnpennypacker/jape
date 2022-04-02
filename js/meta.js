( function() {
	var __ = wp.i18n.__;
	var useState = wp.element.useState;
	
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var registerPlugin = wp.plugins.registerPlugin;
	var PluginDocumentSettingPanel = wp.editPost.PluginDocumentSettingPanel;
	var ToggleControl = wp.components.ToggleControl;
	var PanelRow = wp.components.PanelRow;

	/**
	 * register a metabox
	 */
	registerPlugin( 'jape-settings-panel', {
		//icon: 'lock',
		icon: '',
		render: settingsPanel,
		//scope: 'my-page',
	});
	
	
	function titleVisibility() {
		var el = document.querySelector('.edit-post-visual-editor__post-title-wrapper');
		var v = wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_title;
		el.style.transition = 'opacity .2s ease-in-out';
		if( true == v ) {
			el.style.opacity = '1';
		} else {
			el.style.opacity = '.2';
		}
	}
	
	function updateFeaturedImagePreview(img, obj) {
		img.src = obj.source_url;
	}
	
	function createFeaturedImagePreview() {
		var el = document.querySelector('.edit-post-visual-editor__post-title-wrapper');
		var img, id = 'jape-featured-image-preview';
		img = document.getElementById(id);
		if( ! img ) {
			img = document.createElement('img');
			img.id = id;
			img.style.display = 'block';
			img.style.marginBottom = '2rem';		
			el.parentNode.insertBefore(img, el.nextSibling);
		}
		return img;
	}


	/**
	 * the render function
	 */
	function settingsPanel() {
			
		const [ showTitle, setShowTitle ] = useState( wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_title );
		const [ showImage, setShowImage ] = useState( wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_featured_image );
		const postType = wp.data.select('core/editor').getCurrentPostType();
		
		window._wpLoadBlockEditor.then( function() {

			var img = createFeaturedImagePreview();

			titleVisibility();

			var imageId = wp.media.featuredImage.get();
			var imageObject = wp.data.select('core').getMedia(imageId);
			var previousFeaturedImage = imageObject;
			wp.data.subscribe( function() {
				imageObject = wp.data.select('core').getMedia(imageId);
				if( typeof imageObject !== 'undefined' && imageObject !== previousFeaturedImage ) {
					updateFeaturedImagePreview(img, imageObject);
				}
				previousFeaturedImage = imageObject;
			});
			if( showImage ) {
				img.style.opacity = '1';
			} else {
				img.style.opacity = '.2';
			}

		});
		
		return el(
			Fragment,
			{},
			el(
				PluginDocumentSettingPanel,
				{
					name: 'jape-settings',
					title: 'Visibility for title and image',
				},
				el(
					'div',
					{},
					'Toggle visibility on the ' + postType + '. Doesn‘t affect lists or previews.'
				),
				el(
					PanelRow,
					{},
					el(
						ToggleControl,
						{
							label: __( 'Show Title', 'jape' ),
							name: 'jape-show-title',
							checked: showTitle,
							help: (showTitle) ? 'Title will display.' : 'Title will not appear as a heading.',
 							onChange: function (val) {
 								titleVisibility(); 								
 								// set the meta value
 								wp.data.dispatch('core/editor').editPost({meta: {_jape_show_title: val }});
 								// set the state
 								setShowTitle( ( state ) => ! state ); 								
 							},
						},
						''
					)
				),
				el(
					PanelRow,
					{},
					el(
						ToggleControl,
						{
							label: __( 'Show Featured Image', 'jape' ),
							name: 'jape-show-featured-image',
							checked: showImage,
							help: (showImage) ? 'Featured image will display.' : 'Featured image will be hidden.',
 							onChange: function (val) {
 								// set the meta value
 								wp.data.dispatch('core/editor').editPost({meta: {_jape_show_featured_image: val }});
 								// set the state
 								setShowImage( ( state ) => ! state );
 							},
						},
						''
					)
				)
			),
			
		);
	}
	

})();
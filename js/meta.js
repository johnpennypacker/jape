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

	function featuredImageVisibility() {

		var v = wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_featured_image;		
		var blocks = wp.data.select( 'core/block-editor' ).getBlocks();
				
		if( true == v ) {
			if('core/post-featured-image' !== blocks[0].name) {
				newBlock = wp.blocks.createBlock('core/post-featured-image', { });
				wp.data.dispatch('core/block-editor').insertBlocks(newBlock, 0);
			} 
		} else {
			if('core/post-featured-image' === blocks[0].name) {
				console.log('remove: ', blocks[0].clientId);
				wp.data.dispatch('core/block-editor').removeBlock(blocks[0].clientId);
			} 
		}
	}

	

	/**
	 * the render function
	 */
	function settingsPanel() {
			
		const [ showTitle, setShowTitle ] = useState( wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_title );
		const [ showImage, setShowImage ] = useState( wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_featured_image );
		const postType = wp.data.select('core/editor').getCurrentPostType();
		
		window._wpLoadBlockEditor.then( function() {
			titleVisibility();
			featuredImageVisibility();
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
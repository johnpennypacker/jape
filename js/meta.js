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


	/**
	 * the render function
	 */
	function settingsPanel() {
		
		const [ showTitle, setShowTitle ] = useState( wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_title );
		const [ showImage, setShowImage ] = useState( wp.data.select('core/editor').getEditedPostAttribute('meta')._jape_show_featured_image );
		
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
					'Toggle the visibility on the page/post. Doesn‘t affect lists or previews.'
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
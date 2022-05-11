(function ( blocks, components, element, i18n ) {

	var el = element.createElement;

	/**
	 * Render the sidler's HTML
	 */
	function renderWipe( props ) {
		return el( 'div', { className: 'sidler alignfull flair-io' }, 
			el( 'div', { className: 'line' }, 
				props.attributes.content
			)
		);
	}
	

	blocks.registerBlockType( 'jape/sidler', {
		title: i18n.__('Sidler'),
		icon: 'carrot',
		category: 'widgets',
		description: 'Creates a marquee 2.0',
		attributes: {
			content: {
				type: 'string',
				source: 'html',
				selector: '.line',
			}
		},

		edit: function( props ) {
					
			var blockProps = wp.blockEditor.useBlockProps();
			var content = props.attributes.content;

			return wp.element.createElement( wp.blockEditor.RichText, Object.assign( blockProps, {
				tagName: 'div',
				className: 'sidler',
				value: props.attributes.content,
				allowedFormats: [ 'core/bold', 'core/italic' ],
				onChange: function( content ) {
					props.setAttributes( { content: content } ); // Store updated content as a block attribute
				},
				placeholder: i18n.__( 'sidle...' ), // Display this text before any content has been added by the user
			} ) );


		},
		
		/**
		 * this is what gets saved to the database and displayed on pages
		 */
		save: function( props ) {
			var blockProps = wp.blockEditor.useBlockProps.save();
			return renderWipe( props );
		}


	} );

})(
	window.wp.blocks,
	window.wp.components,
	window.wp.element,
	window.wp.i18n
);


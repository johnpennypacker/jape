(function ( blocks, blockEditor, element, components, i18n ) {

	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'jape/sidler', {

		edit: function( props ) {
					
			var blockProps = wp.blockEditor.useBlockProps();
			var content = props.attributes.content;
			
			return el('div', { className: 'sidler flair-io' }, 
				el( blockEditor.RichText, Object.assign( blockProps, {
					tagName: 'div',
					className: 'line',
					value: props.attributes.content,
					allowedFormats: [ 'core/bold', 'core/italic' ],
					onChange: function( content ) {
						props.setAttributes( { content: content } ); // Store updated content as a block attribute
					},
					placeholder: __( 'sidle...' ), // Display this text before any content has been added by the user
				}))
			);



		},
		
		/**
		 * this is what gets saved to the database and displayed on pages
		 */
		save: function( props ) {
			var blockProps = blockEditor.useBlockProps.save();

			//  @todo: work out css to allow for different alignments			
			var classes = 'sidler flair-io';
// 			if( props.attributes.align ) {
// 				classes += ' align' + props.attributes.align;
// 			}
			classes += ' alignfull';
		
			return el( 'div', { className: classes }, 
				el( blockEditor.RichText.Content, blockEditor.useBlockProps.save( {
					tagName: 'div',
					className: 'line',
					value: props.attributes.content,
				} ) )
			);
		}


	} );

})(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.element,
	window.wp.components,
	window.wp.i18n
);


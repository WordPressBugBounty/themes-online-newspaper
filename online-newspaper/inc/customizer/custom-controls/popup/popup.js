( function( api, $ ) {
	api.controlConstructor['popup'] = api.Control.extend({
		ready: function() {
			let control = this,
                { container, id } = control,
                allSectionControls = api.section( control.section() ).controls(),
                popupWrapper = container.find( '.popup-wrapper' )

            this.handleClick({ container, popupWrapper, allSectionControls, id })
        },
        handleClick: function( props ) {
            let self = this,
                { container, popupWrapper, allSectionControls, id } = props
            container.on( "click", ".customize-control-icon", function(e) {
                popupWrapper.toggleClass( 'open' )
                if( ! popupWrapper.hasClass( 'loaded' ) ) {
                    self.controlsLoop( allSectionControls, popupWrapper, id )
                    popupWrapper.addClass( 'loaded' )
                }
            })
        },
        controlsLoop: function( allControls, popupWrapper, _thisId ) {
            _.each( allControls, function ( control ) {  
                let { params } = control,
                    { popup } = params
                if( _thisId === popup ) {
                    popupWrapper.append( control.container )
                    control.container.show()
                }
            });
        }
    });
} )( wp.customize, jQuery );
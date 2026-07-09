(function( api, $ ) {
    const { ajaxUrl, _wpnonce, custom_callback: customCallback, custom } = customizerExtrasObject

    // contextual
    $.each( customCallback, function( controlId, controlValue ) {
        wp.customize( controlId, function( value ) {
            value.bind( function( to ) {
                $.each( controlValue, function( index, toToggle ){
                    if( JSON.stringify( to ) == index ) {
                        $.each( toToggle, function( key, val ){
                            wp.customize.control( val ).activate()
                        })
                    } else {
                        $.each( toToggle, function( key, val ){
                            wp.customize.control( val ).deactivate()
                        })
                    }
                })
                if( to in controlValue ) {
                    $.each( controlValue[to], function( key, val ){
                        wp.customize.control( val ).activate()
                    })
                }
            });
        });    
    })

    // ajax call
    $(document).on( "click", ".customize-info-box-action-control .info-box-button", function() {
        var _this = $(this), action = _this.data("action"), html = _this.html();
        $.ajax({
            method: 'post',
            url: ajaxUrl,
            data: ({
                'action': action,
                '_wpnonce': _wpnonce,
            }),
            beforeSend: function(response) {
                _this.html( 'Processing' )
                _this.attr( 'disabled', true )
            },
            success: function(response) {
                _this.html( html );
            },
            complete: function() {
                window.location.reload();
            }
        })
    })

    // Change the previewed URL to the selected page when changing the page_for_posts.
    $.each( custom, function( key, val ) {
        if( [ 'archive_panel', 'single_section_panel' ].includes( key ) ) {
            api.panel( key, function ( panel ) {
                panel.expanded.bind(function ( isExpanded ) {
                    if ( isExpanded ) api.previewer.previewUrl.set( val );
                });
            });
        } else {
            api.section( key, function ( section ) {
                section.expanded.bind(function ( isExpanded ) {
                    const { id } = section
                    if( id === 'archive_panel' && api.previewer.previewUrl() === val ) return
                    if ( isExpanded ) api.previewer.previewUrl.set( val )
                });
            });
        }
    })

    const builderHandler = {
        init: function(){
            this.headerBuilder();
            this.footerBuilder();
            this.addActiveClasses();
        },
        widgetSections: {},
        headerBuilderId: '',
        footerBuilderId: '',
        headerBuilder: function() {
            this.headerBuilderId = 'header_builder'
            this.widgetSections['header'] = this.builderBehaviour( this.headerBuilderId )
        },
        footerBuilder: function() {
            this.footerBuilderId = 'footer_builder'
            this.widgetSections['footer'] = this.builderBehaviour( this.footerBuilderId )
        },
        builderBehaviour: function( controlId ){
            let controlInstance = api.control( controlId )
            const { widgets, builder_settings_section } = controlInstance.params
            let widgetSections = this.getWidgetSections( widgets )
            return [ ...widgetSections, builder_settings_section ]
        },
        getWidgetSections: function( widgets ){
            return Object.values( widgets ).reduce(( newValue, widgetValue ) => {
                const { section } = widgetValue
                newValue = [ ...newValue, section ]
                return newValue
            }, [])
        },
        addActiveClasses: function(){
            const widgetSections = this.widgetSections,
                { header, footer } = widgetSections,
                headerBuilderId = this.headerBuilderId,
                footerBuilderId = this.footerBuilderId

            api.section.each(( sectionInstance, sectionID ) => {
                sectionInstance.expanded.bind(function( isExpanded ){
                    if( isExpanded ) {
                        if( sectionInstance.contentContainer.hasClass( 'online-newspaper-builder-related' ) ) {
                            let builderId = ''
                            if( header.includes( sectionID ) ) {
                                builderId = headerBuilderId
                            }
                            if( footer.includes( sectionID ) ) {
                                builderId = footerBuilderId
                            }
                            if( builderId !== '' ) {
                                let controlInstance = api.control( builderId )
                                const { builder_settings_section } = controlInstance.params
                                const { container } = controlInstance
                                const builderSettingsSection = api.section( builder_settings_section ).contentContainer
                                container.parent().addClass( 'is-active' ).siblings().removeClass( 'is-active' )
                                builderSettingsSection.addClass( 'active-builder-setting' ).siblings().removeClass( 'active-builder-setting' )
                                builderSettingsSection.parents( '#customize-controls' ).siblings('#customize-preview').addClass( 'online-newspaper-builder--on' )
                            }
                        } else {
                            if( $('.online-newspaper-builder.is-active') ) $('.online-newspaper-builder.is-active').removeClass( 'is-active' )
                            if( $('.online-newspaper-builder-related.active-builder-setting') ) $('.online-newspaper-builder-related.active-builder-setting').removeClass( 'active-builder-setting' )
                            $('#customize-preview').removeClass( 'online-newspaper-builder--on' )
                        }
                    }
                })
            })
        }
    }
    $( document ).ready(function(){
        builderHandler.init()
    })
})( wp.customize, jQuery )
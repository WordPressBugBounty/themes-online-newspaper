/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

 ( function( $ ) {
	const themeContstants = {
		prefix: 'online_newspaper_'
	}
	const themeCalls = {
		onlineNewspaperGenerateStyleTag: function( code, id ) {
			if( code ) {
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id ).html( code )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + code + '</style>' )
				}
			}
		},
		onlineNewspaperGenerateTypoCss: function( obj = {} ) {
			const { selector = 'body.online-newspaper-variables', value, property } = obj,
				{ preset = '-1', font_family, font_weight, text_transform, text_decoration, font_size, line_height, letter_spacing } = value,
				isVariable = ( selector === 'body.online-newspaper-variables' ),
				selPro = isVariable ? property : selector;

			typographyFunctions.typoFontsEnqueue( value )
			var cssCode = ''
			if( isVariable ) {
				cssCode += 'body.online-newspaper-variables {\n'
			} else {
				cssCode = selPro + '{\n'
			}
			if( font_family ) cssCode += `${( isVariable ? `${ selPro }-family` : 'font-family' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, font_family.value, '-family' ) };\n`

			if( font_weight ) cssCode += `${( isVariable ? `${ selPro }-weight` : 'font-weight' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, font_weight.value, '-weight' ) };\n${( isVariable ? `${ selPro }-style` : 'font-style' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, font_weight.variant, '-style' ) };\n`
			
			if( text_transform ) cssCode += `${( isVariable ? `${ selPro }-texttransform` : 'text-transform' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, text_transform, '-texttransform' )};\n`

			if( text_decoration ) cssCode += `${( isVariable ? `${ selPro }-textdecoration` : 'text-decoration' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, text_decoration, '-textdecoration' )};\n`

			if( font_size.desktop ) cssCode += `${( isVariable ? `${ selPro }-size` : 'font-size' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, font_size.desktop, '-size' ) };\n`

			if( line_height.desktop ) cssCode += `${( isVariable ? `${ selPro }-lineheight` : 'line-height' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, line_height.desktop, '-lineheight' ) };\n`

			if( letter_spacing.desktop ) cssCode += `${( isVariable ? `${ selPro }-letterspacing` : 'letter-spacing' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, letter_spacing.desktop, '-letterspacing' ) };\n`
			if( ! isVariable ) cssCode += '}'

			if( ! isVariable ) cssCode += `@media(max-width: 940px) {\n${ isVariable ? 'body.online-newspaper-variables ' : `${ selPro } ` } {\n`
			if( line_height.tablet ) cssCode += `${( isVariable ? `${ selPro }-lineheight-tab` : 'line-height' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, line_height.tablet, '-lineheight-tab' ) };\n`
			if( letter_spacing.tablet ) cssCode += `${( isVariable ? `${ selPro }-letterspacing-tab` : 'letter-spacing' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, letter_spacing.tablet, '-letterspacing-tab' ) };\n`
			if( font_size.tablet ) cssCode += `${( isVariable ? `${ selPro }-size-tab` : 'font-size' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, font_size.tablet, '-size-tab' ) };\n`
			if( ! isVariable ) cssCode += '}}'
			
			if( ! isVariable ) cssCode += `@media(max-width: 610px) {\n${ isVariable ? 'body.online-newspaper-variables ' : `${ selPro } ` } {\n`
			if( line_height.smartphone ) cssCode += `${( isVariable ? `${ selPro }-lineheight-mobile` : 'line-height' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, line_height.smartphone, '-lineheight-mobile' ) };\n`
			if( letter_spacing.smartphone ) cssCode += `${( isVariable ? `${ selPro }-letterspacing-mobile` : 'letter-spacing' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, letter_spacing.smartphone, '-letterspacing-mobile' ) };\n`
			if( font_size.smartphone ) cssCode += `${( isVariable ? `${ selPro }-size-mobile` : 'font-size' )}: ${ this.onlineNewspaperGetTypographyFormat( preset, font_size.smartphone, '-size-mobile' ) };\n`
			if( ! isVariable ) cssCode += '}}'

			if( isVariable ) cssCode += '}'

			return cssCode
		},
		onlineNewspaperGetTypographyFormat: function( preset, value, suffix ) {
			if( preset === '-1' ) {
				let unitsArray = [ '-size', '-lineheight', '-letterspacing', '-lineheight-tab', '-letterspacing-tab', '-size-tab', '-lineheight-mobile', '-letterspacing-mobile', '-size-mobile' ]
				return ( unitsArray.includes( suffix ) ) ? value + 'px' : value;
			} else {
				let variable = 'var(--online-newspaper-global-preset-typography-' + ( parseInt( preset ) + 1 ) + '-font' + suffix + ')';
				return variable
			}
		}
	}

	/**
	 * Controls
	 * 
	 * @since 1.0.0
	 */
	const NEVControls = {
		generateId( controlId ) {
			return controlId.replaceAll( '_', '-' );
		},
		color( obj = {} ){
			const THIS = this;
			let { controlId, selector = 'body.online-newspaper-variables', property = 'background' } = obj,
				styleId = this.generateId( controlId ),
				isVariable = ( selector === 'body.online-newspaper-variables' );

			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					let cssCode = '',
						isObject = ( typeof to === 'object' ),
						isHover = ( isObject && ( 'hover' in to ) );
					if( isHover ) {
						let { initial, hover } = to;
						cssCode += `${ selector } { ${ property }: ${ THIS.getColorCSS( initial ) }; }\n`
						cssCode += `${ selector }${ isVariable ? '' : ':hover' } { ${ property }${ isVariable ? '-hover' : '' }: ${ THIS.getColorCSS( hover ) }; }\n`
					} else {
						if( isObject && ( 'image' in to ) ) {
							cssCode += `${ selector } { ${ isObject ? THIS.getColorCSS( to ) : to }; }`
						} else {
							cssCode += `${ selector } { ${ property }: ${ isObject ? THIS.getColorCSS( to ) : to }; }`
						}
					}

					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-' + styleId )
				});
			});
		},
		getColorCSS( color ){
			let cssCode = '';
			switch( color.type ) {
				case 'image' : 
						let { repeat = 'no-repeat', position = 'left top', attachment = 'fixed', size = 'auto'  } = color
						if( 'id' in color.image ) cssCode += 'background-image: url(' + color.image.url + ');\n'
						cssCode += " background-repeat: "+ repeat + ';\n'
						cssCode += " background-position: "+ position + ';\n'
						cssCode += " background-attachment: "+ attachment + ';\n'
						cssCode += " background-size: "+ size + ';\n'
					break;
				default: 
						cssCode = helperFunctions.getFormatedColor( color[color.type] )
					break;
			}
			return cssCode;
		},
		typography( obj = {} ){
			let { controlId, selector = 'body.online-newspaper-variables', property } = obj,
				styleId = this.generateId( controlId );

			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					let cssCode = themeCalls.onlineNewspaperGenerateTypoCss({ value: to, selector, property })
					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-' + styleId )
				})
			})
		},
		number( obj = {} ) {
			let { controlId, selector = 'body.online-newspaper-variables', property } = obj,
				styleId = this.generateId( controlId );

			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					let cssCode = `${ selector }{ ${ property }: ${ to }px }`;
					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-' + styleId )
				});
			});
		},
		responsiveSlider( obj = {} ) {
			let { controlId, selector = 'body.online-newspaper-variables', property = 'border-radius', unit = 'px' } = obj,
				styleId = this.generateId( controlId ),
				isVariable = ( selector === 'body.online-newspaper-variables' ),
				cssProp = function( val ){
					if( Array.isArray( property ) ) {
						return property.map(( prop ) => {
							return `${ prop }: ${ val }${ unit };`
						}).join( '' )
					} else {
						return `${ property }: ${ val }${ unit };`
					}
				}

			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					let { desktop, tablet, smartphone } = to,
						cssCode = '';

					if( isVariable ) {
						cssCode += `${ selector } {\n`
						cssCode += `${ property } : ${ desktop }${ unit };\n`;
						cssCode += `${ property }-tab: ${ tablet }${ unit };\n`
						cssCode += `${ property }-mobile: ${ smartphone }${ unit };\n`
						cssCode += '}'
					} else {
						cssCode += `${ selector } {${ cssProp( desktop ) }}`
						cssCode += `@media(max-width: 940px) { ${ selector } {${ cssProp( tablet ) }} }`
						cssCode += `@media(max-width: 610px) { ${ selector } {${ cssProp( smartphone ) }} }`
					}
					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-' + styleId )
				});
			});
		},
		globalContentLayout( obj = {} ) {
			let { controlId, selector, prefix = 'width-' } = obj
			wp.customize( controlId, function( value ) {
				value.bind( function(to) {
					let container = $( selector )
					container.removeClass( `${ prefix }boxed--layout ${ prefix }full-width--layout` )
					if( to === 'global' ) {
						if( $( 'body' ).hasClass( 'global-content-layout--boxed--layout' ) ) {
							container.addClass( `${ prefix }boxed--layout` )
						} else {
							container.addClass( `${ prefix }full-width--layout` )
						}
					} else {
						container.addClass( prefix + to )
					}
				});
			});
		},
		toggleClassWithPrefix( obj = {} ) {
			let { controlId, selector = 'body', prefix = '' } = obj
			wp.customize( controlId, function( value ) {
				value.bind( function(to) {
					$( selector ).removeClass(function( index, currentClass ){
						return currentClass.split( /\s+/ ).filter( className => className.startsWith( prefix )).join( ' ' );
					}).addClass( prefix + to )
				});
			});
		},
		toggleClass( obj = {} ) {
			let { controlId, selector = 'body', classToToggle = '' } = obj
			wp.customize( controlId, function( value ) {
				value.bind( function() {
					$( selector ).toggleClass( classToToggle )
				});
			});
		},
		border( obj = {} ) {
			let { controlId, selector = 'body', property = 'border' } = obj,
				styleId = this.generateId( controlId );

			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					let { type, color, width } = to
						cssCode = `${ selector } {\n`;

					if( type === 'none' ) {
						cssCode += `${ property }: none;`
					} else {
						if( typeof width === 'object' ) {
							let { top, right, bottom, left } = width
							cssCode += `border-width: ${ top }px ${ right }px ${ bottom }px ${ left }px;\n`;
							cssCode += `border-style: ${ type };\n`;
							cssCode += `border-color: ${ online_newspaper_get_color_format( color ) };\n`;
						} else {
							cssCode += `${ property }: ${ width }px ${ type } ${ online_newspaper_get_color_format( color ) };`
						}
					}
					cssCode += '}'
					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-' + styleId )
				});
			});
		},
		dimension( obj = {} ) {
			let { controlId, selector = 'body', property = 'padding' } = obj,
				styleId = this.generateId( controlId );

			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					let { desktop, tablet, smartphone } = to
						cssCode = '';
					cssCode += `${ selector } { ${ property }: ${ desktop.top }px ${ desktop.right }px ${ desktop.bottom }px ${ desktop.left }px; }`
					cssCode += `@media(max-width: 940px) { ${ selector } { ${ property }: ${ tablet.top }px ${ tablet.right }px ${ tablet.bottom }px ${ tablet.left }px; } }`
					cssCode += `@media(max-width: 610px) { ${ selector } { ${ property }: ${ smartphone.top }px ${ smartphone.right }px ${ smartphone.bottom }px ${ smartphone.left }px; } }`
					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-' + styleId )
				});
			});
		},
		boxShadow( obj = {} ) {
			let { controlId, selector = 'body' } = obj,
				styleId = this.generateId( controlId );

			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					var cssCode = ''
					if( to && to.option ) {
						let boxShadowValue = `${ ( to.type === 'outset' ) ? '' : to.type } ${ to.hoffset }px ${ to.voffset }px ${ to.blur }px ${ to.spread }px ${ online_newspaper_get_color_format( to.color ) }`
						cssCode += `${ selector } { box-shadow: ${ boxShadowValue }; -webkit-box-shadow: ${ boxShadowValue }; -moz-box-shadow ${ boxShadowValue } }`
					} else {
						cssCode += `${ selector } { box-shadow: 0px 0px 0px 0px; }`
					}
					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-' + styleId )
				});
			});
		},
		builderResponsive( obj = {} ) {
			let { controlId, selector = 'body', responsiveSelector = '', prefix = '' } = obj
			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					if( responsiveSelector === '' ) responsiveSelector = selector
					const { desktop, tablet, smartphone } = to,
						desktopPrefix = prefix,
						tabletPrefix = `tablet-${ prefix }`,
						smartphonePrefix = `smartphone-${ prefix }`,
						desktopReg = new RegExp( `${ desktopPrefix }\\S+`, 'g' ),
						tabletReg = new RegExp( `${ tabletPrefix }\\S+`, 'g' ),
						smartphoneReg = new RegExp( `${ smartphonePrefix }\\S+`, 'g' );

					$( selector ).removeClass(function( index, _thisClass ) {
						return ( _thisClass.match( desktopReg ) || [] ).join(' ');
					}).addClass( `${ desktopPrefix }${ desktop }` )
					
					$( responsiveSelector ).removeClass(function( index, _thisClass ) {
						return ( _thisClass.match( tabletReg ) || [] ).join(' ');
					}).addClass( `${ tabletPrefix }${ tablet }` )

					$( responsiveSelector ).removeClass(function( index, _thisClass ) {
						return ( _thisClass.match( smartphoneReg ) || [] ).join(' ');
					}).addClass( `${ smartphonePrefix }${ smartphone }` )
				});
			});
		},
		text( obj = {} ) {
			let { controlId, selector = 'body' } = obj
			wp.customize( controlId, function( value ) {
				value.bind( function( to ) {
					$( selector ).text( to )
				});
			});
		},
	}

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	});

	// blog description
	wp.customize( 'blogdescription_option', function( value ) {
		value.bind(function(to) {
			if( to ) {
				$( '.site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		})
	});

	// site title color
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			}
		} );
	});

	// solid color presets
	wp.customize( 'solid_color_preset', function( value ) {
		value.bind( function( to ) {
			const { active_palette: activePaletteIndex, color_palettes: colorPalettes } = to
			const ACTIVEPALETTE = colorPalettes[ activePaletteIndex ]
			helperFunctions.bulkGenerateStyle( ACTIVEPALETTE, 'online-newspaper-solid-presets', '--online-newspaper-global-preset-color-' )
		});
	});

	// gradient color presets
	wp.customize( 'gradient_color_preset', function( value ) {
		value.bind( function( to ) {
			const { active_palette: activePaletteIndex, color_palettes: colorPalettes } = to
			const ACTIVEPALETTE = colorPalettes[ activePaletteIndex ]
			helperFunctions.bulkGenerateStyle( ACTIVEPALETTE, 'online-newspaper-gradient-presets', '--online-newspaper-global-preset-gradient-' )
		});
	});

	// Category Colors
	wp.customize( `category_colors`, function( value ) {
		let previousValue = value.get()
		value.bind( function(to) {
			Object.entries( to ).map(([ catId, colors ]) => {
				let cssCode = '',
					{ color, background } = colors,
					{ initial: cInitial, hover: cHover } = color,
					{ initial: bInitial, hover: bHover } = background,
					{ color: pcolor, background: pbackground } = previousValue[ catId ],
					{ initial: pcInitial, hover: pcHover } = pcolor,
					{ initial: pbInitial, hover: pbHover } = pbackground

				if( JSON.stringify( colors ) !== JSON.stringify( previousValue[ catId ] ) ) {
					if( cInitial && JSON.stringify( pcInitial ) !== JSON.stringify( cInitial ) ) {
						cssCode += `body .post-categories .cat-item.cat-${ catId } a, .widget_online_newspaper_category_collection_widget .layout-one .category-item.cat-${ catId } .category-name, .online-newspaper-web-stories .stories-wrap .story[data-id="${ catId }"] .preview .story-count { color : ${ online_newspaper_get_color_format( cInitial[ cInitial.type ] ) } } `
					}
					if( cHover && JSON.stringify( pcHover ) !== JSON.stringify( cHover ) ) {
						cssCode += `body .post-categories .cat-item.cat-${ catId } a:hover, .widget_online_newspaper_category_collection_widget .layout-one .category-item.cat-${ catId } .category-name:hover, .online-newspaper-web-stories .stories-wrap .story[data-id="${ catId }"] .preview .story-count:hover { color : ${ online_newspaper_get_color_format( cHover[ cHover.type ] ) } } `
					}
					if( bInitial && JSON.stringify( pbInitial ) !== JSON.stringify( bInitial ) ) {
						cssCode += `body .post-categories .cat-item.cat-${ catId } a, .widget_online_newspaper_category_collection_widget .layout-one .category-item.cat-${ catId } .category-name, .online-newspaper-web-stories .inner-stories-wrap.open.cat-${ catId }, .online-newspaper-web-stories .stories-wrap .story[data-id="${ catId }"] .preview .story-count { background : ${ online_newspaper_get_color_format( bInitial[ bInitial.type ] ) } }`
					}
					if( bHover && JSON.stringify( pbHover ) !== JSON.stringify( bHover ) ) {
						cssCode += `body .post-categories .cat-item.cat-${ catId } a:hover, .widget_online_newspaper_category_collection_widget .layout-one .category-item.cat-${ catId } .category-name:hover, .online-newspaper-web-stories .stories-wrap .story[data-id="${ catId }"] .preview .story-count:hover { background : ${ online_newspaper_get_color_format( bHover[ bHover.type ] ) } }`
					}
					themeCalls.onlineNewspaperGenerateStyleTag( cssCode, `online-newspaper-category-${ catId }-style` )
				}
			})
		})
	})

	// theme header general settings search icon color
	wp.customize('search_icon_color', function(value){
		value.bind(function( to ){
			let cssCode = "body.online-newspaper-variables.online-newspaper-light-mode {\n",
				{ initial, hover } = to;
			cssCode += `--search-color: ${ helperFunctions.getFormatedColor( initial[ initial.type ] ) };\n`
			cssCode += `--search-color-hover: ${ helperFunctions.getFormatedColor( hover[ hover.type ] ) };\n`
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-header-search-icon-color' )
		})
	})

	// newsletter label colors
	wp.customize('header_newsletter_label_color', function(value){
		value.bind(function( to ){
			let cssCode = "body.online-newspaper-variables.online-newspaper-light-mode {\n",
				{ initial, hover } = to;
			cssCode += `--newsletter-color: ${ helperFunctions.getFormatedColor( initial[ initial.type ] ) };\n`
			cssCode += `--newsletter-color-hover: ${ helperFunctions.getFormatedColor( hover[ hover.type ] ) };\n`
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-header-newsletter-label-color' )
		})
	})

	// random news label colors
	wp.customize('random_news_label_color', function(value){
		value.bind(function( to ){
			let cssCode = "body.online-newspaper-variables.online-newspaper-light-mode {\n",
				{ initial, hover } = to;
			cssCode += `--random-news-color: ${ helperFunctions.getFormatedColor( initial[ initial.type ] ) };\n`
			cssCode += `--random-news-color-hover: ${ helperFunctions.getFormatedColor( hover[ hover.type ] ) };\n`
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-header-random-news-label-color' )
		})
	})
	
	// menu options text color
	wp.customize('header_menu_color', function(value){
		value.bind(function( to ){
			let cssCode = "body.online-newspaper-variables.online-newspaper-light-mode {\n",
				{ initial, hover } = to;
			cssCode += `--menu-color: ${ helperFunctions.getFormatedColor( initial[ initial.type ] ) };\n`
			cssCode += `--menu-color-hover: ${ helperFunctions.getFormatedColor( hover[ hover.type ] ) };\n`
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-header-menu-color' )
		})
	})

	// menu options mobile menu text color
	wp.customize('mobile_canvas_text_color', function(value){
		value.bind(function(to){
			var cssCode = '@media(max-width: 768px) { body.online-newspaper-light-mode .main-navigation.toggled #header-menu li > a, body.online-newspaper-light-mode nav.main-navigation.toggled ul.menu > li > a, body.online-newspaper-light-mode nav.main-navigation.toggled ul.nav-menu > li > a{ color: '+ online_newspaper_get_color_format( to[ to.type ] ) +'} }'
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'header-mobile-menu-text-color' )
		})
	})

	// menu options mobile menu background color
	wp.customize('mobile_canvas_background', function(value){
		value.bind(function( to ){
			var cssCode = '@media(max-width: 610px) {  nav.main-navigation ul.menu,  nav.main-navigation ul.nav-menu { background: '+ online_newspaper_get_color_format( to[ to.type ] ) +'} }'
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'header-mobile-menu-background-color' )
		})
	})

	// off canvas toggle bar color
	wp.customize('canvas_menu_icon_color', function(value){
		value.bind(function( to ){
			let cssCode = "body.online-newspaper-variables.online-newspaper-light-mode {\n",
				{ initial, hover } = to;
			cssCode += `--sidebar-toggle-color: ${ helperFunctions.getFormatedColor( initial[ initial.type ] ) };\n`
			cssCode += `--sidebar-toggle-color-hover: ${ helperFunctions.getFormatedColor( hover[ hover.type ] ) };\n`
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-header-off-canvas-toggle-color' )
		})
	})

	// single post show original image
	wp.customize('single_post_show_original_image_option', function( value ) {
		value.bind(function( to ) {
			if( to ) {
				$('body.single main#primary .post-inner-wrapper .post-thumbnail').addClass('show-original-image')
			} else {
				$('body.single main#primary .post-inner-wrapper .post-thumbnail').removeClass('show-original-image')
			}
		})
	})

	// single post related news title
	wp.customize('single_post_related_posts_title', function( value ) {
		value.bind(function( to ) {
			var parentElement = $('body #theme-content .post-inner-wrapper .single-related-posts-section')
			if( parentElement.find( '.online-newspaper-block-title' ).length > 0 ) {
				parentElement.find( '.online-newspaper-block-title span' ).text( to )
			} else {
				parentElement.find( '.related_post_close' ).after('<h2 class="online-newspaper-block-title"><span>'+ to +'</span></h2>')
			}
		})
	})

	// single page show original image
	wp.customize('page_show_original_image_option', function( value ) {
		value.bind(function( to ) {
			if( to ) {
				$('body.page main#primary .post-inner-wrapper .post-thumbnail').addClass('show-original-image')
			} else {
				$('body.page main#primary .post-inner-wrapper .post-thumbnail').removeClass('show-original-image')
			}
		})
	})

	// prloader handler
	wp.customize( 'preloader_type', function( value ) {
		value.bind( function( to ) {
			var loaderItem = $( 'body .online_newspaper_loading_box .loader-item' )
			$( "body .online_newspaper_loading_box" ).show()
			setTimeout( function() {
				$( "body .online_newspaper_loading_box" ).hide()
			}, 2000)
			loaderItem.removeClass();
			loaderItem.addClass( "loader-item loader-" + to )
		});
	});

	// Web Story image ratio
	wp.customize('web_stories_image_ratio', function(value) {
		value.bind(function(to) {
			var cssCode = '';
			if (to.desktop && to.desktop > 0) {
			cssCode += "body .online-newspaper-web-stories .stories-wrap .preview:before { padding-bottom: calc(" + to.desktop + " * 100%) } ";
			}
			if (to.tablet && to.tablet > 0) {
			cssCode += "@media(max-width: 940px) { body .online-newspaper-web-stories .stories-wrap .preview:before { padding-bottom: calc(" + to.tablet + " * 100%) } } ";
			}
			if (to.smartphone && to.smartphone > 0) {
			cssCode += "@media(max-width: 610px) { body .online-newspaper-web-stories .stories-wrap .preview:before { padding-bottom: calc(" + to.smartphone + " * 100%) } } ";
			}
			themeCalls.onlineNewspaperGenerateStyleTag(cssCode, 'online-newspaper-web-stories-image-ratio');
		});
	});

	// post title hover class
	wp.customize( 'frontpage_sidebar_sticky_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				if( $('body').hasClass( 'home' ) && $('body').hasClass( 'page-template-default' ) ) $( "body" ).addClass( "sidebar-sticky" )
			} else {
				if( $('body').hasClass( 'home' ) && $('body').hasClass( 'page-template-default' ) )  $( "body" ).removeClass( "sidebar-sticky" )
			}
		});
	});

	// post title hover class
	wp.customize( 'archive_sidebar_sticky_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				if( ( $('body').hasClass( 'home' ) && $('body').hasClass( 'blog' ) ) || $('body').hasClass( 'archive' ) ) $( "body" ).addClass( "sidebar-sticky" )
			} else {
				if( ( $('body').hasClass( 'home' ) && $('body').hasClass( 'blog' ) ) || $('body').hasClass( 'archive' ) ) $( "body" ).removeClass( "sidebar-sticky" )
			}
		});
	});

	// post title hover class
	wp.customize( 'single_sidebar_sticky_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				if( $('body').hasClass( 'single' ) ) $( "body" ).addClass( "sidebar-sticky" )
			} else {
				if( $('body').hasClass( 'single' ) ) $( "body" ).removeClass( "sidebar-sticky" )
			}
		});
	});

	// post title hover class
	wp.customize( 'page_sidebar_sticky_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				if( $('body').hasClass( 'page' ) ) $( "body" ).addClass( "sidebar-sticky" )
			} else {
				if( $('body').hasClass( 'page' ) ) $( "body" ).removeClass( "sidebar-sticky" )
			}
		});
	});
	
	// background animation
	wp.customize( 'site_background_animation', function( value ) {
		value.bind( function( to ) {
			let body = $( 'body' )
			body.removeClass( 'background-animation--three background-animation--none' ).addClass( `background-animation--${ to }` )
			if( ! $( 'body .online-newspaper-background-animation' ).length ) {
				let newDiv = '<div class="online-newspaper-background-animation">'
				for( let i = 0; i < 14; i++ ) {
					newDiv += '<span class="item"></span>'
				}
				newDiv += '</div>'
				$( 'body #page.site' ).append( newDiv )
			}
		})
	})

	// sst responsive option
	wp.customize( 'stt_responsive_option', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			cssCode += `body #online-newspaper-scroll-to-top.show { display: ${( to.desktop ? 'block' : 'none' )} }`;
			cssCode += `@media(max-width: 940px) { body #online-newspaper-scroll-to-top.show { display: ${( to.tablet ? 'block' : 'none' )} } }`
			cssCode += `@media(max-width: 610px) { body #online-newspaper-scroll-to-top.show { display: ${( to.mobile ? 'block' : 'none' )} } }`
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-scroll-to-top-responsive-option' )
		})
	})

	// Global => Website Layout => Website Content Global Layout
	wp.customize( 'website_content_layout', function( value ) {
		value.bind( function(to) {
			$( 'body' ).removeClass( 'global-content-layout--boxed--layout global-content-layout--full-width--layout' ).addClass( 'global-content-layout--' + to )
			// Ticker News
			if( wp.customize( 'ticker_news_width_layout' ).get() === 'global' ) $( '#online-newspaper-ticker-news' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Main Banner
			if( wp.customize( 'main_banner_width_layout' ).get() === 'global' ) $( '#main-banner-section' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Web stories
			if( wp.customize( 'web_stories_full_width_blocks_width_layout' ).get() === 'global' ) $( '#online-newspaper-web-stories' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Front Section => Full Width
			if( wp.customize( 'full_width_blocks_width_layout' ).get() === 'global' ) $( '#full-width-section' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Front Section => Left Content -Right Sidebar => Width Layouts
			if( wp.customize( 'leftc_rights_blocks_width_layout' ).get() === 'global' ) $( '#leftc-rights-section' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Front Section => Left Sidebar -Right Content => Width Layouts
			if( wp.customize( 'lefts_rightc_blocks_width_layout' ).get() === 'global' ) $( '#lefts-rightc-section' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Front Section => Bottom Full Width => Width Layouts
			if( wp.customize( 'bottom_full_width_blocks_width_layout' ).get() === 'global' ) $( '#bottom-full-width-section' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Blog / Archive / Single => Blog / Archive => Width Layouts
			if( wp.customize( 'archive_width_layout' ).get() === 'global' ) $( '.archive #primary.site-main, .home #primary.site-main, body.author .author-info-wrap' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Blog / Archive / Single => Single Post => Width Layouts
			if( wp.customize( 'single_post_width_layout' ).get() === 'global' ) $( '.single #primary.site-main' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Pages => Page => Width Layouts
			if( wp.customize( 'page_width_layout' ).get() === 'global' ) $( '.page #primary.site-main' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Pages => 404 => Width Layouts
			if( wp.customize( 'error_page_width_layout' ).get() === 'global' ) $( '.error404 #primary.site-main' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Pages => Search Page => Width Layouts
			if( wp.customize( 'search_page_width_layout' ).get() === 'global' ) $( '.search #primary.site-main' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
			// Front Sections => Two Column Section => Width Layouts
			if( wp.customize( 'two_column_section_layout' ).get() === 'global' ) $( '#two-column-section' ).removeClass( 'width-boxed--layout width-full-width--layout' ).addClass( 'width-' + to )
		});
	});

	// Ads Banner Visibility
	wp.customize( 'header_ads_banner_responsive_option', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			cssCode += `body .after-header .ads-banner { display: ${( to.desktop ? 'block' : 'none' )} }`;
			cssCode += `@media(max-width: 940px) { body .after-header .ads-banner { display: ${( to.tablet ? 'block' : 'none' )} } }`
			cssCode += `@media(max-width: 610px) { body .after-header .ads-banner { display: ${( to.mobile ? 'block' : 'none' )} } }`
			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-header-ads-banner-responsive-option' )
		})
	})

	let rowFullWidth = [
		'header_first_row_full_width',
		'header_second_row_full_width',
		'header_third_row_full_width',
		'footer_first_row_full_width',
		'footer_second_row_full_width',
		'footer_third_row_full_width'
	]

	rowFullWidth.forEach( function( row, index ) {
		let isHeader = row.includes( 'header' ) ? 'header' : 'footer',
			count = ( index + 1 ) % 3,
			_thisRow = count ? count : 3
		wp.customize( row, function( value ) {
			value.bind( function( to ) {
				let row = $( `body .site-${ isHeader } .row-${ online_newspaper_get_numeric_string( _thisRow ) }` )
				if( to ) {
					row.addClass( 'full-width' ).find( '.bb-bldr-row' ).removeClass( 'full-width' )
				} else {
					row.removeClass( 'full-width' ).find( '.bb-bldr-row' ).addClass( 'full-width' )
				}
			})
		})
	})

	// converts integer to string for attibutes value 
	function online_newspaper_get_numeric_string(int) {
		switch( int ) {
			case 2:
				return "two";
				break;
			case 3:
				return "three";
				break;
			case 4:
				return "four";
				break;
			case 5:
				return "five";
				break;
			case 6:
				return "six";
				break;
			case 7:
				return "seven";
				break;
			case 8:
				return "eight";
				break;
			case 9:
				return "nine";
				break;
			case 10:
				return "ten";
				break;
			default:
				return "one";
		}
	}

	// check if string is variable and formats 
	function online_newspaper_get_color_format(color) {
		if( color == null ) return color
		if( color.indexOf( '--online-newspaper-global-preset' ) >= 0 ) {
			return( 'var( ' + color + ' )' );
		} else {
			return color;
		}
	}

	// constants
	const typographyFunctions = {
		typoFontsEnqueue: function( typography ) {
			const { font_family, font_weight } = typography
			let linkTag = document.getElementById('online-newspaper-generated-typo-fonts')
			let googleFontsUrl = 'https://fonts.googleapis.com/css2?'
			let googleFontsUrlQuery
			let fontStyle = ( font_weight.variant === 'italic' ) ? 'ital,wght@' : 'wght@'
			if( linkTag !== null ) {
				let parser = new URL( linkTag.href )
				let query = parser.search
				let toAppend = this.parseTheFontsQuery( query, typography )
				linkTag.href = googleFontsUrl + toAppend
			} else {
				let newLinkTag = document.createElement('link')
				newLinkTag.rel = 'stylesheet'
				newLinkTag.id = 'online-newspaper-generated-typo-fonts'
				googleFontsUrlQuery = 'family=' + font_family.value + ':' + fontStyle + font_weight.value
				newLinkTag.href = googleFontsUrl + googleFontsUrlQuery
				document.head.appendChild( newLinkTag );
			}
		},
		parseTheFontsQuery: function( query, typography ) {
			const { font_weight:WEIGHT, font_family:FAMILY } = typography
			let toParse = query
			let removeQuestionMark = toParse.replaceAll( '?', '' )
			let filteredQuery = removeQuestionMark.replaceAll( '&', '' )
			let fontFamilyQuery = filteredQuery.split( 'family=' )
			let fontStyleProperty = WEIGHT.variant === 'italic' ? 'ital' : 'wght'
			var fontFamily = [ FAMILY.value ], fontWeight = { [FAMILY.value]: [ WEIGHT.value ] }, fontStyle = { [FAMILY.value]: [ fontStyleProperty ]}
			let filteredFamily = fontFamily.map(( current ) => {
				return current.replaceAll( '%20', ' ' )
			})
			fontFamilyQuery.forEach(( current ) => {
				if( current !== '' ) {
					let splitFamily = current.split( ':' )
					let family = splitFamily[0]
					if ( ! filteredFamily.includes( family ) ) filteredFamily.push( family );
					let splitWeightAndStyle = splitFamily[1].split('@')
					let weight = splitWeightAndStyle[1].replaceAll( '0,', '' ).replaceAll( '1,', '' ).replaceAll( ',', '' )
					let style = splitWeightAndStyle[0]
					if ( ! fontWeight[family] ) fontWeight[family] = []
					if ( ! fontStyle[family] ) fontStyle[family] = []
					if ( ! fontStyle[family].includes( style ) ) fontStyle[family].push( ...style.split(',') );
					
					if ( ! fontWeight[family].includes( weight ) ) fontWeight[family].push( ...weight.split(';') );
				}
			})
			let toAppend = filteredFamily.map(( family ) => {
				let sortedWeights = fontWeight[family].sort(( first, second ) => { return first - second })
				let duplicateRemovedWeights =  [ ...new Set( sortedWeights ) ]	//weights
				let duplicateRemovedStyles =  [ ...new Set( fontStyle[family] ) ]	// styles
				var structuredFontStyles, temporaryStyles = []
				if( duplicateRemovedStyles.includes( 'ital' ) ) {
					duplicateRemovedWeights.forEach(( current ) => { 
						if( current !== undefined && current !== '' ) temporaryStyles.push( '0,' + current + ';' )
					})
					duplicateRemovedWeights.forEach(( current, index ) => { 
						if( current !== undefined && current !== '' ) temporaryStyles.push( '1,' + current + ( index + 1 === duplicateRemovedWeights.length ? '' : ';' ) )
					})
					structuredFontStyles = temporaryStyles.join('')
				} else {
					structuredFontStyles = duplicateRemovedWeights.join(';')
				}
				return 'family=' + family + ':' + duplicateRemovedStyles.sort() + '@' + structuredFontStyles
			}).join('&')
			return toAppend;
		}
	}

	// constants
	const helperFunctions = {
		getFormatedColor: function(color) {
			if( color == null ) return
			if( color.includes('preset') ) {
				return 'var(' + color + ')'
			} else {
				return color
			}
		},
		bulkGenerateStyle: function( colors, id, variablePrefix ) {
			if( colors.length > 0 ) {
				let styleText = 'body.online-newspaper-variables {'
				colors.forEach(( color, index ) => {
					let count = index + 1
					styleText += variablePrefix + count + ': ' + color + ';'
				})
				styleText += '}'
				
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id).text( styleText )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + styleText + '</style>' )
				}
			}
		}
	}

	// pagination text color
	wp.customize( 'pagination_button_text_color', function( value ) {
		value.bind( function( to ) {
			let initialSelector = 'body.online-newspaper-light-mode .navigation.posts-navigation a, body.online-newspaper-light-mode .navigation.posts-navigation .nav-previous a:before, body.online-newspaper-light-mode .navigation.posts-navigation .nav-next a:after, body.online-newspaper-light-mode .pagination .ajax-load-more, body.online-newspaper-light-mode .pagination .page-numbers li a',
				hoverSelector = 'body.online-newspaper-light-mode .navigation.posts-navigation a:hover, body.online-newspaper-light-mode .navigation.posts-navigation .nav-previous a:hover:before, body.online-newspaper-light-mode .navigation.posts-navigation .nav-next a:hover:after, body.online-newspaper-light-mode .pagination .page-numbers li a:hover, body.online-newspaper-light-mode .pagination .ajax-load-more:hover',
				cssCode = '',
				{ initial, hover } = to,
				initialColor = helperFunctions.getFormatedColor( initial[ initial.type ] ),
				hoverColor = helperFunctions.getFormatedColor( hover[ hover.type ] )
			cssCode += `${ initialSelector } { color: ${ initialColor } }\n`
			cssCode += `${ hoverSelector } { color: ${ hoverColor } }\n`
			cssCode += `body.online-newspaper-light-mode .navigation.posts-navigation a { border-color: ${ initialColor } }\n`
			cssCode += `body.online-newspaper-light-mode .navigation.posts-navigation a:hover { border-color: ${ hoverColor } }\n`

			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-pagination-button-text-color' )
		});
	});

	// pagination background color
	wp.customize( 'pagination_button_background_color', function( value ) {
		value.bind( function(to) {
			let initialSelector = 'body.online-newspaper-light-mode .pagination .page-numbers li a, body.online-newspaper-light-mode .pagination .ajax-load-more',
				hoverSelector = 'body.online-newspaper-light-mode .pagination .page-numbers li a:hover, body.online-newspaper-light-mode .pagination .ajax-load-more:hover',
				cssCode = '',
				{ initial, hover } = to,
				initialColor = helperFunctions.getFormatedColor( initial[ initial.type ] ),
				hoverColor = helperFunctions.getFormatedColor( hover[ hover.type ] )
			cssCode += `${ initialSelector } { background: ${ initialColor } }\n`
			cssCode += `${ hoverSelector } { background: ${ hoverColor } }\n`

			themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-pagination-button-background-color' )
		});
	});
	
	// typography preset
	wp.customize( 'typography_presets', function( value ) {
		value.bind( function(to) {
			const { typographies } = to
			typographies.forEach(( typography, index ) => {
				typographyFunctions.typoFontsEnqueue( typography )
				let variable = '--online-newspaper-global-preset-typography-',
					count = index + 1;
               	variable += count + '-font';
				cssCode = themeCalls.onlineNewspaperGenerateTypoCss({ property: variable, value: typography })
				themeCalls.onlineNewspaperGenerateStyleTag( cssCode, 'online-newspaper-typography-preset-' + count )
			})
		});
	});
	
	const frontpageRowFullWidthIds = {
		'main_banner_card_enable': '#main-banner-section',
		'web_stories_card_enable': '#online-newspaper-web-stories',
		'full_width_card_enable': '#full-width-section',
		'leftc_rights_card_enable': '#leftc-rights-section',
		'lefts_rightc_card_enable': '#lefts-rightc-section',
		'bottom_full_width_card_enable': '#bottom-full-width-section',
		'two_column_card_enable': '#two-column-section',
		'archive_card_enable': '#theme-content',
		'ticker_news_card_enable': '#online-newspaper-ticker-news',
		'single_post_card_enable': 'body.single',
		'page_card_enable': 'body.page',
 	}
	Object.entries( frontpageRowFullWidthIds ).forEach(([ sectionId, selector ]) => {
		wp.customize( sectionId, function( value ) {
			value.bind( function( to ) {
				if( to ) {
					$( selector ).addClass( 'card--on' ).removeClass( 'card--off' )
				} else {
					$( selector ).removeClass( 'card--on' ).addClass( 'card--off' )
				}
			});
		});
	})

	/**
	 * MARK: Color
	 */
	NEVControls.color({ controlId: 'theme_color', property: '--online-newspaper-global-preset-theme-color' });
	NEVControls.color({ controlId: 'site_background_color', property: '--site-bk-color' });
	NEVControls.color({ controlId: 'stt_color_group', property: '--move-to-top-color' });
	NEVControls.color({ controlId: 'header_sub_menu_color', property: '--menu-color-submenu' });
	NEVControls.color({ controlId: 'custom_button_color_group', property: '--custom-btn-color' });
	NEVControls.color({ controlId: 'footer_color', property: '--footer-text-color' });
	NEVControls.color({ controlId: 'date_color', property: '--top-header-date-color' });
	NEVControls.color({ controlId: 'time_color', property: '--top-header-time-color' });
	NEVControls.color({ controlId: 'secondary_menu_color', selector: 'body.online-newspaper-variables.online-newspaper-light-mode', property: '--secondary-menu-color' });
	
	NEVControls.color({ controlId: 'ticker_news_background_color_group', selector: 'body.online-newspaper-light-mode .site #online-newspaper-ticker-news' });
	NEVControls.color({ controlId: 'ticker_news_title_color', selector: '.site .ticker-news-wrap.online-newspaper-ticker .ticker-item h2.post-title a', property: 'color' });
	NEVControls.color({ controlId: 'ticker_news_date_color', selector: '.site .ticker-item-wrap .post-date a, .ticker-item-wrap span.post-date:before', property: 'color' });
	NEVControls.color({ controlId: 'main_banner_background_color_group', selector: 'body.online-newspaper-light-mode .site #main-banner-section' });
	NEVControls.color({ controlId: 'web_stories_background_color_group', selector: 'body.online-newspaper-light-mode .site .online-newspaper-web-stories' });
	NEVControls.color({ controlId: 'full_width_blocks_background_color_group', selector: 'body.online-newspaper-light-mode .site #full-width-section' });
	NEVControls.color({ controlId: 'leftc_rights_blocks_background_color_group', selector: 'body.online-newspaper-light-mode .site #leftc-rights-section' });
	NEVControls.color({ controlId: 'header_textcolor', selector: 'body.online-newspaper-light-mode header.site-header .site-title a, body.online-newspaper-light-mode header.site-header .site-title a:after', property: 'color' });
	NEVControls.color({ controlId: 'site_description_color', selector: 'body.online-newspaper-light-mode .site-header .site-description', property: 'color' });
	NEVControls.color({ controlId: 'lefts_rightc_blocks_background_color_group', selector: 'body.online-newspaper-light-mode .site #lefts-rightc-section' });
	NEVControls.color({ controlId: 'bottom_full_width_blocks_background_color_group', selector: 'body.online-newspaper-light-mode .site #bottom-full-width-section' });
	NEVControls.color({ controlId: 'two_column_background_color_group', selector: 'body.online-newspaper-light-mode .site #two-column-section' });
	NEVControls.color({ controlId: 'leftc_rights_sidebar_background_color_group', selector: 'body.online-newspaper-light-mode .site #leftc-rights-section .secondary-sidebar' });
	NEVControls.color({ controlId: 'lefts_rightc_sidebar_background_color_group', selector: 'body.online-newspaper-light-mode .site #lefts-rightc-section .secondary-sidebar' });
	NEVControls.color({ controlId: 'archive_color_group', selector: 'body.online-newspaper-light-mode .site #theme-content' });
	NEVControls.color({ controlId: 'sidebar_background', selector: 'body.online-newspaper-light-mode .site #theme-content .widget-area' });
	NEVControls.color({ controlId: 'site_title_hover_textcolor', selector: 'body.online-newspaper-light-mode header.site-header .site-title a:hover', property: 'color' });
	NEVControls.color({ controlId: 'website_layout_background_color', selector: 'body .site' });
	NEVControls.color({ controlId: 'header_builder_background', selector: 'body.online-newspaper-light-mode .site .site-header' });
	NEVControls.color({ controlId: 'header_first_row_background', selector: 'body.online-newspaper-light-mode .site .site-header .row-one.full-width, body.online-newspaper-light-mode .site .site-header .row-one .full-width' });
	NEVControls.color({ controlId: 'header_second_row_background', selector: 'body.online-newspaper-light-mode .site .site-header .row-two.full-width, body.online-newspaper-light-mode .site .site-header .row-two .full-width' });
	NEVControls.color({ controlId: 'header_third_row_background', selector: 'body.online-newspaper-light-mode .site .site-header .row-three.full-width, body.online-newspaper-light-mode .site .site-header .row-three .full-width' });
	NEVControls.color({ controlId: 'date_color', selector: '.site-header .top-date-time .top-date-time-inner .date', property: 'color' });
	NEVControls.color({ controlId: 'time_color', selector: '.site-header .top-date-time .top-date-time-inner .time', property: 'color' });
	NEVControls.color({ controlId: 'footer_builder_background', selector: 'body.online-newspaper-light-mode footer.site-footer' });
	NEVControls.color({ controlId: 'theme_mode_light_icon_color', selector: 'body.online-newspaper-light-mode .site-header .mode-toggle .light', property: 'color' });
	NEVControls.color({ controlId: 'theme_mode_dark_icon_color', selector: 'body.online-newspaper-dark-mode .site-header .mode-toggle .dark', property: 'color' });
	NEVControls.color({ controlId: 'footer_first_row_background', selector: 'body.online-newspaper-light-mode .site .site-footer .bb-bldr--normal .row-one.full-width, body.online-newspaper-light-mode .site .site-footer .bb-bldr--normal .row-one .full-width' });
	NEVControls.color({ controlId: 'footer_second_row_background', selector: 'body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-two.full-width, body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-two .full-width' });
	NEVControls.color({ controlId: 'footer_third_row_background', selector: 'body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-three.full-width, body.online-newspaper-light-mode .site-footer .bb-bldr--normal .row-three .full-width' });
	NEVControls.color({ controlId: 'footer_menu_color', selector: 'body.online-newspaper-light-mode .site footer.site-footer .bb-bldr-widget:not(.has-sidebar) .menu li a', property: 'color' });
	NEVControls.color({ controlId: 'mobile_canvas_icon_color', selector: 'body.online-newspaper-light-mode .site .toggle-button-wrapper .canvas-menu-icon', property: 'color' });
	/**
	 * MARK: Typography
	 */
	NEVControls.typography({ controlId: 'site_title_typo', property: '--site-title' });
	NEVControls.typography({ controlId: 'site_tagline_typo', property: '--site-tagline' });
	NEVControls.typography({ controlId: 'site_block_title_typo', property: '--block-title' });
	NEVControls.typography({ controlId: 'site_post_title_typo', property: '--post-title' });
	NEVControls.typography({ controlId: 'site_post_meta_typo', property: '--meta' });
	NEVControls.typography({ controlId: 'global_category_typography', property: '--category' });
	NEVControls.typography({ controlId: 'site_post_content_typo', property: '--content' });
	NEVControls.typography({ controlId: 'global_button_typo', property: '--post-link-btn' });
	NEVControls.typography({ controlId: 'header_menu_typo', property: '--menu' });
	NEVControls.typography({ controlId: 'header_sub_menu_typo', property: '--submenu' });
	NEVControls.typography({ controlId: 'custom_button_text_typo', property: '--custom-btn' });
	NEVControls.typography({ controlId: 'single_post_title_typo', property: '--single-title' });
	NEVControls.typography({ controlId: 'single_post_meta_typo', property: '--single-meta' });
	NEVControls.typography({ controlId: 'single_post_content_typo', property: '--single-content' });

	NEVControls.typography({ controlId: 'header_newsletter_typography', selector: '.site .site-header .newsletter-element a' });
	NEVControls.typography({ controlId: 'secondary_menu_typo', selector: 'body .site header.site-header .top-nav-menu:not(.use-primary) ul li a' });
	NEVControls.typography({ controlId: 'date_time_typography', selector: '.site .site-header .top-date-time .top-date-time-inner' });
	NEVControls.typography({ controlId: 'footer_title_typography', selector: '.site .site-footer h2.online-newspaper-block-title, .site .site-footer h2.online-newspaper-block-title span, .site .site-footer h2.widget-title span, .site .site-footer h2.online-newspaper-widget-title span' });
	NEVControls.typography({ controlId: 'footer_text_typography', selector: '.site-footer .post-item .post-element .post-title a, .site-footer .widget_online_newspaper_opinions_widget .your-opinions-block-widget .opinion-content .post-title a, .site-footer .widget .posts-wrap .post-item .post-title a' });
	NEVControls.typography({ controlId: 'footer_menu_typography', selector: '.site footer.site-footer .bb-bldr-widget:not(.has-sidebar) .menu li a' });
	NEVControls.typography({ controlId: 'bottom_footer_text_typography', selector: 'footer.site-footer .site-info' });
	NEVControls.typography({ controlId: 'sticky_posts_label_typography', selector: 'body .online-newspaper-sticky-posts .label-wrapper .label' });
	NEVControls.typography({ controlId: 'sticky_posts_title_typography', selector: 'body .online-newspaper-sticky-posts .post-list article .post-content .post-title' });
	NEVControls.typography({ controlId: 'web_stories_preview_count_typo', selector: '.site .online-newspaper-web-stories .stories-wrap .preview .story-count' });
	NEVControls.typography({ controlId: 'web_stories_preview_title_typo', selector: '.site .online-newspaper-web-stories .stories-wrap .story-title' });
	NEVControls.typography({ controlId: 'web_stories_title_typo', selector: '.site .online-newspaper-web-stories .inner-stories-wrap .content-wrap .title' });
	NEVControls.typography({ controlId: 'random_news_typography', selector: '.site .site-header .random-news-element a' });
	
	/**
	 * MARK: Box Shadow
	 */
	NEVControls.boxShadow({ controlId: 'website_box_shadow', selector: 'body.site-boxed--layout #page.site' })
	NEVControls.boxShadow({
		controlId: 'widgets_styles_image_box_shadow',
		selector: '.widget .post_thumb_image, .widget .opinions-items-wrap .opinion-item figure, .widget .widget-tabs-content .post-thumb, .widget .popular-posts-wrap article .post-thumb, .widget.widget_online_newspaper_news_filter_tabbed_widget .tabs-content-wrap .post-thumb, .widget .online-newspaper-widget-carousel-posts.layout--two .slick-list, .author-wrap.layout-two .post-thumb, .widget_online_newspaper_category_collection_widget .categories-wrap .category-item, .widget .online-newspaper-advertisement-block img'
	})

	/**
	 * MARK: Border
	 */
	NEVControls.border({ 
		controlId: 'widgets_styles_image_border', 
		selector: '.widget .post_thumb_image, .widget .opinions-items-wrap .opinion-item figure, .widget .widget-tabs-content .post-thumb, .widget .popular-posts-wrap article .post-thumb, .widget.widget_online_newspaper_news_filter_tabbed_widget .tabs-content-wrap .post-thumb, .widget .online-newspaper-widget-carousel-posts .post-thumb-wrap, .author-wrap.layout-two .post-thumb, .widget_online_newspaper_category_collection_widget .categories-wrap .category-item, .widget .online-newspaper-advertisement-block img'
	});
	NEVControls.border({ 
		controlId: 'main_banner_section_border', 
		selector: 'body .site #main-banner-section'
	});
	NEVControls.border({ 
		controlId: 'web_stories_section_border', 
		selector: 'body .site .online-newspaper-web-stories'
	});
	NEVControls.border({ 
		controlId: 'full_width_section_border', 
		selector: 'body .site #full-width-section'
	});
	NEVControls.border({ 
		controlId: 'leftc_rights_section_border', 
		selector: 'body .site #leftc-rights-section'
	});
	NEVControls.border({ 
		controlId: 'leftc_rights_sidebar_section_border', 
		selector: 'body .site #leftc-rights-section .secondary-sidebar'
	});
	NEVControls.border({ 
		controlId: 'lefts_rightc_section_border', 
		selector: 'body .site #lefts-rightc-section'
	});
	NEVControls.border({ 
		controlId: 'lefts_rightc_sidebar_section_border', 
		selector: 'body .site #lefts-rightc-section .secondary-sidebar'
	});
	NEVControls.border({ 
		controlId: 'bottom_full_width_section_border', 
		selector: 'body .site #bottom-full-width-section'
	});
	NEVControls.border({ 
		controlId: 'two_column_section_border', 
		selector: 'body .site #two-column-section'
	});
	NEVControls.border({ 
		controlId: 'archive_section_border', 
		selector: 'body .site #theme-content'
	});
	NEVControls.border({ 
		controlId: 'sidebar_border', 
		selector: 'body .site #theme-content .widget-area'
	});
	NEVControls.border({ 
		controlId: 'ticker_news_border', 
		selector: 'body .site #online-newspaper-ticker-news'
	});

	/**
	 * MARK: Toggle Class
	 */
	NEVControls.toggleClass({ selector: 'body #masthead', controlId: 'header_builder_section_width', classToToggle: 'boxed--layout full-width--layout' })
	NEVControls.toggleClass({ selector: 'body .site-footer', controlId: 'footer_builder_section_width', classToToggle: 'boxed--layout full-width--layout' })
	NEVControls.toggleClass({ selector: 'body .site-header .row-one', controlId: 'header_first_row_header_sticky', classToToggle: 'row-sticky' });
	NEVControls.toggleClass({ selector: 'body .site-header .row-two', controlId: 'header_second_row_header_sticky', classToToggle: 'row-sticky' });
	NEVControls.toggleClass({ selector: 'body .site-header .row-three', controlId: 'header_third_row_header_sticky', classToToggle: 'row-sticky' });
	NEVControls.toggleClass({ selector: 'body #masthead .top-date-time', controlId: 'date_time_display_block', classToToggle: 'block' });
	NEVControls.toggleClass({ selector: 'body .site-footer .bb-bldr--normal .row-one .bb-bldr-row', controlId: 'footer_first_row_row_direction', classToToggle: 'is-vertical is-horizontal' });
	NEVControls.toggleClass({ selector: 'body .site-footer .bb-bldr--normal .row-two .bb-bldr-row', controlId: 'footer_second_row_row_direction', classToToggle: 'is-vertical is-horizontal' });
	NEVControls.toggleClass({ selector: 'body .site-footer .bb-bldr--normal .row-three .bb-bldr-row', controlId: 'footer_third_row_row_direction', classToToggle: 'is-vertical is-horizontal' });

	/**
	 * MARK: Toggle Class with Prefix
	 */
	NEVControls.toggleClassWithPrefix({ controlId: 'post_title_hover_effects', prefix: 'online-newspaper-title-' })
	NEVControls.toggleClassWithPrefix({ controlId: 'website_layout', removeClass: 'site-boxed--layout site-full-width--layout', prefix: 'site-' })
	NEVControls.toggleClassWithPrefix({ controlId: 'site_image_hover_effects', prefix: 'online-newspaper-image-hover--effect-' })
	NEVControls.toggleClassWithPrefix({ controlId: 'header_menu_hover_effect', prefix: 'hover-effect--', selector: '#site-navigation' })
	NEVControls.toggleClassWithPrefix({ controlId: 'off_canvas_position', prefix: 'off-canvas-sidebar-appear--', selector: 'body' })
	NEVControls.toggleClassWithPrefix({ controlId: 'archive_page_layout', prefix: 'post-layout--' })
	NEVControls.toggleClassWithPrefix({ controlId: 'single_layout', prefix: 'single-layout--' })
	NEVControls.toggleClassWithPrefix({ controlId: 'footer_menu_hover_effect', selector: '.site-footer .bb-bldr--normal .bb-bldr-widget .menu', prefix: 'hover-effect--' });
	NEVControls.toggleClassWithPrefix({ controlId: 'sticky_posts_position', selector: '.online-newspaper-sticky-posts', prefix: 'position-' });
	NEVControls.toggleClassWithPrefix({ controlId: 'header_newsletter_hover_animation', selector: 'body #masthead .newsletter-element', prefix: 'animation--' });

	/**
	 * MARK: Responsive Slider
	 */
	NEVControls.responsiveSlider({ controlId: 'custom_button_icon_size', property: '--custom-btn-icon-size' })
	NEVControls.responsiveSlider({ controlId: 'archive_image_ratio', property: '--online-newspaper-archive-image-ratio', unit: '' })
	NEVControls.responsiveSlider({ controlId: 'single_post_image_ratio', property: '--online-newspaper-single-image-ratio', unit: '' })
	NEVControls.responsiveSlider({ controlId: 'page_image_ratio', property: '--online-newspaper-page-image-ratio', unit: '' })

	NEVControls.responsiveSlider({ controlId: 'site_logo_width', selector: 'body .site-branding img', property: 'width' })
	NEVControls.responsiveSlider({ controlId: 'website_layout_horizontal_gap', selector: 'body #page.site', property: 'margin-inline' })
	NEVControls.responsiveSlider({ controlId: 'website_layout_vertical_gap', selector: 'body #page.site', property: [ 'margin-bottom', 'margin-top' ] })
	NEVControls.responsiveSlider({ controlId: 'search_icon_size', selector: '.site .site-header .search-wrap .search-trigger i', property: 'font-size' })
	NEVControls.responsiveSlider({ 
		controlId: 'widgets_styles_image_border_radius',
		selector: '.widget .post_thumb_image, .widget .opinions-items-wrap .opinion-item figure, .widget .widget-tabs-content .post-thumb, .widget .popular-posts-wrap article .post-thumb, .widget.widget_online_newspaper_news_filter_tabbed_widget .tabs-content-wrap .post-thumb, .widget .online-newspaper-widget-carousel-posts .post-thumb-wrap, .author-wrap.layout-two .post-thumb, .widget .online-newspaper-widget-carousel-posts.layout--two .slick-list, .widget_online_newspaper_category_collection_widget .categories-wrap .category-item, .widget .online-newspaper-advertisement-block img'
	})
	NEVControls.responsiveSlider({ controlId: 'bottom_footer_logo_width', selector: '.site .site-footer .footer-logo img', property: 'width' })
	NEVControls.responsiveSlider({ controlId: 'site_logo_width', selector: 'body .site-header .site-branding img', property: 'width' })

	/**
	 * MARK: Dimension
	 */
	NEVControls.dimension({ controlId: 'leftc_rights_section_sidebar_padding', selector: 'body .site #leftc-rights-section .secondary-sidebar' });
	NEVControls.dimension({ controlId: 'lefts_rightc_section_sidebar_padding', selector: 'body .site #lefts-rightc-section .secondary-sidebar' });
	NEVControls.dimension({ controlId: 'sidebar_padding', selector: 'body #theme-content .widget-area' });
	

	/**
	 * MARK: Number
	 */
	NEVControls.number({ controlId: 'main_banner_section_border_radius', selector: 'body.online-newspaper-light-mode .site #main-banner-section, body #main-banner-section:not(.banner-layout--one):not(.banner-layout--two):not(.banner-layout--five) article, .banner-layout--five .main-banner-wrap article, .banner-layout--five .grid-posts-wrap article, .banner-layout--five .list-posts-wrap article:first-child, .banner-layout--five .list-posts-wrap article:not(:first-child) .post-thumb, body #main-banner-section .row > div', property: 'border-radius' })
	NEVControls.number({ controlId: 'web_stories_section_border_radius', selector: 'body .online-newspaper-web-stories .preview-thumb, body .site .online-newspaper-web-stories, body .site .online-newspaper-web-stories.card--on .row', property: 'border-radius' })
	NEVControls.number({ controlId: 'full_width_section_border_radius', selector: 'body #full-width-section, body .site #full-width-section .post-thumb-wrap, body .site #full-width-section.card--on .row > div', property: 'border-radius' })
	NEVControls.number({ controlId: 'leftc_rights_section_border_radius', selector: 'body #leftc-rights-section, body .site #leftc-rights-section .post-thumb-wrap , body .site #leftc-rights-section.card--on .row > div', property: 'border-radius' })
	NEVControls.number({ controlId: 'leftc_rights_section_sidebar_border_radius', selector: 'body .site #leftc-rights-section .secondary-sidebar ', property: 'border-radius' })
	NEVControls.number({ controlId: 'lefts_rightc_section_border_radius', selector: 'body #lefts-rightc-section, body .site #lefts-rightc-section .post-thumb-wrap , body .site #lefts-rightc-section.card--on .row > div', property: 'border-radius' })
	NEVControls.number({ controlId: 'lefts_rightc_section_sidebar_border_radius', selector: 'body .site #lefts-rightc-section .secondary-sidebar ', property: 'border-radius' })
	NEVControls.number({ controlId: 'bottom_full_width_section_border_radius', selector: 'body #bottom-full-width-section, body .site #bottom-full-width-section .post-thumb-wrap , body .site #bottom-full-width-section.card--on .row > div', property: 'border-radius' })
	NEVControls.number({ controlId: 'two_column_section_border_radius', selector: 'body #two-column-section, body .site #two-column-section .post-thumb-wrap , body .site #two-column-section.card--on .row > div', property: 'border-radius' })
	NEVControls.number({ controlId: 'archive_border_radius', selector: 'body #theme-content, body .site #theme-content .post-thumb-wrap, body .site #theme-content.card--on .row > div', property: 'border-radius' })
	NEVControls.number({ controlId: 'sidebar_border_radius', selector: 'body #theme-content .widget-area ', property: 'border-radius' })
	NEVControls.number({ controlId: 'ticker_section_border_radius', selector: 'body #online-newspaper-ticker-news .feature_image , body .site #online-newspaper-ticker-news ', property: 'border-radius' })
	/**
	 * MARK: Global Content Layout
	 */
	// Global => Website Layout => Website Content Global Layout
	NEVControls.globalContentLayout({ controlId: 'ticker_news_width_layout', selector: '#online-newspaper-ticker-news'})
	// Main Banner => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'main_banner_width_layout', selector: '#main-banner-section' })
	// Main Banner => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'web_stories_full_width_blocks_width_layout', selector: '#online-newspaper-web-stories' })
	// Front Section => Full Width => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'full_width_blocks_width_layout', selector: '#full-width-section' })
	// Front Section => Left Content -Right Sidebar => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'leftc_rights_blocks_width_layout', selector: '#leftc-rights-section' })
	// Front Section => Left Sidebar -Right Content => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'lefts_rightc_blocks_width_layout', selector: '#lefts-rightc-section' })
	// Front Section => Bottom Full Width => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'bottom_full_width_blocks_width_layout', selector: '#bottom-full-width-section' })
	// Blog / Archive / Single => Blog / Archive => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'archive_width_layout', selector: '.archive #primary.site-main, .home #primary.site-main, body.author .author-info-wrap' })
	// Blog / Archive / Single => Single Post => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'single_post_width_layout', selector: '.single #primary.site-main' })
	// Pages => Page => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'page_width_layout', selector: '.page #primary.site-main' })
	// Pages => 404 => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'error_page_width_layout', selector: '.error404 #primary.site-main' })
	// Pages => Search Page => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'search_page_width_layout', selector: '.search #primary.site-main' })
	// Front Sections => Two Column Section => Width Layouts
	NEVControls.globalContentLayout({ controlId: 'two_column_section_layout', selector: '#two-column-section' })
	
	/**
	 * MARK: Builder Responsive
	*/
	NEVControls.builderResponsive({ controlId: 'header_first_row_column_one', selector: 'header.site-header .bb-bldr--normal .row-one .bb-bldr-row .bb-bldr-column.one', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-one .bb-bldr-row .bb-bldr-column.one', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_first_row_column_two', selector: 'header.site-header .bb-bldr--normal .row-one .bb-bldr-row .bb-bldr-column.two', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-one .bb-bldr-row .bb-bldr-column.two', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_first_row_column_three', selector: 'header.site-header .bb-bldr--normal .row-one .bb-bldr-row .bb-bldr-column.three', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-one .bb-bldr-row .bb-bldr-column.three', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_second_row_column_one', selector: 'header.site-header .bb-bldr--normal .row-two .bb-bldr-row .bb-bldr-column.one', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-two .bb-bldr-row .bb-bldr-column.one', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_second_row_column_two', selector: 'header.site-header .bb-bldr--normal .row-two .bb-bldr-row .bb-bldr-column.two', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-two .bb-bldr-row .bb-bldr-column.two', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_second_row_column_three', selector: 'header.site-header .bb-bldr--normal .row-two .bb-bldr-row .bb-bldr-column.three', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-two .bb-bldr-row .bb-bldr-column.three', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_third_row_column_one', selector: 'header.site-header .bb-bldr--normal .row-three .bb-bldr-row .bb-bldr-column.one', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-three .bb-bldr-row .bb-bldr-column.one', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_third_row_column_two', selector: 'header.site-header .bb-bldr--normal .row-three .bb-bldr-row .bb-bldr-column.two', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-three .bb-bldr-row .bb-bldr-column.two', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'header_third_row_column_three', selector: 'header.site-header .bb-bldr--normal .row-three .bb-bldr-row .bb-bldr-column.three', responsiveSelector: 'header.site-header .bb-bldr--responsive .row-three .bb-bldr-row .bb-bldr-column.three', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_first_row_column_one', selector: 'footer.site-footer .bb-bldr--normal .row-one .bb-bldr-row .bb-bldr-column.one', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_first_row_column_two', selector: 'footer.site-footer .bb-bldr--normal .row-one .bb-bldr-row .bb-bldr-column.two', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_first_row_column_three', selector: 'footer.site-footer .bb-bldr--normal .row-one .bb-bldr-row .bb-bldr-column.three', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_first_row_column_four', selector: 'footer.site-footer .bb-bldr--normal .row-one .bb-bldr-row .bb-bldr-column.four', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_second_row_column_one', selector: 'footer.site-footer .bb-bldr--normal .row-two .bb-bldr-row .bb-bldr-column.one', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_second_row_column_two', selector: 'footer.site-footer .bb-bldr--normal .row-two .bb-bldr-row .bb-bldr-column.two', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_second_row_column_three', selector: 'footer.site-footer .bb-bldr--normal .row-two .bb-bldr-row .bb-bldr-column.three', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_second_row_column_four', selector: 'footer.site-footer .bb-bldr--normal .row-two .bb-bldr-row .bb-bldr-column.four', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_third_row_column_one', selector: 'footer.site-footer .bb-bldr--normal .row-three .bb-bldr-row .bb-bldr-column.one', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_third_row_column_two', selector: 'footer.site-footer .bb-bldr--normal .row-three .bb-bldr-row .bb-bldr-column.two', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_third_row_column_three', selector: 'footer.site-footer .bb-bldr--normal .row-three .bb-bldr-row .bb-bldr-column.three', prefix: 'alignment-' });
	NEVControls.builderResponsive({ controlId: 'footer_third_row_column_four', selector: 'footer.site-footer .bb-bldr--normal .row-three .bb-bldr-row .bb-bldr-column.four', prefix: 'alignment-' });
}( jQuery ) );
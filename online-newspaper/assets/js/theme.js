/**
 * Handles theme general events
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
jQuery(document).ready(function($) {
    "use strict"
    const { stt: sttOption, headerAdsBannerOption, themeColor, slickPrev, slickNext } = onlineNewspaperObject,
        wpadminbar = $( 'body #wpadminbar' ).height(),
        isLoggedIn = $( 'body' ).hasClass( 'admin-bar' )

    var desktopHeaderHeight = $( 'header#masthead .bb-bldr--normal' ).outerHeight(),
        responsiveHeaderHeight = $( 'header#masthead .bb-bldr--responsive' ).outerHeight()

    // on element outside click function
    function onlineNewspaperOnElementOutsideClick( currentElement, callback ) {
        $( document ).mouseup(function( e ) {
            var container = $( currentElement );
            if ( ! container.is( e.target ) && container.has( e.target ).length === 0 ) callback();
        })
    }

    if( ! onlineNewspaperObject.is_customizer ) {
        setTimeout(function() {
            $('body .online_newspaper_loading_box').hide();
        }, 2000);
    } else {
        $('body .online_newspaper_loading_box').hide();
    }

    /**
     * Calculate header Height
     * 
     * @since 1.0.2
     */
    const onlineNewspaperCalculateHeaderHeight = () => {
        let isDesktop = $( 'body' ).hasClass( 'is-desktop' )
        $( 'header#masthead' ).height( isDesktop ? desktopHeaderHeight : responsiveHeaderHeight )   
    }

    /**
     * Add device class
     * 
     * @since 1.0.2
     */
    const onlineNewspaperAddDeviceClass = () => {
        let selector = $('body')
        if( $( window ).width() <= 426 ) {
            selector.removeClass( 'is-desktop is-tablet' ).addClass( 'is-smartphone' )
        } else if( $( window ).width() <= 769 ) {
            selector.removeClass( 'is-desktop is-smartphone' ).addClass( 'is-tablet' )
        } else {
            selector.removeClass( 'is-smartphone is-tablet' ).addClass( 'is-desktop' )
        }
    }

    onlineNewspaperAddDeviceClass()
    $( window ).on("resize", function() {
        onlineNewspaperAddDeviceClass()
        let isDesktop = $( 'body' ).hasClass( 'is-desktop' )
        if( isDesktop ) {
            desktopHeaderHeight = $( 'header#masthead .bb-bldr--normal' ).outerHeight()
        } else {
            responsiveHeaderHeight = $( 'header#masthead .bb-bldr--responsive' ).outerHeight()
        }
        onlineNewspaperCalculateHeaderHeight()
    })

    var nrtl = false
    var ndir = "left"
    if ($('body').hasClass("rtl")) {
        nrtl = true;
        ndir = "right";
    };
    
    // theme trigger modal close
    function onlineNewspaperCloseModal( elm, callback ) {
        $(document).mouseup(function (e) {
            var container = $(elm);
            if (!container.is(e.target) && container.has(e.target).length === 0) callback();
        });
    }

    // ticker news slider events
    var tc = $( ".ticker-news-wrap" );
    if( tc.length ) {
        var tcSpeed = tc.data("speed") || 20000
        var tcM = tc.find( ".ticker-item-wrap" ).marquee({
            duration: tcSpeed,
            gap: 0,
            delayBeforeStart: 0,
            direction: ndir,
            duplicated: true,
            startVisible: true,
            pauseOnHover: true,
        });
        tc.on( "click", ".online-newspaper-ticker-pause", function() {
            $(this).find( "i" ).toggleClass( "fa-pause fa-play" )
            tcM.marquee( "toggle" );
        })
    }

    // top date time
    var timeElement = $( ".top-date-time .time" )
    if( timeElement.length > 0 ) {
        setInterval(function() {
            timeElement.html(new Date().toLocaleTimeString())
        },1000);
    }
    
    // search form and off canvas trigger
    $( "#masthead" ).on( "click", ".off-canvas-trigger", function() {
        // $(this).next().addClass('toggle_show');
        $(this).addClass('slideshow');
        $('body').addClass('off-canvas-active');
    });
    $( "#masthead" ).on( "click", ".off-canvas-trigger.slideshow, .sidebar-toggle .off-canvas-close", function() {
        $('.off-canvas-trigger').removeClass('slideshow');
        $('body').removeClass('off-canvas-active');
        $("#masthead .search-wrap").find(".search-results-wrap").remove()
        $("#masthead .search-wrap form").removeClass( 'results-loaded' )
    });


    /**
     * MARK: Search
     */
    const themeSearch = {
        init: function(){
            this.openSearch();
            this.closeSearch();
            onlineNewspaperOnElementOutsideClick(  "#masthead .search-trigger, #masthead .search-form-wrap", function(){
                $( 'body' ).removeClass( 'bodynoscroll' )
                $( '#masthead .search-form-wrap' ).slideUp()
                $( '#masthead .search-trigger' ).removeClass( 'hide' ).siblings( '.search-close-btn' ).addClass( 'hide' )
            })
            this.closePopupOnESCPress()
        },
        openSearch: function(){
            $( "#masthead" ).on( "click", ".search-trigger", function() {
                let _this = $( this );
                $( '#masthead .search-form-wrap' ).slideDown();
                _this.addClass( 'hide' )
                _this.siblings( '.search-close-btn' ).removeClass( 'hide' )
                $( '#masthead .search-form-wrap input[type="search"]' ).focus()
                $( 'body' ).addClass( 'bodynoscroll' )
            });
        },
        closeSearch: function(){
            $( "#masthead" ).on( "click", ".search-close-btn", function() {
                let _this = $( this )
                _this.addClass( 'hide' )
                $( '#masthead .search-form-wrap' ).slideUp()
                $( '#masthead .search-trigger' ).removeClass( 'hide' )
                $( 'body' ).removeClass( 'bodynoscroll' )
            });
        },
        closePopupOnESCPress: function(){
            $(document).on( 'keydown', function( event ) {
                if( event.keyCode == 27 && $( '#masthead .search-trigger' ).hasClass( 'hide' ) ) {
                    $( '#masthead .search-trigger' ).removeClass( 'hide' )
                    $( '#masthead .search-close-btn' ).addClass( 'hide' )
                    $( '#masthead .search-form-wrap' ).slideUp()
                    $( 'body' ).removeClass( 'bodynoscroll' )
                }
            });
        },
    }
    themeSearch.init()

    onlineNewspaperCloseModal( $( ".sidebar-toggle-wrap" ), function () {
        $( ".sidebar-toggle-wrap .off-canvas-trigger" ).removeClass( "slideshow" );
        $('body').removeClass('off-canvas-active');
    }); // trigger htsidebar close

    onlineNewspaperCloseModal( $( ".newsletter-popup-modal" ), function () {
        $( ".newsletter-popup-modal" ).removeClass( "open" );
        $("body").removeClass("newsletter-popup-active")
    }); // trigger header newsletter popup close

    // header newsletter popup handler
    var nPopup = $( ".newsletter-element" )
    if( nPopup.length > 0 ) {
        var nPopupType = nPopup.find( "a" ).data("popup")
        if( nPopupType == 'popup' ) {
            nPopup.on( "click", "a", function(e) {
                e.preventDefault()
                var _this = $(this)
                $("body").addClass("newsletter-popup-active")
                _this.next(".newsletter-popup-modal").addClass("open")
            })
        }
        $(document).on( "click", ".newsletter-popup-modal.open .modal-close", function () {
            $( ".newsletter-popup-modal" ).removeClass( "open" );
            $("body").removeClass("newsletter-popup-active")
        }); // trigger header newsletter popup close
    }

    // main banner slider events
    var bc = $( "#main-banner-section" );
    if( bc.length ) {
        var bic = bc.find( ".main-banner-slider" )
        var bAuto = bic.data( "auto" )
        var bArrows = bic.data( "arrows" )
        var bDots = bic.data( "dots" )
        var bSpeed = bic.data( "speed" )
        bic.slick({
            dots: bDots,
            infinite: true,
            rtl: nrtl,
            arrows: bArrows,
            autoplay: true,
            speed: bSpeed,
            nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
            prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
        });
    }

    // banner-tabs
    var bptc = bc.find( ".main-banner-tabs" )
    bptc.on( "click", ".banner-tabs li.banner-tab", function() {
        var _this = $(this), tabItem = _this.attr( "tab-item" );
        _this.addClass( "active" ).siblings().removeClass( "active" );
        bptc.find( '.banner-tabs-content div[tab-content="' + tabItem + '"]' ).addClass( "active" ).siblings().removeClass( "active" );
    })

    // main banner popular posts slider events
    var bpc = bc.find( ".popular-posts-wrap" );
    if( bpc.length ) {
        var bpcAuto = bpc.data( "auto" )
        var bpcArrows = bpc.data( "arrows" )
        var bpcVertical = bpc.data( "vertical" );
        if( bpcVertical) {
            bpc.slick({
                vertical: bpcVertical,
                slidesToShow: 5,
                dots: false,
                infinite: true,
                arrows: bpcArrows,
                autoplay: bpcAuto,
                nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
                prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
            })
        } else {
            bpc.slick({
                dots: false,
                infinite: true,
                arrows: bpcArrows,
                rtl: nrtl,
                draggable: true,
                autoplay: bpcAuto,
                nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
                prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
            })
        }  
    }

    // main banner layout five grid posts slider events
    var bpc = bc.find( ".main-banner-grid-posts .grid-posts-wrap" );
    if( bpc.length ) {
        bpc.slick({
            vertical: true,
            slidesToShow: 3,
            dots: false,
            infinite: true,
            arrows: true,
            autoplay: false,
            nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
            prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
        }) 
    }

    // news carousel events
    var nc = $( ".online-newspaper-section .news-carousel .news-carousel-post-wrap" );
    if( nc.length ) {
        nc.each(function() {
            var _this = $(this)
            var multiColumnSection = _this.parents('.online-newspaper-multi-column-section')
            var ncDots= _this.data("dots") == '1'
            var ncLoop= _this.data("loop") == '1'
            var ncArrows= _this.data("arrows") == '1'
            var ncAuto  = _this.data("auto") == '1'
            var ncColumns  = _this.data("columns")
            var ncColumnsTablet = 2
            if( multiColumnSection.length > 0 ) {
                ncColumnsTablet = 1
                ncColumns = 1
            }
            _this.slick({
                dots: ncDots,
                infinite: ncLoop,
                arrows: ncArrows,
                autoplay: ncAuto,
                rtl: nrtl,
                slidesToShow: ncColumns,
                nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
                prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
                responsive: [
                  {
                    breakpoint: 910,
                    settings: {
                      slidesToShow: ncColumnsTablet,
                    },
                  },
                  {
                    breakpoint: 640,
                    settings: {
                      slidesToShow: 1,
                    },
                  }
                ]
            });
        })
    }

    // popular posts widgets
    var ppWidgets = $( ".online-newspaper-widget-popular-posts" )
    ppWidgets.each(function() {
        var _this = $(this), parentWidgetContainerId = _this.parents( ".widget.widget_online_newspaper_popular_posts_widget" ).attr( "id" ), parentWidgetContainer = $( "#" + parentWidgetContainerId )
        var ppWidget = parentWidgetContainer.find( ".popular-posts-wrap" );
        if( ppWidget.length > 0 ) {
            var ppWidgetVertical = ppWidget.data( "vertical" )
            if( ppWidgetVertical == 'vertical' ) {
                ppWidget.slick({
                    vertical: true,
                    slidesToShow: 4,
                    dots: false,
                    infinite: true,
                    arrows: true,
                    autoplay: true,
                    nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
                    prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`
                })
            } else {
                ppWidget.slick({
                    dots: false,
                    infinite: true,
                    rtl: nrtl,
                    arrows: true,
                    autoplay: true,
                    nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
                    prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`
                })
            }  
        }
    })

    // carousel posts widgets
    var cpWidgets = $( ".online-newspaper-widget-carousel-posts" )
    cpWidgets.each(function() {
        var _this = $(this), parentWidgetContainerId = _this.parents( ".widget.widget_online_newspaper_carousel_widget" ).attr( "id" ), parentWidgetContainer
        if( typeof parentWidgetContainerId != 'undefined' ) {
            parentWidgetContainer = $( "#" + parentWidgetContainerId )
            var ppWidget = parentWidgetContainer.find( ".carousel-posts-wrap" );
        } else {
            var ppWidget = _this;
        }
        if( ppWidget.length > 0 ) {
            var ppWidgetVertical = ppWidget.data( "vertical" )
            if( ppWidgetVertical == 'vertical' ) {
                ppWidget.slick({
                    vertical: true,
                    dots: false,
                    infinite: true,
                    arrows: true,
                    autoplay: true,
                    nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
                    prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`
                })
            } else {
                ppWidget.slick({
                    dots: false,
                    infinite: true,
                    rtl: nrtl,
                    arrows: true,
                    autoplay: true,
                    adaptiveHeight: true,
                    nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
                    prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`
                })
            }  
        }
    })

    // tabbed posts
    var tabpWidgets = $( ".online-newspaper-tabbed-widget-tabs-wrap" )
    tabpWidgets.each(function() {
        var _this = $(this), parentWidgetContainerId = _this.parents( ".widget.widget_online_newspaper_tabbed_posts_widget" ).attr( "id" ), parentWidgetContainer
        if( typeof parentWidgetContainerId != 'undefined' ) {
            parentWidgetContainer = $( "#" + parentWidgetContainerId )
            var tabpWidget = parentWidgetContainer.find( ".online-newspaper-tabbed-widget-tabs-wrap" );
        } else {
            var tabpWidget = _this;
        }
        if( tabpWidget.length > 0 ) {
            tabpWidget.on( "click", ".tabbed-widget-tabs li.tabbed-widget", function() {
                var _this = $(this), tabItem = _this.attr( "tab-item" );
                _this.addClass( "active" ).siblings().removeClass( "active" );
                tabpWidget.find( '.widget-tabs-content div[tab-content="' + tabItem + '"]' ).addClass( "active" ).siblings().removeClass( "active" );
            })
        }
    })

    // news filter tabbed posts
    var nftabpWidgets = $( ".online-newspaper-news-filter-tabbed-widget-tabs-wrap" )
    nftabpWidgets.each(function() {
        var _this = $(this), parentWidgetContainerId = _this.parents( ".widget.widget_online_newspaper_news_filter_tabbed_widget" ).attr( "id" ), parentWidgetContainer
        if( typeof parentWidgetContainerId != 'undefined' ) {
            parentWidgetContainer = $( "#" + parentWidgetContainerId )
            var nftabpWidget = parentWidgetContainer.find( ".online-newspaper-news-filter-tabbed-widget-tabs-wrap" );
        } else {
            var nftabpWidget = _this;
        }
        if( nftabpWidget.length > 0 ) {
            nftabpWidget.on( "click", ".widget-tabs li.widget-tab", function() {
                var _this = $(this), tabItem = _this.attr( "tab-item" );
                _this.addClass( "active" ).siblings().removeClass( "active" );
                nftabpWidget.find( '.tabs-content-wrap div.tabs-content.' + tabItem ).addClass( "show" ).siblings().removeClass( "show" );
            })
        }
    })

    /**
     * MARK: Theme Mode
     */
    if( localStorage.getItem( "themeMode" ) != null ) {
        if( localStorage.getItem("themeMode") == "dark" ) {
            $( 'body' ).addClass( 'online-newspaper-dark-mode' ).removeClass( 'online-newspaper-light-mode ')
        } else {
            $( 'body' ).addClass( 'online-newspaper-light-mode' ).removeClass( 'online-newspaper-dark-mode' )
        }
    }
    const themeModeContainer = $( '#masthead .mode-toggle-wrap' )
    if( themeModeContainer.length > 0 ) {
        themeModeContainer.on( 'click', function(){
            var _this = $(this), bodyElement = $( 'body' )
            if( bodyElement.hasClass( 'online-newspaper-dark-mode' ) ) {
                localStorage.setItem( 'themeMode', 'light' )
                bodyElement.removeClass( 'online-newspaper-dark-mode' ).addClass( 'online-newspaper-light-mode' )
            } else {
                localStorage.setItem( 'themeMode', 'dark' )
                bodyElement.removeClass( 'online-newspaper-light-mode' ).addClass( 'online-newspaper-dark-mode' )
            }
        })
    }

    // back to top script
    var scrollContainer = $( "#online-newspaper-scroll-to-top" );
    if( sttOption && scrollContainer.length ) {
        $( window ).scroll(function() {
            if ( $( this ).scrollTop() > 800 ) {
                scrollContainer.addClass( 'show' );
            } else {
                scrollContainer.removeClass( 'show' );
            }
        });
        scrollContainer.click(function( event ) {
            event.preventDefault();
            // Animate the scrolling motion.
            $( "html, body" ).animate({ scrollTop: 0 }, "slow" );
        });
    }

    // back to top script
    var headerAdsBannerContainer = $( "#masthead .ads-banner" );
    if( headerAdsBannerOption && headerAdsBannerContainer.length ) {
        $( window ).scroll(function() {
            if ( $( this ).scrollTop() > 800 ) {
                headerAdsBannerContainer.addClass( 'show' );
            } else {
                headerAdsBannerContainer.removeClass( 'show' );
            }
        });
        headerAdsBannerContainer.click(function( event ) {
            event.preventDefault();
            // Animate the scrolling motion.
            $( "html, body" ).animate({ scrollTop: 0 }, "slow" );
        });
    }

    // category archive hide featured post in list
    var featuredPost = $( ".archive.category .featured-post.is-sticky" )
    if( featuredPost.length > 0 ) {
        var postHide = "#post-" + featuredPost.data("id")
        $(postHide).addClass( "sticky-hide" );
    }

    // ads slide block
    var adsSliderContainer = $(".ads-banner.ads-banner-slider")
    if( adsSliderContainer.length > 0 ) {
        adsSliderContainer.slick({
            dots: false,
            infinite: true,
            rtl: nrtl,
            vertical: false,
            arrows: true,
            autoplay: true,
            nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
            prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
        })
    }

    // ads slider widget
    var adsSliderWidget = $(".widget_online_newspaper_ads_slider_widget .online-newspaper-advertisement-block")
    if( adsSliderWidget.length > 0 ) {
        adsSliderWidget.slick({
            dots: false,
            infinite: true,
            rtl: nrtl,
            vertical: false,
            arrows: true,
            autoplay: true,
            nextArrow: `<button type="button" title="${ slickNext }" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
            prevArrow: `<button type="button" title="${ slickPrev }" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
        })
    }

    // post format - gallery
    var gallery = $('.wp-block-gallery')
    if( gallery.length > 0 ) {
        gallery.each(function(){
            var _this = $(this)
            var findImageSrc = _this.find('.wp-block-image img')
            var srcArgs = []
            findImageSrc.each(function(){
                srcArgs.push({
                    src: $(this).attr('src'),
                    type: 'image'
                })
            })
            _this.magnificPopup({
                items: srcArgs,
                gallery: {
                    enabled: true
                },
                type: 'image'
            })
        })
    }

    // news filter burger
    var newsFilterContainer = $('.news-filter')
    if( newsFilterContainer.length > 0 ) {
        newsFilterContainer.each(function(){
            $(this).on('click', '.online-newspaper-burger', function(){
                var _this = $(this)
                _this.siblings().toggleClass('isactive')
            })
        })
    }

    /**
     * MARK: Cursor Animation
     */
    var cursorContainer = $('.online-newspaper-cursor')
    if( cursorContainer.length > 0 ) {
        $(document).on( 'mousemove', function( event ){
            cursorContainer.css({
                'top': 'calc('+ event.clientY +'px - 15px)',
                'left': 'calc('+ event.clientX +'px - 15px)'
            })
        })
        var selector = 'a, button, input[type="submit"], #online-newspaper-scroll-to-top .icon-text, #online-newspaper-scroll-to-top .icon-holder, .pagination .ajax-load-more, .online-newspaper-widget-loader .load-more, .blaze-switcher-button, .online-newspaper-canvas-menu .canvas-menu-icon, .online-newspaper-table-of-content .toc-fixed-icon, .online-newspaper-social-share .social-share'
        $( selector ).on( 'mouseover', function(){
            $( cursorContainer ).addClass( 'isActive' )
        })
        $( selector ).on( 'mouseout', function(){
            $( cursorContainer ).removeClass( 'isActive' )
        })
    }

    /**
     * Responsive header builder toggle button
     * 
     * @since 1.0.0
     */
    var responsiveHeaderBuilderWrapper = $('.bb-bldr--responsive')
    if( responsiveHeaderBuilderWrapper.length > 0 ) {
        let toggleButton = responsiveHeaderBuilderWrapper.find( '.toggle-button-wrapper' )
        toggleButton.on("click", function() {
            let _this = $(this)
            _this.parents( '.row-wrap' ).siblings( '.bb-bldr-row.mobile-canvas' ).toggleClass( 'open' )
        })
    }

    /**
     * Header Sticky
     */
    const { headerSticky } = onlineNewspaperObject
    if( headerSticky ) {
        let lastScroll = 0,
            sidebarSelector = $( 'aside#secondary.widget-area' ),
            allStickyRows = $( 'header#masthead .row-sticky' ),
            dynamicTopValue = 0
            allStickyRows.each(function(){
                let _this = $( this )
                dynamicTopValue += _this.outerHeight()
            })
        if( isLoggedIn ) dynamicTopValue += wpadminbar
        $( window ).on('scroll',function() {
            onlineNewspaperCalculateHeaderHeight()
            let scroll = $( this ).scrollTop(),
                mainHeaderContainer = $('body header.site-header')

            if( $( 'header#masthead' ).hasClass( 'fixed--on' ) && $( 'body' ).hasClass( 'online-newspaper-sticky-sidebar--enabled' ) ) {
                sidebarSelector.css({
                    'top': `${ dynamicTopValue }px`
                })
            } else {
                sidebarSelector.css({
                    'top': ( isLoggedIn ) ? `${ wpadminbar }px` : '0px'
                })
            }
            if( scroll >= 200 ) {
                mainHeaderContainer.addClass( 'header-sticky--enabled' ).removeClass( 'header-sticky--disabled' )
            } else {
                mainHeaderContainer.addClass( 'header-sticky--disabled' ).removeClass( 'header-sticky--enabled' )
            }

            if( scroll > 50 ) {
                if ( scroll > lastScroll ) {
                    /* Scrolling Down */
                    mainHeaderContainer.addClass( 'fixed--on' ).removeClass( 'fixed--off' )
                } else {
                    /* Scrolling UP */
                    mainHeaderContainer.removeClass( 'fixed--on' ).addClass( 'fixed--off' )
                }
                lastScroll = scroll
            } else {
                $( mainHeaderContainer ).addClass("header-sticky--disabled fixed--off").removeClass( 'fixed--on' );
            }
        });
    }

    /**
     * Mark: Progress Bar
     */
    const progressBar = {
        init: function() {
            this.scrollEvent()
        },
        selectors: {
            'single-progress': {
                'selector': 'body.page .single-progress, body.single .single-progress, body.archive .single-progress, body.search .single-progress',
                'property': 'width',
                'usesBackground': false
            }
        },
        totalScrollableArea: $('body')[0].clientHeight,
        sizeOfScrollBar: window.innerHeight,
        scrollEvent: function() {
            let self = this
            $(window).on("scroll", function(){
                let scrollBarPosition = window.scrollY
                if( scrollBarPosition < 1 ) {   /* Hide when Top is reached */
                    $( self.selectors['single-progress'].selector ).hide()
                } else {
                    $( self.selectors['single-progress'].selector ).show()
                }
                let width = self.getWidth( scrollBarPosition )
                if( self.isBottom() ) width = 100   /* Run when bottom is reached */
                let background = `conic-gradient(${ themeColor } ${ width }%, transparent ${ width }%)`
                Object.entries( self.selectors ).forEach(( current ) => {
                    const [ ID, selectorValues ] = current
                    const { selector, property, usesBackground } = selectorValues
                    if( usesBackground ) {
                        $( selector ).attr( 'style', property + ': ' + background )
                    } else {
                        $( selector ).css( property, width + '%' )
                    }
                })
            })
        },
        getWidth: function( scrollBarPosition ) {
            let width = ( ( ( scrollBarPosition + this.sizeOfScrollBar ) / this.totalScrollableArea ) * 100 )
            return Math.round( width );
        },
        isBottom: function() {
            if ( $(window).scrollTop() + $(window).height() >= $(document).height()) return true
        }
    }
    progressBar.init()
})
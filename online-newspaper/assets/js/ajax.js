(function( $ ){
    const { ajaxUrl, _wpnonce, isRtl, slickPrev, slickNext } = onlineNewspaperAjaxObject

    /**
     * MARK: Initialize Slick js
     * 
     * @since 1.0.0
     */
    const onlineNewspaperInitializeSlick = ( props, returnInstance = false ) => {
        let { responsive = [], dots = false, arrows = true, fade = false, infinite = true, speed = 300, autoplay = false, autoplaySpeed = 3000, slidesToShow = 1, slidesToScroll = 1, prevIcon = 'fa-solid fa-angle-left', nextIcon = 'fa-solid fa-angle-right', focusOnSelect = false, selector, ...remains } = props,
        slickObject = {
            dots,
            arrows,
            infinite,
            speed,
            autoplay,
            autoplaySpeed,
            slidesToShow,
            slidesToScroll,
            fade,
            focusOnSelect,
            rtl: isRtl === '1' ? true : false,
            prevArrow: `<button type="button" title="${ slickPrev }" class="slick-test-arrow slick-prev"><i class="${ prevIcon }"></i></button>`,
            nextArrow: `<button type="button" title="${ slickNext }" class="slick-test-arrow slick-next"><i class="${ nextIcon }"></i></button>`,
            responsive: [
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 940,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 1,
                    },
                }
            ],
            ...remains
        }
        if( ! responsive ) slickObject.responsive = []
        let slickInstance = $( selector ).slick( slickObject )
        if( returnInstance ) return slickInstance;
    }

    // on element outside click function
    function onlineNewspaperOnElementOutsideClick( currentElement, callback ) {
        $( document ).mouseup(function( e ) {
            var container = $( currentElement );
            if ( ! container.is( e.target ) && container.has( e.target ).length === 0 ) callback();
        })
    }

    /**
     * Nonce manager
     * to prevent nonce from going state when a cache plugin is used
     * that caches the site and when an ajax call is triggered nonce has
     * already expired causing 403(forbidden) when ajax is called.
     * 
     * @since 1.0.6
     */
    const NonceManager = {
        /**
         * Current nonce
         * 
         * @since 1.0.6
         */
        nonce: null,
        /**
         * Get a fresh new nonce
         * 
         * @since 1.0.6
         */
        getNonce: function() {
            let self = this
            return new Promise( resolve => {
                if( self.nonce ) {
                    resolve( self.nonce )
                    return
                }
                $.post( ajaxUrl, { action: 'online_newspaper_get_nonce' }, function( res ) {
                    if( res.success ) {
                        self.nonce = res.data.nonce
                        resolve( self.nonce )
                    }
                })
            })
        }
    }

    // Filter posts
     $( ".online-newspaper-section .news-filter" ).each(function() {
        var $scope = $(this), $scopeOptions = $scope.data("args"), newTabs = $scope.find( ".filter-tab-wrapper" ), newTabsContent = $scope.find( ".filter-tab-content-wrapper" );
        newTabs.on( "click", ".tab-title", function() {
          var a = $(this), aT = a.data("tab"), isLayoutFiveOrSix = a.parents().is( '.layout--five, .layout--six' )
          a.addClass( "isActive" ).siblings().removeClass( "isActive" );
          if( newTabsContent.find( ".tab-content.content-" + aT ).length < 1 ) {
            $scopeOptions.category_id = aT
            NonceManager.getNonce().then(function( nonce ){
                $.ajax({
                    method: 'get',
                    url: ajaxUrl,
                    data: {
                        action: ( ! isLayoutFiveOrSix ? 'online_newspaper_filter_posts_load_tab_content' : 'online_newspaper_filter_layout_five_posts_load_tab_content' ),
                        options : JSON.stringify( $scopeOptions ),
                        _wpnonce: nonce
                    },
                    beforeSend: function() {
                        $scope.addClass( 'retrieving-posts' );
                    },
                    success : function(res) {
                        if( res.data.loaded ) {
                            newTabsContent.append( res.data.posts )
                            $scope.removeClass( 'retrieving-posts' );
                        }
                    },
                    complete: function() {
                        newTabsContent.find( ".tab-content.content-" + aT ).show().siblings().hide()
                    }
                })
            })
          } else {
            newTabsContent.find( ".tab-content.content-" + aT ).show().siblings().hide()
          }
        })
    })

    /**
     * MARK: Web Stories
     */
    const WebStories = {
        container: $( '.online-newspaper-web-stories' ),
        activeStoryId: null,
        allStoryIds: [],
        activeStoryCount: null,
        storiesWrap: $( '.online-newspaper-web-stories .stories-wrap' ),
        innerStories: $( '.online-newspaper-web-stories .inner-stories-wrap .inner-stories' ),
        actionButtons: $( '.online-newspaper-web-stories .action-buttons' ),
        isPaused: false,
        outsideClickEnabled: false,
        init: function(){
            if( this.container.length ) {
                this.outsideClickEnabled = this.container.hasClass( 'outside-click--enabled' )
                this.countClick();
                this.storyClick();
                this.close();
                this.pause();
                this.scrollButtons();
                this.closePopupOnESCPress();
                $( 'body' ).css({
                    '--expandWidth-timer': `${ 5000 / 1000 }s`
                })
                let self = this
                this.container.find( '.story' ).each(function(){
                    let _this = $( this )
                    self.allStoryIds = [ ...self.allStoryIds, _this.data( 'id' ) ]
                })
            }
        },
        countClick: function(){
            this.container.on( 'click', '.story .story-count', function( event ) {
                event.stopPropagation()
            })
        },
        storyClick: function() {
            let self = this
            this.container.on( 'click', '.story', function() {
                let _this = $( this ),
                    storyId = _this.data( 'id' ),
                    count = _this.data( 'count' )
                
                self.innerStories.parent().addClass( `cat-${ storyId }` )
                $( 'body' ).addClass( 'web-stories--open' )
                self.activeStoryId = storyId
                self.activeStoryCount = count
                if( ! self.container.hasClass( 'added' ) ) {
                    self.ajaxCall();
                } else {
                    onlineNewspaperInitializeSlick({
                        selector: self.storiesWrap,
                        arrows: true,
                        fade: true,
                        infinite: true,
                        appendArrows: self.container.find( '.story-arrows' ),
                        pauseOnFocus: false,
                        pauseOnHover: false
                    })
                    self.innerStories.parent().addClass( 'open' )
                    let storyWrap = self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` )
                    self.initSecondarySlider( storyWrap );
                    self.addAmbient( storyWrap.find( '.story-cover img' ) )
                    self.actionButtons.appendTo( storyWrap.parent() )
                    self.container.find( '.story-arrows' ).appendTo( storyWrap.parent() )
                    self.container.addClass( 'added' )
                }
                self.afterChange();
                if( _this.is( ':first-child' ) ) {
                  self.container.find( '.slider-arrow.prev' ).addClass( 'disabled' )
                } else {
                    self.container.find( '.slider-arrow.prev' ).removeClass( 'disabled' )
                }
                if( _this.is( ':last-child' ) ) {
                    self.container.find( '.slider-arrow.next' ).addClass( 'disabled' )
                } else {
                    self.container.find( '.slider-arrow.next' ).removeClass( 'disabled' )
                }
            });
        },
        afterChange: function(){
            let self = this
            self.storiesWrap.on( 'afterChange', function( a, slick, currentSlide ){
                let slide = $( slick.$slides.get( currentSlide ) )
                self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` ).slick( 'unslick' )
                self.activeStoryId = slide.data( 'id' )
                let storyWrap = self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` )
                self.initSecondarySlider( storyWrap );
                self.actionButtons.appendTo( storyWrap.parent() )
                self.container.find( '.story-arrows' ).appendTo( storyWrap.parent() )
                self.innerStories.parent().removeClass(( index, className ) => {
                    return ( className.match( /\bcat-\S+/g ) || [] ).join( ' ' )
                }).addClass( `cat-${ self.activeStoryId }` )
                if( currentSlide === 0 ) {
                    self.container.find( '.slider-arrow.prev' ).addClass( 'disabled' )
                } else {
                    self.container.find( '.slider-arrow.prev' ).removeClass( 'disabled' )
                }

                if( currentSlide === ( slick.slideCount - 1 ) ) {
                    self.container.find( '.slider-arrow.next' ).addClass( 'disabled' )
                } else {
                    self.container.find( '.slider-arrow.next' ).removeClass( 'disabled' )
                }
                self.afterLastSlide()
                self.addAmbient( storyWrap.find( '.story-cover img' ) )
            })
        },
        afterLastSlide: function(){
            let self = this
            self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` ).on( 'afterChange', function( a, slick, currentSlide ){
                let isLastSlide = ( currentSlide === ( slick.slideCount - slick.options.slidesToShow ) ),
                    slide = $( slick.$slides.get( currentSlide ) )
                if( slide.hasClass( 'no-thumb' ) ) {
                    slide.parents( '.inner-story' ).addClass( 'no-thumb' )
                } else {
                    slide.parents( '.inner-story' ).removeClass( 'no-thumb' )
                }
                self.addAmbient( slide.find( '.story-cover img' ) )
                if( isLastSlide ) {
                    setTimeout(() => {
                        self.storiesWrap.slick( 'slickNext' )
                    }, 5000 - 600 );
                }
            })
        },
        /**
         * fetch stories
         * 
         * @param { string } nonce A brand new and fresh nonce
         * @since 1.0.6
         */
        ajaxCall: function( nonce ){
            let self = this
            NonceManager.getNonce().then(function( nonce ){
                $.ajax({
                    method: 'POST',
                    url: ajaxUrl,
                    data: {
                        action: 'online_newspaper_stories_ajax_call',
                        _wpnonce: nonce,
                        storyIds: self.allStoryIds,
                        count: self.activeStoryCount
                    },
                    beforeSend: function() {
                        self.storiesWrap.addClass( 'retrieving-stories' )
                    },
                    success: function( result ) {
                        let { success, data } = result
                        if( success ) {
                            onlineNewspaperInitializeSlick({
                                selector: self.storiesWrap,
                                arrows: true,
                                fade: true,
                                infinite: true,
                                appendArrows: self.container.find( '.story-arrows' ),
                                pauseOnFocus: false,
                                pauseOnHover: false
                            })
                            self.innerStories.append( data )
                            let storyWrap = self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` ),
                                storyCover = storyWrap.find( '.story-cover img' )
                            self.addAmbient( storyCover[ 0 ] ) 
                            self.initSecondarySlider( storyWrap );
                            self.afterLastSlide();
                            self.actionButtons.appendTo( storyWrap.parent() )
                            self.container.find( '.story-arrows' ).appendTo( storyWrap.parent() )
                            self.container.addClass( 'added' )
                            self.innerStories.parent().addClass( 'open' )
                        }
                    },
                    complete: function() {
                        self.storiesWrap.removeClass( 'retrieving-stories' )
                    }
                })
            })
        },
        close: function(){
            let self = this
            self.container.find( '.action-btn.close' ).on( 'click', function(){
                $( 'body' ).removeClass( 'web-stories--open' )
                self.innerStories.parent().removeClass( 'open' )
                self.storiesWrap.slick( 'unslick' )
                self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` ).slick( 'unslick' )
                self.container.find( '.ambient-wrapper' ).css({
                    'background-image': ''
                })
                self.container.find( '.action-btn.pause' ).removeClass( 'paused' )
                self.activeStoryId =  null
                self.allStoryIds =  []
                self.activeStoryCount =  null
                self.innerStories.parent().removeClass(function(index, className) {
                    return (className.match(/\bcat-[^\s]+/g) || []).join(' ');
                });
                self.storiesWrap.find( '.story' ).removeAttr( 'style' )
                self.container.find( '.action-btn' ).addClass( 'pause' )
                self.container.find( '.action-btn i' ).removeClass( 'fa-play' ).addClass( 'fa-pause' )
            })
        },
        pause: function(){
            let self = this
            self.container.find( '.action-btn.pause' ).on( 'click', function(){
                let _this = $( this )
                _this.find( 'i' ).toggleClass( 'fa-pause fa-play' )
                _this.toggleClass( 'paused' )
                self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` ).slick( _this.hasClass( 'paused' ) ? 'slickPause' : 'slickPlay' )
            })
        },
        initSecondarySlider: function( selector ) {
            $( selector ).slick({
                autoplay: true,
                arrows: true,
                fade: true,
                infinite: false,
                autoplaySpeed: 5000,
                speed: 300,
                dots: true,
                customPaging: function(slider, i) {
                    return `<button></button>`;
                },
                pauseOnFocus: false,
                pauseOnHover: false,
                prevArrow: `<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>`,
                nextArrow: `<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>`,
                rtl: isRtl === '1' ? true : false,
            })
        },
        /* Add ambient */
        addAmbient: function( imageTag ) {
            let storyImage = $( imageTag ).attr( 'src' );

            this.container.find( '.ambient-wrapper' ).css({
                'background-image': 'url('+ storyImage +')'
            })
        },
        /* Close Popup on ESC Button Press */
        closePopupOnESCPress: function(){
            let self = this
            $(document).on( 'keydown', function( event ) {
                if( event.keyCode == 27 ) {
                    $( 'body' ).removeClass( 'web-stories--open' )
                    self.innerStories.parent().removeClass( 'open' )
                    self.storiesWrap.slick( 'unslick' )
                    self.innerStories.find( `.inner-story-wrap[data-id="${ self.activeStoryId }"]` ).slick( 'unslick' )
                    self.container.find( '.action-btn.pause' ).removeClass( 'paused' )
                    self.activeStoryId =  null
                    self.allStoryIds =  []
                    self.activeStoryCount =  null
                    self.innerStories.parent().removeClass(function(index, className) {
                        return (className.match(/\bcat-[^\s]+/g) || []).join(' ');
                    });
                    self.storiesWrap.find( '.story' ).removeAttr( 'style' )
                    self.container.find( '.action-btn' ).addClass( 'pause' )
                    self.container.find( '.action-btn i' ).removeClass( 'fa-play' ).addClass( 'fa-pause' )
                }
            });
        },
        /* Scroll Button Handles */
        scrollButtons: function() {
            let self = this
            self.container.on( 'click', '.scroll-button', function(){
                let _this = $( this ),
                    leftButton = _this.hasClass( 'left' ),
                    rightButton = _this.hasClass( 'right' ),
                    storiesWrap = _this.siblings( '.stories-wrap' ),
                    sign = '-'
                if( leftButton ) sign = '-'
                if( rightButton ) sign = '+'
                storiesWrap.animate({
                    scrollLeft: `${ sign }=100`
                })
            })
        }
    }
    WebStories.init();
    
    /**
     * MARK: Sticky Posts
     */
    const StickyPosts = {
        container: $( '.online-newspaper-sticky-posts' ),
        init: function() {
            if( this.container.length ) {
                this.click()
                this.zIndex()
            }
        },
        click: function(){
            let self = this
            this.container.on( 'click', '.indicator.active', function(){
                let _this = $( this )
                _this.removeClass( 'active' ).siblings().addClass( 'active' )
                _this.parent().siblings( '.post.append' ).toggleClass( 'hide' )
                if( ! _this.parents( '.post-list' ).hasClass( 'added' ) ) self.ajaxCall()
            })
        },
        /* Adding z-index */
        zIndex: function(){
            let initialZindex = this.container.find( '.post' ).length
            this.container.find( '.post' ).each(function(){
                let _this = $( this )
                _this.css({
                    'z-index': initialZindex--
                })
            })
        },
        ajaxCall: function(){
            let self = this
            NonceManager.getNonce().then(function( nonce ){
                $.ajax({
                    method: 'POST',
                    url: ajaxUrl,
                    data: {
                        action: 'online_newspaper_sticky_posts_ajax_call',
                        _wpnonce: nonce
                    },
                    beforeSend: function() {
                        self.container.find( '.post-list' ).addClass( 'retrieving-stories' )
                    },
                    success: function( result ) {
                        let { success, data } = result
                        if( success ) {
                            self.container.find( '.post:last' ).after( data )
                            self.container.find( '.post-list' ).addClass( 'added' )
                            self.zIndex()
                        }
                    },
                    complete: function() {
                        self.container.find( '.post-list' ).removeClass( 'retrieving-stories' )
                    }
                })
            })
        }
    }
    StickyPosts.init()

    /**
     * MARK: SEARCH QUERY
     */
    const SearchQuery = {
        container: $( 'body.search .filter-wrapper' ),
        query: {
            'post_type': [],
            'post_status': 'publish',
            'category__in': [],
            'tag__in': [],
            's': '',
            'author__in': [],
            'date_query': {
                'relation': 'OR',
            },
            'after': {
                'after': '',
                'inclusive': true
            },
            'before': {
                'before': '',
                'inclusive': true
            },
            'paged': 1
        },
        clickedButton: 'filter',
        hasQueryChanged: false,
        init: function() {
            if( this.container.length ) {
                let datePickerObj = {
                    changeMonth: true,  // adds month dropdown
                    changeYear: true,   // adds year dropdown
                    yearRange: "1900:2050", // optional: limit years,
                    dateFormat: "M dd, y",
                    monthNamesShort: [
                        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                    ]
                }
                this.container.find( '#before' ).datepicker( datePickerObj )
                this.container.find( '#after' ).datepicker( datePickerObj )
                this.filterClick()
                this.headClick()
                this.checkboxChange()
                this.datepickerChange()
                this.loadMoreClick()
                this.checkboxClear()
                this.clearSearchQuery()
            }
        },
        filterClick: function() {
            let self = this
            this.container.on( 'click', '.filter-button', function(){
                if( ! self.hasQueryChanged ) return
                let _this = $( this ),
                    searchField = _this.parent().siblings( '.page-header' ).find( '.online-newspaper-search-page .search-form .search-field' ),
                    searchValue = searchField.val()

                self.clickedButton = 'filter'
                self.query.s = searchValue
                self.query.paged = 1
                self.ajaxCall()
                if( self.hasQueryChanged ) {
                    self.hasQueryChanged = false
                    _this.addClass( 'disabled' )
                }
            })
        },
        ajaxCall: function() {
            let self = this,
                contentWrap = self.container.siblings( '.post-inner-wrapper' ).find( '.news-list-wrap ' ),
                hasLoadedClass = contentWrap.hasClass( 'loaded' ),
                loadMoreButton = contentWrap.siblings( '.pagination' ).find( '.ajax-load-more' )
            NonceManager.getNonce().then(function( nonce ){
                $.ajax({
                    method: 'POST',
                    url: ajaxUrl,
                    data: {
                        action: 'online_newspaper_search_page_ajax_call',
                        _wpnonce: nonce,
                        query: self.query,
                        clickedButton: self.clickedButton
                    },
                    beforeSend: function() {
                        contentWrap.addClass( 'retrieving-posts' )
                        loadMoreButton.text( 'Retrieving posts...' )
                    },
                    success: function( result ) {
                        let { success, data } = result
                        if( self.clickedButton === 'filter' ) contentWrap.empty()
                        if( ! success ) {
                            let { message } = data
                            self.container.siblings().find( '.pagination' ).find( '.ajax-load-more' ).hide()
                            self.container.siblings().find( '.news-list-wrap' ).append( message )
                        } else {
                            contentWrap.append( data )
                            self.container.siblings().find( '.pagination' ).find( '.ajax-load-more' ).show()
                            self.container.siblings().find( '.pagination' ).find( '.failure-message' ).remove()
                        }
                    },
                    complete: function() {
                        contentWrap.removeClass( 'retrieving-posts' )
                        if( ! hasLoadedClass ) contentWrap.addClass( 'loaded' )
                        loadMoreButton.text( 'Load More' )
                    }
                })
            })
        },
        headClick: function(){
            let self = this
            this.container.on( 'click', '.filter .head', function(){
                let _this = $( this )
                self.toggleClass( _this )
            })
        },
        checkboxChange: function() {
            let self = this
            this.container.on( 'change', '.filter .body .item input[type="checkbox"]', function(){
                let _this = $( this ),
                    value = _this.val(),
                    isChecked = _this.is( ':checked' ),
                    parent = _this.parents( '.filter' ),
                    isType = parent.hasClass( 'type' ),
                    isAuthor = parent.hasClass( 'authors' ),
                    isCategory = parent.hasClass( 'categories' ),
                    isTag = parent.hasClass( 'tags' ),
                    param = ''

                if( ! self.hasQueryChanged ) {
                    self.hasQueryChanged = true
                    parent.siblings( '.filter-button' ).removeClass( 'disabled' )
                    parent.siblings( '.clear-button' ).removeClass( 'disabled' )
                }
                if( isType ) {
                    param = 'post_type'
                } else if( isAuthor ) {
                    param = 'author__in'
                } else if( isCategory ) {
                    param = 'category__in'
                } else if( isTag ) {
                    param = 'tag__in'
                }

                if( isChecked ) {
                    self.query[ param ] = [ ...self.query[ param ], value ]
                } else {
                    self.query[ param ] = self.query[ param ].filter( item => item !== value );
                }
            })
        },
        datepickerChange: function() {
            let self = this
            this.container.on( 'change focus', '.filter input[type="text"]', function(){
                let _this = $( this ),
                    value = _this.val(),
                    parent = _this.parent(),
                    isBefore = parent.hasClass( 'before' ),
                    isAfter = parent.hasClass( 'after' ),
                    param = ''

                if( ! self.hasQueryChanged ) {
                    self.hasQueryChanged = true
                    parent.siblings( '.filter-button' ).removeClass( 'disabled' )
                    parent.siblings( '.clear-button' ).removeClass( 'disabled' )
                }

                if( isBefore ) {
                    param = 'before'
                } else if( isAfter ) {
                    param = 'after'
                }

                self.query[ param ] = { ...self.query[ param ], [ param ]: value }

                self.toggleClass( _this )
            })
        },
        toggleClass: function( _this ) {
            let parent = _this.parents( '.filter' )
            parent.toggleClass( 'active' )
            parent.siblings( '.filter' ).removeClass( 'active' )
            onlineNewspaperOnElementOutsideClick( _this.parents( '.filter-wrapper' ), function(){
                parent.removeClass( 'active' )
            })
        },
        loadMoreClick: function() {
            let self = this
            this.container.siblings().find( '.pagination' ).on( 'click', '.ajax-load-more', function() {
                self.query.paged++
                self.clickedButton = 'load-more'
                self.ajaxCall()
            })
        },
        checkboxClear: function() {
            this.container.on( 'click', '.filter .clear', function() {
                let _this = $( this )
                _this.siblings().find( 'input[type="checkbox"]' ).prop( 'checked', false )
            })
        },
        clearSearchQuery: function() {
            this.container.on( 'click', '.clear-button', function() {
                let _this = $( this )
                if( _this.hasClass( 'disabled' ) ) return
                location.reload()
            })
        }
    }
    SearchQuery.init()
})( jQuery )
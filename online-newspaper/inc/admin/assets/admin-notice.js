jQuery(document).ready(function( $ ){
    var ajaxUrl = onlineNewspaperNoticeOject.ajaxUrl, _wpnonce = onlineNewspaperNoticeOject._wpnonce
    var welcomeOption = onlineNewspaperNoticeOject.welcomeOption

    var noticeContainer = $('.online-newspaper-admin-notice')
    if( noticeContainer.length > 0 ) {
        // dismiss notice
        noticeContainer.on('click', '.alert-dismiss, .action-button.review-never, .action-button.already-reviewed', function(){
            var _this = $(this), notice
            if( _this.parents('.online-newspaper-admin-notice').hasClass( 'online-newspaper-welcome-notice' ) ) notice = welcomeOption
            $.ajax({
                url: ajaxUrl,
                method: "POST",
                data: {
                    "action": 'online_newspaper_admin_notice_ajax_call',
                    "_wpnonce": _wpnonce,
                    "dismiss_option": notice
                },
                beforeSend: function(){
                    _this.text( 'Dismissing...' )
                },
                success: function( result ) {
                    var parsedResult = JSON.parse( result )
                    if( parsedResult.status ) _this.parents( '.online-newspaper-admin-notice' ).fadeOut()
                },
                complete: function() {
                    _this.text( 'Dismissed' )
                }
            })
        })
    }
})
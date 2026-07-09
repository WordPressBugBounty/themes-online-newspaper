jQuery(document).ready(function($) {
    "use strict"
    var container = $("#online-newspaper-post-metabox")
    if( container.length > 0 ) {
        container.on( "click", ".radio-image-field .radio-field", function() {
            var _this = $(this), fieldVal = _this.data("value")
            _this.addClass("selected").siblings().removeClass("selected")
            _this.parent().next().val(fieldVal)
        })
    }
})
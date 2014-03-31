/**
 * Simple affix wrapper.
 */
;(function($, window, undefined) {
    $.fn.affixTop = function() {
        return this.each(function() {
            var element = $(this);

            element.width(element.parent().outerWidth());
            element.affix({offset: {top: element.offset().top, bottom: 0}});
        });
    };
})(jQuery, this);
/**
 * ArgonBook game character skill level.
 */
;(function($, window, undefined) {
    $.fn.skillLevel = function(experience, available) {
        var elements = this;

        function updateTotal() {
            var total = 0;

            elements.each(function() {
                var element = $(this);
                var level   = element.val() === "" ? 0 : parseInt(element.val());
                var price   = parseInt(element.attr('data-price'));

                total += level * price;
            });

            $('#progress')
                .html(total)
                .parent().css('width', Math.round((total * 100) / experience).toString() + '%');

            if (total >= available) {
                //
            }
        };

        elements.each(function() {
            var element = $(this).hide();
            var elevel  = element.parent().find('span');

            var min = parseInt(element.attr('data-level'));
            var max = parseInt(element.attr('data-max'));

            function buttonHTML(dir) {
                return '<button class="btn btn-default"><span class="glyphicon glyphicon-chevron-' + dir + '"></span></button>';
            }

            var down = $(buttonHTML('down')).click(function () { update(-1); updateTotal(); return false; });
            var up   = $(buttonHTML('up')).click(function() { update(+1); updateTotal(); return false; });

            var buttons = $('<span class="input-group-btn"></span>').append(up).append(down);

            function update(modifier) {
                var level = element.val() === "" ? 0 : parseInt(element.val());
                var buy   = level + 1 * modifier;
                var next  = min + buy;

                down.toggleClass('disabled', next <= min);
                up.toggleClass('disabled', next >= max);

                element.val(buy);
                elevel.html(next);
            }

            element.parent().append(buttons);

            update(0);
        });

        updateTotal();

        return elements;
    };
})(jQuery, this);
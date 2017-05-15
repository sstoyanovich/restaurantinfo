/**
 * === X
 * === x
 * ===
 * 
 * =====
 *
 * Featured Company module on homepage
 * click on picture to load new content
 *
 */
featuredCompany = {
    init: function () {
        $('.more-featured-companies').click(featuredCompany.clickHandler);
    },
    clickHandler: function (e) {
        var element = e.target,
            canvas = $('.featured-company dl'),
            canvasContent = canvas.html(),
            next,
            nextContent;

        if (element.nodeName === 'IMG') {
            next = $(element).parent().parent();
            nextContent = next.html();
            $('.current').removeClass('current');
            canvas.html(nextContent);
            $(element).addClass('current');
        }
        
        return false;
    }
};

$(featuredCompany.init);
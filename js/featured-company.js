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
            current = $('.featured-company dl'),
            currentContent = current.html(),
            next,
            nextContent;

        if (element.nodeName === 'IMG') {
            next = $(element).parent().parent();
            nextContent = next.html();
            
            current.html(nextContent);
            next.html(currentContent);
        }
        
        return false;
    }
};

$(featuredCompany.init);
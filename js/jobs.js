var Jobs = {
    init: function () {
        $("#jobs-listing li").click(Jobs.clickHandler);
    },
    clickHandler: function () {
        $("#jobs-listing li").removeClass("current");
        $(this).addClass("current");
        
        return false;
    }
}
$(Jobs.init);

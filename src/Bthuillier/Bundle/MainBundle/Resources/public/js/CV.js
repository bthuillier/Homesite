if (typeof accordion === "undefined"){
    accordion = {};
}
/**
 * 
 */
accordion.CV = {
    /**
     * Bind events to the CV page
     */
    bind: function ()
    {
        $("dl.accordion").each(accordion.CV.bindList);
    },
    
    bindList: function (number, element)
    {
        var current = null;
        var titles = $(element).find("dt");

        titles.css("cursor", "pointer");
        titles.each(function (i, e) {
            var element = $(e);
            element.html('<span class="more">+</span> ' + $(e).html());
            element.nextUntil('dt').hide();
        });
        titles.click(function () {
            var title = $(this);
            var definition = title.nextUntil('dt');

            if (current) {
                current.slideUp();
                var currentTitle = current.prev();
                currentTitle.removeClass("active");
                currentTitle.find(".more").text("+");
            }
            if (definition.is(current)) {
                current = null;
                return;
            }
            definition.slideDown();
            title.addClass("active");
            title.find(".more").text("");
            current = definition;
        });
    }    
};

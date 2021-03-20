import { isViewport } from "./isViewport.js";

export function handleMenuFit() {
    var menu = $("#app-menu");
    var dinamicLiWrapper = menu.find("#app-menu-fit-li");
    var shouldResize = false;

    var getLimitWidth = function() {
        var menuPaddingRight = parseInt(menu.css("padding-right"), 10);
        var negativeOffset = 120;
        return menu.outerWidth() - menuPaddingRight - negativeOffset;
    };

    var getChildsWidth = function(liOptions) {
        var optionsWidth = 0;

        liOptions = liOptions || getMenuOptions();

        liOptions.each(function() {
            var li = $(this);
            optionsWidth += li.outerWidth();
        });
        return optionsWidth;
    };

    var getMenuOptions = function(popLength) {
        var options = menu.find("> li").not(dinamicLiWrapper);
        if (popLength) {
            for (var i = 0; i < popLength; i++) {
                options.splice(options.length - 1, 1);
            }
        }
        return options;
    };

    var shouldResize = function() {
        resetMenu();
        var widthResult = getLimitWidth() - getChildsWidth();
        return widthResult < 0;
    };

    var resetMenu = function() {
        dinamicLiWrapper.find("ul").html("");
        dinamicLiWrapper.hide();
        menu.find("> li")
            .not(dinamicLiWrapper)
            .show();
    };

    var fitMenu = function(popMenuLength) {
        popMenuLength = popMenuLength || 1;
        var options = getMenuOptions(popMenuLength);
        var optionsWidth = 0;
        options.each(function() {
            var li = $(this);
            optionsWidth += li.outerWidth();
        });

        var widthResult = getLimitWidth() - optionsWidth;
        var shouldPopOption = widthResult < 0;

        if (shouldPopOption) {
            fitMenu(popMenuLength + 1);
        } else {
            var floatOptions = [];
            var optionsLength = menu.find("> li").not(dinamicLiWrapper).length;

            for (var i = 0; i < popMenuLength; i++) {
                var index = optionsLength - i - 1;

                var item = menu
                    .find("> li")
                    .not(dinamicLiWrapper)
                    .eq(index);
                var clonedOption = item.clone();
                item.hide();

                floatOptions.push(clonedOption);
            }

            floatOptions = floatOptions.reverse();
            for (var i = 0; i < floatOptions.length; i++) {
                dinamicLiWrapper.find("ul").html("");
                dinamicLiWrapper.find("ul").append(floatOptions);
            }
            dinamicLiWrapper.show();
        }
    };

    if (!isViewport("medium") && shouldResize()) {
        fitMenu();
    } else {
        resetMenu();
    }
}

import { isViewport } from "./isViewport.js";

export function handleMenuFit() {
    var menu = $("#app-menu");
    var shouldResize = false;

    var getLimitWidth = function() {
        var menuPaddingRight = parseInt(menu.css("padding-right"), 10);
        var negativeOffset = 10;
        return menu.outerWidth() - menuPaddingRight - negativeOffset;
    };

    var getChildsWidth = function() {
        var menuOptionsWidth = 0;
        menu.find("> li").each(function() {
            var li = $(this);
            menuOptionsWidth += li.outerWidth();
        });
        return menuOptionsWidth;
    };

    var shouldResize = function() {
        var widthResult = getLimitWidth() - getChildsWidth();
        return widthResult < 0;
    };

    var resetMenu = function() {
        console.log("reset menu");
    };

    if (!isViewport("medium") && shouldResize()) {
        console.log("fix menu options");
    } else {
        resetMenu();
    }
}

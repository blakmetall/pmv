import { getViewport } from "./getViewport.js";

export function isViewport(size) {
    var viewport = getViewport();

    if (size == "medium") {
        return viewport.w <= 767;
    }

    return null;
}

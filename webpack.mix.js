const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// files mixes
mix.react("resources/js/app.js", "public/js/app.js");
mix.js("resources/js/scripts.js", "public/js/scripts.js");
mix.sass("resources/sass/app.scss", "public/css/app.css");
mix.sass(
    "resources/gull/assets/styles/sass/themes/palmera-vacations.scss",
    "public/assets/styles/css/themes/palmera-vacations.min.css"
);

// vendor styles mix
mix.combine(
    [
        "public/assets/styles/vendor/calendar/fullcalendar.min.css",
        "public/assets/styles/vendor/perfect-scrollbar.css",
        "public/assets/styles/vendor/fastselect.min.css",
        "public/assets/styles/vendor/jquery.timepicker.min.css",
        "public/assets/styles/vendor/pickadate/classic.css",
        "public/assets/styles/vendor/pickadate/classic.date.css"
    ],
    "public/css/vendor.css"
);

// gull scripts
mix.js(
    ["resources/gull/assets/js/script.js"],
    "public/assets/js/gull-script.js"
);

// vendor scripts mix
mix.combine(
    [
        "resources/gull/assets/js/vendor/jquery-3.3.1.min.js",
        "resources/gull/assets/js/vendor/bootstrap.bundle.min.js",
        "resources/gull/assets/js/vendor/perfect-scrollbar.min.js",
        "resources/gull/assets/js/vendor/calendar/moment.min.js",
        "resources/gull/assets/js/vendor/calendar/fullcalendar.min.js",
        "public/assets/js/vendor/fastselect.standalone.js",
        "public/assets/js/vendor/jquery.timepicker.min.js",
        "public/assets/js/vendor/pickadate/legacy.js",
        "public/assets/js/vendor/pickadate/picker.js",
        "public/assets/js/vendor/pickadate/picker.date.js",
        "public/assets/js/vendor/index.umd.min.js",
    ],
    "public/assets/js/common-bundle-script.js"
);

// public styles mix
mix.combine(
    [
        "public/assets/public/css/all.css",
        "public/assets/public/css/system.base.css",
        "public/assets/public/css/jquery.ui.core.min.css",
        "public/assets/public/css/jquery.ui.theme.min.css",
        "public/assets/public/css/jquery.ui.datepicker.min.css",
        "public/assets/public/css/field.css",
        "public/assets/public/css/node.css",
        "public/assets/public/css/views.css",
        "public/assets/public/css/back_to_top.css",
        "public/assets/public/css/ctools.css",
        "public/assets/public/css/panels.css",
        "public/assets/public/css/locale.css",
        "public/assets/public/css/onecol.css",
        "public/assets/public/css/threecol_33_34_33_stacked.css",
        "public/assets/public/css/bookings.css",
        "public/assets/public/css/bootstrap.css",
        "public/assets/public/css/drupal-bootstrap-flatly.css",
        "public/assets/public/css/style.css",
        "public/assets/public/css/clic.css",
        "public/assets/public/css/calendar.css",
    ],
    "public/assets/public/css/public.css"
);


// vendor scripts mix
mix.combine(
    [
        "public/assets/public/js/jquery.min.js",
        "public/assets/public/js/jquery.once.js",
        "public/assets/public/js/jquery.ui.core.min.js",
        "public/assets/public/js/jquery.ui.effect.min.js",
        "public/assets/public/js/jquery.ui.datepicker.min.js",
        "public/assets/public/js/locale.datepicker.js",
        "public/assets/public/js/bootstrap.js",
        "public/assets/public/js/widgets.js",
        "public/assets/public/js/scripts.js",
        "public/assets/public/js/clic.js",
    ],
    "public/assets/public/js/public.js"
);

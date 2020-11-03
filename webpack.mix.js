const mix = require("laravel-mix");
const tailwind = require("tailwindcss");

mix.js("resources/js/app.js", "public/js");

mix.sass("resources/sass/site.scss", "public/css").options({
    processCssUrls: false,
    postCss: [require("postcss-import"), tailwind("./tailwind.config.js")]
});

var grunticonController = (function() {
    var ret = {}, svgPath, pngPath,
        fallbackPath;

    function doGrunticon() {
        svgPath = SiteInfo.grunticonPath + 'icons.data.svg.css';
        pngPath = SiteInfo.grunticonPath + 'icons.data.png.css';
        fallbackPath = SiteInfo.grunticonPath + 'icons.fallback.css';

        grunticon([svgPath, pngPath, fallbackPath], function() {
            grunticon.svgLoadedCORSCallback();
        });
    }

    document.addEventListener('DOMContentLoaded', doGrunticon);

    ret = {
        doGrunticon: doGrunticon
    };

    return ret;
})();

export default grunticonController;

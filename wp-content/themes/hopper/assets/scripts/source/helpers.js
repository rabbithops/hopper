//asynchronously load JavaScript
export function loadJS(url) {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.src = url;
    s.async = true;

    document.head.appendChild(s);
}

//asynchronously loads css
export function loadCss(url) {
    var ss = document.styleSheets;

    for (var i = 0, max = ss.length; i < max; i++) {

        if (ss[i].href === url) {
            return;
        }
    }

    var l = document.createElement('link');
    l.type = 'text/css';
    l.rel = 'stylesheet';
    l.href = url;
    document.head.appendChild(l);
}

export function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

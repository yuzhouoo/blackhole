(function() {
    window.XdlMedia = function(obj) {
        var ta = document.createElement('script');
        ta.type = 'text/javascript';
        ta.async = true;
        ta.src = '//yun.lvehaisen.com/h5/media/media-3.2.1.min.js';
        ta.onload = function() {
            new TuiaMedia({
                container: obj.container,
                appKey: obj.appKey,
                adslotId: obj.adslotId
            });
        };
        var s = document.querySelector('head');
        s.appendChild(ta);
    };
})();
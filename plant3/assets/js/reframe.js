!(function (e, t) {
  'object' == typeof exports && 'undefined' != typeof module
    ? (module.exports = t())
    : 'function' == typeof define && define.amd
    ? define(t)
    : ((e = 'undefined' != typeof globalThis ? globalThis : e || self).reframe = t());
})(this, function () {
  'use strict';
  return function (e, t) {
    var i = 'string' == typeof e ? document.querySelectorAll(e) : e,
      n = t || 'js-reframe';
    'length' in i || (i = [i]);
    for (var o = 0; o < i.length; o += 1) {
      var r = i[o];
      if (-1 !== r.className.split(' ').indexOf(n) || -1 < r.style.width.indexOf('%')) return;
      var f = r.getAttribute('height') || r.offsetHeight,
        l = r.getAttribute('width') || r.offsetWidth,
        f = (('string' == typeof f ? parseInt(f) : f) / ('string' == typeof l ? parseInt(l) : l)) * 100,
        l = document.createElement('div'),
        s = ((l.className = n), l.style),
        s = ((s.position = 'relative'), (s.width = '100%'), (s.paddingTop = ''.concat(f, '%')), r.style);
      (s.position = 'absolute'),
        (s.width = '100%'),
        (s.height = '100%'),
        (s.left = '0'),
        (s.top = '0'),
        null != (f = r.parentNode) && f.insertBefore(l, r),
        null != (s = r.parentNode) && s.removeChild(r),
        l.appendChild(r);
    }
  };
});
reframe('main iframe[src*="youtube.com"], main iframe[src*="vimeo.com"]');

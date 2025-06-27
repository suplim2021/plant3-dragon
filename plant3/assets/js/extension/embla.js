!(function (n, t) {
  'object' == typeof exports && 'undefined' != typeof module
    ? (module.exports = t())
    : 'function' == typeof define && define.amd
    ? define(t)
    : ((n = 'undefined' != typeof globalThis ? globalThis : n || self).EmblaCarousel = t());
})(this, function () {
  'use strict';
  function n(n) {
    return 'number' == typeof n;
  }
  function t(n) {
    return 'string' == typeof n;
  }
  function e(n) {
    return 'boolean' == typeof n;
  }
  function r(n) {
    return '[object Object]' === Object.prototype.toString.call(n);
  }
  function o(n) {
    return Math.abs(n);
  }
  function i(n) {
    return Math.sign(n);
  }
  function c(n, t) {
    return o(n - t);
  }
  function u(n) {
    return l(n).map(Number);
  }
  function s(n) {
    return n[a(n)];
  }
  function a(n) {
    return Math.max(0, n.length - 1);
  }
  function l(n) {
    return Object.keys(n);
  }
  function d(n, t) {
    return [n, t].reduce(
      (n, t) => (
        l(t).forEach((e) => {
          const o = n[e],
            i = t[e],
            c = r(o) && r(i);
          n[e] = c ? d(o, i) : i;
        }),
        n
      ),
      {}
    );
  }
  function f(n, t) {
    return void 0 !== t.MouseEvent && n instanceof t.MouseEvent;
  }
  function p(t, e) {
    const r = {
      start: function () {
        return 0;
      },
      center: function (n) {
        return o(n) / 2;
      },
      end: o,
    };
    function o(n) {
      return e - n;
    }
    return {
      measure: function (o) {
        return n(t) ? e * Number(t) : r[t](o);
      },
    };
  }
  function m(n, t) {
    const e = o(n - t);
    function r(t) {
      return t < n;
    }
    function i(n) {
      return n > t;
    }
    function c(n) {
      return r(n) || i(n);
    }
    return {
      length: e,
      max: t,
      min: n,
      constrain: function (e) {
        return c(e) ? (r(e) ? n : t) : e;
      },
      reachedAny: c,
      reachedMax: i,
      reachedMin: r,
      removeOffset: function (n) {
        return e ? n - e * Math.ceil((n - t) / e) : n;
      },
    };
  }
  function g(n, t, e) {
    const { constrain: r } = m(0, n),
      i = n + 1;
    let c = u(t);
    function u(n) {
      return e ? o((i + n) % i) : r(n);
    }
    function s() {
      return c;
    }
    function a() {
      return g(n, s(), e);
    }
    const l = {
      get: s,
      set: function (n) {
        return (c = u(n)), l;
      },
      add: function (n) {
        return a().set(s() + n);
      },
      clone: a,
    };
    return l;
  }
  function h() {
    let n = [];
    const t = {
      add: function (e, r, o, i = { passive: !0 }) {
        return e.addEventListener(r, o, i), n.push(() => e.removeEventListener(r, o, i)), t;
      },
      clear: function () {
        n = n.filter((n) => n());
      },
    };
    return t;
  }
  function x(n, t, r, u, s, a, l, d, p, g, x, y, v, b, S, w, E, D, M) {
    const { cross: A } = n,
      I = ['INPUT', 'SELECT', 'TEXTAREA'],
      O = { passive: !1 },
      P = h(),
      T = h(),
      F = m(50, 225).constrain(S.measure(20)),
      z = { mouse: 300, touch: 400 },
      B = { mouse: 500, touch: 600 },
      L = w ? 43 : 25;
    let k = !1,
      H = 0,
      R = 0,
      N = !1,
      C = !1,
      V = !1,
      j = !1;
    function q(n) {
      const e = l.readPoint(n),
        r = l.readPoint(n, A),
        o = c(e, H),
        i = c(r, R);
      if (!C && !j) {
        if (!n.cancelable) return U(n);
        if (((C = o > i), !C)) return U(n);
      }
      const u = l.pointerMove(n);
      o > E && (V = !0), x.useFriction(0.3).useDuration(1), p.start(), a.add(t.apply(u)), n.preventDefault();
    }
    function U(n) {
      const e = y.byDistance(0, !1).index !== v.get(),
        r = l.pointerUp(n) * (w ? B : z)[j ? 'mouse' : 'touch'],
        u = (function (n, t) {
          const e = v.add(-1 * i(n)),
            r = y.byDistance(n, !w).distance;
          return w || o(n) < F ? r : D && t ? 0.5 * r : y.byIndex(e.get(), 0).distance;
        })(t.apply(r), e),
        s = (function (n, t) {
          if (0 === n || 0 === t) return 0;
          if (o(n) <= o(t)) return 0;
          const e = c(o(n), o(t));
          return o(e / n);
        })(r, u),
        a = L - 10 * s,
        d = M + s / 50;
      (C = !1), (N = !1), T.clear(), x.useDuration(a).useFriction(d), g.distance(u, !w), (j = !1), b.emit('pointerUp');
    }
    function W(n) {
      V && (n.stopPropagation(), n.preventDefault());
    }
    return {
      init: function (n, t) {
        if (!t) return;
        function o(o) {
          (e(t) || t(n, o)) &&
            (function (n) {
              const t = f(n, s);
              if (((j = t), t && 0 !== n.button)) return;
              if (
                (function (n) {
                  const t = n.nodeName || '';
                  return I.includes(t);
                })(n.target)
              )
                return;
              (V = w && t && !n.buttons && k),
                (k = c(a.get(), d.get()) >= 2),
                (N = !0),
                l.pointerDown(n),
                x.useFriction(0).useDuration(0),
                a.set(d),
                (function () {
                  const n = j ? u : r;
                  T.add(n, 'touchmove', q, O).add(n, 'touchend', U).add(n, 'mousemove', q, O).add(n, 'mouseup', U);
                })(),
                (H = l.readPoint(n)),
                (R = l.readPoint(n, A)),
                b.emit('pointerDown');
            })(o);
        }
        const i = r;
        P.add(i, 'dragstart', (n) => n.preventDefault(), O)
          .add(i, 'touchmove', () => {}, O)
          .add(i, 'touchend', () => {})
          .add(i, 'touchstart', o)
          .add(i, 'mousedown', o)
          .add(i, 'touchcancel', U)
          .add(i, 'contextmenu', U)
          .add(i, 'click', W, !0);
      },
      pointerDown: function () {
        return N;
      },
      destroy: function () {
        P.clear(), T.clear();
      },
    };
  }
  function y(n, t) {
    let e, r;
    function i(n) {
      return n.timeStamp;
    }
    function c(e, r) {
      const o = 'client' + ('x' === (r || n.scroll) ? 'X' : 'Y');
      return (f(e, t) ? e : e.touches[0])[o];
    }
    return {
      pointerDown: function (n) {
        return (e = n), (r = n), c(n);
      },
      pointerMove: function (n) {
        const t = c(n) - c(r),
          o = i(n) - i(e) > 170;
        return (r = n), o && (e = n), t;
      },
      pointerUp: function (n) {
        if (!e || !r) return 0;
        const t = c(r) - c(e),
          u = i(n) - i(e),
          s = i(n) - i(r) > 170,
          a = t / u;
        return u && !s && o(a) > 0.1 ? a : 0;
      },
      readPoint: c,
    };
  }
  function v(n, t, r, o, i) {
    let c,
      u,
      s = [],
      a = !1;
    function l(n) {
      return i.measureSize(n.getBoundingClientRect());
    }
    return {
      init: function (i, d) {
        if (!d) return;
        (u = l(n)),
          (s = o.map(l)),
          (c = new ResizeObserver((c) => {
            a ||
              ((e(d) || d(i, c)) &&
                (function (e) {
                  for (const c of e) {
                    const e = c.target === n,
                      a = o.indexOf(c.target);
                    if ((e ? u : s[a]) !== l(e ? n : o[a])) {
                      r.requestAnimationFrame(() => {
                        i.reInit(), t.emit('resize');
                      });
                      break;
                    }
                  }
                })(c));
          })),
          [n].concat(o).forEach((n) => c.observe(n));
      },
      destroy: function () {
        c && c.disconnect(), (a = !0);
      },
    };
  }
  function b(n, t, e, r, i) {
    const c = i.measure(10),
      u = i.measure(50),
      s = m(0.1, 0.99);
    let a = !1;
    return {
      constrain: function (i) {
        if (a || !n.reachedAny(e.get()) || !n.reachedAny(t.get())) return;
        const l = n.reachedMin(t.get()) ? 'min' : 'max',
          d = o(n[l] - t.get()),
          f = e.get() - t.get(),
          p = s.constrain(d / u);
        e.subtract(f * p), !i && o(f) < c && (e.set(n.constrain(e.get())), r.useDuration(25).useBaseFriction());
      },
      toggleActive: function (n) {
        a = !n;
      },
    };
  }
  function S(n, t, e, r) {
    const o = m(-t + n, e[0]),
      i = e.map(o.constrain).map((n) => parseFloat(n.toFixed(3)));
    return {
      snapsContained: (function () {
        if (t <= n) return [o.max];
        if ('keepSnaps' === r) return i;
        const { min: e, max: c } = (function () {
          const n = i[0],
            t = s(i),
            e = i.lastIndexOf(n),
            r = i.indexOf(t) + 1;
          return m(e, r);
        })();
        return i.slice(e, c);
      })(),
    };
  }
  function w(n, t, e, r) {
    const o = t.min + 0.1,
      i = t.max + 0.1,
      { reachedMin: c, reachedMax: u } = m(o, i);
    return {
      loop: function (t) {
        if (
          !(function (n) {
            return 1 === n ? u(e.get()) : -1 === n && c(e.get());
          })(t)
        )
          return;
        const o = n * (-1 * t);
        r.forEach((n) => n.add(o));
      },
    };
  }
  function E(n) {
    const { max: t, length: e } = n;
    return {
      get: function (n) {
        return (n - t) / -e;
      },
    };
  }
  function D(n, t, e, r, c) {
    const { reachedAny: u, removeOffset: s, constrain: a } = r;
    function l(n) {
      return n.concat().sort((n, t) => o(n) - o(t))[0];
    }
    function d(t, r) {
      const o = [t, t + e, t - e];
      if (!n) return o[0];
      if (!r) return l(o);
      return l(o.filter((n) => i(n) === r));
    }
    return {
      byDistance: function (e, r) {
        const i = c.get() + e,
          { index: l, distance: f } = (function (e) {
            const r = n ? s(e) : a(e),
              i = t
                .map((n) => n - r)
                .map((n) => d(n, 0))
                .map((n, t) => ({ diff: n, index: t }))
                .sort((n, t) => o(n.diff) - o(t.diff)),
              { index: c } = i[0];
            return { index: c, distance: r };
          })(i),
          p = !n && u(i);
        return !r || p ? { index: l, distance: e } : { index: l, distance: e + d(t[l] - f, 0) };
      },
      byIndex: function (n, e) {
        return { index: n, distance: d(t[n] - c.get(), e) };
      },
      shortcut: d,
    };
  }
  function M(t) {
    let e = t;
    function r(t) {
      return n(t) ? t : t.get();
    }
    return {
      get: function () {
        return e;
      },
      set: function (n) {
        e = r(n);
      },
      add: function (n) {
        e += r(n);
      },
      subtract: function (n) {
        e -= r(n);
      },
    };
  }
  function A(n, t, e) {
    const r =
        'x' === n.scroll
          ? function (n) {
              return `translate3d(${n}px,0px,0px)`;
            }
          : function (n) {
              return `translate3d(0px,${n}px,0px)`;
            },
      o = e.style;
    let i = !1;
    return {
      clear: function () {
        i || ((o.transform = ''), e.getAttribute('style') || e.removeAttribute('style'));
      },
      to: function (n) {
        i || (o.transform = r(t.apply(n)));
      },
      toggleActive: function (n) {
        i = !n;
      },
    };
  }
  function I(n, t, e, r, o, i, c, s, a) {
    const l = u(o),
      d = u(o).reverse(),
      f = (function () {
        const n = i[0] - 1;
        return g(m(d, n), 'end');
      })().concat(
        (function () {
          const n = e - i[0] - 1;
          return g(m(l, n), 'start');
        })()
      );
    function p(n, t) {
      return n.reduce((n, t) => n - o[t], t);
    }
    function m(n, t) {
      return n.reduce((n, e) => (p(n, t) > 0 ? n.concat([e]) : n), []);
    }
    function g(e, o) {
      const i = 'start' === o,
        u = i ? -r : r,
        l = c.findSlideBounds([u]);
      return e.map((e) => {
        const o = i ? 0 : -r,
          c = i ? r : 0,
          u = l.filter((n) => n.index === e)[0][i ? 'end' : 'start'],
          d = M(-1),
          f = A(n, t, a[e]);
        return { index: e, location: d, translate: f, target: () => (s.get() > u ? o : c) };
      });
    }
    return {
      canLoop: function () {
        return f.every(
          ({ index: n }) =>
            p(
              l.filter((t) => t !== n),
              e
            ) <= 0.1
        );
      },
      clear: function () {
        f.forEach((n) => n.translate.clear());
      },
      loop: function () {
        f.forEach((n) => {
          const { target: t, translate: e, location: r } = n,
            o = t();
          o !== r.get() && (e.to(o), r.set(o));
        });
      },
      loopPoints: f,
    };
  }
  function O(n, t) {
    let r,
      o = !1;
    return {
      init: function (i, c) {
        c &&
          ((r = new MutationObserver((n) => {
            o ||
              ((e(c) || c(i, n)) &&
                (function (n) {
                  for (const e of n)
                    if ('childList' === e.type) {
                      i.reInit(), t.emit('slidesChanged');
                      break;
                    }
                })(n));
          })),
          r.observe(n, { childList: !0 }));
      },
      destroy: function () {
        r && r.disconnect(), (o = !0);
      },
    };
  }
  function P(n, t, e, r, o, i, c) {
    const { removeOffset: u, constrain: s } = o,
      a = i ? [0, t, -t] : [0],
      l = d(a, c);
    function d(t, o) {
      const i = t || a,
        c = (function (n) {
          const t = n || 0;
          return e.map((n) => m(0.5, n - 0.5).constrain(n * t));
        })(o);
      return i.reduce((t, o) => {
        const i = r.map((t, r) => ({ start: t - e[r] + c[r] + o, end: t + n - c[r] + o, index: r }));
        return t.concat(i);
      }, []);
    }
    return {
      check: function (n, t) {
        const e = i ? u(n) : s(n);
        return (t || l).reduce((n, t) => {
          const { index: r, start: o, end: i } = t;
          return !n.includes(r) && o < e && i > e ? n.concat([r]) : n;
        }, []);
      },
      findSlideBounds: d,
    };
  }
  function T(t, e, r) {
    const o = n(r);
    return {
      groupSlides: function (n) {
        return o
          ? (function (n, t) {
              return u(n)
                .filter((n) => n % t == 0)
                .map((e) => n.slice(e, e + t));
            })(n, r)
          : (function (n) {
              return u(n)
                .reduce((n, r) => {
                  const o = e.slice(s(n), r + 1).reduce((n, t) => n + t, 0);
                  return !r || o > t ? n.concat(r) : n;
                }, [])
                .map((t, e, r) => n.slice(t, r[e + 1]));
            })(n);
      },
    };
  }
  function F(n, t, e, r, c, l, d, f) {
    const { align: F, axis: z, direction: B, startIndex: L, inViewThreshold: k, loop: H, duration: R, dragFree: N, dragThreshold: C, slidesToScroll: V, skipSnaps: j, containScroll: q } = l,
      U = t.getBoundingClientRect(),
      W = e.map((n) => n.getBoundingClientRect()),
      $ = (function (n) {
        const t = 'rtl' === n ? -1 : 1;
        return {
          apply: function (n) {
            return n * t;
          },
        };
      })(B),
      G = (function (n, t) {
        const e = 'y' === n ? 'y' : 'x';
        return {
          scroll: e,
          cross: 'y' === n ? 'x' : 'y',
          startEdge: 'y' === e ? 'top' : 'rtl' === t ? 'right' : 'left',
          endEdge: 'y' === e ? 'bottom' : 'rtl' === t ? 'left' : 'right',
          measureSize: function (n) {
            const { width: t, height: r } = n;
            return 'x' === e ? t : r;
          },
        };
      })(z, B),
      Q = G.measureSize(U),
      X = (function (n) {
        return {
          measure: function (t) {
            return n * (t / 100);
          },
        };
      })(Q),
      Y = p(F, Q),
      J = !H && !!q,
      K = H || !!q,
      { slideSizes: Z, slideSizesWithGaps: _ } = (function (n, t, e, r, i, c) {
        const { measureSize: u, startEdge: l, endEdge: d } = n,
          f = e[0] && i,
          p = (function () {
            if (!f) return 0;
            const n = e[0];
            return o(t[l] - n[l]);
          })(),
          m = (function () {
            if (!f) return 0;
            const n = c.getComputedStyle(s(r));
            return parseFloat(n.getPropertyValue(`margin-${d}`));
          })(),
          g = e.map(u),
          h = e
            .map((n, t, e) => {
              const r = !t,
                o = t === a(e);
              return r ? g[t] + p : o ? g[t] + m : e[t + 1][l] - n[l];
            })
            .map(o);
        return { slideSizes: g, slideSizesWithGaps: h };
      })(G, U, W, e, K, c),
      nn = T(Q, _, V),
      { snaps: tn, snapsAligned: en } = (function (n, t, e, r, i, c, u) {
        const { startEdge: l, endEdge: d } = n,
          { groupSlides: f } = c,
          p = f(r)
            .map((n) => s(n)[d] - n[0][l])
            .map(o)
            .map(t.measure),
          m = r.map((n) => e[l] - n[l]).map((n) => -o(n)),
          g = (function () {
            const n = s(m) - s(i);
            return f(m)
              .map((n) => n[0])
              .map((t, e, r) => {
                const o = !e,
                  i = e === a(r);
                return u && o ? 0 : u && i ? n : t + p[e];
              });
          })();
        return { snaps: m, snapsAligned: g };
      })(G, Y, U, W, _, nn, J),
      rn = -s(tn) + s(_),
      { snapsContained: on } = S(Q, rn, en, q),
      cn = J ? on : en,
      { limit: un } = (function (n, t, e) {
        const r = t[0];
        return { limit: m(e ? r - n : s(t), r) };
      })(rn, cn, H),
      sn = g(a(cn), L, H),
      an = sn.clone(),
      ln = u(e),
      dn = {
        update: () =>
          (({ dragHandler: n, scrollBody: t, scrollBounds: e, scrollLooper: r, slideLooper: o, eventHandler: i, animation: c, options: { loop: u } }) => {
            const s = n.pointerDown();
            u || e.constrain(s);
            const a = t.seek().settled();
            a && !s && (c.stop(), i.emit('settle')), a || i.emit('scroll'), u && (r.loop(t.direction()), o.loop());
          })(vn),
        render: (n) =>
          (({ scrollBody: n, translate: t, location: e }, r) => {
            const o = n.velocity(),
              i = e.get() - o + o * r;
            t.to(i);
          })(vn, n),
        start: () => f.start(vn),
        stop: () => f.stop(vn),
      },
      fn = cn[sn.get()],
      pn = M(fn),
      mn = M(fn),
      gn = (function (n, t, e, r) {
        let c = !0,
          u = 0,
          s = 0,
          a = e,
          l = r;
        function d(n) {
          return (a = n), p;
        }
        function f(n) {
          return (l = n), p;
        }
        const p = {
          direction: function () {
            return s;
          },
          seek: function () {
            const e = t.get() - n.get();
            return l && a ? ((u += e / a), (u *= l), n.add(u)) : ((u = 0), n.set(t)), (s = i(u || e)), (c = o(e) < 0.001), p;
          },
          settled: function () {
            return c && n.set(t), c;
          },
          useBaseFriction: function () {
            return f(r);
          },
          useBaseDuration: function () {
            return d(e);
          },
          useFriction: f,
          useDuration: d,
          velocity: function () {
            return u;
          },
        };
        return p;
      })(pn, mn, R, 0.68),
      hn = D(H, cn, rn, un, mn),
      xn = (function (n, t, e, r, o, i) {
        function c(r) {
          const c = r.distance,
            u = r.index !== t.get();
          c && (n.start(), o.add(c)), u && (e.set(t.get()), t.set(r.index), i.emit('select'));
        }
        return {
          distance: function (n, t) {
            c(r.byDistance(n, t));
          },
          index: function (n, e) {
            const o = t.clone().set(n);
            c(r.byIndex(o.get(), e));
          },
        };
      })(dn, sn, an, hn, mn, d),
      yn = P(Q, rn, Z, tn, un, H, k),
      vn = {
        ownerDocument: r,
        ownerWindow: c,
        eventHandler: d,
        containerRect: U,
        slideRects: W,
        animation: dn,
        axis: G,
        direction: $,
        dragHandler: x(G, $, n, r, c, mn, y(G, c), pn, dn, xn, gn, hn, sn, d, X, N, C, j, 0.68),
        eventStore: h(),
        percentOfView: X,
        index: sn,
        indexPrevious: an,
        limit: un,
        location: pn,
        options: l,
        resizeHandler: v(t, d, c, e, G),
        scrollBody: gn,
        scrollBounds: b(un, pn, mn, gn, X),
        scrollLooper: w(rn, un, pn, [pn, mn]),
        scrollProgress: E(un),
        scrollSnaps: cn,
        scrollTarget: hn,
        scrollTo: xn,
        slideLooper: I(G, $, Q, rn, _, cn, yn, pn, e),
        slidesHandler: O(t, d),
        slidesInView: yn,
        slideIndexes: ln,
        slidesToScroll: nn,
        target: mn,
        translate: A(G, $, t),
      };
    return vn;
  }
  const z = {
    align: 'center',
    axis: 'x',
    container: null,
    slides: null,
    containScroll: null,
    direction: 'ltr',
    slidesToScroll: 1,
    breakpoints: {},
    dragFree: !1,
    dragThreshold: 10,
    inViewThreshold: 0,
    loop: !1,
    skipSnaps: !1,
    duration: 25,
    startIndex: 0,
    active: !0,
    watchDrag: !0,
    watchResize: !0,
    watchSlides: !0,
  };
  function B(n) {
    function t(n, t) {
      return d(n, t || {});
    }
    const e = {
      mergeOptions: t,
      optionsAtMedia: function (e) {
        const r = e.breakpoints || {},
          o = l(r)
            .filter((t) => n.matchMedia(t).matches)
            .map((n) => r[n])
            .reduce((n, e) => t(n, e), {});
        return t(e, o);
      },
      optionsMediaQueries: function (t) {
        return t
          .map((n) => l(n.breakpoints || {}))
          .reduce((n, t) => n.concat(t), [])
          .map(n.matchMedia);
      },
    };
    return e;
  }
  function L(n, e, r) {
    const i = n.ownerDocument,
      c = i.defaultView,
      u = B(c),
      s = (function (n) {
        let t = [];
        return {
          init: function (e, r) {
            return (t = e.filter(({ options: t }) => !1 !== n.optionsAtMedia(t).active)), t.forEach((t) => t.init(r, n)), e.reduce((n, t) => Object.assign(n, { [t.name]: t }), {});
          },
          destroy: function () {
            t = t.filter((n) => n.destroy());
          },
        };
      })(u),
      a = h(),
      l = h(),
      d = (function () {
        const n = {};
        let t;
        function e(t) {
          return n[t] || [];
        }
        const r = {
          init: function (n) {
            t = n;
          },
          emit: function (n) {
            return e(n).forEach((e) => e(t, n)), r;
          },
          off: function (t, o) {
            return (n[t] = e(t).filter((n) => n !== o)), r;
          },
          on: function (t, o) {
            return (n[t] = e(t).concat([o])), r;
          },
        };
        return r;
      })(),
      { animationRealms: f } = L,
      { mergeOptions: p, optionsAtMedia: m, optionsMediaQueries: g } = u,
      { on: x, off: y, emit: v } = d,
      b = T;
    let S,
      w,
      E,
      D,
      M = !1,
      A = p(z, L.globalOptions),
      I = p(A),
      O = [];
    function P(e, r) {
      if (M) return;
      const u = f.find((n) => n.window === c),
        h =
          u ||
          (function (n) {
            const t = 1e3 / 60;
            let e = [],
              r = null,
              i = 0,
              c = 0;
            function u(s) {
              r || (r = s);
              const a = s - r;
              for (r = s, i += a; i >= t; ) e.forEach(({ animation: n }) => n.update()), (i -= t);
              const l = o(i / t);
              e.forEach(({ animation: n }) => n.render(l)), c && n.requestAnimationFrame(u);
            }
            return {
              start: function (t) {
                e.includes(t) || e.push(t), c || (c = n.requestAnimationFrame(u));
              },
              stop: function (t) {
                (e = e.filter((n) => n !== t)), e.length || (n.cancelAnimationFrame(c), (r = null), (i = 0), (c = 0));
              },
              reset: function () {
                (r = null), (i = 0);
              },
              window: n,
            };
          })(c);
      if (
        (u || f.push(h),
        (A = p(A, e)),
        (I = m(A)),
        (O = r || O),
        (function () {
          const { container: e, slides: r } = I,
            o = t(e) ? n.querySelector(e) : e;
          E = o || n.children[0];
          const i = t(r) ? E.querySelectorAll(r) : r;
          D = [].slice.call(i || E.children);
        })(),
        (S = F(n, E, D, i, c, I, d, h)),
        g([A, ...O.map(({ options: n }) => n)]).forEach((n) => a.add(n, 'change', T)),
        I.active)
      ) {
        if (
          (S.translate.to(S.location.get()),
          S.eventHandler.init(C),
          S.resizeHandler.init(C, I.watchResize),
          S.slidesHandler.init(C, I.watchSlides),
          l.add(i, 'visibilitychange', () => {
            i.hidden && h.reset();
          }),
          I.loop)
        ) {
          if (!S.slideLooper.canLoop()) return k(), P({ loop: !1 }, r), void (A = p(A, { loop: !0 }));
          S.slideLooper.loop();
        }
        E.offsetParent && D.length && S.dragHandler.init(C, I.watchDrag), (w = s.init(O, C));
      }
    }
    function T(n, t) {
      const e = N();
      k(), P(p({ startIndex: e }, n), t), d.emit('reInit');
    }
    function k() {
      S.dragHandler.destroy(),
        S.animation.stop(),
        S.eventStore.clear(),
        S.translate.clear(),
        S.slideLooper.clear(),
        S.resizeHandler.destroy(),
        S.slidesHandler.destroy(),
        s.destroy(),
        a.clear(),
        l.clear();
    }
    function H(n) {
      const t = S[n ? 'target' : 'location'].get(),
        e = I.loop ? 'removeOffset' : 'constrain';
      return S.slidesInView.check(S.limit[e](t));
    }
    function R(n, t, e) {
      I.active && !M && (S.scrollBody.useBaseFriction().useDuration(t ? 0 : I.duration), S.scrollTo.index(n, e || 0));
    }
    function N() {
      return S.index.get();
    }
    const C = {
      canScrollNext: function () {
        return S.index.add(1).get() !== N();
      },
      canScrollPrev: function () {
        return S.index.add(-1).get() !== N();
      },
      containerNode: function () {
        return E;
      },
      internalEngine: function () {
        return S;
      },
      destroy: function () {
        M || ((M = !0), a.clear(), k(), d.emit('destroy'));
      },
      off: y,
      on: x,
      emit: v,
      plugins: function () {
        return w;
      },
      previousScrollSnap: function () {
        return S.indexPrevious.get();
      },
      reInit: b,
      rootNode: function () {
        return n;
      },
      scrollNext: function (n) {
        R(S.index.add(1).get(), !0 === n, -1);
      },
      scrollPrev: function (n) {
        R(S.index.add(-1).get(), !0 === n, 1);
      },
      scrollProgress: function () {
        return S.scrollProgress.get(S.location.get());
      },
      scrollSnapList: function () {
        return S.scrollSnaps.map(S.scrollProgress.get);
      },
      scrollTo: R,
      selectedScrollSnap: N,
      slideNodes: function () {
        return D;
      },
      slidesInView: H,
      slidesNotInView: function (n) {
        const t = H(n);
        return S.slideIndexes.filter((n) => !t.includes(n));
      },
    };
    return P(e, r), setTimeout(() => d.emit('init'), 0), C;
  }
  return (L.animationRealms = []), (L.globalOptions = void 0), L;
});

//====================================================================================================

// DOTS
var generateDots = (slider, embla) => {
  const dots = slider.querySelector('.s-dots');
  const template = '<span class="dot"></span>';
  dots.innerHTML = embla.scrollSnapList().reduce((acc) => acc + template, '');
  return [].slice.call(dots.querySelectorAll('.dot'));
};
var setupDots = (dots, embla) => {
  dots.forEach((node, i) => {
    node.addEventListener('click', () => embla.scrollTo(i), false);
  });
};
var selectDot = (dots, embla) => () => {
  const previous = embla.previousScrollSnap();
  const selected = embla.selectedScrollSnap();
  dots[previous].classList.remove('active');
  dots[selected].classList.add('active');
};

// THUMBS
var setupThumbs = (thumbs, embla) => {
  thumbs.forEach((node, i) => {
    node.addEventListener('click', () => embla.scrollTo(i), false);
  });
};
var selectThumb = (thumbs, embla) => () => {
  const previous = embla.previousScrollSnap();
  const selected = embla.selectedScrollSnap();
  thumbs[previous].classList.remove('active');
  thumbs[selected].classList.add('active');
};

// Arrows
var setupArrows = (node, embla) => {
  node.querySelector('.prev').addEventListener('click', embla.scrollPrev, false);
  node.querySelector('.next').addEventListener('click', embla.scrollNext, false);
};
var disableArrows = (node, embla) => {
  prevBtn = node.querySelector('.prev');
  nextBtn = node.querySelector('.next');
  return () => {
    if (embla.canScrollPrev()) prevBtn.removeAttribute('disabled');
    else prevBtn.setAttribute('disabled', 'disabled');

    if (embla.canScrollNext()) nextBtn.removeAttribute('disabled');
    else nextBtn.setAttribute('disabled', 'disabled');
  };
};

// SLIDER FUNCTION
var sCarousel = (sld) => {
  const viewport = sld.querySelector('.s-viewport');
  const align = sld.dataset.align;
  if (!align) {
    align = 'start';
  }
  const embla = EmblaCarousel(viewport, { loop: true, align: align });
  const dots = generateDots(sld, embla);
  setupDots(dots, embla);
  setupArrows(sld, embla);
  embla.on('select', selectDot(dots, embla));
  embla.on('init', selectDot(dots, embla));
  if (sld.querySelector('.s-thumbs')) {
    const thumbs = sld.querySelectorAll('.thumb');
    setupThumbs(thumbs, embla);
    embla.on('select', selectThumb(thumbs, embla));
    embla.on('init', selectThumb(thumbs, embla));
  }
};

// INI
document.addEventListener(
  'DOMContentLoaded',
  function () {
    var slds = document.querySelectorAll('.s-slider');
    if (slds) {
      slds.forEach((sld) => {
        sCarousel(sld);
      });
    }
  },
  false
);

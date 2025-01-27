/*!
 * FullCalendar v1.6.3
 * Docs & License: http://arshaw.com/fullcalendar/
 * (c) 2013 Adam Shaw
 */
(function (t, e) {
	//alert(t);
    function n(e) {
        t.extend(!0, he, e)
    }

    function r(n, r, c) {
		//alert(c);
        function u(t) {
            ae ? p() && (T(), M(t)) : f()
        }

        function f() {
            oe = r.theme ? "ui" : "fc", n.addClass("fc"), r.isRTL ? n.addClass("fc-rtl") : n.addClass("fc-ltr"), r.theme && n.addClass("ui-widget"), ae = t("<div class='fc-content' style='position:relative'/>").prependTo(n), ne = new a(ee, r), re = ne.render(), re && n.prepend(re), y(r.defaultView), r.handleWindowResize && t(window).resize(x), m() || v()
        }

        function v() {
            setTimeout(function () {
                !ie.start && m() && C()
            }, 0)
        }

        function h() {
            ie && (te("viewDestroy", ie, ie, ie.element), ie.triggerEventDestroy()), t(window).unbind("resize", x), ne.destroy(), ae.remove(), n.removeClass("fc fc-rtl ui-widget")
        }

        function p() {
            return n.is(":visible")
        }

        function m() {
            return t("body").is(":visible")
        }

        function y(t) {
            ie && t == ie.name || w(t)
        }

        function w(e) {
            he++, ie && (te("viewDestroy", ie, ie, ie.element), B(), ie.triggerEventDestroy(), G(), ie.element.remove(), ne.deactivateButton(ie.name)), ne.activateButton(e), ie = new me[e](t("<div class='fc-view fc-view-" + e + "' style='position:relative'/>").appendTo(ae), ee), C(), $(), he--
        }

        function C(t) {
            (!ie.start || t || ie.start > ge || ge >= ie.end) && p() && M(t)
        }

        function M(t) {
            he++, ie.start && (te("viewDestroy", ie, ie, ie.element), B(), N()), G(), ie.render(ge, t || 0), S(), $(), (ie.afterRender || A)(), _(), q(), te("viewRender", ie, ie, ie.element), ie.trigger("viewDisplay", de), he--, z()
        }

        function E() {
            p() && (B(), N(), T(), S(), F())
        }

        function T() {
            le = r.contentHeight ? r.contentHeight : r.height ? r.height - (re ? re.height() : 0) - R(ae) : Math.round(ae.width() / Math.max(r.aspectRatio, .5))
        }

        function S() {
            le === e && T(), he++, ie.setHeight(le), ie.setWidth(ae.width()), he--, se = n.outerWidth()
        }

        function x() {
            if (!he)
                if (ie.start) {
                    var t = ++ve;
                    setTimeout(function () {
                        t == ve && !he && p() && se != (se = n.outerWidth()) && (he++, E(), ie.trigger("windowResize", de), he--)
                    }, 200)
                } else v()
        }

        function k() {
            N(), W()
        }

        function H(t) {
            N(), F(t)
        }

        function F(t) {
            p() && (ie.setEventData(pe), ie.renderEvents(pe, t), ie.trigger("eventAfterAllRender"))
        }

        function N() {
            ie.triggerEventDestroy(), ie.clearEvents(), ie.clearEventData()
        }

        function z() {
            !r.lazyFetching || ue(ie.visStart, ie.visEnd) ? W() : F()
        }

        function W() {
            fe(ie.visStart, ie.visEnd)
        }

        function O(t) {
            pe = t, F()
        }

        function L(t) {
            H(t)
        }

        function _() {
            ne.updateTitle(ie.title)
        }

        function q() {
            var t = new Date;
            t >= ie.start && ie.end > t ? ne.disableButton("today") : ne.enableButton("today")
        }

        function Y(t, n, r) {
            ie.select(t, n, r === e ? !0 : r)
        }

        function B() {
            ie && ie.unselect()
        }

        function P() {
            C(-1)
        }

        function j() {
            C(1)
        }

        function I() {
            i(ge, -1), C()
        }

        function X() {
            i(ge, 1), C()
        }

        function J() {
            ge = new Date, C()
        }

        function V(t, e, n) {
            t instanceof Date ? ge = d(t) : g(ge, t, e, n), C()
        }

        function U(t, n, r) {
            t !== e && i(ge, t), n !== e && s(ge, n), r !== e && l(ge, r), C()
        }

        function Z() {
            return d(ge)
        }

        function G() {
            ae.css({
                width: "100%",
                height: ae.height(),
                overflow: "hidden"
            })
        }

        function $() {
            ae.css({
                width: "",
                height: "",
                overflow: ""
            })
        }

        function Q() {
            return ie
        }

        function K(t, n) {
            return n === e ? r[t] : (("height" == t || "contentHeight" == t || "aspectRatio" == t) && (r[t] = n, E()), e)
        }

        function te(t, n) {
            return r[t] ? r[t].apply(n || de, Array.prototype.slice.call(arguments, 2)) : e
        }
        var ee = this;
        ee.options = r, ee.render = u, ee.destroy = h, ee.refetchEvents = k, ee.reportEvents = O, ee.reportEventChange = L, ee.rerenderEvents = H, ee.changeView = y, ee.select = Y, ee.unselect = B, ee.prev = P, ee.next = j, ee.prevYear = I, ee.nextYear = X, ee.today = J, ee.gotoDate = V, ee.incrementDate = U, ee.formatDate = function (t, e) {
            return b(t, e, r)
        }, ee.formatDates = function (t, e, n) {
            return D(t, e, n, r)
        }, ee.getDate = Z, ee.getView = Q, ee.option = K, ee.trigger = te, o.call(ee, r, c);
        var ne, re, ae, oe, ie, se, le, ce, ue = ee.isFetchNeeded,
            fe = ee.fetchEvents,
            de = n[0],
            ve = 0,
            he = 0,
            ge = new Date,
            pe = [];
        g(ge, r.year, r.month, r.date), r.droppable && t(document).bind("dragstart", function (e, n) {
            var a = e.target,
                o = t(a);
            if (!o.parents(".fc").length) {
                var i = r.dropAccept;
                (t.isFunction(i) ? i.call(a, o) : o.is(i)) && (ce = a, ie.dragStart(ce, e, n))
            }
        }).bind("dragstop", function (t, e) {
            ce && (ie.dragStop(ce, t, e), ce = null)
        })
    }

    function a(n, r) {
        function a() {
            v = r.theme ? "ui" : "fc";
            var n = r.header;
            return n ? h = t("<table class='fc-header' style='width:100%'/>").append(t("<tr/>").append(i("left")).append(i("center")).append(i("right"))) : e
        }

        function o() {
            h.remove()
        }

        function i(e) {
            var a = t("<td class='fc-header-" + e + "'/>"),
                o = r.header[e];
            return o && t.each(o.split(" "), function (e) {
                e > 0 && a.append("<span class='fc-header-space'/>");
                var o;
                t.each(this.split(","), function (e, i) {
                    if ("title" == i) a.append("<span class='fc-header-title'><h2>&nbsp;</h2></span>"), o && o.addClass(v + "-corner-right"), o = null;
                    else {
                        var s;
                        if (n[i] ? s = n[i] : me[i] && (s = function () {
                            u.removeClass(v + "-state-hover"), n.changeView(i)
                        }), s) {
                            var l = r.theme ? q(r.buttonIcons, i) : null,
                                c = q(r.buttonText, i),
                                u = t("<span class='fc-button fc-button-" + i + " " + v + "-state-default'>" + (l ? "<span class='fc-icon-wrap'><span class='ui-icon ui-icon-" + l + "'/>" + "</span>" : c) + "</span>").click(function () {
                                    u.hasClass(v + "-state-disabled") || s()
                                }).mousedown(function () {
                                    u.not("." + v + "-state-active").not("." + v + "-state-disabled").addClass(v + "-state-down")
                                }).mouseup(function () {
                                    u.removeClass(v + "-state-down")
                                }).hover(function () {
                                    u.not("." + v + "-state-active").not("." + v + "-state-disabled").addClass(v + "-state-hover")
                                }, function () {
                                    u.removeClass(v + "-state-hover").removeClass(v + "-state-down")
                                }).appendTo(a);
                            B(u), o || u.addClass(v + "-corner-left"), o = u
                        }
                    }
                }), o && o.addClass(v + "-corner-right")
            }), a
        }

        function s(t) {
            h.find("h2").html(t)
        }

        function l(t) {
            h.find("span.fc-button-" + t).addClass(v + "-state-active")
        }

        function c(t) {
            h.find("span.fc-button-" + t).removeClass(v + "-state-active")
        }

        function u(t) {
            h.find("span.fc-button-" + t).addClass(v + "-state-disabled")
        }

        function f(t) {
            h.find("span.fc-button-" + t).removeClass(v + "-state-disabled")
        }
        var d = this;
        d.render = a, d.destroy = o, d.updateTitle = s, d.activateButton = l, d.deactivateButton = c, d.disableButton = u, d.enableButton = f;
        var v, h = t([])
    }

    function o(n, r) {
        function a(t, e) {
            return !E || E > t || e > T
        }

        function o(t, e) {
            E = t, T = e, W = [];
            var n = ++R,
                r = F.length;
            N = r;
            for (var a = 0; r > a; a++) i(F[a], n)
        }

        function i(e, r) {
            s(e, function (a) {
                if (r == R) {
                    if (a) {
                        n.eventDataTransform && (a = t.map(a, n.eventDataTransform)), e.eventDataTransform && (a = t.map(a, e.eventDataTransform));
                        for (var o = 0; a.length > o; o++) a[o].source = e, b(a[o]);
                        W = W.concat(a)
                    }
                    N--, N || k(W)
                }
            })
        }

        function s(r, a) {
            var o, i, l = pe.sourceFetchers;
            for (o = 0; l.length > o; o++) {
                if (i = l[o](r, E, T, a), i === !0) return;
                if ("object" == typeof i) return s(i, a), e
            }
            var c = r.events;
            if (c) t.isFunction(c) ? (m(), c(d(E), d(T), function (t) {
                a(t), y()
            })) : t.isArray(c) ? a(c) : a();
            else {
                var u = r.url;
                if (u) {
                    var f, v = r.success,
                        h = r.error,
                        g = r.complete;
                    f = t.isFunction(r.data) ? r.data() : r.data;
                    var p = t.extend({}, f || {}),
                        b = X(r.startParam, n.startParam),
                        D = X(r.endParam, n.endParam);
                    b && (p[b] = Math.round(+E / 1e3)), D && (p[D] = Math.round(+T / 1e3)), m(), t.ajax(t.extend({}, ye, r, {
                        data: p,
                        success: function (e) {
                            e = e || [];
                            var n = I(v, this, arguments);
                            t.isArray(n) && (e = n), a(e)
                        },
                        error: function () {
                            I(h, this, arguments), a()
                        },
                        complete: function () {
                            I(g, this, arguments), y()
                        }
                    }))
                } else a()
            }
        }

        function l(t) {
            t = c(t), t && (N++, i(t, R))
        }

        function c(n) {
            return t.isFunction(n) || t.isArray(n) ? n = {
                events: n
            } : "string" == typeof n && (n = {
                url: n
            }), "object" == typeof n ? (D(n), F.push(n), n) : e
        }

        function u(e) {
            F = t.grep(F, function (t) {
                return !w(t, e)
            }), W = t.grep(W, function (t) {
                return !w(t.source, e)
            }), k(W)
        }

        function f(t) {
            var e, n, r = W.length,
                a = x().defaultEventEnd,
                o = t.start - t._start,
                i = t.end ? t.end - (t._end || a(t)) : 0;
            for (e = 0; r > e; e++) n = W[e], n._id == t._id && n != t && (n.start = new Date(+n.start + o), n.end = t.end ? n.end ? new Date(+n.end + i) : new Date(+a(n) + i) : null, n.title = t.title, n.url = t.url, n.allDay = t.allDay, n.className = t.className, n.editable = t.editable, n.color = t.color, n.backgroundColor = t.backgroundColor, n.borderColor = t.borderColor, n.textColor = t.textColor, b(n));
            b(t), k(W)
        }

        function v(t, e) {
            b(t), t.source || (e && (H.events.push(t), t.source = H), W.push(t)), k(W)
        }

        function h(e) {
            if (e) {
                if (!t.isFunction(e)) {
                    var n = e + "";
                    e = function (t) {
                        return t._id == n
                    }
                }
                W = t.grep(W, e, !0);
                for (var r = 0; F.length > r; r++) t.isArray(F[r].events) && (F[r].events = t.grep(F[r].events, e, !0))
            } else {
                W = [];
                for (var r = 0; F.length > r; r++) t.isArray(F[r].events) && (F[r].events = [])
            }
            k(W)
        }

        function g(e) {
            return t.isFunction(e) ? t.grep(W, e) : e ? (e += "", t.grep(W, function (t) {
                return t._id == e
            })) : W
        }

        function m() {
            z++ || S("loading", null, !0)
        }

        function y() {
            --z || S("loading", null, !1)
        }

        function b(t) {
            var r = t.source || {}, a = X(r.ignoreTimezone, n.ignoreTimezone);
            t._id = t._id || (t.id === e ? "_fc" + be++ : t.id + ""), t.date && (t.start || (t.start = t.date), delete t.date), t._start = d(t.start = p(t.start, a)), t.end = p(t.end, a), t.end && t.end <= t.start && (t.end = null), t._end = t.end ? d(t.end) : null, t.allDay === e && (t.allDay = X(r.allDayDefault, n.allDayDefault)), t.className ? "string" == typeof t.className && (t.className = t.className.split(/\s+/)) : t.className = []
        }

        function D(t) {
            t.className ? "string" == typeof t.className && (t.className = t.className.split(/\s+/)) : t.className = [];
            for (var e = pe.sourceNormalizers, n = 0; e.length > n; n++) e[n](t)
        }

        function w(t, e) {
            return t && e && C(t) == C(e)
        }

        function C(t) {
            return ("object" == typeof t ? t.events || t.url : "") || t
        }
        var M = this;
        M.isFetchNeeded = a, M.fetchEvents = o, M.addEventSource = l, M.removeEventSource = u, M.updateEvent = f, M.renderEvent = v, M.removeEvents = h, M.clientEvents = g, M.normalizeEvent = b;
        for (var E, T, S = M.trigger, x = M.getView, k = M.reportEvents, H = {
                events: []
            }, F = [H], R = 0, N = 0, z = 0, W = [], A = 0; r.length > A; A++) c(r[A])
    }

    function i(t, e, n) {
        return t.setFullYear(t.getFullYear() + e), n || f(t), t
    }

    function s(t, e, n) {
        if (+t) {
            var r = t.getMonth() + e,
                a = d(t);
            for (a.setDate(1), a.setMonth(r), t.setMonth(r), n || f(t); t.getMonth() != a.getMonth();) t.setDate(t.getDate() + (a > t ? 1 : -1))
        }
        return t
    }

    function l(t, e, n) {
        if (+t) {
            var r = t.getDate() + e,
                a = d(t);
            a.setHours(9), a.setDate(r), t.setDate(r), n || f(t), c(t, a)
        }
        return t
    }

    function c(t, e) {
        if (+t)
            for (; t.getDate() != e.getDate();) t.setTime(+t + (e > t ? 1 : -1) * Ce)
    }

    function u(t, e) {
        return t.setMinutes(t.getMinutes() + e), t
    }

    function f(t) {
        return t.setHours(0), t.setMinutes(0), t.setSeconds(0), t.setMilliseconds(0), t
    }

    function d(t, e) {
        return e ? f(new Date(+t)) : new Date(+t)
    }

    function v() {
        var t, e = 0;
        do t = new Date(1970, e++, 1); while (t.getHours());
        return t
    }

    function h(t, e) {
        return Math.round((d(t, !0) - d(e, !0)) / we)
    }

    function g(t, n, r, a) {
        n !== e && n != t.getFullYear() && (t.setDate(1), t.setMonth(0), t.setFullYear(n)), r !== e && r != t.getMonth() && (t.setDate(1), t.setMonth(r)), a !== e && t.setDate(a)
    }

    function p(t, n) {
        return "object" == typeof t ? t : "number" == typeof t ? new Date(1e3 * t) : "string" == typeof t ? t.match(/^\d+(\.\d+)?$/) ? new Date(1e3 * parseFloat(t)) : (n === e && (n = !0), m(t, n) || (t ? new Date(t) : null)) : null
    }

    function m(t, e) {
        var n = t.match(/^([0-9]{4})(-([0-9]{2})(-([0-9]{2})([T ]([0-9]{2}):([0-9]{2})(:([0-9]{2})(\.([0-9]+))?)?(Z|(([-+])([0-9]{2})(:?([0-9]{2}))?))?)?)?)?$/);
        if (!n) return null;
        var r = new Date(n[1], 0, 1);
        if (e || !n[13]) {
            var a = new Date(n[1], 0, 1, 9, 0);
            n[3] && (r.setMonth(n[3] - 1), a.setMonth(n[3] - 1)), n[5] && (r.setDate(n[5]), a.setDate(n[5])), c(r, a), n[7] && r.setHours(n[7]), n[8] && r.setMinutes(n[8]), n[10] && r.setSeconds(n[10]), n[12] && r.setMilliseconds(1e3 * Number("0." + n[12])), c(r, a)
        } else if (r.setUTCFullYear(n[1], n[3] ? n[3] - 1 : 0, n[5] || 1), r.setUTCHours(n[7] || 0, n[8] || 0, n[10] || 0, n[12] ? 1e3 * Number("0." + n[12]) : 0), n[14]) {
            var o = 60 * Number(n[16]) + (n[18] ? Number(n[18]) : 0);
            o *= "-" == n[15] ? 1 : -1, r = new Date(+r + 1e3 * 60 * o)
        }
        return r
    }

    function y(t) {
        if ("number" == typeof t) return 60 * t;
        if ("object" == typeof t) return 60 * t.getHours() + t.getMinutes();
        var e = t.match(/(\d+)(?::(\d+))?\s*(\w+)?/);
        if (e) {
            var n = parseInt(e[1], 10);
            return e[3] && (n %= 12, "p" == e[3].toLowerCase().charAt(0) && (n += 12)), 60 * n + (e[2] ? parseInt(e[2], 10) : 0)
        }
    }

    function b(t, e, n) {
        return D(t, null, e, n)
    }

    function D(t, e, n, r) {
        r = r || he;
        var a, o, i, s, l = t,
            c = e,
            u = n.length,
            f = "";
        for (a = 0; u > a; a++)
            if (o = n.charAt(a), "'" == o) {
                for (i = a + 1; u > i; i++)
                    if ("'" == n.charAt(i)) {
                        l && (f += i == a + 1 ? "'" : n.substring(a + 1, i), a = i);
                        break
                    }
            } else if ("(" == o) {
            for (i = a + 1; u > i; i++)
                if (")" == n.charAt(i)) {
                    var d = b(l, n.substring(a + 1, i), r);
                    parseInt(d.replace(/\D/, ""), 10) && (f += d), a = i;
                    break
                }
        } else if ("[" == o) {
            for (i = a + 1; u > i; i++)
                if ("]" == n.charAt(i)) {
                    var v = n.substring(a + 1, i),
                        d = b(l, v, r);
                    d != b(c, v, r) && (f += d), a = i;
                    break
                }
        } else if ("{" == o) l = e, c = t;
        else if ("}" == o) l = t, c = e;
        else {
            for (i = u; i > a; i--)
                if (s = Ee[n.substring(a, i)]) {
                    l && (f += s(l, r)), a = i - 1;
                    break
                }
            i == a && l && (f += o)
        }
        return f
    }

    function w(t) {
        var e, n = new Date(t.getTime());
        return n.setDate(n.getDate() + 4 - (n.getDay() || 7)), e = n.getTime(), n.setMonth(0), n.setDate(1), Math.floor(Math.round((e - n) / 864e5) / 7) + 1
    }

    function C(t) {
        return t.end ? M(t.end, t.allDay) : l(d(t.start), 1)
    }

    function M(t, e) {
        return t = d(t), e || t.getHours() || t.getMinutes() ? l(t, 1) : f(t)
    }

    function E(n, r, a) {
        n.unbind("mouseover").mouseover(function (n) {
            for (var o, i, s, l = n.target; l != this;) o = l, l = l.parentNode;
            (i = o._fci) !== e && (o._fci = e, s = r[i], a(s.event, s.element, s), t(n.target).trigger(n)), n.stopPropagation()
        })
    }

    function T(e, n, r) {
        for (var a, o = 0; e.length > o; o++) a = t(e[o]), a.width(Math.max(0, n - x(a, r)))
    }

    function S(e, n, r) {
        for (var a, o = 0; e.length > o; o++) a = t(e[o]), a.height(Math.max(0, n - R(a, r)))
    }

    function x(t, e) {
        return k(t) + F(t) + (e ? H(t) : 0)
    }

    function k(e) {
        return (parseFloat(t.css(e[0], "paddingLeft", !0)) || 0) + (parseFloat(t.css(e[0], "paddingRight", !0)) || 0)
    }

    function H(e) {
        return (parseFloat(t.css(e[0], "marginLeft", !0)) || 0) + (parseFloat(t.css(e[0], "marginRight", !0)) || 0)
    }

    function F(e) {
        return (parseFloat(t.css(e[0], "borderLeftWidth", !0)) || 0) + (parseFloat(t.css(e[0], "borderRightWidth", !0)) || 0)
    }

    function R(t, e) {
        return N(t) + W(t) + (e ? z(t) : 0)
    }

    function N(e) {
        return (parseFloat(t.css(e[0], "paddingTop", !0)) || 0) + (parseFloat(t.css(e[0], "paddingBottom", !0)) || 0)
    }

    function z(e) {
        return (parseFloat(t.css(e[0], "marginTop", !0)) || 0) + (parseFloat(t.css(e[0], "marginBottom", !0)) || 0)
    }

    function W(e) {
        return (parseFloat(t.css(e[0], "borderTopWidth", !0)) || 0) + (parseFloat(t.css(e[0], "borderBottomWidth", !0)) || 0)
    }

    function A() {}

    function O(t, e) {
        return t - e
    }

    function L(t) {
        return Math.max.apply(Math, t)
    }

    function _(t) {
        return (10 > t ? "0" : "") + t
    }

    function q(t, n) {
        if (t[n] !== e) return t[n];
        for (var r, a = n.split(/(?=[A-Z])/), o = a.length - 1; o >= 0; o--)
            if (r = t[a[o].toLowerCase()], r !== e) return r;
        return t[""]
    }

    function Y(t) {
        return t.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, "&#039;").replace(/"/g, "&quot;").replace(/\n/g, "<br />")
    }

    function B(t) {
        t.attr("unselectable", "on").css("MozUserSelect", "none").bind("selectstart.ui", function () {
            return !1
        })
    }

    function P(t) {
        t.children().removeClass("fc-first fc-last").filter(":first-child").addClass("fc-first").end().filter(":last-child").addClass("fc-last")
    }

    function j(t, e) {
        var n = t.source || {}, r = t.color,
            a = n.color,
            o = e("eventColor"),
            i = t.backgroundColor || r || n.backgroundColor || a || e("eventBackgroundColor") || o,
            s = t.borderColor || r || n.borderColor || a || e("eventBorderColor") || o,
            l = t.textColor || n.textColor || e("eventTextColor"),
            c = [];
        return i && c.push("background-color:" + i), s && c.push("border-color:" + s), l && c.push("color:" + l), c.join(";")
    }

    function I(e, n, r) {
        if (t.isFunction(e) && (e = [e]), e) {
            var a, o;
            for (a = 0; e.length > a; a++) o = e[a].apply(n, r) || o;
            return o
        }
    }

    function X() {
        for (var t = 0; arguments.length > t; t++)
            if (arguments[t] !== e) return arguments[t]
    }

    function J(t, e) {
        function n(t, e) {
            e && (s(t, e), t.setDate(1));
            var n = a("firstDay"),
                f = d(t, !0);
            f.setDate(1);
            var v = s(d(f), 1),
                g = d(f);
            l(g, -((g.getDay() - n + 7) % 7)), i(g);
            var p = d(v);
            l(p, (7 - p.getDay() + n) % 7), i(p, -1, !0);
            var m = c(),
                y = Math.round(h(p, g) / 7);
            "fixed" == a("weekMode") && (l(p, 7 * (6 - y)), y = 6), r.title = u(f, a("titleFormat")), r.start = f, r.end = v, r.visStart = g, r.visEnd = p, o(y, m, !0)
        }
        var r = this;
        r.render = n, Z.call(r, t, e, "month");
        var a = r.opt,
            o = r.renderBasic,
            i = r.skipHiddenDays,
            c = r.getCellsPerWeek,
            u = e.formatDate
    }

    function V(t, e) {
        function n(t, e) {
            e && l(t, 7 * e);
            var n = l(d(t), -((t.getDay() - a("firstDay") + 7) % 7)),
                u = l(d(n), 7),
                f = d(n);
            i(f);
            var v = d(u);
            i(v, -1, !0);
            var h = s();
            r.start = n, r.end = u, r.visStart = f, r.visEnd = v, r.title = c(f, l(d(v), -1), a("titleFormat")), o(1, h, !1)
        }
        var r = this;
        r.render = n, Z.call(r, t, e, "basicWeek");
        var a = r.opt,
            o = r.renderBasic,
            i = r.skipHiddenDays,
            s = r.getCellsPerWeek,
            c = e.formatDates
    }

    function U(t, e) {
        function n(t, e) {
            e && l(t, e), i(t, 0 > e ? -1 : 1);
            var n = d(t, !0),
                c = l(d(n), 1);
            r.title = s(t, a("titleFormat")), r.start = r.visStart = n, r.end = r.visEnd = c, o(1, 1, !1)
        }
        var r = this;
        r.render = n, Z.call(r, t, e, "basicDay");
        var a = r.opt,
            o = r.renderBasic,
            i = r.skipHiddenDays,
            s = e.formatDate
    }

    function Z(e, n, r) {
        function a(t, e, n) {
            ee = t, ne = e, re = n, o(), j || i(), s()
        }

        function o() {
            he = be("theme") ? "ui" : "fc", ge = be("columnFormat"), pe = be("weekNumbers"), me = be("weekNumberTitle"), ye = "iso" != be("weekNumberCalculation") ? "w" : "W"
        }

        function i() {
            Z = t("<div class='fc-event-container' style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(e)
        }

        function s() {
            var n = c();
            L && L.remove(), L = t(n).appendTo(e), _ = L.find("thead"), q = _.find(".fc-day-header"), j = L.find("tbody"), I = j.find("tr"), X = j.find(".fc-day"), J = I.find("td:first-child"), V = I.eq(0).find(".fc-day > div"), U = I.eq(0).find(".fc-day-content > div"), P(_.add(_.find("tr"))), P(I), I.eq(0).addClass("fc-first"), I.filter(":last").addClass("fc-last"), X.each(function (e, n) {
                var r = Te(Math.floor(e / ne), e % ne);
                we("dayRender", O, r, t(n))
            }), y(X)
        }

        function c() {
            var t = "<table class='fc-border-separate' style='width:100%' cellspacing='0'>" + u() + v() + "</table>";
            return t
        }

        function u() {
            var t, e, n = he + "-widget-header",
                r = "";
            for (r += "<thead><tr>", pe && (r += "<th class='fc-week-number " + n + "'>" + Y(me) + "</th>"), t = 0; ne > t; t++) e = Te(0, t), r += "<th class='fc-day-header fc-" + De[e.getDay()] + " " + n + "'>" + Y(ke(e, ge)) + "</th>";
          //  return r += "</tr></thead>";
		  return ""
        }

        function v() {
            var t, e, n, r = he + "-widget-content",
                a = "";
            for (a += "<tbody>", t = 0; ee > t; t++) {
                for (a += "<tr class='fc-week'>", pe && (n = Te(t, 0), a += "<td class='fc-week-number " + r + "'>" + "<div>" + Y(ke(n, ye)) + "</div>" + "</td>"), e = 0; ne > e; e++) n = Te(t, e), a += h(n);
                a += "</tr>"
            }
            return a += "</tbody>"
        }

        function h(t) {
            var e = he + "-widget-content",
                n = O.start.getMonth(),
                r = f(new Date),
                a = "",
                o = ["fc-day", "fc-" + De[t.getDay()], e];
            return t.getMonth() != n && o.push("fc-other-month"), +t == +r ? o.push("fc-today", he + "-state-highlight") : r > t ? o.push("fc-past") : o.push("fc-future"), a += "<td class='" + o.join(" ") + "'" + " data-date='" + ke(t, "yyyy-MM-dd") + "'" + ">" + "<div>", re && (a += "<div class='fc-day-number'>" + t.getDate() + "</div>"), a += "<div class='fc-day-content'><div style='position:relative'>&nbsp;</div></div></div></td>"
        }

        function g(e) {
            Q = e;
            var n, r, a, o = Q - _.height();
            "variable" == be("weekMode") ? n = r = Math.floor(o / (1 == ee ? 2 : 6)) : (n = Math.floor(o / ee), r = o - n * (ee - 1)), J.each(function (e, o) {
                ee > e && (a = t(o), a.find("> div").css("min-height", (e == ee - 1 ? r : n) - R(a)))
            })
        }

        function p(t) {
            $ = t, se.clear(), de.clear(), te = 0, pe && (te = _.find("th.fc-week-number").outerWidth()), K = Math.floor(($ - te) / ne), T(q.slice(0, -1), K)
        }

        function y(t) {
            t.click(b).mousedown(Ee)
        }

        function b(e) {
            if (!be("selectable")) {
                var n = m(t(this).data("date"));
                we("dayClick", this, n, !0, e)
            }
        }

        function D(t, e, n) {
            n && oe.build();
            for (var r = xe(t, e), a = 0; r.length > a; a++) {
                var o = r[a];
                y(w(o.row, o.leftCol, o.row, o.rightCol))
            }
        }

        function w(t, n, r, a) {
            var o = oe.rect(t, n, r, a, e);
            return Ce(o, e)
        }

        function C(t) {
            return d(t)
        }

        function M(t, e) {
            D(t, l(d(e), 1), !0)
        }

        function E() {
            Me()
        }

        function S(t, e, n) {
            var r = Se(t),
                a = X[r.row * ne + r.col];
            we("dayClick", a, t, e, n)
        }

        function x(t, e) {
            ie.start(function (t) {
                Me(), t && w(t.row, t.col, t.row, t.col)
            }, e)
        }

        function k(t, e, n) {
            var r = ie.stop();
            if (Me(), r) {
                var a = Te(r);
                we("drop", t, a, !0, e, n)
            }
        }

        function H(t) {
            return d(t.start)
        }

        function F(t) {
            return se.left(t)
        }

        function N(t) {
            return se.right(t)
        }

        function z(t) {
            return de.left(t)
        }

        function W(t) {
            return de.right(t)
        }

        function A(t) {
            return I.eq(t)
        }
        var O = this;
        O.renderBasic = a, O.setHeight = g, O.setWidth = p, O.renderDayOverlay = D, O.defaultSelectionEnd = C, O.renderSelection = M, O.clearSelection = E, O.reportDayClick = S, O.dragStart = x, O.dragStop = k, O.defaultEventEnd = H, O.getHoverListener = function () {
            return ie
        }, O.colLeft = F, O.colRight = N, O.colContentLeft = z, O.colContentRight = W, O.getIsCellAllDay = function () {
            return !0
        }, O.allDayRow = A, O.getRowCnt = function () {
            return ee
        }, O.getColCnt = function () {
            return ne
        }, O.getColWidth = function () {
            return K
        }, O.getDaySegmentContainer = function () {
            return Z
        }, ae.call(O, e, n, r), ce.call(O), le.call(O), G.call(O);
        var L, _, q, j, I, X, J, V, U, Z, $, Q, K, te, ee, ne, re, oe, ie, se, de, he, ge, pe, me, ye, be = O.opt,
            we = O.trigger,
            Ce = O.renderOverlay,
            Me = O.clearOverlays,
            Ee = O.daySelectionMousedown,
            Te = O.cellToDate,
            Se = O.dateToCell,
            xe = O.rangeToSegments,
            ke = n.formatDate;
        B(e.addClass("fc-grid")), oe = new ue(function (e, n) {
            var r, a, o;
            q.each(function (e, i) {
                r = t(i), a = r.offset().left, e && (o[1] = a), o = [a], n[e] = o
            }), o[1] = a + r.outerWidth(), I.each(function (n, i) {
                ee > n && (r = t(i), a = r.offset().top, n && (o[1] = a), o = [a], e[n] = o)
            }), o[1] = a + r.outerHeight()
        }), ie = new fe(oe), se = new ve(function (t) {
            return V.eq(t)
        }), de = new ve(function (t) {
            return U.eq(t)
        })
    }

    function G() {
        function t(t, e) {
            n.renderDayEvents(t, e)
        }

        function e() {
            n.getDaySegmentContainer().empty()
        }
        var n = this;
        n.renderEvents = t, n.clearEvents = e, oe.call(n)
    }

    function $(t, e) {
        function n(t, e) {
            e && l(t, 7 * e);
            var n = l(d(t), -((t.getDay() - a("firstDay") + 7) % 7)),
                u = l(d(n), 7),
                f = d(n);
            i(f);
            var v = d(u);
            i(v, -1, !0);
            var h = s();
            r.title = c(f, l(d(v), -1), a("titleFormat")), r.start = n, r.end = u, r.visStart = f, r.visEnd = v, o(h)
        }
        var r = this;
        r.render = n, K.call(r, t, e, "agendaWeek");
        var a = r.opt,
            o = r.renderAgenda,
            i = r.skipHiddenDays,
            s = r.getCellsPerWeek,
            c = e.formatDates
    }

    function Q(t, e) {
        function n(t, e) {
            e && l(t, e), i(t, 0 > e ? -1 : 1);
            var n = d(t, !0),
                c = l(d(n), 1);
            r.title = s(t, a("titleFormat")), r.start = r.visStart = n, r.end = r.visEnd = c, o(1)
        }
        var r = this;
        r.render = n, K.call(r, t, e, "agendaDay");
        var a = r.opt,
            o = r.renderAgenda,
            i = r.skipHiddenDays,
            s = e.formatDate
    }

    function K(n, r, a) {
        function o(t) {
            Ae = t, i(), K ? c() : s()
        }

        function i() {
            Be = Ze("theme") ? "ui" : "fc", Pe = Ze("isRTL"), je = y(Ze("minTime")), Ie = y(Ze("maxTime")), Xe = Ze("columnFormat"), Je = Ze("weekNumbers"), Ve = Ze("weekNumberTitle"), Ue = "iso" != Ze("weekNumberCalculation") ? "w" : "W", Ne = Ze("snapMinutes") || Ze("slotMinutes")
        }

        function s() {
            var e, r, a, o, i, s = Be + "-widget-header",
                l = Be + "-widget-content",
                f = 0 == Ze("slotMinutes") % 15;
            for (c(), ge = t("<div style='position:absolute;z-index:2;left:0;width:100%'/>").appendTo(n), Ze("allDaySlot") ? (pe = t("<div class='fc-event-container' style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(ge), e = "<table style='width:100%' class='fc-agenda-allday' cellspacing='0'><tr><th class='" + s + " fc-agenda-axis'>" + Ze("allDayText") + "</th>" + "<td>" + "<div class='fc-day-content'><div style='position:relative'/></div>" + "</td>" + "<th class='" + s + " fc-agenda-gutter'>&nbsp;</th>" + "</tr>" + "</table>", me = t(e).appendTo(ge), ye = me.find("tr"), C(ye.find("td")), ge.append("<div class='fc-agenda-divider " + s + "'>" + "<div class='fc-agenda-divider-inner'/>" + "</div>")) : pe = t([]), be = t("<div style='position:absolute;width:100%;overflow-x:hidden;overflow-y:auto'/>").appendTo(ge), we = t("<div style='position:relative;width:100%;overflow:hidden'/>").appendTo(be), Ce = t("<div class='fc-event-container' style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(we), e = "<table class='fc-agenda-slots' style='width:100%' cellspacing='0'><tbody>", r = v(), o = u(d(r), Ie), u(r, je), Oe = 0, a = 0; o > r; a++) i = r.getMinutes(), e += "<tr class='fc-slot" + a + " " + (i ? "fc-minor" : "") + "'>" + "<th class='fc-agenda-axis " + s + "'>" + (f && i ? "&nbsp;" : sn(r, Ze("axisFormat"))) + "</th>" + "<td class='" + l + "'>" + "<div style='position:relative'>&nbsp;</div>" + "</td>" + "</tr>", u(r, Ze("slotMinutes")), Oe++;
            e += "</tbody></table>", Me = t(e).appendTo(we), Ee = Me.find("div:first"), M(Me.find("td"))
        }

        function c() {
            var e = h();
            K && K.remove(), K = t(e).appendTo(n), ee = K.find("thead"), ne = ee.find("th").slice(1, -1), re = K.find("tbody"), oe = re.find("td").slice(0, -1), ie = oe.find("> div"), se = oe.find(".fc-day-content > div"), de = oe.eq(0), he = ie.eq(0), P(ee.add(ee.find("tr"))), P(re.add(re.find("tr")))
        }

        function h() {
            var t = "<table style='width:100%' class='fc-agenda-days fc-border-separate' cellspacing='0'>" + g() + p() + "</table>";
            return t
        }

        function g() {
            var t, e, n, r = Be + "-widget-header",
                a = "";
            for (a += "<thead><tr>", Je ? (e = sn(t, Ue), Pe ? e += Ve : e = Ve + e, a += "<th class='fc-agenda-axis fc-week-number " + r + "'>" + Y(e) + "</th>") : a += "<th class='fc-agenda-axis " + r + "'>&nbsp;</th>", n = 0; Ae > n; n++) t = rn(0, n), a += "<th class='fc-" + De[t.getDay()] + " fc-col" + n + " " + r + "'>" + Y(sn(t, Xe)) + "</th>";
            return a += "<th class='fc-agenda-gutter " + r + "'>&nbsp;</th>" + "</tr>" + "</thead>"
        }

        function p() {
            var t, e, n, r, a, o = Be + "-widget-header",
                i = Be + "-widget-content",
                s = f(new Date),
                l = "";
            for (l += "<tbody><tr><th class='fc-agenda-axis " + o + "'>&nbsp;</th>", n = "", e = 0; Ae > e; e++) t = rn(0, e), a = ["fc-col" + e, "fc-" + De[t.getDay()], i], +t == +s ? a.push(Be + "-state-highlight", "fc-today") : s > t ? a.push("fc-past") : a.push("fc-future"), r = "<td class='" + a.join(" ") + "'>" + "<div>" + "<div class='fc-day-content'>" + "<div style='position:relative'>&nbsp;</div>" + "</div>" + "</div>" + "</td>", n += r;
            return l += n, l += "<td class='fc-agenda-gutter " + i + "'>&nbsp;</td>" + "</tr>" + "</tbody>"
        }

        function m(t) {
            t === e && (t = xe), xe = t, ln = {};
            var n = re.position().top,
                r = be.position().top,
                a = Math.min(t - n, Me.height() + r + 1);
            he.height(a - R(de)), ge.css("top", n), be.height(a - r - 1), Re = Ee.height() + 1, ze = Ze("slotMinutes") / Ne, We = Re / ze
        }

        function b(e) {
            Se = e, qe.clear(), Ye.clear();
            var n = ee.find("th:first");
            me && (n = n.add(me.find("th:first"))), n = n.add(Me.find("th:first")), ke = 0, T(n.width("").each(function (e, n) {
                ke = Math.max(ke, t(n).outerWidth())
            }), ke);
            var r = K.find(".fc-agenda-gutter");
            me && (r = r.add(me.find("th.fc-agenda-gutter")));
            var a = be[0].clientWidth;
            Fe = be.width() - a, Fe ? (T(r, Fe), r.show().prev().removeClass("fc-last")) : r.hide().prev().addClass("fc-last"), He = Math.floor((a - ke) / Ae), T(ne.slice(0, -1), He)
        }

        function D() {
            function t() {
                be.scrollTop(r)
            }
            var e = v(),
                n = d(e);
            n.setHours(Ze("firstHour"));
            var r = _(e, n) + 1;
            t(), setTimeout(t, 0)
        }

        function w() {
            D()
        }

        function C(t) {
            t.click(E).mousedown(en)
        }

        function M(t) {
            t.click(E).mousedown(U)
        }

        function E(t) {
            if (!Ze("selectable")) {
                var e = Math.min(Ae - 1, Math.floor((t.pageX - K.offset().left - ke) / He)),
                    n = rn(0, e),
                    r = this.parentNode.className.match(/fc-slot(\d+)/);
                if (r) {
                    var a = parseInt(r[1]) * Ze("slotMinutes"),
                        o = Math.floor(a / 60);
                    n.setHours(o), n.setMinutes(a % 60 + je), Ge("dayClick", oe[e], n, !1, t)
                } else Ge("dayClick", oe[e], n, !0, t)
            }
        }

        function x(t, e, n) {
            n && Le.build();
            for (var r = on(t, e), a = 0; r.length > a; a++) {
                var o = r[a];
                C(k(o.row, o.leftCol, o.row, o.rightCol))
            }
        }

        function k(t, e, n, r) {
            var a = Le.rect(t, e, n, r, ge);
            return $e(a, ge)
        }

        function H(t, e) {
            for (var n = 0; Ae > n; n++) {
                var r = rn(0, n),
                    a = l(d(r), 1),
                    o = new Date(Math.max(r, t)),
                    i = new Date(Math.min(a, e));
                if (i > o) {
                    var s = Le.rect(0, n, 0, n, we),
                        c = _(r, o),
                        u = _(r, i);
                    s.top = c, s.height = u - c, M($e(s, we))
                }
            }
        }

        function F(t) {
            return qe.left(t)
        }

        function N(t) {
            return Ye.left(t)
        }

        function z(t) {
            return qe.right(t)
        }

        function W(t) {
            return Ye.right(t)
        }

        function A(t) {
            return Ze("allDaySlot") && !t.row
        }

        function L(t) {
            var e = rn(0, t.col),
                n = t.row;
            return Ze("allDaySlot") && n--, n >= 0 && u(e, je + n * Ne), e
        }

        function _(t, n) {
            if (t = d(t, !0), u(d(t), je) > n) return 0;
            if (n >= u(d(t), Ie)) return Me.height();
            var r = Ze("slotMinutes"),
                a = 60 * n.getHours() + n.getMinutes() - je,
                o = Math.floor(a / r),
                i = ln[o];
            return i === e && (i = ln[o] = Me.find("tr").eq(o).find("td div")[0].offsetTop), Math.max(0, Math.round(i - 1 + Re * (a % r / r)))
        }

        function q() {
            return ye
        }

        function j(t) {
            var e = d(t.start);
            return t.allDay ? e : u(e, Ze("defaultEventMinutes"))
        }

        function I(t, e) {
            return e ? d(t) : u(d(t), Ze("slotMinutes"))
        }

        function X(t, e, n) {
            n ? Ze("allDaySlot") && x(t, l(d(e), 1), !0) : J(t, e)
        }

        function J(e, n) {
            var r = Ze("selectHelper");
            if (Le.build(), r) {
                var a = an(e).col;
                if (a >= 0 && Ae > a) {
                    var o = Le.rect(0, a, 0, a, we),
                        i = _(e, e),
                        s = _(e, n);
                    if (s > i) {
                        if (o.top = i, o.height = s - i, o.left += 2, o.width -= 5, t.isFunction(r)) {
                            var l = r(e, n);
                            l && (o.position = "absolute", Te = t(l).css(o).appendTo(we))
                        } else o.isStart = !0, o.isEnd = !0, Te = t(nn({
                            title: "",
                            start: e,
                            end: n,
                            className: ["fc-select-helper"],
                            editable: !1
                        }, o)), Te.css("opacity", Ze("dragOpacity"));
                        Te && (M(Te), we.append(Te), T(Te, o.width, !0), S(Te, o.height, !0))
                    }
                }
            } else H(e, n)
        }

        function V() {
            Qe(), Te && (Te.remove(), Te = null)
        }

        function U(e) {
            if (1 == e.which && Ze("selectable")) {
                tn(e);
                var n;
                _e.start(function (t, e) {
                    if (V(), t && t.col == e.col && !A(t)) {
                        var r = L(e),
                            a = L(t);
                        n = [r, u(d(r), Ne), a, u(d(a), Ne)].sort(O), J(n[0], n[3])
                    } else n = null
                }, e), t(document).one("mouseup", function (t) {
                    _e.stop(), n && (+n[0] == +n[1] && Z(n[0], !1, t), Ke(n[0], n[3], !1, t))
                })
            }
        }

        function Z(t, e, n) {
            Ge("dayClick", oe[an(t).col], t, e, n)
        }

        function G(t, e) {
            _e.start(function (t) {
                if (Qe(), t)
                    if (A(t)) k(t.row, t.col, t.row, t.col);
                    else {
                        var e = L(t),
                            n = u(d(e), Ze("defaultEventMinutes"));
                        H(e, n)
                    }
            }, e)
        }

        function $(t, e, n) {
            var r = _e.stop();
            Qe(), r && Ge("drop", t, L(r), A(r), e, n)
        }
        var Q = this;
        Q.renderAgenda = o, Q.setWidth = b, Q.setHeight = m, Q.afterRender = w, Q.defaultEventEnd = j, Q.timePosition = _, Q.getIsCellAllDay = A, Q.allDayRow = q, Q.getCoordinateGrid = function () {
            return Le
        }, Q.getHoverListener = function () {
            return _e
        }, Q.colLeft = F, Q.colRight = z, Q.colContentLeft = N, Q.colContentRight = W, Q.getDaySegmentContainer = function () {
            return pe
        }, Q.getSlotSegmentContainer = function () {
            return Ce
        }, Q.getMinMinute = function () {
            return je
        }, Q.getMaxMinute = function () {
            return Ie
        }, Q.getSlotContainer = function () {
            return we
        }, Q.getRowCnt = function () {
            return 1
        }, Q.getColCnt = function () {
            return Ae
        }, Q.getColWidth = function () {
            return He
        }, Q.getSnapHeight = function () {
            return We
        }, Q.getSnapMinutes = function () {
            return Ne
        }, Q.defaultSelectionEnd = I, Q.renderDayOverlay = x, Q.renderSelection = X, Q.clearSelection = V, Q.reportDayClick = Z, Q.dragStart = G, Q.dragStop = $, ae.call(Q, n, r, a), ce.call(Q), le.call(Q), te.call(Q);
        var K, ee, ne, re, oe, ie, se, de, he, ge, pe, me, ye, be, we, Ce, Me, Ee, Te, Se, xe, ke, He, Fe, Re, Ne, ze, We, Ae, Oe, Le, _e, qe, Ye, Be, Pe, je, Ie, Xe, Je, Ve, Ue, Ze = Q.opt,
            Ge = Q.trigger,
            $e = Q.renderOverlay,
            Qe = Q.clearOverlays,
            Ke = Q.reportSelection,
            tn = Q.unselect,
            en = Q.daySelectionMousedown,
            nn = Q.slotSegHtml,
            rn = Q.cellToDate,
            an = Q.dateToCell,
            on = Q.rangeToSegments,
            sn = r.formatDate,
            ln = {};
        B(n.addClass("fc-agenda")), Le = new ue(function (e, n) {
            function r(t) {
                return Math.max(l, Math.min(c, t))
            }
            var a, o, i;
            ne.each(function (e, r) {
                a = t(r), o = a.offset().left, e && (i[1] = o), i = [o], n[e] = i
            }), i[1] = o + a.outerWidth(), Ze("allDaySlot") && (a = ye, o = a.offset().top, e[0] = [o, o + a.outerHeight()]);
            for (var s = we.offset().top, l = be.offset().top, c = l + be.outerHeight(), u = 0; Oe * ze > u; u++) e.push([r(s + We * u), r(s + We * (u + 1))])
        }), _e = new fe(Le), qe = new ve(function (t) {
            return ie.eq(t)
        }), Ye = new ve(function (t) {
            return se.eq(t)
        })
    }

    function te() {
        function n(t, e) {
            var n, r = t.length,
                o = [],
                i = [];
            for (n = 0; r > n; n++) t[n].allDay ? o.push(t[n]) : i.push(t[n]);
            y("allDaySlot") && (re(o, e), k()), s(a(i), e)
        }

        function r() {
            H().empty(), F().empty()
        }

        function a(e) {
            var n, r, a, s, l, c, f, v = P(),
                h = W(),
                g = z(),
                p = t.map(e, i),
                m = [];
            for (r = 0; v > r; r++)
                for (n = q(0, r), u(n, h), a = ee(o(e, p, n, u(d(n), g - h))), ne(a), s = 0; a.length > s; s++)
                    for (l = a[s], c = 0; l.length > c; c++) f = l[c], f.col = r, f.level = s, m.push(f);
            return m
        }

        function o(t, e, n, r) {
            var a, o, i, s, l, c, u, f, v = [],
                h = t.length;
            for (a = 0; h > a; a++) o = t[a], i = o.start, s = e[a], s > n && r > i && (n > i ? (l = d(n), u = !1) : (l = i, u = !0), s > r ? (c = d(r), f = !1) : (c = s, f = !0), v.push({
                event: o,
                start: l,
                end: c,
                isStart: u,
                isEnd: f,
                msLength: c - l
            }));
            return v.sort(B)
        }

        function i(t) {
            return t.end ? d(t.end) : u(d(t.start), y("defaultEventMinutes"))
        }

        function s(n, r) {
            var a, o, i, s, l, u, d, v, h, g, p, m, D, w, C, M, T, S, k, H = n.length,
                N = "",
                z = F();
            for (k = (S = y("isRTL")) ? -1 : 1, a = 0; H > a; a++) o = n[a], i = o.event, s = A(o.start, o.start), l = A(o.start, o.end), u = o.col, d = o.level, v = o.forward || 0, h = L(u), g = _(u) - h, g = Math.min(g - 6, .95 * g), p = d ? g / (d + v + 1) : v ? 2 * (g / (v + 1) - 6) : g, m = h + g / (d + v + 1) * d * k + (S ? g - p : 0), o.top = s, o.left = m, o.outerWidth = p, o.outerHeight = l - s, N += c(i, o);
            for (z[0].innerHTML = N, D = z.children(), a = 0; H > a; a++) o = n[a], i = o.event, w = t(D[a]), C = b("eventRender", i, i, w), C === !1 ? w.remove() : (C && C !== !0 && (w.remove(), w = t(C).css({
                position: "absolute",
                top: o.top,
                left: o.left
            }).appendTo(z)), o.element = w, i._id === r ? f(i, w, o) : w[0]._fci = a, U(i, w));
            for (E(z, n, f), a = 0; H > a; a++) o = n[a], (w = o.element) && (o.vsides = R(w, !0), o.hsides = x(w, !0), M = w.find(".fc-event-title"), M.length && (o.contentTop = M[0].offsetTop));
            for (a = 0; H > a; a++) o = n[a], (w = o.element) && (w[0].style.width = Math.max(0, o.outerWidth - o.hsides) + "px", T = Math.max(0, o.outerHeight - o.vsides), w[0].style.height = T + "px", i = o.event, o.contentTop !== e && 10 > T - o.contentTop && (w.find("div.fc-event-time").text(ie(i.start, y("timeFormat")) + " - " + i.title), w.find("div.fc-event-title").remove()), b("eventAfterRender", i, i, w))
        }

        function c(t, e) {
            var n = "<",
                r = t.url,
                a = j(t, y),
                o = ["fc-event", "fc-event-vert"];
            return D(t) && o.push("fc-event-draggable"), e.isStart && o.push("fc-event-start"), e.isEnd && o.push("fc-event-end"), o = o.concat(t.className), t.source && (o = o.concat(t.source.className || [])), n += r ? "a href='" + Y(t.url) + "'" : "div", n += " class='" + o.join(" ") + "'" + " style=" + "'" + "position:absolute;" + "top:" + e.top + "px;" + "left:" + e.left + "px;" + a + "'" + ">" + "<div class='fc-event-inner'>" + "<div class='fc-event-time'>" + Y(se(t.start, t.end, y("timeFormat"))) + "</div>" + "<div class='fc-event-title'>" + Y(t.title || "") + "</div>" + "</div>" + "<div class='fc-event-bg'></div>", e.isEnd && w(t) && (n += "<div class='ui-resizable-handle ui-resizable-s'>=</div>"), n += "</" + (r ? "a" : "div") + ">"
        }

        function f(t, e, n) {
            var r = e.find("div.fc-event-time");
            D(t) && g(t, e, r), n.isEnd && w(t) && p(t, e, r), T(t, e)
        }

        function v(t, e, n) {
            function r() {
                c || (e.width(a).height("").draggable("option", "grid", null), c = !0)
            }
            var a, o, i, s = n.isStart,
                c = !0,
                u = N(),
                f = I(),
                v = X(),
                g = J(),
                p = W();
            e.draggable({
                opacity: y("dragOpacity", "month"),
                revertDuration: y("dragRevertDuration"),
                start: function (n, p) {
                    b("eventDragStart", e, t, n, p), G(t, e), a = e.width(), u.start(function (n, a) {
                        if (te(), n) {
                            o = !1;
                            var u = q(0, a.col),
                                p = q(0, n.col);
                            i = h(p, u), n.row ? s ? c && (e.width(f - 10), S(e, v * Math.round((t.end ? (t.end - t.start) / Me : y("defaultEventMinutes")) / g)), e.draggable("option", "grid", [f, 1]), c = !1) : o = !0 : (K(l(d(t.start), i), l(C(t), i)), r()), o = o || c && !i
                        } else r(), o = !0;
                        e.draggable("option", "revert", o)
                    }, n, "drag")
                },
                stop: function (n, a) {
                    if (u.stop(), te(), b("eventDragStop", e, t, n, a), o) r(), e.css("filter", ""), Z(t, e);
                    else {
                        var s = 0;
                        c || (s = Math.round((e.offset().top - V().offset().top) / v) * g + p - (60 * t.start.getHours() + t.start.getMinutes())), $(this, t, i, s, c, n, a)
                    }
                }
            })
        }

        function g(t, e, n) {
            function r() {
                te(), s && (f ? (n.hide(), e.draggable("option", "grid", null), K(l(d(t.start), D), l(C(t), D))) : (a(w), n.css("display", ""), e.draggable("option", "grid", [S, x])))
            }

            function a(e) {
                var r, a = u(d(t.start), e);
                t.end && (r = u(d(t.end), e)), n.text(se(a, r, y("timeFormat")))
            }
            var o, i, s, c, f, v, g, p, D, w, M, E = m.getCoordinateGrid(),
                T = P(),
                S = I(),
                x = X(),
                k = J();
            e.draggable({
                scroll: !1,
                grid: [S, x],
                axis: 1 == T ? "y" : !1,
                opacity: y("dragOpacity"),
                revertDuration: y("dragRevertDuration"),
                start: function (n, r) {
                    b("eventDragStart", e, t, n, r), G(t, e), E.build(), o = e.position(), i = E.cell(n.pageX, n.pageY), s = c = !0, f = v = O(i), g = p = 0, D = 0, w = M = 0
                },
                drag: function (t, n) {
                    var a = E.cell(t.pageX, t.pageY);
                    if (s = !! a) {
                        if (f = O(a), g = Math.round((n.position.left - o.left) / S), g != p) {
                            var l = q(0, i.col),
                                u = i.col + g;
                            u = Math.max(0, u), u = Math.min(T - 1, u);
                            var d = q(0, u);
                            D = h(d, l)
                        }
                        f || (w = Math.round((n.position.top - o.top) / x) * k)
                    }(s != c || f != v || g != p || w != M) && (r(), c = s, v = f, p = g, M = w), e.draggable("option", "revert", !s)
                },
                stop: function (n, a) {
                    te(), b("eventDragStop", e, t, n, a), s && (f || D || w) ? $(this, t, D, f ? 0 : w, f, n, a) : (s = !0, f = !1, g = 0, D = 0, w = 0, r(), e.css("filter", ""), e.css(o), Z(t, e))
                }
            })
        }

        function p(t, e, n) {
            var r, a, o = X(),
                i = J();
            e.resizable({
                handles: {
                    s: ".ui-resizable-handle"
                },
                grid: o,
                start: function (n, o) {
                    r = a = 0, G(t, e), b("eventResizeStart", this, t, n, o)
                },
                resize: function (s, l) {
                    r = Math.round((Math.max(o, e.height()) - l.originalSize.height) / o), r != a && (n.text(se(t.start, r || t.end ? u(M(t), i * r) : null, y("timeFormat"))), a = r)
                },
                stop: function (n, a) {
                    b("eventResizeStop", this, t, n, a), r ? Q(this, t, 0, i * r, n, a) : Z(t, e)
                }
            })
        }
        var m = this;
        m.renderEvents = n, m.clearEvents = r, m.slotSegHtml = c, oe.call(m);
        var y = m.opt,
            b = m.trigger,
            D = m.isEventDraggable,
            w = m.isEventResizable,
            M = m.eventEnd,
            T = m.eventElementHandlers,
            k = m.setHeight,
            H = m.getDaySegmentContainer,
            F = m.getSlotSegmentContainer,
            N = m.getHoverListener,
            z = m.getMaxMinute,
            W = m.getMinMinute,
            A = m.timePosition,
            O = m.getIsCellAllDay,
            L = m.colContentLeft,
            _ = m.colContentRight,
            q = m.cellToDate,
            B = m.segmentCompare,
            P = m.getColCnt,
            I = m.getColWidth,
            X = m.getSnapHeight,
            J = m.getSnapMinutes,
            V = m.getSlotContainer,
            U = m.reportEventElement,
            Z = m.showEvents,
            G = m.hideEvents,
            $ = m.eventDrop,
            Q = m.eventResize,
            K = m.renderDayOverlay,
            te = m.clearOverlays,
            re = m.renderDayEvents,
            ae = m.calendar,
            ie = ae.formatDate,
            se = ae.formatDates;
        m.draggableDayEvent = v
    }

    function ee(t) {
        var e, n, r, a, o, i = [],
            s = t.length;
        for (e = 0; s > e; e++) {
            for (n = t[e], r = 0;;) {
                if (a = !1, i[r])
                    for (o = 0; i[r].length > o; o++)
                        if (re(i[r][o], n)) {
                            a = !0;
                            break
                        }
                if (!a) break;
                r++
            }
            i[r] ? i[r].push(n) : i[r] = [n]
        }
        return i
    }

    function ne(t) {
        var e, n, r, a, o, i;
        for (e = t.length - 1; e > 0; e--)
            for (a = t[e], n = 0; a.length > n; n++)
                for (o = a[n], r = 0; t[e - 1].length > r; r++) i = t[e - 1][r], re(o, i) && (i.forward = Math.max(i.forward || 0, (o.forward || 0) + 1))
    }

    function re(t, e) {
        return t.end > e.start && t.start < e.end
    }

    function ae(n, r, a) {
        function o(e, n) {
            var r = Z[e];
            return t.isPlainObject(r) ? q(r, n || a) : r
        }

        function i(t, e) {
            return r.trigger.apply(r, [t, e || B].concat(Array.prototype.slice.call(arguments, 2), [B]))
        }

        function s(t) {
            var e = t.source || {};
            return X(t.startEditable, e.startEditable, o("eventStartEditable"), t.editable, e.editable, o("editable")) && !o("disableDragging")
        }

        function c(t) {
            var e = t.source || {};
            return X(t.durationEditable, e.durationEditable, o("eventDurationEditable"), t.editable, e.editable, o("editable")) && !o("disableResizing")
        }

        function f(t) {
            J = {};
            var e, n, r = t.length;
            for (e = 0; r > e; e++) n = t[e], J[n._id] ? J[n._id].push(n) : J[n._id] = [n]
        }

        function v() {
            J = {}, V = {}, U = []
        }

        function g(t) {
            return t.end ? d(t.end) : P(t)
        }

        function p(t, e) {
            U.push({
                event: t,
                element: e
            }), V[t._id] ? V[t._id].push(e) : V[t._id] = [e]
        }

        function m() {
            t.each(U, function (t, e) {
                B.trigger("eventDestroy", e.event, e.event, e.element)
            })
        }

        function y(t, n) {
            n.click(function (r) {
                return n.hasClass("ui-draggable-dragging") || n.hasClass("ui-resizable-resizing") ? e : i("eventClick", this, t, r)
            }).hover(function (e) {
                i("eventMouseover", this, t, e)
            }, function (e) {
                i("eventMouseout", this, t, e)
            })
        }

        function b(t, e) {
            w(t, e, "show")
        }

        function D(t, e) {
            w(t, e, "hide")
        }

        function w(t, e, n) {
            var r, a = V[t._id],
                o = a.length;
            for (r = 0; o > r; r++) e && a[r][0] == e[0] || a[r][n]()
        }

        function C(t, e, n, r, a, o, s) {
            var l = e.allDay,
                c = e._id;
            E(J[c], n, r, a), i("eventDrop", t, e, n, r, a, function () {
                E(J[c], -n, -r, l), I(c)
            }, o, s), I(c)
        }

        function M(t, e, n, r, a, o) {
            var s = e._id;
            T(J[s], n, r), i("eventResize", t, e, n, r, function () {
                T(J[s], -n, -r), I(s)
            }, a, o), I(s)
        }

        function E(t, n, r, a) {
            r = r || 0;
            for (var o, i = t.length, s = 0; i > s; s++) o = t[s], a !== e && (o.allDay = a), u(l(o.start, n, !0), r), o.end && (o.end = u(l(o.end, n, !0), r)), j(o, Z)
        }

        function T(t, e, n) {
            n = n || 0;
            for (var r, a = t.length, o = 0; a > o; o++) r = t[o], r.end = u(l(g(r), e, !0), n), j(r, Z)
        }

        function S(t) {
            return "object" == typeof t && (t = t.getDay()), Q[t]
        }

        function x() {
            return G
        }

        function k(t, e, n) {
            for (e = e || 1; Q[(t.getDay() + (n ? e : 0) + 7) % 7];) l(t, e)
        }

        function H() {
            var t = F.apply(null, arguments),
                e = R(t),
                n = N(e);
            return n
        }

        function F(t, e) {
            var n = B.getColCnt(),
                r = ee ? -1 : 1,
                a = ee ? n - 1 : 0;
            "object" == typeof t && (e = t.col, t = t.row);
            var o = t * n + (e * r + a);
            return o
        }

        function R(t) {
            var e = B.visStart.getDay();
            return t += K[e], 7 * Math.floor(t / G) + te[(t % G + G) % G] - e
        }

        function N(t) {
            var e = d(B.visStart);
            return l(e, t), e
        }

        function z(t) {
            var e = W(t),
                n = A(e),
                r = O(n);
            return r
        }

        function W(t) {
            return h(t, B.visStart)
        }

        function A(t) {
            var e = B.visStart.getDay();
            return t += e, Math.floor(t / 7) * G + K[(t % 7 + 7) % 7] - K[e]
        }

        function O(t) {
            var e = B.getColCnt(),
                n = ee ? -1 : 1,
                r = ee ? e - 1 : 0,
                a = Math.floor(t / e),
                o = (t % e + e) % e * n + r;
            return {
                row: a,
                col: o
            }
        }

        function L(t, e) {
            for (var n = B.getRowCnt(), r = B.getColCnt(), a = [], o = W(t), i = W(e), s = A(o), l = A(i) - 1, c = 0; n > c; c++) {
                var u = c * r,
                    f = u + r - 1,
                    d = Math.max(s, u),
                    v = Math.min(l, f);
                if (v >= d) {
                    var h = O(d),
                        g = O(v),
                        p = [h.col, g.col].sort(),
                        m = R(d) == o,
                        y = R(v) + 1 == i;
                    a.push({
                        row: c,
                        leftCol: p[0],
                        rightCol: p[1],
                        isStart: m,
                        isEnd: y
                    })
                }
            }
            return a
        }

        function _(t, e) {
            return Y(t, e) || t.event.start - e.event.start || (t.event.title || "").localeCompare(e.event.title)
        }

        function Y(t, e) {
            return "msLength" in t ? e.msLength - t.msLength : e.rightCol - e.leftCol - (t.rightCol - t.leftCol) || e.event.allDay - t.event.allDay
        }
        var B = this;
        B.element = n, B.calendar = r, B.name = a, B.opt = o, B.trigger = i, B.isEventDraggable = s, B.isEventResizable = c, B.setEventData = f, B.clearEventData = v, B.eventEnd = g, B.reportEventElement = p, B.triggerEventDestroy = m, B.eventElementHandlers = y, B.showEvents = b, B.hideEvents = D, B.eventDrop = C, B.eventResize = M;
        var P = B.defaultEventEnd,
            j = r.normalizeEvent,
            I = r.reportEventChange,
            J = {}, V = {}, U = [],
            Z = r.options;
        B.isHiddenDay = S, B.skipHiddenDays = k, B.getCellsPerWeek = x, B.dateToCell = z, B.dateToDayOffset = W, B.dayOffsetToCellOffset = A, B.cellOffsetToCell = O, B.cellToDate = H, B.cellToCellOffset = F, B.cellOffsetToDayOffset = R, B.dayOffsetToDate = N, B.rangeToSegments = L, B.segmentCompare = _;
        var G, $ = o("hiddenDays") || [],
            Q = [],
            K = [],
            te = [],
            ee = o("isRTL");
        (function () {
            o("weekends") === !1 && $.push(0, 6);
            for (var e = 0, n = 0; 7 > e; e++) K[e] = n, Q[e] = -1 != t.inArray(e, $), Q[e] || (te[n] = e, n++);
            if (G = n, !G) throw "invalid hiddenDays"
        })()
    }

    function oe() {
        function e(t, e) {
            var n = r(t, !1, !0);
            se(n, function (t, e) {
                N(t.event, e)
            }), b(n, e), se(n, function (t, e) {
                k("eventAfterRender", t.event, t.event, e)
            })
        }

        function n(t, e, n) {
            var a = r([t], !0, !1),
                o = [];
            return se(a, function (t, r) {
                t.row === e && r.css("top", n), o.push(r[0])
            }), o
        }

        function r(e, n, r) {
            var o, l, c = Z(),
                d = n ? t("<div/>") : c,
                v = a(e);
            return i(v), o = s(v), d[0].innerHTML = o, l = d.children(), n && c.append(l), u(v, l), se(v, function (t, e) {
                t.hsides = x(e, !0)
            }), se(v, function (t, e) {
                e.width(Math.max(0, t.outerWidth - t.hsides))
            }), se(v, function (t, e) {
                t.outerHeight = e.outerHeight(!0)
            }), f(v, r), v
        }

        function a(t) {
            for (var e = [], n = 0; t.length > n; n++) {
                var r = o(t[n]);
                e.push.apply(e, r)
            }
            return e
        }

        function o(t) {
            for (var e = t.start, n = C(t), r = ee(e, n), a = 0; r.length > a; a++) r[a].event = t;
            return r
        }

        function i(t) {
            for (var e = S("isRTL"), n = 0; t.length > n; n++) {
                var r = t[n],
                    a = (e ? r.isEnd : r.isStart) ? V : X,
                    o = (e ? r.isStart : r.isEnd) ? U : J,
                    i = a(r.leftCol),
                    s = o(r.rightCol);
                r.left = i, r.outerWidth = s - i
            }
        }

        function s(t) {
            for (var e = "", n = 0; t.length > n; n++) e += c(t[n]);
            return e
        }

        function c(t) {
            var e = "",
                n = S("isRTL"),
                r = t.event,
                a = r.url,
                o = ["fc-event", "fc-event-hori"];
            H(r) && o.push("fc-event-draggable"), t.isStart && o.push("fc-event-start"), t.isEnd && o.push("fc-event-end"), o = o.concat(r.className), r.source && (o = o.concat(r.source.className || []));
            var i = j(r, S);
            return e += a ? "<a href='" + Y(a) + "'" : "<div", e += " class='" + o.join(" ") + "'" + " style=" + "'" + "position:absolute;" + "left:" + t.left + "px;" + i + "'" + ">" + "<div class='fc-event-inner'>", !r.allDay && t.isStart && (e += "<span class='fc-event-time'>" + Y(G(r.start, r.end, S("timeFormat"))) + "</span>"), e += "<span class='fc-event-title'><nobr>" + Y(r.title || "") + "</nobr></span>" + "</div>", t.isEnd && F(r) && (e += "<div class='ui-resizable-handle ui-resizable-" + (n ? "w" : "e") + "'>" + "&nbsp;&nbsp;&nbsp;" + "</div>"), e += "</" + (a ? "a" : "div") + ">"
        }

        function u(e, n) {
            for (var r = 0; e.length > r; r++) {
                var a = e[r],
                    o = a.event,
                    i = n.eq(r),
                    s = k("eventRender", o, o, i);
                s === !1 ? i.remove() : (s && s !== !0 && (s = t(s).css({
                    position: "absolute",
                    left: a.left
                }), i.replaceWith(s), i = s), a.element = i)
            }
        }

        function f(t, e) {
            var n = v(t),
                r = y(),
                a = [];
            if (e)
                for (var o = 0; r.length > o; o++) r[o].height(n[o]);
            for (var o = 0; r.length > o; o++) a.push(r[o].position().top);
            se(t, function (t, e) {
                e.css("top", a[t.row] + t.top)
            })
        }

        function v(t) {
            for (var e = q(), n = P(), r = [], a = g(t), o = 0; e > o; o++) {
                for (var i = a[o], s = [], l = 0; n > l; l++) s.push(0);
                for (var c = 0; i.length > c; c++) {
                    var u = i[c];
                    u.top = L(s.slice(u.leftCol, u.rightCol + 1));
                    for (var l = u.leftCol; u.rightCol >= l; l++) s[l] = u.top + u.outerHeight
                }
                r.push(L(s))
            }
            return r
        }

        function g(t) {
            var e, n, r, a = q(),
                o = [];
            for (e = 0; t.length > e; e++) n = t[e], r = n.row, n.element && (o[r] ? o[r].push(n) : o[r] = [n]);
            for (r = 0; a > r; r++) o[r] = p(o[r] || []);
            return o
        }

        function p(t) {
            for (var e = [], n = m(t), r = 0; n.length > r; r++) e.push.apply(e, n[r]);
            return e
        }

        function m(t) {
            t.sort(ne);
            for (var e = [], n = 0; t.length > n; n++) {
                for (var r = t[n], a = 0; e.length > a && ie(r, e[a]); a++);
                e[a] ? e[a].push(r) : e[a] = [r]
            }
            return e
        }

        function y() {
            var t, e = q(),
                n = [];
            for (t = 0; e > t; t++) n[t] = I(t).find("div.fc-day-content > div");
            return n
        }

        function b(t, e) {
            var n = Z();
            se(t, function (t, n, r) {
                var a = t.event;
                a._id === e ? D(a, n, t) : n[0]._fci = r
            }), E(n, t, D)
        }

        function D(t, e, n) {
            H(t) && T.draggableDayEvent(t, e, n), n.isEnd && F(t) && T.resizableDayEvent(t, e, n), z(t, e)
        }

        function w(t, e) {
            var n, r = te();
            e.draggable({
                delay: 50,
                opacity: S("dragOpacity"),
                revertDuration: S("dragRevertDuration"),
                start: function (a, o) {
                    k("eventDragStart", e, t, a, o), A(t, e), r.start(function (r, a, o, i) {
                        if (e.draggable("option", "revert", !r || !o && !i), Q(), r) {
                            var s = re(a),
                                c = re(r);
                            n = h(c, s), $(l(d(t.start), n), l(C(t), n))
                        } else n = 0
                    }, a, "drag")
                },
                stop: function (a, o) {
                    r.stop(), Q(), k("eventDragStop", e, t, a, o), n ? O(this, t, n, 0, t.allDay, a, o) : (e.css("filter", ""), W(t, e))
                }
            })
        }

        function M(e, r, a) {
            var o = S("isRTL"),
                i = o ? "w" : "e",
                s = r.find(".ui-resizable-" + i),
                c = !1;
            B(r), r.mousedown(function (t) {
                t.preventDefault()
            }).click(function (t) {
                c && (t.preventDefault(), t.stopImmediatePropagation())
            }), s.mousedown(function (o) {
                function s(n) {
                    k("eventResizeStop", this, e, n), t("body").css("cursor", ""), u.stop(), Q(), f && _(this, e, f, 0, n), setTimeout(function () {
                        c = !1
                    }, 0)
                }
                if (1 == o.which) {
                    c = !0;
                    var u = te();
                    q(), P();
                    var f, d, v = r.css("top"),
                        h = t.extend({}, e),
                        g = ce(le(e.start));
                    K(), t("body").css("cursor", i + "-resize").one("mouseup", s), k("eventResizeStart", this, e, o), u.start(function (r, o) {
                        if (r) {
                            var s = ae(o),
                                c = ae(r);
                            if (c = Math.max(c, g), f = oe(c) - oe(s)) {
                                h.end = l(R(e), f, !0);
                                var u = d;
                                d = n(h, a.row, v), d = t(d), d.find("*").css("cursor", i + "-resize"), u && u.remove(), A(e)
                            } else d && (W(e), d.remove(), d = null);
                            Q(), $(e.start, l(C(e), f))
                        }
                    }, o)
                }
            })
        }
        var T = this;
        T.renderDayEvents = e, T.draggableDayEvent = w, T.resizableDayEvent = M;
        var S = T.opt,
            k = T.trigger,
            H = T.isEventDraggable,
            F = T.isEventResizable,
            R = T.eventEnd,
            N = T.reportEventElement,
            z = T.eventElementHandlers,
            W = T.showEvents,
            A = T.hideEvents,
            O = T.eventDrop,
            _ = T.eventResize,
            q = T.getRowCnt,
            P = T.getColCnt;
        T.getColWidth;
        var I = T.allDayRow,
            X = T.colLeft,
            J = T.colRight,
            V = T.colContentLeft,
            U = T.colContentRight;
        T.dateToCell;
        var Z = T.getDaySegmentContainer,
            G = T.calendar.formatDates,
            $ = T.renderDayOverlay,
            Q = T.clearOverlays,
            K = T.clearSelection,
            te = T.getHoverListener,
            ee = T.rangeToSegments,
            ne = T.segmentCompare,
            re = T.cellToDate,
            ae = T.cellToCellOffset,
            oe = T.cellOffsetToDayOffset,
            le = T.dateToDayOffset,
            ce = T.dayOffsetToCellOffset
    }

    function ie(t, e) {
        for (var n = 0; e.length > n; n++) {
            var r = e[n];
            if (r.leftCol <= t.rightCol && r.rightCol >= t.leftCol) return !0
        }
        return !1
    }

    function se(t, e) {
        for (var n = 0; t.length > n; n++) {
            var r = t[n],
                a = r.element;
            a && e(r, a, n)
        }
    }

    function le() {
        function e(t, e, a) {
            n(), e || (e = l(t, a)), c(t, e, a), r(t, e, a)
        }

        function n(t) {
            f && (f = !1, u(), s("unselect", null, t))
        }

        function r(t, e, n, r) {
            f = !0, s("select", null, t, e, n, r)
        }

        function a(e) {
            var a = o.cellToDate,
                s = o.getIsCellAllDay,
                l = o.getHoverListener(),
                f = o.reportDayClick;
            if (1 == e.which && i("selectable")) {
                n(e);
                var d;
                l.start(function (t, e) {
                    u(), t && s(t) ? (d = [a(e), a(t)].sort(O), c(d[0], d[1], !0)) : d = null
                }, e), t(document).one("mouseup", function (t) {
                    l.stop(), d && (+d[0] == +d[1] && f(d[0], !0, t), r(d[0], d[1], !0, t))
                })
            }
        }
        var o = this;
        o.select = e, o.unselect = n, o.reportSelection = r, o.daySelectionMousedown = a;
        var i = o.opt,
            s = o.trigger,
            l = o.defaultSelectionEnd,
            c = o.renderSelection,
            u = o.clearSelection,
            f = !1;
        i("selectable") && i("unselectAuto") && t(document).mousedown(function (e) {
            var r = i("unselectCancel");
            r && t(e.target).parents(r).length || n(e)
        })
    }

    function ce() {
        function e(e, n) {
            var r = o.shift();
            return r || (r = t("<div class='fc-cell-overlay' style='position:absolute;z-index:3'/>")), r[0].parentNode != n[0] && r.appendTo(n), a.push(r.css(e).show()), r
        }

        function n() {
            for (var t; t = a.shift();) o.push(t.hide().unbind())
        }
        var r = this;
        r.renderOverlay = e, r.clearOverlays = n;
        var a = [],
            o = []
    }

    function ue(t) {
        var e, n, r = this;
        r.build = function () {
            e = [], n = [], t(e, n)
        }, r.cell = function (t, r) {
            var a, o = e.length,
                i = n.length,
                s = -1,
                l = -1;
            for (a = 0; o > a; a++)
                if (r >= e[a][0] && e[a][1] > r) {
                    s = a;
                    break
                }
            for (a = 0; i > a; a++)
                if (t >= n[a][0] && n[a][1] > t) {
                    l = a;
                    break
                }
            return s >= 0 && l >= 0 ? {
                row: s,
                col: l
            } : null
        }, r.rect = function (t, r, a, o, i) {
            var s = i.offset();
            return {
                top: e[t][0] - s.top,
                left: n[r][0] - s.left,
                width: n[o][1] - n[r][0],
                height: e[a][1] - e[t][0]
            }
        }
    }

    function fe(e) {
        function n(t) {
            de(t);
            var n = e.cell(t.pageX, t.pageY);
            (!n != !i || n && (n.row != i.row || n.col != i.col)) && (n ? (o || (o = n), a(n, o, n.row - o.row, n.col - o.col)) : a(n, o), i = n)
        }
        var r, a, o, i, s = this;
        s.start = function (s, l, c) {
            a = s, o = i = null, e.build(), n(l), r = c || "mousemove", t(document).bind(r, n)
        }, s.stop = function () {
            return t(document).unbind(r, n), i
        }
    }

    function de(t) {
        t.pageX === e && (t.pageX = t.originalEvent.pageX, t.pageY = t.originalEvent.pageY)
    }

    function ve(t) {
        function n(e) {
            return a[e] = a[e] || t(e)
        }
        var r = this,
            a = {}, o = {}, i = {};
        r.left = function (t) {
            return o[t] = o[t] === e ? n(t).position().left : o[t]
        }, r.right = function (t) {
            return i[t] = i[t] === e ? r.left(t) + n(t).width() : i[t]
        }, r.clear = function () {
            a = {}, o = {}, i = {}
        }
    }
    var he = {
        defaultView: "month",
        aspectRatio: 1.35,
        header: {
            left: "title",
            center: "",
            right: "today prev,next"
        },
        weekends: !0,
        weekNumbers: !1,
        weekNumberCalculation: "iso",
        weekNumberTitle: "W",
        allDayDefault: !0,
        ignoreTimezone: !0,
        lazyFetching: !0,
        startParam: "start",
        endParam: "end",
        titleFormat: {
            month: "MMMM · yyyy",
            week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",
            day: "dddd, MMM d, yyyy"
        },
        columnFormat: {
            month: "ddd",
            week: "ddd M/d",
            day: "dddd M/d"
        },
        timeFormat: {
            "": "h(:mm)t"
        },
        isRTL: !1,
        firstDay: 0,
        monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        buttonText: {
            prev: "<span class='fc-text-arrow'>&lsaquo;</span>",
            next: "<span class='fc-text-arrow'>&rsaquo;</span>",
            prevYear: "<span class='fc-text-arrow'>&laquo;</span>",
            nextYear: "<span class='fc-text-arrow'>&raquo;</span>",
            today: "today",
            month: "month",
            week: "week",
            day: "day"
        },
        theme: !1,
        buttonIcons: {
            prev: "circle-triangle-w",
            next: "circle-triangle-e"
        },
        unselectAuto: !0,
        dropAccept: "*",
        handleWindowResize: !0
    }, ge = {
            header: {
                left: "next,prev today",
                center: "",
                right: "title"
            },
            buttonText: {
                prev: "<span class='fc-text-arrow'>&rsaquo;</span>",
                next: "<span class='fc-text-arrow'>&lsaquo;</span>",
                prevYear: "<span class='fc-text-arrow'>&raquo;</span>",
                nextYear: "<span class='fc-text-arrow'>&laquo;</span>"
            },
            buttonIcons: {
                prev: "circle-triangle-e",
                next: "circle-triangle-w"
            }
        }, pe = t.fullCalendar = {
            version: "1.6.3"
        }, me = pe.views = {};
	
    t.fn.fullCalendar = function (n) {		
        if ("string" == typeof n) {
            var a, o = Array.prototype.slice.call(arguments, 1);
            return this.each(function () {
                var r = t.data(this, "fullCalendar");
                if (r && t.isFunction(r[n])) {
                    var i = r[n].apply(r, o);
                    a === e && (a = i), "destroy" == n && t.removeData(this, "fullCalendar")
                }
            }), a !== e ? a : this
        }
        var i = n.eventSources || [];

        return delete n.events && (i.push(n.events), delete n.events), n = t.extend(!0, {}, he, n.isRTL || n.isRTL === e && he.isRTL ? ge : {}, e), this.each(function (e, a) {	
			
            var o = t(a),
                s = new r(o, n, i);
				
            o.data("fullCalendar", s), s.render()
        }), this
    }, pe.sourceNormalizers = [], pe.sourceFetchers = [];
    var ye = {
        dataType: "json",
        cache: !1
    }, be = 1;
    pe.addDays = l, pe.cloneDate = d, pe.parseDate = p, pe.parseISO8601 = m, pe.parseTime = y, pe.formatDate = b, pe.formatDates = D;
    var De = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"],
        we = 864e5,
        Ce = 36e5,
        Me = 6e4,
        Ee = {
            s: function (t) {
                return t.getSeconds()
            },
            ss: function (t) {
                return _(t.getSeconds())
            },
            m: function (t) {
                return t.getMinutes()
            },
            mm: function (t) {
                return _(t.getMinutes())
            },
            h: function (t) {
                return t.getHours() % 12 || 12
            },
            hh: function (t) {
                return _(t.getHours() % 12 || 12)
            },
            H: function (t) {
                return t.getHours()
            },
            HH: function (t) {
                return _(t.getHours())
            },
            d: function (t) {
                return t.getDate()
            },
            dd: function (t) {
                return _(t.getDate())
            },
            ddd: function (t, e) {
                return e.dayNamesShort[t.getDay()]
            },
            dddd: function (t, e) {
                return e.dayNames[t.getDay()]
            },
            M: function (t) {
                return t.getMonth() + 1
            },
            MM: function (t) {
                return _(t.getMonth() + 1)
            },
            MMM: function (t, e) {
                return e.monthNamesShort[t.getMonth()]
            },
            MMMM: function (t, e) {
                return e.monthNames[t.getMonth()]
            },
            yy: function (t) {
                return (t.getFullYear() + "").substring(2)
            },
            yyyy: function (t) {
                return t.getFullYear()
            },
            t: function (t) {
                return 12 > t.getHours() ? "a" : "p"
            },
            tt: function (t) {
                return 12 > t.getHours() ? "am" : "pm"
            },
            T: function (t) {
                return 12 > t.getHours() ? "A" : "P"
            },
            TT: function (t) {
                return 12 > t.getHours() ? "AM" : "PM"
            },
            u: function (t) {
                return b(t, "yyyy-MM-dd'T'HH:mm:ss'Z'")
            },
            S: function (t) {
                var e = t.getDate();
                return e > 10 && 20 > e ? "th" : ["st", "nd", "rd"][e % 10 - 1] || "th"
            },
            w: function (t, e) {
                return e.weekNumberCalculation(t)
            },
            W: function (t) {
                return w(t)
            }
        };
    pe.dateFormatters = Ee, pe.applyAll = I, me.month = J, me.basicWeek = V, me.basicDay = U, n({
        weekMode: "fixed"
    }), me.agendaWeek = $, me.agendaDay = Q, n({
        allDaySlot: !0,
        allDayText: "all-day",
        firstHour: 6,
        slotMinutes: 30,
        defaultEventMinutes: 120,
        axisFormat: "h(:mm)tt",
        timeFormat: {
            agenda: "h:mm{ - h:mm}"
        },
        dragOpacity: {
            agenda: .5
        },
        minTime: 0,
        maxTime: 24
    })
})(jQuery);
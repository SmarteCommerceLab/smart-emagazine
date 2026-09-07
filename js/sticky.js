/**
 * jquery.stickOnScroll.js
 * A jQuery plugin for making element fixed on the page.
 * 
 * Created by Paul Tavares on 2012-10-19.
 * Copyright 2012 Paul Tavares. All rights reserved.
 * Licensed under the terms of the MIT License
 * 
 */
! function(t) {
    "use strict";

    function e(e) {
        var s, n, l = o[t(this).prop("stickOnScroll")];
        for (s = 0, n = l.length; s < n; s++) ! function(t) {
            var e, o, n, c, r, p;
            null !== (t = l[s]) && null === t.ele[0].parentNode && (l[s] = t = null), null !== t && (e = t.viewport.scrollTop(), o = t.getEleMaxTop(), !1 === t.isWindow && i && t.ele.stop(), e > o ? (n = {
                position: "fixed",
                top: t.topOffset - t.eleTopMargin
            }, !1 === t.isWindow && (n = {
                position: "absolute",
                top: e + t.topOffset - t.eleTopMargin
            }), t.isStick = !0, t.footerElement.length && (c = t.footerElement.position().top, r = t.ele.outerHeight(), p = n.top + r + t.bottomOffset + t.topOffset, !1 === t.isWindow ? p = r + t.bottomOffset + t.topOffset : (p = n.top + e + r + t.bottomOffset, c = t.footerElement.offset().top), p > c && (!0 === t.isWindow ? n.top = c - (e + r + t.bottomOffset) : n.top = e - (p - c))), !0 === t.setParentOnStick && t.eleParent.css("height", t.eleParent.height()), !0 === t.setWidthOnStick && t.ele.css("width", t.ele.css("width")), i && !1 === t.isWindow ? t.ele.addClass(t.stickClass).css("position", n.position).animate({
                top: n.top
            }, 150) : t.ele.css(n).addClass(t.stickClass), !1 === t.wasStickCalled && (t.wasStickCalled = !0, setTimeout(function() {
                !0 === t.isOnStickSet && t.onStick.call(t.ele, t.ele), t.ele.trigger("stickOnScroll:onStick", [t.ele])
            }, 20))) : e <= o && t.isStick && (t.ele.css({
                position: "",
                top: ""
            }).removeClass(t.stickClass), t.isStick = !1, !0 === t.setParentOnStick && t.eleParent.css("height", ""), !0 === t.setWidthOnStick && t.ele.css("width", ""), t.wasStickCalled = !1, setTimeout(function() {
                t.isOnUnStickSet && t.onUnStick.call(t.ele, t.ele), t.ele.trigger("stickOnScroll:onUnStick", [t.ele])
            }, 20)), 0 === e && t.setEleTop())
        }(l[s]);
        return this
    }
    var i = !1 === t.support.optSelected,
        o = {};
    t.fn.stickOnScroll = function(i) {
        return this.each(function() {
            function s() {
                c.setEleTop(), (n = c.viewport.prop("stickOnScroll")) || (n = "stickOnScroll" + String(Math.random()).replace(/\D/g, ""), c.viewport.prop("stickOnScroll", n), o[n] = [], c.viewport.on("scroll", e)), o[n].push(c), c.viewport.scroll()
            }
            if (t(this).hasClass("hasStickOnScroll")) return this;
            var n, l, c = t.extend({}, {
                    topOffset: 0,
                    bottomOffset: 5,
                    footerElement: null,
                    viewport: window,
                    stickClass: "stickOnScroll-on",
                    setParentOnStick: !1,
                    setWidthOnStick: !1,
                    onStick: null,
                    onUnStick: null
                }, i),
                r = 1800;
            return c.isStick = !1, c.ele = t(this).addClass("hasStickOnScroll"), c.eleParent = c.ele.parent(), c.viewport = t(c.viewport), c.eleTop = 0, c.eleTopMargin = parseFloat(c.ele.css("margin-top")), c.footerElement = t(c.footerElement), c.isWindow = !0, c.isOnStickSet = t.isFunction(c.onStick), c.isOnUnStickSet = t.isFunction(c.onUnStick), c.wasStickCalled = !1, c.setEleTop = function() {
                !1 === c.isStick && (c.isWindow ? c.eleTop = c.ele.offset().top : c.eleTop = c.ele.position().top)
            }, c.getEleMaxTop = function() {
                var t = c.eleTop - c.topOffset;
                return c.isWindow || (t += c.eleTopMargin), t
            }, !0 === c.setParentOnStick && c.eleParent.is("body") && (c.setParentOnStick = !1), t.isWindow(c.viewport[0]) || (c.isWindow = !1), c.ele.is(":visible") ? s() : l = setInterval(function() {
                !c.ele.is(":visible") && r || (clearInterval(l), s()), --r
            }, 100), this
        })
    }
}(jQuery);
/* <![CDATA[ */
window._wpemojiSettings = {
    "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/16.0.1\/72x72\/",
    "ext": ".png",
    "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/16.0.1\/svg\/",
    "svgExt": ".svg",
    "source": {
        "concatemoji": "https:\/\/www.tokobalimandera.nl\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.8.5"
    }
};
/*! This file is auto-generated */
! function(s, n) {
    var o, i, e;

    function c(e) {
        try {
            var t = {
                supportTests: e,
                timestamp: (new Date).valueOf()
            };
            sessionStorage.setItem(o, JSON.stringify(t))
        } catch (e) {}
    }

    function p(e, t, n) {
        e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(t, 0, 0);
        var t = new Uint32Array(e.getImageData(0, 0, e.canvas.width, e.canvas.height).data),
            a = (e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(n, 0, 0), new Uint32Array(e
                .getImageData(0, 0, e.canvas.width, e.canvas.height).data));
        return t.every(function(e, t) {
            return e === a[t]
        })
    }

    function u(e, t) {
        e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(t, 0, 0);
        for (var n = e.getImageData(16, 16, 1, 1), a = 0; a < n.data.length; a++)
            if (0 !== n.data[a]) return !1;
        return !0
    }

    function f(e, t, n, a) {
        switch (t) {
            case "flag":
                return n(e, "\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f", "\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f") ? !1 : !
                    n(e, "\ud83c\udde8\ud83c\uddf6", "\ud83c\udde8\u200b\ud83c\uddf6") && !n(e,
                        "\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f",
                        "\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f"
                    );
            case "emoji":
                return !a(e, "\ud83e\udedf")
        }
        return !1
    }

    function g(e, t, n, a) {
        var r = "undefined" != typeof WorkerGlobalScope && self instanceof WorkerGlobalScope ? new OffscreenCanvas(
                300, 150) : s.createElement("canvas"),
            o = r.getContext("2d", {
                willReadFrequently: !0
            }),
            i = (o.textBaseline = "top", o.font = "600 32px Arial", {});
        return e.forEach(function(e) {
            i[e] = t(o, e, n, a)
        }), i
    }

    function t(e) {
        var t = s.createElement("script");
        t.src = e, t.defer = !0, s.head.appendChild(t)
    }
    "undefined" != typeof Promise && (o = "wpEmojiSettingsSupports", i = ["flag", "emoji"], n.supports = {
        everything: !0,
        everythingExceptFlag: !0
    }, e = new Promise(function(e) {
        s.addEventListener("DOMContentLoaded", e, {
            once: !0
        })
    }), new Promise(function(t) {
        var n = function() {
            try {
                var e = JSON.parse(sessionStorage.getItem(o));
                if ("object" == typeof e && "number" == typeof e.timestamp && (new Date).valueOf() <
                    e.timestamp + 604800 && "object" == typeof e.supportTests) return e.supportTests
            } catch (e) {}
            return null
        }();
        if (!n) {
            if ("undefined" != typeof Worker && "undefined" != typeof OffscreenCanvas && "undefined" !=
                typeof URL && URL.createObjectURL && "undefined" != typeof Blob) try {
                var e = "postMessage(" + g.toString() + "(" + [JSON.stringify(i), f.toString(), p
                        .toString(), u.toString()
                    ].join(",") + "));",
                    a = new Blob([e], {
                        type: "text/javascript"
                    }),
                    r = new Worker(URL.createObjectURL(a), {
                        name: "wpTestEmojiSupports"
                    });
                return void(r.onmessage = function(e) {
                    c(n = e.data), r.terminate(), t(n)
                })
            } catch (e) {}
            c(n = g(i, f, p, u))
        }
        t(n)
    }).then(function(e) {
        for (var t in e) n.supports[t] = e[t], n.supports.everything = n.supports.everything && n
            .supports[t], "flag" !== t && (n.supports.everythingExceptFlag = n.supports
                .everythingExceptFlag && n.supports[t]);
        n.supports.everythingExceptFlag = n.supports.everythingExceptFlag && !n.supports.flag, n
            .DOMReady = !1, n.readyCallback = function() {
                n.DOMReady = !0
            }
    }).then(function() {
        return e
    }).then(function() {
        var e;
        n.supports.everything || (n.readyCallback(), (e = n.source || {}).concatemoji ? t(e
            .concatemoji) : e.wpemoji && e.twemoji && (t(e.twemoji), t(e.wpemoji)))
    }))
}((window, document), window._wpemojiSettings);
/* ]]> */


        /* <![CDATA[ */
        var Cli_Data = {
            "nn_cookie_ids": [],
            "cookielist": [],
            "non_necessary_cookies": [],
            "ccpaEnabled": "",
            "ccpaRegionBased": "",
            "ccpaBarEnabled": "",
            "strictlyEnabled": ["necessary", "obligatoire"],
            "ccpaType": "gdpr",
            "js_blocking": "1",
            "custom_integration": "",
            "triggerDomRefresh": "",
            "secure_cookies": ""
        };
        var cli_cookiebar_settings = {
            "animate_speed_hide": "500",
            "animate_speed_show": "500",
            "background": "#FFF",
            "border": "#b1a6a6c2",
            "border_on": "",
            "button_1_button_colour": "#61a229",
            "button_1_button_hover": "#4e8221",
            "button_1_link_colour": "#fff",
            "button_1_as_button": "1",
            "button_1_new_win": "",
            "button_2_button_colour": "#333",
            "button_2_button_hover": "#292929",
            "button_2_link_colour": "#444",
            "button_2_as_button": "",
            "button_2_hidebar": "",
            "button_3_button_colour": "#3566bb",
            "button_3_button_hover": "#2a5296",
            "button_3_link_colour": "#fff",
            "button_3_as_button": "1",
            "button_3_new_win": "",
            "button_4_button_colour": "#000",
            "button_4_button_hover": "#000000",
            "button_4_link_colour": "#333333",
            "button_4_as_button": "",
            "button_7_button_colour": "#61a229",
            "button_7_button_hover": "#4e8221",
            "button_7_link_colour": "#fff",
            "button_7_as_button": "1",
            "button_7_new_win": "",
            "font_family": "inherit",
            "header_fix": "",
            "notify_animate_hide": "1",
            "notify_animate_show": "",
            "notify_div_id": "#cookie-law-info-bar",
            "notify_position_horizontal": "right",
            "notify_position_vertical": "bottom",
            "scroll_close": "",
            "scroll_close_reload": "",
            "accept_close_reload": "",
            "reject_close_reload": "",
            "showagain_tab": "",
            "showagain_background": "#fff",
            "showagain_border": "#000",
            "showagain_div_id": "#cookie-law-info-again",
            "showagain_x_position": "100px",
            "text": "#333333",
            "show_once_yn": "",
            "show_once": "10000",
            "logging_on": "",
            "as_popup": "",
            "popup_overlay": "1",
            "bar_heading_text": "",
            "cookie_bar_as": "widget",
            "popup_showagain_position": "bottom-right",
            "widget_position": "right"
        };
        var log_object = {
            "ajax_url": "https:\/\/www.tokobalimandera.nl\/wp-admin\/admin-ajax.php"
        };
        /* ]]> */

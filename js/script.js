var resultWrapper = document.querySelector(".spin-result-wrapper"),
    wheel = document.querySelector(".wheel-img");
function buildQueryString(e) {
    var t = [];
    for (var o in e) e.hasOwnProperty(o) && e[o] && t.push(o + "=" + e[o]);
    return t.join("&");
}
function mapFormDataToObject(e) {
    const t = $(e).serializeArray(),
        o = {};
    return (
        $.map(t, function (e, t) {
            o[e.name] = e.value;
        }),
        o
    );
}
function setOrderCookie() {
    let e = new Date();
    e.setMonth(e.getMonth() + 1), (document.cookie = "ptc=strue; expires=" + e.toGMTString());
}
function spin() {
    wheel.classList.contains("rotated") ||
        (wheel.classList.add("super-rotation"),
        setTimeout(function () {
            resultWrapper.style.display = "block";
        }, 8e3),
        setTimeout(function () {
            $(".spin-wrapper").slideUp(), $("#boxes").slideUp(), $(".order_block").slideDown(), start_timer();
        }, 1e4),
        wheel.classList.add("rotated"));
}
$(function () {
    $("a[href^='#']").click(function () {
        let e = $(this).attr("href");
        return document.getElementById(e.slice(1)) || (e = "#order_form"), $("html, body").animate({ scrollTop: $(e).offset().top + "px" }), !1;
    }),
        $(".fadepopup input").click(function () {
            $(".eeee, .fadepopup").css("display", "none");
        });
});
let counterBagsWidget = 0;
const attempt = 5;
let formTime = 600;
const counterElem = $(".counter_attempts");
let interval = {};
(window.bag = {
    open: (e) => {
        if (counterBagsWidget >= 5) return;
        const t = $(e.currentTarget);
        counterBagsWidget < 6 && !t.hasClass("showed-goods") && (counterBagsWidget++, window.bag.substractConter(), window.bag.changeClass(counterBagsWidget, t)), t.addClass("showed-goods");
    },
    substractConter: () => {
        let e = 5 - counterBagsWidget;
        counterElem.text(e);
    },
    changeClass: (e, t) => {
        switch (e) {
            case 1:
                t.addClass("sale sale-30");
                break;
            case 2:
            case 4:
                t.addClass("sale sale-100");
                break;
            case 3:
                t.addClass("sale sale-50");
                break;
            case 5:
                t.addClass("sale sale-100"), $(".card__item.sale.sale-100").addClass("glow"), window.bag.showResultWindow(), window.bag.showForm();
        }
    },
    showResultWindow: () => {
        setTimeout(function () {
            $(".spin-result-wrapper").css("display", "block");
        }, 1e3);
    },
    showForm: () => {
        setTimeout(function () {
            $(".spin-wrapper").slideUp(), $(".order_block").slideDown(), window.bag.start_timer();
        }, 3e3);
    },
    start_timer: () => {
        interval = setInterval(window.bag.tick, 1e3);
    },
    tick: () => {
        formTime -= 1;
        let e = Math.floor(formTime / 60),
            t = formTime - 60 * e;
        0 == e && 0 == t && clearInterval(interval), (t = t >= 10 ? t : "0" + t), $("#min").html( e), $("#sec").html(t);
    },
}),
    $(".card__item").click((e) => {
        window.bag.open(e);
    });
var closePopup = document.querySelector(".close-popup");
$(".close-popup, .pop-up-button").click(function (e) {
    e.preventDefault(), $(".spin-result-wrapper").fadeOut();
    let t = $("#roulette");
    t || (t = $("#order_form"));
    let o = t.offset().top;
    $("body,html").animate({ scrollTop: o }, 800);
});
var intr,
    time = 3600;
function start_timer() {
    intr = setInterval(tick, 1e3);
}
function tick() {
    time -= 1;
    var e = Math.floor(time / 60),
        t = time - 60 * e;
    0 == e && 0 == t && clearInterval(intr), (t = t >= 10 ? t : "0" + t), $("#min").html(e), $("#sec").html(t);
}
start_timer();

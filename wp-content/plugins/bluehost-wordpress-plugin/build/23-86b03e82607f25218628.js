(window.webpackJsonp_bluehost_wordpress_plugin=window.webpackJsonp_bluehost_wordpress_plugin||[]).push([[23],{147:function(t,e,n){"use strict";n.d(e,"c",(function(){return j})),n.d(e,"b",(function(){return y})),n.d(e,"d",(function(){return g})),n.d(e,"a",(function(){return v}));var o=n(9),r=n.n(o),c=n(141),i=n.n(c),u=n(1),s=n(21),a=n.n(s),l=(n(44),n(17)),f=n(159),d=n(5),p=n(12),b=n(2),w=n(16),O=n.n(w),h=n(38);function m(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,o)}return n}var j=function(){var t=i()(a.a.mark((function t(e){return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(null!==document.querySelector(e)){t.next=5;break}return t.next=3,new Promise((function(t){return requestAnimationFrame(t)}));case 3:t.next=0;break;case 5:return t.abrupt("return",document.querySelector(e));case 6:case"end":return t.stop()}}),t)})));return function(_x){return t.apply(this,arguments)}}(),y=function(t,e,n){var o=g(t,e);return o&&(t[o]=Object(d.merge)(t[o],n)),t},g=function(t,e){var n=Object(d.findIndex)(t,{id:e});return-1!==n&&n},v=function(t){var e=t.type,n=t.steps,o=t.options,c=void 0===o?{}:o,i=Object(d.merge)({defaultStepOptions:{cancelIcon:{enabled:!0}},useModalOverlay:!0},function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?m(Object(n),!0).forEach((function(e){r()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):m(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({type:e},c));return Object(u.createElement)(f.a,{steps:n,tourOptions:i},Object(u.createElement)((function(){return window.nfTour=Object(u.useContext)(f.b),function(t,e){Object(h.b)();var n,o=function(){jQuery("a.newfold-tour-relauncher").on("click",(function(t){t.preventDefault(),e.start()}))};(n=document.getElementById("newfold-editortours-loading"))&&(Object(h.c)(),n.classList.add("loaded"));var r=function(t,e){var n={action:"tour-"+t.tour.options.type,category:e,data:{step:t.id}};O()({path:"/newfold-notifications/v1/notifications/events",method:"POST",data:n})},c={id:"newfold-tour-notice",actions:[{url:"#",label:Object(b.__)("Reopen Tour","bluehost-wordpress-plugin"),className:"newfold-tour-relauncher"}]},i=Object(d.capitalize)(e.options.type);e.on("active",(function(){Object(p.dispatch)("core/notices").removeNotice("newfold-tour-notice")})),e.on("show",(function(t){r(t,"show")})),e.on("hide",(function(){Object(p.dispatch)("core/notices").createInfoNotice(i+" "+Object(b.__)("Page tour closed.","bluehost-wordpress-plugin"),c).then((function(){o()}))})),e.on("complete",(function(t){r(t,"complete"),Object(p.dispatch)("core/notices").createSuccessNotice(i+" "+Object(b.__)("Page tour is complete!","bluehost-wordpress-plugin"),c).then((function(){o()}))})),e.on("cancel",(function(t){r(t,"cancel"),Object(p.dispatch)("core/notices").createInfoNotice(i+" "+Object(b.__)("Page tour closed. You can restart it below.","bluehost-wordpress-plugin"),c).then((function(){o()}))}))}(0,window.nfTour),window.nfTourContext===Object(l.getQueryArg)(window.location.href,"tour")?Object(u.createElement)(u.Fragment,null,window.nfTour.start()):Object(u.createElement)(u.Fragment,null)}),null))}},240:function(t,e,n){"use strict";n.r(e),n.d(e,"HomeTour",(function(){return l}));var o=n(3),r=n.n(o),c=n(1),i=n(16),u=n.n(i),s=n(17),a=n(147),l=function(){var t=Object(c.useState)(!1),e=r()(t,2),n=e[0],o=e[1],i=Object(c.useState)([]),l=r()(i,2),f=l[0],d=l[1],p=Object(s.addQueryArgs)("/newfold/v1/tours/blockeditor",{type:"home",brand:"bluehost",lang:"en-us"});return Object(c.useEffect)((function(){u()({path:p}).then((function(t){d(function(t){var e=t,n=Object(a.d)(e,"prompt"),o=Object(a.d)(e,"mostly-selling"),r=Object(a.d)(e,"mostly-sharing"),c=Object(a.d)(e,"finish-cta");return n&&(e[n].buttons[0].action=function(){window.nfTour.show("mostly-selling"),window.nfHomeSiteType="mostly-selling"},e[n].buttons[1].action=function(){window.nfTour.show("mostly-sharing"),window.nfHomeSiteType="mostly-sharing"}),o&&(e[o].buttons[1].action=function(){window.nfTour.show("finish-cta")}),r&&(e[r].buttons[0].action=function(){window.nfTour.show("prompt")}),c&&(e[c].buttons[0].action=function(){void 0!==window.nfHomeSiteType?window.nfTour.show(window.nfHomeSiteType):window.nfTour.show("prompt")}),e}(t)),o(!0)}))}),[]),!!n&&Object(c.createElement)(a.a,{type:"home",steps:f})};e.default=l}}]);
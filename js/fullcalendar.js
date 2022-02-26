(function(factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery', 'moment'], factory);
    } else if (typeof exports === 'object') {
        module.exports = factory(require('jquery'), require('moment'));
    } else {
        factory(jQuery, moment);
    }
})(function($, moment) {;;
    var FC = $.fullCalendar = {
        version: "3.4.0",
        internalApiVersion: 9
    };
    var fcViews = FC.views = {};
    $.fn.fullCalendar = function(options) {
        var args = Array.prototype.slice.call(arguments, 1);
        var res = this;
        this.each(function(i, _element) {
            var element = $(_element);
            var calendar = element.data('fullCalendar');
            var singleRes;
            if (typeof options === 'string') {
                if (calendar && $.isFunction(calendar[options])) {
                    singleRes = calendar[options].apply(calendar, args);
                    if (!i) {
                        res = singleRes;
                    }
                    if (options === 'destroy') {
                        element.removeData('fullCalendar');
                    }
                }
            } else if (!calendar) {
                calendar = new Calendar(element, options);
                element.data('fullCalendar', calendar);
                calendar.render();
            }
        });
        return res;
    };
    var complexOptions = ['header', 'footer', 'buttonText', 'buttonIcons', 'themeButtonIcons'];
    function mergeOptions(optionObjs) {
        return mergeProps(optionObjs, complexOptions);
    };;
    FC.intersectRanges = intersectRanges;
    FC.applyAll = applyAll;
    FC.debounce = debounce;
    FC.isInt = isInt;
    FC.htmlEscape = htmlEscape;
    FC.cssToStr = cssToStr;
    FC.proxy = proxy;
    FC.capitaliseFirstLetter = capitaliseFirstLetter;
    function compensateScroll(rowEls, scrollbarWidths) {
        if (scrollbarWidths.left) {
            rowEls.css({
                'border-left-width': 1,
                'margin-left': scrollbarWidths.left - 1
            });
        }
        if (scrollbarWidths.right) {
            rowEls.css({
                'border-right-width': 1,
                'margin-right': scrollbarWidths.right - 1
            });
        }
    }
    function uncompensateScroll(rowEls) {
        rowEls.css({
            'margin-left': '',
            'margin-right': '',
            'border-left-width': '',
            'border-right-width': ''
        });
    }
    function disableCursor() {
        $('body').addClass('fc-not-allowed');
    }
    function enableCursor() {
        $('body').removeClass('fc-not-allowed');
    }
    function distributeHeight(els, availableHeight, shouldRedistribute) {
        var minOffset1 = Math.floor(availableHeight / els.length);
        var minOffset2 = Math.floor(availableHeight - minOffset1 * (els.length - 1));
        var flexEls = [];
        var flexOffsets = [];
        var flexHeights = [];
        var usedHeight = 0;
        undistributeHeight(els);
        els.each(function(i, el) {
            var minOffset = i === els.length - 1 ? minOffset2 : minOffset1;
            var naturalOffset = $(el).outerHeight(true);
            if (naturalOffset < minOffset) {
                flexEls.push(el);
                flexOffsets.push(naturalOffset);
                flexHeights.push($(el).height());
            } else {
                usedHeight += naturalOffset;
            }
        });
        if (shouldRedistribute) {
            availableHeight -= usedHeight;
            minOffset1 = Math.floor(availableHeight / flexEls.length);
            minOffset2 = Math.floor(availableHeight - minOffset1 * (flexEls.length - 1));
        }
        $(flexEls).each(function(i, el) {
            var minOffset = i === flexEls.length - 1 ? minOffset2 : minOffset1;
            var naturalOffset = flexOffsets[i];
            var naturalHeight = flexHeights[i];
            var newHeight = minOffset - (naturalOffset - naturalHeight);
            if (naturalOffset < minOffset) {
                $(el).height(newHeight);
            }
        });
    }
    function undistributeHeight(els) {
        els.height('');
    }
    function matchCellWidths(els) {
        var maxInnerWidth = 0;
        els.find('> *').each(function(i, innerEl) {
            var innerWidth = $(innerEl).outerWidth();
            if (innerWidth > maxInnerWidth) {
                maxInnerWidth = innerWidth;
            }
        });
        maxInnerWidth++;
        els.width(maxInnerWidth);
        return maxInnerWidth;
    }
    function subtractInnerElHeight(outerEl, innerEl) {
        var both = outerEl.add(innerEl);
        var diff;
        both.css({
            position: 'relative',
            left: -1
        });
        diff = outerEl.outerHeight() - innerEl.outerHeight();
        both.css({
            position: '',
            left: ''
        });
        return diff;
    }
    FC.getOuterRect = getOuterRect;
    FC.getClientRect = getClientRect;
    FC.getContentRect = getContentRect;
    FC.getScrollbarWidths = getScrollbarWidths;
    function getScrollParent(el) {
        var position = el.css('position'),
            scrollParent = el.parents().filter(function() {
                var parent = $(this);
                return (/(auto|scroll)/).test(parent.css('overflow') + parent.css('overflow-y') + parent.css('overflow-x'));
            }).eq(0);
        return position === 'fixed' || !scrollParent.length ? $(el[0].ownerDocument || document) : scrollParent;
    }
    function getOuterRect(el, origin) {
        var offset = el.offset();
        var left = offset.left - (origin ? origin.left : 0);
        var top = offset.top - (origin ? origin.top : 0);
        return {
            left: left,
            right: left + el.outerWidth(),
            top: top,
            bottom: top + el.outerHeight()
        };
    }
    function getClientRect(el, origin) {
        var offset = el.offset();
        var scrollbarWidths = getScrollbarWidths(el);
        var left = offset.left + getCssFloat(el, 'border-left-width') + scrollbarWidths.left - (origin ? origin.left : 0);
        var top = offset.top + getCssFloat(el, 'border-top-width') + scrollbarWidths.top - (origin ? origin.top : 0);
        return {
            left: left,
            right: left + el[0].clientWidth,
            top: top,
            bottom: top + el[0].clientHeight
        };
    }
    function getContentRect(el, origin) {
        var offset = el.offset();
        var left = offset.left + getCssFloat(el, 'border-left-width') + getCssFloat(el, 'padding-left') - (origin ? origin.left : 0);
        var top = offset.top + getCssFloat(el, 'border-top-width') + getCssFloat(el, 'padding-top') - (origin ? origin.top : 0);
        return {
            left: left,
            right: left + el.width(),
            top: top,
            bottom: top + el.height()
        };
    }
    function getScrollbarWidths(el) {
        var leftRightWidth = el[0].offsetWidth - el[0].clientWidth;
        var bottomWidth = el[0].offsetHeight - el[0].clientHeight;
        var widths;
        leftRightWidth = sanitizeScrollbarWidth(leftRightWidth);
        bottomWidth = sanitizeScrollbarWidth(bottomWidth);
        widths = {
            left: 0,
            right: 0,
            top: 0,
            bottom: bottomWidth
        };
        if (getIsLeftRtlScrollbars() && el.css('direction') == 'rtl') {
            widths.left = leftRightWidth;
        } else {
            widths.right = leftRightWidth;
        }
        return widths;
    }
    function sanitizeScrollbarWidth(width) {
        width = Math.max(0, width);
        width = Math.round(width);
        return width;
    }
    var _isLeftRtlScrollbars = null;
    function getIsLeftRtlScrollbars() {
        if (_isLeftRtlScrollbars === null) {
            _isLeftRtlScrollbars = computeIsLeftRtlScrollbars();
        }
        return _isLeftRtlScrollbars;
    }
    function computeIsLeftRtlScrollbars() {
        var el = $('<div><div/></div>').css({
            position: 'absolute',
            top: -1000,
            left: 0,
            border: 0,
            padding: 0,
            overflow: 'scroll',
            direction: 'rtl'
        }).appendTo('body');
        var innerEl = el.children();
        var res = innerEl.offset().left > el.offset().left;
        el.remove();
        return res;
    }
    function getCssFloat(el, prop) {
        return parseFloat(el.css(prop)) || 0;
    }
    FC.preventDefault = preventDefault;
    function isPrimaryMouseButton(ev) {
        return ev.which == 1 && !ev.ctrlKey;
    }
    function getEvX(ev) {
        var touches = ev.originalEvent.touches;
        if (touches && touches.length) {
            return touches[0].pageX;
        }
        return ev.pageX;
    }
    function getEvY(ev) {
        var touches = ev.originalEvent.touches;
        if (touches && touches.length) {
            return touches[0].pageY;
        }
        return ev.pageY;
    }
    function getEvIsTouch(ev) {
        return /^touch/.test(ev.type);
    }
    function preventSelection(el) {
        el.addClass('fc-unselectable').on('selectstart', preventDefault);
    }
    function allowSelection(el) {
        el.removeClass('fc-unselectable').off('selectstart', preventDefault);
    }
    function preventDefault(ev) {
        ev.preventDefault();
    }
    FC.intersectRects = intersectRects;
    function intersectRects(rect1, rect2) {
        var res = {
            left: Math.max(rect1.left, rect2.left),
            right: Math.min(rect1.right, rect2.right),
            top: Math.max(rect1.top, rect2.top),
            bottom: Math.min(rect1.bottom, rect2.bottom)
        };
        if (res.left < res.right && res.top < res.bottom) {
            return res;
        }
        return false;
    }
    function constrainPoint(point, rect) {
        return {
            left: Math.min(Math.max(point.left, rect.left), rect.right),
            top: Math.min(Math.max(point.top, rect.top), rect.bottom)
        };
    }
    function getRectCenter(rect) {
        return {
            left: (rect.left + rect.right) / 2,
            top: (rect.top + rect.bottom) / 2
        };
    }
    function diffPoints(point1, point2) {
        return {
            left: point1.left - point2.left,
            top: point1.top - point2.top
        };
    }
    FC.parseFieldSpecs = parseFieldSpecs;
    FC.compareByFieldSpecs = compareByFieldSpecs;
    FC.compareByFieldSpec = compareByFieldSpec;
    FC.flexibleCompare = flexibleCompare;
    function parseFieldSpecs(input) {
        var specs = [];
        var tokens = [];
        var i, token;
        if (typeof input === 'string') {
            tokens = input.split(/\s*,\s*/);
        } else if (typeof input === 'function') {
            tokens = [input];
        } else if ($.isArray(input)) {
            tokens = input;
        }
        for (i = 0; i < tokens.length; i++) {
            token = tokens[i];
            if (typeof token === 'string') {
                specs.push(token.charAt(0) == '-' ? {
                    field: token.substring(1),
                    order: -1
                } : {
                    field: token,
                    order: 1
                });
            } else if (typeof token === 'function') {
                specs.push({
                    func: token
                });
            }
        }
        return specs;
    }
    function compareByFieldSpecs(obj1, obj2, fieldSpecs) {
        var i;
        var cmp;
        for (i = 0; i < fieldSpecs.length; i++) {
            cmp = compareByFieldSpec(obj1, obj2, fieldSpecs[i]);
            if (cmp) {
                return cmp;
            }
        }
        return 0;
    }
    function compareByFieldSpec(obj1, obj2, fieldSpec) {
        if (fieldSpec.func) {
            return fieldSpec.func(obj1, obj2);
        }
        return flexibleCompare(obj1[fieldSpec.field], obj2[fieldSpec.field]) * (fieldSpec.order || 1);
    }
    function flexibleCompare(a, b) {
        if (!a && !b) {
            return 0;
        }
        if (b == null) {
            return -1;
        }
        if (a == null) {
            return 1;
        }
        if ($.type(a) === 'string' || $.type(b) === 'string') {
            return String(a).localeCompare(String(b));
        }
        return a - b;
    }
    function intersectRanges(subjectRange, constraintRange) {
        var subjectStart = subjectRange.start;
        var subjectEnd = subjectRange.end;
        var constraintStart = constraintRange.start;
        var constraintEnd = constraintRange.end;
        var segStart, segEnd;
        var isStart, isEnd;
        if (subjectEnd > constraintStart && subjectStart < constraintEnd) {
            if (subjectStart >= constraintStart) {
                segStart = subjectStart.clone();
                isStart = true;
            } else {
                segStart = constraintStart.clone();
                isStart = false;
            }
            if (subjectEnd <= constraintEnd) {
                segEnd = subjectEnd.clone();
                isEnd = true;
            } else {
                segEnd = constraintEnd.clone();
                isEnd = false;
            }
            return {
                start: segStart,
                end: segEnd,
                isStart: isStart,
                isEnd: isEnd
            };
        }
    }
    FC.computeGreatestUnit = computeGreatestUnit;
    FC.divideRangeByDuration = divideRangeByDuration;
    FC.divideDurationByDuration = divideDurationByDuration;
    FC.multiplyDuration = multiplyDuration;
    FC.durationHasTime = durationHasTime;
    var dayIDs = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
    var unitsDesc = ['year', 'month', 'week', 'day', 'hour', 'minute', 'second', 'millisecond'];
    function diffDayTime(a, b) {
        return moment.duration({
            days: a.clone().stripTime().diff(b.clone().stripTime(), 'days'),
            ms: a.time() - b.time()
        });
    }
    function diffDay(a, b) {
        return moment.duration({
            days: a.clone().stripTime().diff(b.clone().stripTime(), 'days')
        });
    }
    function diffByUnit(a, b, unit) {
        return moment.duration(Math.round(a.diff(b, unit, true)), unit);
    }
    function computeGreatestUnit(start, end) {
        var i, unit;
        var val;
        for (i = 0; i < unitsDesc.length; i++) {
            unit = unitsDesc[i];
            val = computeRangeAs(unit, start, end);
            if (val >= 1 && isInt(val)) {
                break;
            }
        }
        return unit;
    }
    function computeDurationGreatestUnit(duration, durationInput) {
        var unit = computeGreatestUnit(duration);
        if (unit === 'week' && typeof durationInput === 'object' && durationInput.days) {
            unit = 'day';
        }
        return unit;
    }
    function computeRangeAs(unit, start, end) {
        if (end != null) {
            return end.diff(start, unit, true);
        } else if (moment.isDuration(start)) {
            return start.as(unit);
        } else {
            return start.end.diff(start.start, unit, true);
        }
    }
    function divideRangeByDuration(start, end, dur) {
        var months;
        if (durationHasTime(dur)) {
            return (end - start) / dur;
        }
        months = dur.asMonths();
        if (Math.abs(months) >= 1 && isInt(months)) {
            return end.diff(start, 'months', true) / months;
        }
        return end.diff(start, 'days', true) / dur.asDays();
    }
    function divideDurationByDuration(dur1, dur2) {
        var months1, months2;
        if (durationHasTime(dur1) || durationHasTime(dur2)) {
            return dur1 / dur2;
        }
        months1 = dur1.asMonths();
        months2 = dur2.asMonths();
        if (Math.abs(months1) >= 1 && isInt(months1) && Math.abs(months2) >= 1 && isInt(months2)) {
            return months1 / months2;
        }
        return dur1.asDays() / dur2.asDays();
    }
    function multiplyDuration(dur, n) {
        var months;
        if (durationHasTime(dur)) {
            return moment.duration(dur * n);
        }
        months = dur.asMonths();
        if (Math.abs(months) >= 1 && isInt(months)) {
            return moment.duration({
                months: months * n
            });
        }
        return moment.duration({
            days: dur.asDays() * n
        });
    }
    function cloneRange(range) {
        return {
            start: range.start.clone(),
            end: range.end.clone()
        };
    }
    function constrainRange(innerRange, outerRange) {
        innerRange = cloneRange(innerRange);
        if (outerRange.start) {
            innerRange.start = constrainDate(innerRange.start, outerRange);
        }
        if (outerRange.end) {
            innerRange.end = minMoment(innerRange.end, outerRange.end);
        }
        return innerRange;
    }
    function constrainDate(date, range) {
        date = date.clone();
        if (range.start) {
            date = maxMoment(date, range.start);
        }
        if (range.end && date >= range.end) {
            date = range.end.clone().subtract(1);
        }
        return date;
    }
    function isDateWithinRange(date, range) {
        return (!range.start || date >= range.start) && (!range.end || date < range.end);
    }
    function doRangesIntersect(subjectRange, constraintRange) {
        return (!constraintRange.start || subjectRange.end >= constraintRange.start) && (!constraintRange.end || subjectRange.start < constraintRange.end);
    }
    function isRangeWithinRange(innerRange, outerRange) {
        return (!outerRange.start || innerRange.start >= outerRange.start) && (!outerRange.end || innerRange.end <= outerRange.end);
    }
    function isRangesEqual(range0, range1) {
        return ((range0.start && range1.start && range0.start.isSame(range1.start)) || (!range0.start && !range1.start)) && ((range0.end && range1.end && range0.end.isSame(range1.end)) || (!range0.end && !range1.end));
    }
    function minMoment(mom1, mom2) {
        return (mom1.isBefore(mom2) ? mom1 : mom2).clone();
    }
    function maxMoment(mom1, mom2) {
        return (mom1.isAfter(mom2) ? mom1 : mom2).clone();
    }
    function durationHasTime(dur) {
        return Boolean(dur.hours() || dur.minutes() || dur.seconds() || dur.milliseconds());
    }
    function isNativeDate(input) {
        return Object.prototype.toString.call(input) === '[object Date]' || input instanceof Date;
    }
    function isTimeString(str) {
        return /^\d+\:\d+(?:\:\d+\.?(?:\d{3})?)?$/.test(str);
    }
    FC.log = function() {
        var console = window.console;
        if (console && console.log) {
            return console.log.apply(console, arguments);
        }
    };
    FC.warn = function() {
        var console = window.console;
        if (console && console.warn) {
            return console.warn.apply(console, arguments);
        } else {
            return FC.log.apply(FC, arguments);
        }
    };
    var hasOwnPropMethod = {}.hasOwnProperty;
    function mergeProps(propObjs, complexProps) {
        var dest = {};
        var i, name;
        var complexObjs;
        var j, val;
        var props;
        if (complexProps) {
            for (i = 0; i < complexProps.length; i++) {
                name = complexProps[i];
                complexObjs = [];
                for (j = propObjs.length - 1; j >= 0; j--) {
                    val = propObjs[j][name];
                    if (typeof val === 'object') {
                        complexObjs.unshift(val);
                    } else if (val !== undefined) {
                        dest[name] = val;
                        break;
                    }
                }
                if (complexObjs.length) {
                    dest[name] = mergeProps(complexObjs);
                }
            }
        }
        for (i = propObjs.length - 1; i >= 0; i--) {
            props = propObjs[i];
            for (name in props) {
                if (!(name in dest)) {
                    dest[name] = props[name];
                }
            }
        }
        return dest;
    }
    function createObject(proto) {
        var f = function() {};
        f.prototype = proto;
        return new f();
    }
    FC.createObject = createObject;
    function copyOwnProps(src, dest) {
        for (var name in src) {
            if (hasOwnProp(src, name)) {
                dest[name] = src[name];
            }
        }
    }
    function hasOwnProp(obj, name) {
        return hasOwnPropMethod.call(obj, name);
    }
    function isAtomic(val) {
        return /undefined|null|boolean|number|string/.test($.type(val));
    }
    function applyAll(functions, thisObj, args) {
        if ($.isFunction(functions)) {
            functions = [functions];
        }
        if (functions) {
            var i;
            var ret;
            for (i = 0; i < functions.length; i++) {
                ret = functions[i].apply(thisObj, args) || ret;
            }
            return ret;
        }
    }
    function firstDefined() {
        for (var i = 0; i < arguments.length; i++) {
            if (arguments[i] !== undefined) {
                return arguments[i];
            }
        }
    }
    function htmlEscape(s) {
        return (s + '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#039;').replace(/"/g, '&quot;').replace(/\n/g, '<br />');
    }
    function stripHtmlEntities(text) {
        return text.replace(/&.*?;/g, '');
    }
    function cssToStr(cssProps) {
        var statements = [];
        $.each(cssProps, function(name, val) {
            if (val != null) {
                statements.push(name + ':' + val);
            }
        });
        return statements.join(';');
    }
    function attrsToStr(attrs) {
        var parts = [];
        $.each(attrs, function(name, val) {
            if (val != null) {
                parts.push(name + '="' + htmlEscape(val) + '"');
            }
        });
        return parts.join(' ');
    }
    function capitaliseFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
    function compareNumbers(a, b) {
        return a - b;
    }
    function isInt(n) {
        return n % 1 === 0;
    }
    function proxy(obj, methodName) {
        var method = obj[methodName];
        return function() {
            return method.apply(obj, arguments);
        };
    }
    function debounce(func, wait, immediate) {
        var timeout, args, context, timestamp, result;
        var later = function() {
            var last = +new Date() - timestamp;
            if (last < wait) {
                timeout = setTimeout(later, wait - last);
            } else {
                timeout = null;
                if (!immediate) {
                    result = func.apply(context, args);
                    context = args = null;
                }
            }
        };
        return function() {
            context = this;
            args = arguments;
            timestamp = +new Date();
            var callNow = immediate && !timeout;
            if (!timeout) {
                timeout = setTimeout(later, wait);
            }
            if (callNow) {
                result = func.apply(context, args);
                context = args = null;
            }
            return result;
        };
    };;
    var ambigDateOfMonthRegex = /^\s*\d{4}-\d\d$/;
    var ambigTimeOrZoneRegex = /^\s*\d{4}-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?)?$/;
    var newMomentProto = moment.fn;
    var oldMomentProto = $.extend({}, newMomentProto);
    var momentProperties = moment.momentProperties;
    momentProperties.push('_fullCalendar');
    momentProperties.push('_ambigTime');
    momentProperties.push('_ambigZone');
    FC.moment = function() {
        return makeMoment(arguments);
    };
    FC.moment.utc = function() {
        var mom = makeMoment(arguments, true);
        if (mom.hasTime()) {
            mom.utc();
        }
        return mom;
    };
    FC.moment.parseZone = function() {
        return makeMoment(arguments, true, true);
    };
    function makeMoment(args, parseAsUTC, parseZone) {
        var input = args[0];
        var isSingleString = args.length == 1 && typeof input === 'string';
        var isAmbigTime;
        var isAmbigZone;
        var ambigMatch;
        var mom;
        if (moment.isMoment(input) || isNativeDate(input) || input === undefined) {
            mom = moment.apply(null, args);
        } else {
            isAmbigTime = false;
            isAmbigZone = false;
            if (isSingleString) {
                if (ambigDateOfMonthRegex.test(input)) {
                    input += '-01';
                    args = [input];
                    isAmbigTime = true;
                    isAmbigZone = true;
                } else if ((ambigMatch = ambigTimeOrZoneRegex.exec(input))) {
                    isAmbigTime = !ambigMatch[5];
                    isAmbigZone = true;
                }
            } else if ($.isArray(input)) {
                isAmbigZone = true;
            }
            if (parseAsUTC || isAmbigTime) {
                mom = moment.utc.apply(moment, args);
            } else {
                mom = moment.apply(null, args);
            }
            if (isAmbigTime) {
                mom._ambigTime = true;
                mom._ambigZone = true;
            } else if (parseZone) {
                if (isAmbigZone) {
                    mom._ambigZone = true;
                } else if (isSingleString) {
                    mom.utcOffset(input);
                }
            }
        }
        mom._fullCalendar = true;
        return mom;
    }
    newMomentProto.week = newMomentProto.weeks = function(input) {
        var weekCalc = this._locale._fullCalendar_weekCalc;
        if (input == null && typeof weekCalc === 'function') {
            return weekCalc(this);
        } else if (weekCalc === 'ISO') {
            return oldMomentProto.isoWeek.apply(this, arguments);
        }
        return oldMomentProto.week.apply(this, arguments);
    };
    newMomentProto.time = function(time) {
        if (!this._fullCalendar) {
            return oldMomentProto.time.apply(this, arguments);
        }
        if (time == null) {
            return moment.duration({
                hours: this.hours(),
                minutes: this.minutes(),
                seconds: this.seconds(),
                milliseconds: this.milliseconds()
            });
        } else {
            this._ambigTime = false;
            if (!moment.isDuration(time) && !moment.isMoment(time)) {
                time = moment.duration(time);
            }
            var dayHours = 0;
            if (moment.isDuration(time)) {
                dayHours = Math.floor(time.asDays()) * 24;
            }
            return this.hours(dayHours + time.hours()).minutes(time.minutes()).seconds(time.seconds()).milliseconds(time.milliseconds());
        }
    };
    newMomentProto.stripTime = function() {
        if (!this._ambigTime) {
            this.utc(true);
            this.set({
                hours: 0,
                minutes: 0,
                seconds: 0,
                ms: 0
            });
            this._ambigTime = true;
            this._ambigZone = true;
        }
        return this;
    };
    newMomentProto.hasTime = function() {
        return !this._ambigTime;
    };
    newMomentProto.stripZone = function() {
        var wasAmbigTime;
        if (!this._ambigZone) {
            wasAmbigTime = this._ambigTime;
            this.utc(true);
            this._ambigTime = wasAmbigTime || false;
            this._ambigZone = true;
        }
        return this;
    };
    newMomentProto.hasZone = function() {
        return !this._ambigZone;
    };
    newMomentProto.local = function(keepLocalTime) {
        oldMomentProto.local.call(this, this._ambigZone || keepLocalTime);
        this._ambigTime = false;
        this._ambigZone = false;
        return this;
    };
    newMomentProto.utc = function(keepLocalTime) {
        oldMomentProto.utc.call(this, keepLocalTime);
        this._ambigTime = false;
        this._ambigZone = false;
        return this;
    };
    newMomentProto.utcOffset = function(tzo) {
        if (tzo != null) {
            this._ambigTime = false;
            this._ambigZone = false;
        }
        return oldMomentProto.utcOffset.apply(this, arguments);
    };
    newMomentProto.format = function() {
        if (this._fullCalendar && arguments[0]) {
            return formatDate(this, arguments[0]);
        }
        if (this._ambigTime) {
            return oldMomentFormat(englishMoment(this), 'YYYY-MM-DD');
        }
        if (this._ambigZone) {
            return oldMomentFormat(englishMoment(this), 'YYYY-MM-DD[T]HH:mm:ss');
        }
        if (this._fullCalendar) {
            return oldMomentFormat(englishMoment(this));
        }
        return oldMomentProto.format.apply(this, arguments);
    };
    newMomentProto.toISOString = function() {
        if (this._ambigTime) {
            return oldMomentFormat(englishMoment(this), 'YYYY-MM-DD');
        }
        if (this._ambigZone) {
            return oldMomentFormat(englishMoment(this), 'YYYY-MM-DD[T]HH:mm:ss');
        }
        if (this._fullCalendar) {
            return oldMomentProto.toISOString.apply(englishMoment(this), arguments);
        }
        return oldMomentProto.toISOString.apply(this, arguments);
    };
    function englishMoment(mom) {
        if (mom.locale() !== 'en') {
            return mom.clone().locale('en');
        }
        return mom;
    };;
    (function() {
        FC.formatDate = formatDate;
        FC.formatRange = formatRange;
        FC.oldMomentFormat = oldMomentFormat;
        FC.queryMostGranularFormatUnit = queryMostGranularFormatUnit;
        var PART_SEPARATOR = '\u000b';
        var SPECIAL_TOKEN_MARKER = '\u001f';
        var MAYBE_MARKER = '\u001e';
        var MAYBE_REGEXP = new RegExp(MAYBE_MARKER + '([^' + MAYBE_MARKER + ']*)' + MAYBE_MARKER, 'g');
        var specialTokens = {
            t: function(date) {
                return oldMomentFormat(date, 'a').charAt(0);
            },
            T: function(date) {
                return oldMomentFormat(date, 'A').charAt(0);
            }
        };
        var largeTokenMap = {
            Y: {
                value: 1,
                unit: 'year'
            },
            M: {
                value: 2,
                unit: 'month'
            },
            W: {
                value: 3,
                unit: 'week'
            },
            w: {
                value: 3,
                unit: 'week'
            },
            D: {
                value: 4,
                unit: 'day'
            },
            d: {
                value: 4,
                unit: 'day'
            }
        };
        function formatDate(date, formatStr) {
            return renderFakeFormatString(getParsedFormatString(formatStr).fakeFormatString, date);
        }
        function oldMomentFormat(mom, formatStr) {
            return oldMomentProto.format.call(mom, formatStr);
        }
        function formatRange(date1, date2, formatStr, separator, isRTL) {
            var localeData;
            date1 = FC.moment.parseZone(date1);
            date2 = FC.moment.parseZone(date2);
            localeData = date1.localeData();
            formatStr = localeData.longDateFormat(formatStr) || formatStr;
            return renderParsedFormat(getParsedFormatString(formatStr), date1, date2, separator || ' - ', isRTL);
        }
        function renderParsedFormat(parsedFormat, date1, date2, separator, isRTL) {
            var sameUnits = parsedFormat.sameUnits;
            var unzonedDate1 = date1.clone().stripZone();
            var unzonedDate2 = date2.clone().stripZone();
            var renderedParts1 = renderFakeFormatStringParts(parsedFormat.fakeFormatString, date1);
            var renderedParts2 = renderFakeFormatStringParts(parsedFormat.fakeFormatString, date2);
            var leftI;
            var leftStr = '';
            var rightI;
            var rightStr = '';
            var middleI;
            var middleStr1 = '';
            var middleStr2 = '';
            var middleStr = '';
            for (leftI = 0; leftI < sameUnits.length && (!sameUnits[leftI] || unzonedDate1.isSame(unzonedDate2, sameUnits[leftI])); leftI++) {
                leftStr += renderedParts1[leftI];
            }
            for (rightI = sameUnits.length - 1; rightI > leftI && (!sameUnits[rightI] || unzonedDate1.isSame(unzonedDate2, sameUnits[rightI])); rightI--) {
                if (rightI - 1 === leftI && renderedParts1[rightI] === '.') {
                    break;
                }
                rightStr = renderedParts1[rightI] + rightStr;
            }
            for (middleI = leftI; middleI <= rightI; middleI++) {
                middleStr1 += renderedParts1[middleI];
                middleStr2 += renderedParts2[middleI];
            }
            if (middleStr1 || middleStr2) {
                if (isRTL) {
                    middleStr = middleStr2 + separator + middleStr1;
                } else {
                    middleStr = middleStr1 + separator + middleStr2;
                }
            }
            return processMaybeMarkers(leftStr + middleStr + rightStr);
        }
        var parsedFormatStrCache = {};
        function getParsedFormatString(formatStr) {
            return parsedFormatStrCache[formatStr] || (parsedFormatStrCache[formatStr] = parseFormatString(formatStr));
        }
        function parseFormatString(formatStr) {
            var chunks = chunkFormatString(formatStr);
            return {
                fakeFormatString: buildFakeFormatString(chunks),
                sameUnits: buildSameUnits(chunks)
            };
        }
        function chunkFormatString(formatStr) {
            var chunks = [];
            var match;
            var chunker = /\[([^\]]*)\]|\(([^\)]*)\)|(LTS|LT|(\w)\4*o?)|([^\w\[\(]+)/g;
            while ((match = chunker.exec(formatStr))) {
                if (match[1]) {
                    chunks.push.apply(chunks, splitStringLiteral(match[1]));
                } else if (match[2]) {
                    chunks.push({
                        maybe: chunkFormatString(match[2])
                    });
                } else if (match[3]) {
                    chunks.push({
                        token: match[3]
                    });
                } else if (match[5]) {
                    chunks.push.apply(chunks, splitStringLiteral(match[5]));
                }
            }
            return chunks;
        }
        function splitStringLiteral(s) {
            if (s === '. ') {
                return ['.', ' '];
            } else {
                return [s];
            }
        }
        function buildFakeFormatString(chunks) {
            var parts = [];
            var i, chunk;
            for (i = 0; i < chunks.length; i++) {
                chunk = chunks[i];
                if (typeof chunk === 'string') {
                    parts.push('[' + chunk + ']');
                } else if (chunk.token) {
                    if (chunk.token in specialTokens) {
                        parts.push(SPECIAL_TOKEN_MARKER + '[' + chunk.token + ']');
                    } else {
                        parts.push(chunk.token);
                    }
                } else if (chunk.maybe) {
                    parts.push(MAYBE_MARKER + buildFakeFormatString(chunk.maybe) + MAYBE_MARKER);
                }
            }
            return parts.join(PART_SEPARATOR);
        }
        function buildSameUnits(chunks) {
            var units = [];
            var i, chunk;
            var tokenInfo;
            for (i = 0; i < chunks.length; i++) {
                chunk = chunks[i];
                if (chunk.token) {
                    tokenInfo = largeTokenMap[chunk.token.charAt(0)];
                    units.push(tokenInfo ? tokenInfo.unit : 'second');
                } else if (chunk.maybe) {
                    units.push.apply(units, buildSameUnits(chunk.maybe));
                } else {
                    units.push(null);
                }
            }
            return units;
        }
        function renderFakeFormatString(fakeFormatString, date) {
            return processMaybeMarkers(renderFakeFormatStringParts(fakeFormatString, date).join(''));
        }
        function renderFakeFormatStringParts(fakeFormatString, date) {
            var parts = [];
            var fakeRender = oldMomentFormat(date, fakeFormatString);
            var fakeParts = fakeRender.split(PART_SEPARATOR);
            var i, fakePart;
            for (i = 0; i < fakeParts.length; i++) {
                fakePart = fakeParts[i];
                if (fakePart.charAt(0) === SPECIAL_TOKEN_MARKER) {
                    parts.push(specialTokens[fakePart.substring(1)](date));
                } else {
                    parts.push(fakePart);
                }
            }
            return parts;
        }
        function processMaybeMarkers(s) {
            return s.replace(MAYBE_REGEXP, function(m0, m1) {
                if (m1.match(/[1-9]/)) {
                    return m1;
                } else {
                    return '';
                }
            });
        }
        function queryMostGranularFormatUnit(formatStr) {
            var chunks = chunkFormatString(formatStr);
            var i, chunk;
            var candidate;
            var best;
            for (i = 0; i < chunks.length; i++) {
                chunk = chunks[i];
                if (chunk.token) {
                    candidate = largeTokenMap[chunk.token.charAt(0)];
                    if (candidate) {
                        if (!best || candidate.value > best.value) {
                            best = candidate;
                        }
                    }
                }
            }
            if (best) {
                return best.unit;
            }
            return null;
        };
    })();
    var formatDate = FC.formatDate;
    var formatRange = FC.formatRange;
    var oldMomentFormat = FC.oldMomentFormat;;;
    FC.Class = Class;
    function Class() {}
    Class.extend = function() {
        var len = arguments.length;
        var i;
        var members;
        for (i = 0; i < len; i++) {
            members = arguments[i];
            if (i < len - 1) {
                mixIntoClass(this, members);
            }
        }
        return extendClass(this, members || {});
    };
    Class.mixin = function(members) {
        mixIntoClass(this, members);
    };
    function extendClass(superClass, members) {
        var subClass;
        if (hasOwnProp(members, 'constructor')) {
            subClass = members.constructor;
        }
        if (typeof subClass !== 'function') {
            subClass = members.constructor = function() {
                superClass.apply(this, arguments);
            };
        }
        subClass.prototype = createObject(superClass.prototype);
        copyOwnProps(members, subClass.prototype);
        copyOwnProps(superClass, subClass);
        return subClass;
    }
    function mixIntoClass(theClass, members) {
        copyOwnProps(members, theClass.prototype);
    };;
    var Model = Class.extend(EmitterMixin, ListenerMixin, {
        _props: null,
        _watchers: null,
        _globalWatchArgs: null,
        constructor: function() {
            this._watchers = {};
            this._props = {};
            this.applyGlobalWatchers();
        },
        applyGlobalWatchers: function() {
            var argSets = this._globalWatchArgs || [];
            var i;
            for (i = 0; i < argSets.length; i++) {
                this.watch.apply(this, argSets[i]);
            }
        },
        has: function(name) {
            return name in this._props;
        },
        get: function(name) {
            if (name === undefined) {
                return this._props;
            }
            return this._props[name];
        },
        set: function(name, val) {
            var newProps;
            if (typeof name === 'string') {
                newProps = {};
                newProps[name] = val === undefined ? null : val;
            } else {
                newProps = name;
            }
            this.setProps(newProps);
        },
        reset: function(newProps) {
            var oldProps = this._props;
            var changeset = {};
            var name;
            for (name in oldProps) {
                changeset[name] = undefined;
            }
            for (name in newProps) {
                changeset[name] = newProps[name];
            }
            this.setProps(changeset);
        },
        unset: function(name) {
            var newProps = {};
            var names;
            var i;
            if (typeof name === 'string') {
                names = [name];
            } else {
                names = name;
            }
            for (i = 0; i < names.length; i++) {
                newProps[names[i]] = undefined;
            }
            this.setProps(newProps);
        },
        setProps: function(newProps) {
            var changedProps = {};
            var changedCnt = 0;
            var name, val;
            for (name in newProps) {
                val = newProps[name];
                if (typeof val === 'object' || val !== this._props[name]) {
                    changedProps[name] = val;
                    changedCnt++;
                }
            }
            if (changedCnt) {
                this.trigger('before:batchChange', changedProps);
                for (name in changedProps) {
                    val = changedProps[name];
                    this.trigger('before:change', name, val);
                    this.trigger('before:change:' + name, val);
                }
                for (name in changedProps) {
                    val = changedProps[name];
                    if (val === undefined) {
                        delete this._props[name];
                    } else {
                        this._props[name] = val;
                    }
                    this.trigger('change:' + name, val);
                    this.trigger('change', name, val);
                }
                this.trigger('batchChange', changedProps);
            }
        },
        watch: function(name, depList, startFunc, stopFunc) {
            var _this = this;
            this.unwatch(name);
            this._watchers[name] = this._watchDeps(depList, function(deps) {
                var res = startFunc.call(_this, deps);
                if (res && res.then) {
                    _this.unset(name);
                    res.then(function(val) {
                        _this.set(name, val);
                    });
                } else {
                    _this.set(name, res);
                }
            }, function() {
                _this.unset(name);
                if (stopFunc) {
                    stopFunc.call(_this);
                }
            });
        },
        unwatch: function(name) {
            var watcher = this._watchers[name];
            if (watcher) {
                delete this._watchers[name];
                watcher.teardown();
            }
        },
        _watchDeps: function(depList, startFunc, stopFunc) {
            var _this = this;
            var queuedChangeCnt = 0;
            var depCnt = depList.length;
            var satisfyCnt = 0;
            var values = {};
            var bindTuples = [];
            var isCallingStop = false;
            function onBeforeDepChange(depName, val, isOptional) {
                queuedChangeCnt++;
                if (queuedChangeCnt === 1) {
                    if (satisfyCnt === depCnt) {
                        isCallingStop = true;
                        stopFunc();
                        isCallingStop = false;
                    }
                }
            }
            function onDepChange(depName, val, isOptional) {
                if (val === undefined) {
                    if (!isOptional && values[depName] !== undefined) {
                        satisfyCnt--;
                    }
                    delete values[depName];
                } else {
                    if (!isOptional && values[depName] === undefined) {
                        satisfyCnt++;
                    }
                    values[depName] = val;
                }
                queuedChangeCnt--;
                if (!queuedChangeCnt) {
                    if (satisfyCnt === depCnt) {
                        if (!isCallingStop) {
                            startFunc(values);
                        }
                    }
                }
            }
            function bind(eventName, handler) {
                _this.on(eventName, handler);
                bindTuples.push([eventName, handler]);
            }
            depList.forEach(function(depName) {
                var isOptional = false;
                if (depName.charAt(0) === '?') {
                    depName = depName.substring(1);
                    isOptional = true;
                }
                bind('before:change:' + depName, function(val) {
                    onBeforeDepChange(depName, val, isOptional);
                });
                bind('change:' + depName, function(val) {
                    onDepChange(depName, val, isOptional);
                });
            });
            depList.forEach(function(depName) {
                var isOptional = false;
                if (depName.charAt(0) === '?') {
                    depName = depName.substring(1);
                    isOptional = true;
                }
                if (_this.has(depName)) {
                    values[depName] = _this.get(depName);
                    satisfyCnt++;
                } else if (isOptional) {
                    satisfyCnt++;
                }
            });
            if (satisfyCnt === depCnt) {
                startFunc(values);
            }
            return {
                teardown: function() {
                    for (var i = 0; i < bindTuples.length; i++) {
                        _this.off(bindTuples[i][0], bindTuples[i][1]);
                    }
                    bindTuples = null;
                    if (satisfyCnt === depCnt) {
                        stopFunc();
                    }
                },
                flash: function() {
                    if (satisfyCnt === depCnt) {
                        stopFunc();
                        startFunc(values);
                    }
                }
            };
        },
        flash: function(name) {
            var watcher = this._watchers[name];
            if (watcher) {
                watcher.flash();
            }
        }
    });
    Model.watch = function() {
        var proto = this.prototype;
        if (!proto._globalWatchArgs) {
            proto._globalWatchArgs = [];
        }
        proto._globalWatchArgs.push(arguments);
    };
    FC.Model = Model;;;
    var Promise = {
        construct: function(executor) {
            var deferred = $.Deferred();
            var promise = deferred.promise();
            if (typeof executor === 'function') {
                executor(function(val) {
                    deferred.resolve(val);
                    attachImmediatelyResolvingThen(promise, val);
                }, function() {
                    deferred.reject();
                    attachImmediatelyRejectingThen(promise);
                });
            }
            return promise;
        },
        resolve: function(val) {
            var deferred = $.Deferred().resolve(val);
            var promise = deferred.promise();
            attachImmediatelyResolvingThen(promise, val);
            return promise;
        },
        reject: function() {
            var deferred = $.Deferred().reject();
            var promise = deferred.promise();
            attachImmediatelyRejectingThen(promise);
            return promise;
        }
    };
    function attachImmediatelyResolvingThen(promise, val) {
        promise.then = function(onResolve) {
            if (typeof onResolve === 'function') {
                onResolve(val);
            }
            return promise;
        };
    }
    function attachImmediatelyRejectingThen(promise) {
        promise.then = function(onResolve, onReject) {
            if (typeof onReject === 'function') {
                onReject();
            }
            return promise;
        };
    }
    FC.Promise = Promise;;;
    var TaskQueue = Class.extend(EmitterMixin, {
        q: null,
        isPaused: false,
        isRunning: false,
        constructor: function() {
            this.q = [];
        },
        queue: function() {
            this.q.push.apply(this.q, arguments);
            this.tryStart();
        },
        pause: function() {
            this.isPaused = true;
        },
        resume: function() {
            this.isPaused = false;
            this.tryStart();
        },
        tryStart: function() {
            if (!this.isRunning && this.canRunNext()) {
                this.isRunning = true;
                this.trigger('start');
                this.runNext();
            }
        },
        canRunNext: function() {
            return !this.isPaused && this.q.length;
        },
        runNext: function() {
            this.runTask(this.q.shift());
        },
        runTask: function(task) {
            this.runTaskFunc(task);
        },
        runTaskFunc: function(taskFunc) {
            var _this = this;
            var res = taskFunc();
            if (res && res.then) {
                res.then(done);
            } else {
                done();
            }
            function done() {
                if (_this.canRunNext()) {
                    _this.runNext();
                } else {
                    _this.isRunning = false;
                    _this.trigger('stop');
                }
            }
        }
    });
    FC.TaskQueue = TaskQueue;;;
    var RenderQueue = TaskQueue.extend({
        waitsByNamespace: null,
        waitNamespace: null,
        waitId: null,
        constructor: function(waitsByNamespace) {
            TaskQueue.call(this);
            this.waitsByNamespace = waitsByNamespace || {};
        },
        queue: function(taskFunc, namespace, type) {
            var task = {
                func: taskFunc,
                namespace: namespace,
                type: type
            };
            var waitMs;
            if (namespace) {
                waitMs = this.waitsByNamespace[namespace];
            }
            if (this.waitNamespace) {
                if (namespace === this.waitNamespace && waitMs != null) {
                    this.delayWait(waitMs);
                } else {
                    this.clearWait();
                    this.tryStart();
                }
            }
            if (this.compoundTask(task)) {
                if (!this.waitNamespace && waitMs != null) {
                    this.startWait(namespace, waitMs);
                } else {
                    this.tryStart();
                }
            }
        },
        startWait: function(namespace, waitMs) {
            this.waitNamespace = namespace;
            this.spawnWait(waitMs);
        },
        delayWait: function(waitMs) {
            clearTimeout(this.waitId);
            this.spawnWait(waitMs);
        },
        spawnWait: function(waitMs) {
            var _this = this;
            this.waitId = setTimeout(function() {
                _this.waitNamespace = null;
                _this.tryStart();
            }, waitMs);
        },
        clearWait: function() {
            if (this.waitNamespace) {
                clearTimeout(this.waitId);
                this.waitId = null;
                this.waitNamespace = null;
            }
        },
        canRunNext: function() {
            if (!TaskQueue.prototype.canRunNext.apply(this, arguments)) {
                return false;
            }
            if (this.waitNamespace) {
                for (var q = this.q, i = 0; i < q.length; i++) {
                    if (q[i].namespace !== this.waitNamespace) {
                        return true;
                    }
                }
                return false;
            }
            return true;
        },
        runTask: function(task) {
            this.runTaskFunc(task.func);
        },
        compoundTask: function(newTask) {
            var q = this.q;
            var shouldAppend = true;
            var i, task;
            if (newTask.namespace) {
                if (newTask.type === 'destroy' || newTask.type === 'init') {
                    for (i = q.length - 1; i >= 0; i--) {
                        task = q[i];
                        if (task.namespace === newTask.namespace && (task.type === 'add' || task.type === 'remove')) {
                            q.splice(i, 1);
                        }
                    }
                    if (newTask.type === 'destroy') {
                        if (q.length) {
                            task = q[q.length - 1];
                            if (task.namespace === newTask.namespace) {
                                if (task.type === 'init') {
                                    shouldAppend = false;
                                    q.pop();
                                } else if (task.type === 'destroy') {
                                    shouldAppend = false;
                                }
                            }
                        }
                    } else if (newTask.type === 'init') {
                        if (q.length) {
                            task = q[q.length - 1];
                            if (task.namespace === newTask.namespace && task.type === 'init') {
                                q.pop();
                            }
                        }
                    }
                }
            }
            if (shouldAppend) {
                q.push(newTask);
            }
            return shouldAppend;
        }
    });
    FC.RenderQueue = RenderQueue;;;
    var EmitterMixin = FC.EmitterMixin = {
        on: function(types, handler) {
            $(this).on(types, this._prepareIntercept(handler));
            return this;
        },
        one: function(types, handler) {
            $(this).one(types, this._prepareIntercept(handler));
            return this;
        },
        _prepareIntercept: function(handler) {
            var intercept = function(ev, extra) {
                return handler.apply(extra.context || this, extra.args || []);
            };
            if (!handler.guid) {
                handler.guid = $.guid++;
            }
            intercept.guid = handler.guid;
            return intercept;
        },
        off: function(types, handler) {
            $(this).off(types, handler);
            return this;
        },
        trigger: function(types) {
            var args = Array.prototype.slice.call(arguments, 1);
            $(this).triggerHandler(types, {
                args: args
            });
            return this;
        },
        triggerWith: function(types, context, args) {
            $(this).triggerHandler(types, {
                context: context,
                args: args
            });
            return this;
        }
    };;;
    var ListenerMixin = FC.ListenerMixin = (function() {
        var guid = 0;
        var ListenerMixin = {
            listenerId: null,
            listenTo: function(other, arg, callback) {
                if (typeof arg === 'object') {
                    for (var eventName in arg) {
                        if (arg.hasOwnProperty(eventName)) {
                            this.listenTo(other, eventName, arg[eventName]);
                        }
                    }
                } else if (typeof arg === 'string') {
                    other.on(arg + '.' + this.getListenerNamespace(), $.proxy(callback, this));
                }
            },
            stopListeningTo: function(other, eventName) {
                other.off((eventName || '') + '.' + this.getListenerNamespace());
            },
            getListenerNamespace: function() {
                if (this.listenerId == null) {
                    this.listenerId = guid++;
                }
                return '_listener' + this.listenerId;
            }
        };
        return ListenerMixin;
    })();;;
    var Popover = Class.extend(ListenerMixin, {
        isHidden: true,
        options: null,
        el: null,
        margin: 10,
        constructor: function(options) {
            this.options = options || {};
        },
        show: function() {
            if (this.isHidden) {
                if (!this.el) {
                    this.render();
                }
                this.el.show();
                this.position();
                this.isHidden = false;
                this.trigger('show');
            }
        },
        hide: function() {
            if (!this.isHidden) {
                this.el.hide();
                this.isHidden = true;
                this.trigger('hide');
            }
        },
        render: function() {
            var _this = this;
            var options = this.options;
            this.el = $('<div class="fc-popover"/>').addClass(options.className || '').css({
                top: 0,
                left: 0
            }).append(options.content).appendTo(options.parentEl);
            this.el.on('click', '.fc-close', function() {
                _this.hide();
            });
            if (options.autoHide) {
                this.listenTo($(document), 'mousedown', this.documentMousedown);
            }
        },
        documentMousedown: function(ev) {
            if (this.el && !$(ev.target).closest(this.el).length) {
                this.hide();
            }
        },
        removeElement: function() {
            this.hide();
            if (this.el) {
                this.el.remove();
                this.el = null;
            }
            this.stopListeningTo($(document), 'mousedown');
        },
        position: function() {
            var options = this.options;
            var origin = this.el.offsetParent().offset();
            var width = this.el.outerWidth();
            var height = this.el.outerHeight();
            var windowEl = $(window);
            var viewportEl = getScrollParent(this.el);
            var viewportTop;
            var viewportLeft;
            var viewportOffset;
            var top;
            var left;
            top = options.top || 0;
            if (options.left !== undefined) {
                left = options.left;
            } else if (options.right !== undefined) {
                left = options.right - width;
            } else {
                left = 0;
            }
            if (viewportEl.is(window) || viewportEl.is(document)) {
                viewportEl = windowEl;
                viewportTop = 0;
                viewportLeft = 0;
            } else {
                viewportOffset = viewportEl.offset();
                viewportTop = viewportOffset.top;
                viewportLeft = viewportOffset.left;
            }
            viewportTop += windowEl.scrollTop();
            viewportLeft += windowEl.scrollLeft();
            if (options.viewportConstrain !== false) {
                top = Math.min(top, viewportTop + viewportEl.outerHeight() - height - this.margin);
                top = Math.max(top, viewportTop + this.margin);
                left = Math.min(left, viewportLeft + viewportEl.outerWidth() - width - this.margin);
                left = Math.max(left, viewportLeft + this.margin);
            }
            this.el.css({
                top: top - origin.top,
                left: left - origin.left
            });
        },
        trigger: function(name) {
            if (this.options[name]) {
                this.options[name].apply(this, Array.prototype.slice.call(arguments, 1));
            }
        }
    });;;
    var CoordCache = FC.CoordCache = Class.extend({
        els: null,
        forcedOffsetParentEl: null,
        origin: null,
        boundingRect: null,
        isHorizontal: false,
        isVertical: false,
        lefts: null,
        rights: null,
        tops: null,
        bottoms: null,
        constructor: function(options) {
            this.els = $(options.els);
            this.isHorizontal = options.isHorizontal;
            this.isVertical = options.isVertical;
            this.forcedOffsetParentEl = options.offsetParent ? $(options.offsetParent) : null;
        },
        build: function() {
            var offsetParentEl = this.forcedOffsetParentEl;
            if (!offsetParentEl && this.els.length > 0) {
                offsetParentEl = this.els.eq(0).offsetParent();
            }
            this.origin = offsetParentEl ? offsetParentEl.offset() : null;
            this.boundingRect = this.queryBoundingRect();
            if (this.isHorizontal) {
                this.buildElHorizontals();
            }
            if (this.isVertical) {
                this.buildElVerticals();
            }
        },
        clear: function() {
            this.origin = null;
            this.boundingRect = null;
            this.lefts = null;
            this.rights = null;
            this.tops = null;
            this.bottoms = null;
        },
        ensureBuilt: function() {
            if (!this.origin) {
                this.build();
            }
        },
        buildElHorizontals: function() {
            var lefts = [];
            var rights = [];
            this.els.each(function(i, node) {
                var el = $(node);
                var left = el.offset().left;
                var width = el.outerWidth();
                lefts.push(left);
                rights.push(left + width);
            });
            this.lefts = lefts;
            this.rights = rights;
        },
        buildElVerticals: function() {
            var tops = [];
            var bottoms = [];
            this.els.each(function(i, node) {
                var el = $(node);
                var top = el.offset().top;
                var height = el.outerHeight();
                tops.push(top);
                bottoms.push(top + height);
            });
            this.tops = tops;
            this.bottoms = bottoms;
        },
        getHorizontalIndex: function(leftOffset) {
            this.ensureBuilt();
            var lefts = this.lefts;
            var rights = this.rights;
            var len = lefts.length;
            var i;
            for (i = 0; i < len; i++) {
                if (leftOffset >= lefts[i] && leftOffset < rights[i]) {
                    return i;
                }
            }
        },
        getVerticalIndex: function(topOffset) {
            this.ensureBuilt();
            var tops = this.tops;
            var bottoms = this.bottoms;
            var len = tops.length;
            var i;
            for (i = 0; i < len; i++) {
                if (topOffset >= tops[i] && topOffset < bottoms[i]) {
                    return i;
                }
            }
        },
        getLeftOffset: function(leftIndex) {
            this.ensureBuilt();
            return this.lefts[leftIndex];
        },
        getLeftPosition: function(leftIndex) {
            this.ensureBuilt();
            return this.lefts[leftIndex] - this.origin.left;
        },
        getRightOffset: function(leftIndex) {
            this.ensureBuilt();
            return this.rights[leftIndex];
        },
        getRightPosition: function(leftIndex) {
            this.ensureBuilt();
            return this.rights[leftIndex] - this.origin.left;
        },
        getWidth: function(leftIndex) {
            this.ensureBuilt();
            return this.rights[leftIndex] - this.lefts[leftIndex];
        },
        getTopOffset: function(topIndex) {
            this.ensureBuilt();
            return this.tops[topIndex];
        },
        getTopPosition: function(topIndex) {
            this.ensureBuilt();
            return this.tops[topIndex] - this.origin.top;
        },
        getBottomOffset: function(topIndex) {
            this.ensureBuilt();
            return this.bottoms[topIndex];
        },
        getBottomPosition: function(topIndex) {
            this.ensureBuilt();
            return this.bottoms[topIndex] - this.origin.top;
        },
        getHeight: function(topIndex) {
            this.ensureBuilt();
            return this.bottoms[topIndex] - this.tops[topIndex];
        },
        queryBoundingRect: function() {
            var scrollParentEl;
            if (this.els.length > 0) {
                scrollParentEl = getScrollParent(this.els.eq(0));
                if (!scrollParentEl.is(document)) {
                    return getClientRect(scrollParentEl);
                }
            }
            return null;
        },
        isPointInBounds: function(leftOffset, topOffset) {
            return this.isLeftInBounds(leftOffset) && this.isTopInBounds(topOffset);
        },
        isLeftInBounds: function(leftOffset) {
            return !this.boundingRect || (leftOffset >= this.boundingRect.left && leftOffset < this.boundingRect.right);
        },
        isTopInBounds: function(topOffset) {
            return !this.boundingRect || (topOffset >= this.boundingRect.top && topOffset < this.boundingRect.bottom);
        }
    });;;
    var DragListener = FC.DragListener = Class.extend(ListenerMixin, {
        options: null,
        subjectEl: null,
        originX: null,
        originY: null,
        scrollEl: null,
        isInteracting: false,
        isDistanceSurpassed: false,
        isDelayEnded: false,
        isDragging: false,
        isTouch: false,
        isGeneric: false,
        delay: null,
        delayTimeoutId: null,
        minDistance: null,
        shouldCancelTouchScroll: true,
        scrollAlwaysKills: false,
        constructor: function(options) {
            this.options = options || {};
        },
        startInteraction: function(ev, extraOptions) {
            if (ev.type === 'mousedown') {
                if (GlobalEmitter.get().shouldIgnoreMouse()) {
                    return;
                } else if (!isPrimaryMouseButton(ev)) {
                    return;
                } else {
                    ev.preventDefault();
                }
            }
            if (!this.isInteracting) {
                extraOptions = extraOptions || {};
                this.delay = firstDefined(extraOptions.delay, this.options.delay, 0);
                this.minDistance = firstDefined(extraOptions.distance, this.options.distance, 0);
                this.subjectEl = this.options.subjectEl;
                preventSelection($('body'));
                this.isInteracting = true;
                this.isTouch = getEvIsTouch(ev);
                this.isGeneric = ev.type === 'dragstart';
                this.isDelayEnded = false;
                this.isDistanceSurpassed = false;
                this.originX = getEvX(ev);
                this.originY = getEvY(ev);
                this.scrollEl = getScrollParent($(ev.target));
                this.bindHandlers();
                this.initAutoScroll();
                this.handleInteractionStart(ev);
                this.startDelay(ev);
                if (!this.minDistance) {
                    this.handleDistanceSurpassed(ev);
                }
            }
        },
        handleInteractionStart: function(ev) {
            this.trigger('interactionStart', ev);
        },
        endInteraction: function(ev, isCancelled) {
            if (this.isInteracting) {
                this.endDrag(ev);
                if (this.delayTimeoutId) {
                    clearTimeout(this.delayTimeoutId);
                    this.delayTimeoutId = null;
                }
                this.destroyAutoScroll();
                this.unbindHandlers();
                this.isInteracting = false;
                this.handleInteractionEnd(ev, isCancelled);
                allowSelection($('body'));
            }
        },
        handleInteractionEnd: function(ev, isCancelled) {
            this.trigger('interactionEnd', ev, isCancelled || false);
        },
        bindHandlers: function() {
            var globalEmitter = GlobalEmitter.get();
            if (this.isGeneric) {
                this.listenTo($(document), {
                    drag: this.handleMove,
                    dragstop: this.endInteraction
                });
            } else if (this.isTouch) {
                this.listenTo(globalEmitter, {
                    touchmove: this.handleTouchMove,
                    touchend: this.endInteraction,
                    scroll: this.handleTouchScroll
                });
            } else {
                this.listenTo(globalEmitter, {
                    mousemove: this.handleMouseMove,
                    mouseup: this.endInteraction
                });
            }
            this.listenTo(globalEmitter, {
                selectstart: preventDefault,
                contextmenu: preventDefault
            });
        },
        unbindHandlers: function() {
            this.stopListeningTo(GlobalEmitter.get());
            this.stopListeningTo($(document));
        },
        startDrag: function(ev, extraOptions) {
            this.startInteraction(ev, extraOptions);
            if (!this.isDragging) {
                this.isDragging = true;
                this.handleDragStart(ev);
            }
        },
        handleDragStart: function(ev) {
            this.trigger('dragStart', ev);
        },
        handleMove: function(ev) {
            var dx = getEvX(ev) - this.originX;
            var dy = getEvY(ev) - this.originY;
            var minDistance = this.minDistance;
            var distanceSq;
            if (!this.isDistanceSurpassed) {
                distanceSq = dx * dx + dy * dy;
                if (distanceSq >= minDistance * minDistance) {
                    this.handleDistanceSurpassed(ev);
                }
            }
            if (this.isDragging) {
                this.handleDrag(dx, dy, ev);
            }
        },
        handleDrag: function(dx, dy, ev) {
            this.trigger('drag', dx, dy, ev);
            this.updateAutoScroll(ev);
        },
        endDrag: function(ev) {
            if (this.isDragging) {
                this.isDragging = false;
                this.handleDragEnd(ev);
            }
        },
        handleDragEnd: function(ev) {
            this.trigger('dragEnd', ev);
        },
        startDelay: function(initialEv) {
            var _this = this;
            if (this.delay) {
                this.delayTimeoutId = setTimeout(function() {
                    _this.handleDelayEnd(initialEv);
                }, this.delay);
            } else {
                this.handleDelayEnd(initialEv);
            }
        },
        handleDelayEnd: function(initialEv) {
            this.isDelayEnded = true;
            if (this.isDistanceSurpassed) {
                this.startDrag(initialEv);
            }
        },
        handleDistanceSurpassed: function(ev) {
            this.isDistanceSurpassed = true;
            if (this.isDelayEnded) {
                this.startDrag(ev);
            }
        },
        handleTouchMove: function(ev) {
            if (this.isDragging && this.shouldCancelTouchScroll) {
                ev.preventDefault();
            }
            this.handleMove(ev);
        },
        handleMouseMove: function(ev) {
            this.handleMove(ev);
        },
        handleTouchScroll: function(ev) {
            if (!this.isDragging || this.scrollAlwaysKills) {
                this.endInteraction(ev, true);
            }
        },
        trigger: function(name) {
            if (this.options[name]) {
                this.options[name].apply(this, Array.prototype.slice.call(arguments, 1));
            }
            if (this['_' + name]) {
                this['_' + name].apply(this, Array.prototype.slice.call(arguments, 1));
            }
        }
    });;;
    DragListener.mixin({
        isAutoScroll: false,
        scrollBounds: null,
        scrollTopVel: null,
        scrollLeftVel: null,
        scrollIntervalId: null,
        scrollSensitivity: 30,
        scrollSpeed: 200,
        scrollIntervalMs: 50,
        initAutoScroll: function() {
            var scrollEl = this.scrollEl;
            this.isAutoScroll = this.options.scroll && scrollEl && !scrollEl.is(window) && !scrollEl.is(document);
            if (this.isAutoScroll) {
                this.listenTo(scrollEl, 'scroll', debounce(this.handleDebouncedScroll, 100));
            }
        },
        destroyAutoScroll: function() {
            this.endAutoScroll();
            if (this.isAutoScroll) {
                this.stopListeningTo(this.scrollEl, 'scroll');
            }
        },
        computeScrollBounds: function() {
            if (this.isAutoScroll) {
                this.scrollBounds = getOuterRect(this.scrollEl);
            }
        },
        updateAutoScroll: function(ev) {
            var sensitivity = this.scrollSensitivity;
            var bounds = this.scrollBounds;
            var topCloseness, bottomCloseness;
            var leftCloseness, rightCloseness;
            var topVel = 0;
            var leftVel = 0;
            if (bounds) {
                topCloseness = (sensitivity - (getEvY(ev) - bounds.top)) / sensitivity;
                bottomCloseness = (sensitivity - (bounds.bottom - getEvY(ev))) / sensitivity;
                leftCloseness = (sensitivity - (getEvX(ev) - bounds.left)) / sensitivity;
                rightCloseness = (sensitivity - (bounds.right - getEvX(ev))) / sensitivity;
                if (topCloseness >= 0 && topCloseness <= 1) {
                    topVel = topCloseness * this.scrollSpeed * -1;
                } else if (bottomCloseness >= 0 && bottomCloseness <= 1) {
                    topVel = bottomCloseness * this.scrollSpeed;
                }
                if (leftCloseness >= 0 && leftCloseness <= 1) {
                    leftVel = leftCloseness * this.scrollSpeed * -1;
                } else if (rightCloseness >= 0 && rightCloseness <= 1) {
                    leftVel = rightCloseness * this.scrollSpeed;
                }
            }
            this.setScrollVel(topVel, leftVel);
        },
        setScrollVel: function(topVel, leftVel) {
            this.scrollTopVel = topVel;
            this.scrollLeftVel = leftVel;
            this.constrainScrollVel();
            if ((this.scrollTopVel || this.scrollLeftVel) && !this.scrollIntervalId) {
                this.scrollIntervalId = setInterval(proxy(this, 'scrollIntervalFunc'), this.scrollIntervalMs);
            }
        },
        constrainScrollVel: function() {
            var el = this.scrollEl;
            if (this.scrollTopVel < 0) {
                if (el.scrollTop() <= 0) {
                    this.scrollTopVel = 0;
                }
            } else if (this.scrollTopVel > 0) {
                if (el.scrollTop() + el[0].clientHeight >= el[0].scrollHeight) {
                    this.scrollTopVel = 0;
                }
            }
            if (this.scrollLeftVel < 0) {
                if (el.scrollLeft() <= 0) {
                    this.scrollLeftVel = 0;
                }
            } else if (this.scrollLeftVel > 0) {
                if (el.scrollLeft() + el[0].clientWidth >= el[0].scrollWidth) {
                    this.scrollLeftVel = 0;
                }
            }
        },
        scrollIntervalFunc: function() {
            var el = this.scrollEl;
            var frac = this.scrollIntervalMs / 1000;
            if (this.scrollTopVel) {
                el.scrollTop(el.scrollTop() + this.scrollTopVel * frac);
            }
            if (this.scrollLeftVel) {
                el.scrollLeft(el.scrollLeft() + this.scrollLeftVel * frac);
            }
            this.constrainScrollVel();
            if (!this.scrollTopVel && !this.scrollLeftVel) {
                this.endAutoScroll();
            }
        },
        endAutoScroll: function() {
            if (this.scrollIntervalId) {
                clearInterval(this.scrollIntervalId);
                this.scrollIntervalId = null;
                this.handleScrollEnd();
            }
        },
        handleDebouncedScroll: function() {
            if (!this.scrollIntervalId) {
                this.handleScrollEnd();
            }
        },
        handleScrollEnd: function() {}
    });;;
    var HitDragListener = DragListener.extend({
        component: null,
        origHit: null,
        hit: null,
        coordAdjust: null,
        constructor: function(component, options) {
            DragListener.call(this, options);
            this.component = component;
        },
        handleInteractionStart: function(ev) {
            var subjectEl = this.subjectEl;
            var subjectRect;
            var origPoint;
            var point;
            this.component.hitsNeeded();
            this.computeScrollBounds();
            if (ev) {
                origPoint = {
                    left: getEvX(ev),
                    top: getEvY(ev)
                };
                point = origPoint;
                if (subjectEl) {
                    subjectRect = getOuterRect(subjectEl);
                    point = constrainPoint(point, subjectRect);
                }
                this.origHit = this.queryHit(point.left, point.top);
                if (subjectEl && this.options.subjectCenter) {
                    if (this.origHit) {
                        subjectRect = intersectRects(this.origHit, subjectRect) || subjectRect;
                    }
                    point = getRectCenter(subjectRect);
                }
                this.coordAdjust = diffPoints(point, origPoint);
            } else {
                this.origHit = null;
                this.coordAdjust = null;
            }
            DragListener.prototype.handleInteractionStart.apply(this, arguments);
        },
        handleDragStart: function(ev) {
            var hit;
            DragListener.prototype.handleDragStart.apply(this, arguments);
            hit = this.queryHit(getEvX(ev), getEvY(ev));
            if (hit) {
                this.handleHitOver(hit);
            }
        },
        handleDrag: function(dx, dy, ev) {
            var hit;
            DragListener.prototype.handleDrag.apply(this, arguments);
            hit = this.queryHit(getEvX(ev), getEvY(ev));
            if (!isHitsEqual(hit, this.hit)) {
                if (this.hit) {
                    this.handleHitOut();
                }
                if (hit) {
                    this.handleHitOver(hit);
                }
            }
        },
        handleDragEnd: function() {
            this.handleHitDone();
            DragListener.prototype.handleDragEnd.apply(this, arguments);
        },
        handleHitOver: function(hit) {
            var isOrig = isHitsEqual(hit, this.origHit);
            this.hit = hit;
            this.trigger('hitOver', this.hit, isOrig, this.origHit);
        },
        handleHitOut: function() {
            if (this.hit) {
                this.trigger('hitOut', this.hit);
                this.handleHitDone();
                this.hit = null;
            }
        },
        handleHitDone: function() {
            if (this.hit) {
                this.trigger('hitDone', this.hit);
            }
        },
        handleInteractionEnd: function() {
            DragListener.prototype.handleInteractionEnd.apply(this, arguments);
            this.origHit = null;
            this.hit = null;
            this.component.hitsNotNeeded();
        },
        handleScrollEnd: function() {
            DragListener.prototype.handleScrollEnd.apply(this, arguments);
            if (this.isDragging) {
                this.component.releaseHits();
                this.component.prepareHits();
            }
        },
        queryHit: function(left, top) {
            if (this.coordAdjust) {
                left += this.coordAdjust.left;
                top += this.coordAdjust.top;
            }
            return this.component.queryHit(left, top);
        }
    });
    function isHitsEqual(hit0, hit1) {
        if (!hit0 && !hit1) {
            return true;
        }
        if (hit0 && hit1) {
            return hit0.component === hit1.component && isHitPropsWithin(hit0, hit1) && isHitPropsWithin(hit1, hit0);
        }
        return false;
    }
    function isHitPropsWithin(subHit, superHit) {
        for (var propName in subHit) {
            if (!/^(component|left|right|top|bottom)$/.test(propName)) {
                if (subHit[propName] !== superHit[propName]) {
                    return false;
                }
            }
        }
        return true;
    };;
    FC.touchMouseIgnoreWait = 500;
    var GlobalEmitter = Class.extend(ListenerMixin, EmitterMixin, {
        isTouching: false,
        mouseIgnoreDepth: 0,
        handleScrollProxy: null,
        bind: function() {
            var _this = this;
            this.listenTo($(document), {
                touchstart: this.handleTouchStart,
                touchcancel: this.handleTouchCancel,
                touchend: this.handleTouchEnd,
                mousedown: this.handleMouseDown,
                mousemove: this.handleMouseMove,
                mouseup: this.handleMouseUp,
                click: this.handleClick,
                selectstart: this.handleSelectStart,
                contextmenu: this.handleContextMenu
            });
            window.addEventListener('touchmove', this.handleTouchMoveProxy = function(ev) {
                _this.handleTouchMove($.Event(ev));
            }, {
                passive: false
            });
            window.addEventListener('scroll', this.handleScrollProxy = function(ev) {
                _this.handleScroll($.Event(ev));
            }, true);
        },
        unbind: function() {
            this.stopListeningTo($(document));
            window.removeEventListener('touchmove', this.handleTouchMoveProxy);
            window.removeEventListener('scroll', this.handleScrollProxy, true);
        },
        handleTouchStart: function(ev) {
            this.stopTouch(ev, true);
            this.isTouching = true;
            this.trigger('touchstart', ev);
        },
        handleTouchMove: function(ev) {
            if (this.isTouching) {
                this.trigger('touchmove', ev);
            }
        },
        handleTouchCancel: function(ev) {
            if (this.isTouching) {
                this.trigger('touchcancel', ev);
                this.stopTouch(ev);
            }
        },
        handleTouchEnd: function(ev) {
            this.stopTouch(ev);
        },
        handleMouseDown: function(ev) {
            if (!this.shouldIgnoreMouse()) {
                this.trigger('mousedown', ev);
            }
        },
        handleMouseMove: function(ev) {
            if (!this.shouldIgnoreMouse()) {
                this.trigger('mousemove', ev);
            }
        },
        handleMouseUp: function(ev) {
            if (!this.shouldIgnoreMouse()) {
                this.trigger('mouseup', ev);
            }
        },
        handleClick: function(ev) {
            if (!this.shouldIgnoreMouse()) {
                this.trigger('click', ev);
            }
        },
        handleSelectStart: function(ev) {
            this.trigger('selectstart', ev);
        },
        handleContextMenu: function(ev) {
            this.trigger('contextmenu', ev);
        },
        handleScroll: function(ev) {
            this.trigger('scroll', ev);
        },
        stopTouch: function(ev, skipMouseIgnore) {
            if (this.isTouching) {
                this.isTouching = false;
                this.trigger('touchend', ev);
                if (!skipMouseIgnore) {
                    this.startTouchMouseIgnore();
                }
            }
        },
        startTouchMouseIgnore: function() {
            var _this = this;
            var wait = FC.touchMouseIgnoreWait;
            if (wait) {
                this.mouseIgnoreDepth++;
                setTimeout(function() {
                    _this.mouseIgnoreDepth--;
                }, wait);
            }
        },
        shouldIgnoreMouse: function() {
            return this.isTouching || Boolean(this.mouseIgnoreDepth);
        }
    });
    (function() {
        var globalEmitter = null;
        var neededCount = 0;
        GlobalEmitter.get = function() {
            if (!globalEmitter) {
                globalEmitter = new GlobalEmitter();
                globalEmitter.bind();
            }
            return globalEmitter;
        };
        GlobalEmitter.needed = function() {
            GlobalEmitter.get();
            neededCount++;
        };
        GlobalEmitter.unneeded = function() {
            neededCount--;
            if (!neededCount) {
                globalEmitter.unbind();
                globalEmitter = null;
            }
        };
    })();;;
    var MouseFollower = Class.extend(ListenerMixin, {
        options: null,
        sourceEl: null,
        el: null,
        parentEl: null,
        top0: null,
        left0: null,
        y0: null,
        x0: null,
        topDelta: null,
        leftDelta: null,
        isFollowing: false,
        isHidden: false,
        isAnimating: false,
        constructor: function(sourceEl, options) {
            this.options = options = options || {};
            this.sourceEl = sourceEl;
            this.parentEl = options.parentEl ? $(options.parentEl) : sourceEl.parent();
        },
        start: function(ev) {
            if (!this.isFollowing) {
                this.isFollowing = true;
                this.y0 = getEvY(ev);
                this.x0 = getEvX(ev);
                this.topDelta = 0;
                this.leftDelta = 0;
                if (!this.isHidden) {
                    this.updatePosition();
                }
                if (getEvIsTouch(ev)) {
                    this.listenTo($(document), 'touchmove', this.handleMove);
                } else {
                    this.listenTo($(document), 'mousemove', this.handleMove);
                }
            }
        },
        stop: function(shouldRevert, callback) {
            var _this = this;
            var revertDuration = this.options.revertDuration;
            function complete() {
                _this.isAnimating = false;
                _this.removeElement();
                _this.top0 = _this.left0 = null;
                if (callback) {
                    callback();
                }
            }
            if (this.isFollowing && !this.isAnimating) {
                this.isFollowing = false;
                this.stopListeningTo($(document));
                if (shouldRevert && revertDuration && !this.isHidden) {
                    this.isAnimating = true;
                    this.el.animate({
                        top: this.top0,
                        left: this.left0
                    }, {
                        duration: revertDuration,
                        complete: complete
                    });
                } else {
                    complete();
                }
            }
        },
        getEl: function() {
            var el = this.el;
            if (!el) {
                el = this.el = this.sourceEl.clone().addClass(this.options.additionalClass || '').css({
                    position: 'absolute',
                    visibility: '',
                    display: this.isHidden ? 'none' : '',
                    margin: 0,
                    right: 'auto',
                    bottom: 'auto',
                    width: this.sourceEl.width(),
                    height: this.sourceEl.height(),
                    opacity: this.options.opacity || '',
                    zIndex: this.options.zIndex
                });
                el.addClass('fc-unselectable');
                el.appendTo(this.parentEl);
            }
            return el;
        },
        removeElement: function() {
            if (this.el) {
                this.el.remove();
                this.el = null;
            }
        },
        updatePosition: function() {
            var sourceOffset;
            var origin;
            this.getEl();
            if (this.top0 === null) {
                sourceOffset = this.sourceEl.offset();
                origin = this.el.offsetParent().offset();
                this.top0 = sourceOffset.top - origin.top;
                this.left0 = sourceOffset.left - origin.left;
            }
            this.el.css({
                top: this.top0 + this.topDelta,
                left: this.left0 + this.leftDelta
            });
        },
        handleMove: function(ev) {
            this.topDelta = getEvY(ev) - this.y0;
            this.leftDelta = getEvX(ev) - this.x0;
            if (!this.isHidden) {
                this.updatePosition();
            }
        },
        hide: function() {
            if (!this.isHidden) {
                this.isHidden = true;
                if (this.el) {
                    this.el.hide();
                }
            }
        },
        show: function() {
            if (this.isHidden) {
                this.isHidden = false;
                this.updatePosition();
                this.getEl().show();
            }
        }
    });;;
    var Grid = FC.Grid = Class.extend(ListenerMixin, {
        hasDayInteractions: true,
        view: null,
        isRTL: null,
        start: null,
        end: null,
        el: null,
        elsByFill: null,
        eventTimeFormat: null,
        displayEventTime: null,
        displayEventEnd: null,
        minResizeDuration: null,
        largeUnit: null,
        dayClickListener: null,
        daySelectListener: null,
        segDragListener: null,
        segResizeListener: null,
        externalDragListener: null,
        constructor: function(view) {
            this.view = view;
            this.isRTL = view.opt('isRTL');
            this.elsByFill = {};
            this.dayClickListener = this.buildDayClickListener();
            this.daySelectListener = this.buildDaySelectListener();
        },
        computeEventTimeFormat: function() {
            return this.view.opt('smallTimeFormat');
        },
        computeDisplayEventTime: function() {
            return true;
        },
        computeDisplayEventEnd: function() {
            return true;
        },
        setRange: function(range) {
            this.start = range.start.clone();
            this.end = range.end.clone();
            this.rangeUpdated();
            this.processRangeOptions();
        },
        rangeUpdated: function() {},
        processRangeOptions: function() {
            var view = this.view;
            var displayEventTime;
            var displayEventEnd;
            this.eventTimeFormat = view.opt('eventTimeFormat') || view.opt('timeFormat') || this.computeEventTimeFormat();
            displayEventTime = view.opt('displayEventTime');
            if (displayEventTime == null) {
                displayEventTime = this.computeDisplayEventTime();
            }
            displayEventEnd = view.opt('displayEventEnd');
            if (displayEventEnd == null) {
                displayEventEnd = this.computeDisplayEventEnd();
            }
            this.displayEventTime = displayEventTime;
            this.displayEventEnd = displayEventEnd;
        },
        spanToSegs: function(span) {},
        diffDates: function(a, b) {
            if (this.largeUnit) {
                return diffByUnit(a, b, this.largeUnit);
            } else {
                return diffDayTime(a, b);
            }
        },
        hitsNeededDepth: 0,
        hitsNeeded: function() {
            if (!(this.hitsNeededDepth++)) {
                this.prepareHits();
            }
        },
        hitsNotNeeded: function() {
            if (this.hitsNeededDepth && !(--this.hitsNeededDepth)) {
                this.releaseHits();
            }
        },
        prepareHits: function() {},
        releaseHits: function() {},
        queryHit: function(leftOffset, topOffset) {},
        getSafeHitSpan: function(hit) {
            var hitSpan = this.getHitSpan(hit);
            if (!isRangeWithinRange(hitSpan, this.view.activeRange)) {
                return null;
            }
            return hitSpan;
        },
        getHitSpan: function(hit) {},
        getHitEl: function(hit) {},
        setElement: function(el) {
            this.el = el;
            if (this.hasDayInteractions) {
                preventSelection(el);
                this.bindDayHandler('touchstart', this.dayTouchStart);
                this.bindDayHandler('mousedown', this.dayMousedown);
            }
            this.bindSegHandlers();
            this.bindGlobalHandlers();
        },
        bindDayHandler: function(name, handler) {
            var _this = this;
            this.el.on(name, function(ev) {
                if (!$(ev.target).is(_this.segSelector + ',' + _this.segSelector + ' *,' + '.fc-more,' + 'a[data-goto]')) {
                    return handler.call(_this, ev);
                }
            });
        },
        removeElement: function() {
            this.unbindGlobalHandlers();
            this.clearDragListeners();
            this.el.remove();
        },
        renderSkeleton: function() {},
        renderDates: function() {},
        unrenderDates: function() {},
        bindGlobalHandlers: function() {
            this.listenTo($(document), {
                dragstart: this.externalDragStart,
                sortstart: this.externalDragStart
            });
        },
        unbindGlobalHandlers: function() {
            this.stopListeningTo($(document));
        },
        dayMousedown: function(ev) {
            var view = this.view;
            if (GlobalEmitter.get().shouldIgnoreMouse()) {
                return;
            }
            this.dayClickListener.startInteraction(ev);
            if (view.opt('selectable')) {
                this.daySelectListener.startInteraction(ev, {
                    distance: view.opt('selectMinDistance')
                });
            }
        },
        dayTouchStart: function(ev) {
            var view = this.view;
            var selectLongPressDelay;
            if (view.isSelected || view.selectedEvent) {
                return;
            }
            selectLongPressDelay = view.opt('selectLongPressDelay');
            if (selectLongPressDelay == null) {
                selectLongPressDelay = view.opt('longPressDelay');
            }
            this.dayClickListener.startInteraction(ev);
            if (view.opt('selectable')) {
                this.daySelectListener.startInteraction(ev, {
                    delay: selectLongPressDelay
                });
            }
        },
        buildDayClickListener: function() {
            var _this = this;
            var view = this.view;
            var dayClickHit;
            var dragListener = new HitDragListener(this, {
                scroll: view.opt('dragScroll'),
                interactionStart: function() {
                    dayClickHit = dragListener.origHit;
                },
                hitOver: function(hit, isOrig, origHit) {
                    if (!isOrig) {
                        dayClickHit = null;
                    }
                },
                hitOut: function() {
                    dayClickHit = null;
                },
                interactionEnd: function(ev, isCancelled) {
                    var hitSpan;
                    if (!isCancelled && dayClickHit) {
                        hitSpan = _this.getSafeHitSpan(dayClickHit);
                        if (hitSpan) {
                            view.triggerDayClick(hitSpan, _this.getHitEl(dayClickHit), ev);
                        }
                    }
                }
            });
            dragListener.shouldCancelTouchScroll = false;
            dragListener.scrollAlwaysKills = true;
            return dragListener;
        },
        buildDaySelectListener: function() {
            var _this = this;
            var view = this.view;
            var selectionSpan;
            var dragListener = new HitDragListener(this, {
                scroll: view.opt('dragScroll'),
                interactionStart: function() {
                    selectionSpan = null;
                },
                dragStart: function() {
                    view.unselect();
                },
                hitOver: function(hit, isOrig, origHit) {
                    var origHitSpan;
                    var hitSpan;
                    if (origHit) {
                        origHitSpan = _this.getSafeHitSpan(origHit);
                        hitSpan = _this.getSafeHitSpan(hit);
                        if (origHitSpan && hitSpan) {
                            selectionSpan = _this.computeSelection(origHitSpan, hitSpan);
                        } else {
                            selectionSpan = null;
                        }
                        if (selectionSpan) {
                            _this.renderSelection(selectionSpan);
                        } else if (selectionSpan === false) {
                            disableCursor();
                        }
                    }
                },
                hitOut: function() {
                    selectionSpan = null;
                    _this.unrenderSelection();
                },
                hitDone: function() {
                    enableCursor();
                },
                interactionEnd: function(ev, isCancelled) {
                    if (!isCancelled && selectionSpan) {
                        view.reportSelection(selectionSpan, ev);
                    }
                }
            });
            return dragListener;
        },
        clearDragListeners: function() {
            this.dayClickListener.endInteraction();
            this.daySelectListener.endInteraction();
            if (this.segDragListener) {
                this.segDragListener.endInteraction();
            }
            if (this.segResizeListener) {
                this.segResizeListener.endInteraction();
            }
            if (this.externalDragListener) {
                this.externalDragListener.endInteraction();
            }
        },
        renderEventLocationHelper: function(eventLocation, sourceSeg) {
            var fakeEvent = this.fabricateHelperEvent(eventLocation, sourceSeg);
            return this.renderHelper(fakeEvent, sourceSeg);
        },
        fabricateHelperEvent: function(eventLocation, sourceSeg) {
            var fakeEvent = sourceSeg ? createObject(sourceSeg.event) : {};
            fakeEvent.start = eventLocation.start.clone();
            fakeEvent.end = eventLocation.end ? eventLocation.end.clone() : null;
            fakeEvent.allDay = null;
            this.view.calendar.normalizeEventDates(fakeEvent);
            fakeEvent.className = (fakeEvent.className || []).concat('fc-helper');
            if (!sourceSeg) {
                fakeEvent.editable = false;
            }
            return fakeEvent;
        },
        renderHelper: function(eventLocation, sourceSeg) {},
        unrenderHelper: function() {},
        renderSelection: function(span) {
            this.renderHighlight(span);
        },
        unrenderSelection: function() {
            this.unrenderHighlight();
        },
        computeSelection: function(span0, span1) {
            var span = this.computeSelectionSpan(span0, span1);
            if (span && !this.view.calendar.isSelectionSpanAllowed(span)) {
                return false;
            }
            return span;
        },
        computeSelectionSpan: function(span0, span1) {
            var dates = [span0.start, span0.end, span1.start, span1.end];
            dates.sort(compareNumbers);
            return {
                start: dates[0].clone(),
                end: dates[3].clone()
            };
        },
        renderHighlight: function(span) {
            this.renderFill('highlight', this.spanToSegs(span));
        },
        unrenderHighlight: function() {
            this.unrenderFill('highlight');
        },
        highlightSegClasses: function() {
            return ['fc-highlight'];
        },
        renderBusinessHours: function() {},
        unrenderBusinessHours: function() {},
        getNowIndicatorUnit: function() {},
        renderNowIndicator: function(date) {},
        unrenderNowIndicator: function() {},
        renderFill: function(type, segs) {},
        unrenderFill: function(type) {
            var el = this.elsByFill[type];
            if (el) {
                el.remove();
                delete this.elsByFill[type];
            }
        },
        renderFillSegEls: function(type, segs) {
            var _this = this;
            var segElMethod = this[type + 'SegEl'];
            var html = '';
            var renderedSegs = [];
            var i;
            if (segs.length) {
                for (i = 0; i < segs.length; i++) {
                    html += this.fillSegHtml(type, segs[i]);
                }
                $(html).each(function(i, node) {
                    var seg = segs[i];
                    var el = $(node);
                    if (segElMethod) {
                        el = segElMethod.call(_this, seg, el);
                    }
                    if (el) {
                        el = $(el);
                        if (el.is(_this.fillSegTag)) {
                            seg.el = el;
                            renderedSegs.push(seg);
                        }
                    }
                });
            }
            return renderedSegs;
        },
        fillSegTag: 'div',
        fillSegHtml: function(type, seg) {
            var classesMethod = this[type + 'SegClasses'];
            var cssMethod = this[type + 'SegCss'];
            var classes = classesMethod ? classesMethod.call(this, seg) : [];
            var css = cssToStr(cssMethod ? cssMethod.call(this, seg) : {});
            return '<' + this.fillSegTag + (classes.length ? ' class="' + classes.join(' ') + '"' : '') + (css ? ' style="' + css + '"' : '') + ' />';
        },
        getDayClasses: function(date, noThemeHighlight) {
            var view = this.view;
            var classes = [];
            var today;
            if (!isDateWithinRange(date, view.activeRange)) {
                classes.push('fc-disabled-day');
            } else {
                classes.push('fc-' + dayIDs[date.day()]);
                if (view.currentRangeAs('months') == 1 && date.month() != view.currentRange.start.month()) {
                    classes.push('fc-other-month');
                }
                today = view.calendar.getNow();
                if (date.isSame(today, 'day')) {
                    classes.push('fc-today');
                    if (noThemeHighlight !== true) {
                        classes.push(view.highlightStateClass);
                    }
                } else if (date < today) {
                    classes.push('fc-past');
                } else {
                    classes.push('fc-future');
                }
            }
            return classes;
        }
    });;;
    Grid.mixin({
        segSelector: '.fc-event-container > *',
        mousedOverSeg: null,
        isDraggingSeg: false,
        isResizingSeg: false,
        isDraggingExternal: false,
        segs: null,
        renderEvents: function(events) {
            var bgEvents = [];
            var fgEvents = [];
            var i;
            for (i = 0; i < events.length; i++) {
                (isBgEvent(events[i]) ? bgEvents : fgEvents).push(events[i]);
            }
            this.segs = [].concat(this.renderBgEvents(bgEvents), this.renderFgEvents(fgEvents));
        },
        renderBgEvents: function(events) {
            var segs = this.eventsToSegs(events);
            return this.renderBgSegs(segs) || segs;
        },
        renderFgEvents: function(events) {
            var segs = this.eventsToSegs(events);
            return this.renderFgSegs(segs) || segs;
        },
        unrenderEvents: function() {
            this.handleSegMouseout();
            this.clearDragListeners();
            this.unrenderFgSegs();
            this.unrenderBgSegs();
            this.segs = null;
        },
        getEventSegs: function() {
            return this.segs || [];
        },
        renderFgSegs: function(segs) {},
        unrenderFgSegs: function() {},
        renderFgSegEls: function(segs, disableResizing) {
            var view = this.view;
            var html = '';
            var renderedSegs = [];
            var i;
            if (segs.length) {
                for (i = 0; i < segs.length; i++) {
                    html += this.fgSegHtml(segs[i], disableResizing);
                }
                $(html).each(function(i, node) {
                    var seg = segs[i];
                    var el = view.resolveEventEl(seg.event, $(node));
                    if (el) {
                        el.data('fc-seg', seg);
                        seg.el = el;
                        renderedSegs.push(seg);
                    }
                });
            }
            return renderedSegs;
        },
        fgSegHtml: function(seg, disableResizing) {},
        renderBgSegs: function(segs) {
            return this.renderFill('bgEvent', segs);
        },
        unrenderBgSegs: function() {
            this.unrenderFill('bgEvent');
        },
        bgEventSegEl: function(seg, el) {
            return this.view.resolveEventEl(seg.event, el);
        },
        bgEventSegClasses: function(seg) {
            var event = seg.event;
            var source = event.source || {};
            return ['fc-bgevent'].concat(event.className, source.className || []);
        },
        bgEventSegCss: function(seg) {
            return {
                'background-color': this.getSegSkinCss(seg)['background-color']
            };
        },
        businessHoursSegClasses: function(seg) {
            return ['fc-nonbusiness', 'fc-bgevent'];
        },
        buildBusinessHourSegs: function(wholeDay, businessHours) {
            return this.eventsToSegs(this.buildBusinessHourEvents(wholeDay, businessHours));
        },
        buildBusinessHourEvents: function(wholeDay, businessHours) {
            var calendar = this.view.calendar;
            var events;
            if (businessHours == null) {
                businessHours = calendar.opt('businessHours');
            }
            events = calendar.computeBusinessHourEvents(wholeDay, businessHours);
            if (!events.length && businessHours) {
                events = [$.extend({}, BUSINESS_HOUR_EVENT_DEFAULTS, {
                    start: this.view.activeRange.end,
                    end: this.view.activeRange.end,
                    dow: null
                })];
            }
            return events;
        },
        bindSegHandlers: function() {
            this.bindSegHandlersToEl(this.el);
        },
        bindSegHandlersToEl: function(el) {
            this.bindSegHandlerToEl(el, 'touchstart', this.handleSegTouchStart);
            this.bindSegHandlerToEl(el, 'mouseenter', this.handleSegMouseover);
            this.bindSegHandlerToEl(el, 'mouseleave', this.handleSegMouseout);
            this.bindSegHandlerToEl(el, 'mousedown', this.handleSegMousedown);
            this.bindSegHandlerToEl(el, 'click', this.handleSegClick);
        },
        bindSegHandlerToEl: function(el, name, handler) {
            var _this = this;
            el.on(name, this.segSelector, function(ev) {
                var seg = $(this).data('fc-seg');
                if (seg && !_this.isDraggingSeg && !_this.isResizingSeg) {
                    return handler.call(_this, seg, ev);
                }
            });
        },
        handleSegClick: function(seg, ev) {
            var res = this.view.publiclyTrigger('eventClick', seg.el[0], seg.event, ev);
            if (res === false) {
                ev.preventDefault();
            }
        },
        handleSegMouseover: function(seg, ev) {
            if (!GlobalEmitter.get().shouldIgnoreMouse() && !this.mousedOverSeg) {
                this.mousedOverSeg = seg;
                if (this.view.isEventResizable(seg.event)) {
                    seg.el.addClass('fc-allow-mouse-resize');
                }
                this.view.publiclyTrigger('eventMouseover', seg.el[0], seg.event, ev);
            }
        },
        handleSegMouseout: function(seg, ev) {
            ev = ev || {};
            if (this.mousedOverSeg) {
                seg = seg || this.mousedOverSeg;
                this.mousedOverSeg = null;
                if (this.view.isEventResizable(seg.event)) {
                    seg.el.removeClass('fc-allow-mouse-resize');
                }
                this.view.publiclyTrigger('eventMouseout', seg.el[0], seg.event, ev);
            }
        },
        handleSegMousedown: function(seg, ev) {
            var isResizing = this.startSegResize(seg, ev, {
                distance: 5
            });
            if (!isResizing && this.view.isEventDraggable(seg.event)) {
                this.buildSegDragListener(seg).startInteraction(ev, {
                    distance: 5
                });
            }
        },
        handleSegTouchStart: function(seg, ev) {
            var view = this.view;
            var event = seg.event;
            var isSelected = view.isEventSelected(event);
            var isDraggable = view.isEventDraggable(event);
            var isResizable = view.isEventResizable(event);
            var isResizing = false;
            var dragListener;
            var eventLongPressDelay;
            if (isSelected && isResizable) {
                isResizing = this.startSegResize(seg, ev);
            }
            if (!isResizing && (isDraggable || isResizable)) {
                eventLongPressDelay = view.opt('eventLongPressDelay');
                if (eventLongPressDelay == null) {
                    eventLongPressDelay = view.opt('longPressDelay');
                }
                dragListener = isDraggable ? this.buildSegDragListener(seg) : this.buildSegSelectListener(seg);
                dragListener.startInteraction(ev, {
                    delay: isSelected ? 0 : eventLongPressDelay
                });
            }
        },
        startSegResize: function(seg, ev, dragOptions) {
            if ($(ev.target).is('.fc-resizer')) {
                this.buildSegResizeListener(seg, $(ev.target).is('.fc-start-resizer')).startInteraction(ev, dragOptions);
                return true;
            }
            return false;
        },
        buildSegDragListener: function(seg) {
            var _this = this;
            var view = this.view;
            var el = seg.el;
            var event = seg.event;
            var isDragging;
            var mouseFollower;
            var dropLocation;
            if (this.segDragListener) {
                return this.segDragListener;
            }
            var dragListener = this.segDragListener = new HitDragListener(view, {
                scroll: view.opt('dragScroll'),
                subjectEl: el,
                subjectCenter: true,
                interactionStart: function(ev) {
                    seg.component = _this;
                    isDragging = false;
                    mouseFollower = new MouseFollower(seg.el, {
                        additionalClass: 'fc-dragging',
                        parentEl: view.el,
                        opacity: dragListener.isTouch ? null : view.opt('dragOpacity'),
                        revertDuration: view.opt('dragRevertDuration'),
                        zIndex: 2
                    });
                    mouseFollower.hide();
                    mouseFollower.start(ev);
                },
                dragStart: function(ev) {
                    if (dragListener.isTouch && !view.isEventSelected(event)) {
                        view.selectEvent(event);
                    }
                    isDragging = true;
                    _this.handleSegMouseout(seg, ev);
                    _this.segDragStart(seg, ev);
                    view.hideEvent(event);
                },
                hitOver: function(hit, isOrig, origHit) {
                    var isAllowed = true;
                    var origHitSpan;
                    var hitSpan;
                    var dragHelperEls;
                    if (seg.hit) {
                        origHit = seg.hit;
                    }
                    origHitSpan = origHit.component.getSafeHitSpan(origHit);
                    hitSpan = hit.component.getSafeHitSpan(hit);
                    if (origHitSpan && hitSpan) {
                        dropLocation = _this.computeEventDrop(origHitSpan, hitSpan, event);
                        isAllowed = dropLocation && _this.isEventLocationAllowed(dropLocation, event);
                    } else {
                        isAllowed = false;
                    }
                    if (!isAllowed) {
                        dropLocation = null;
                        disableCursor();
                    }
                    if (dropLocation && (dragHelperEls = view.renderDrag(dropLocation, seg))) {
                        dragHelperEls.addClass('fc-dragging');
                        if (!dragListener.isTouch) {
                            _this.applyDragOpacity(dragHelperEls);
                        }
                        mouseFollower.hide();
                    } else {
                        mouseFollower.show();
                    }
                    if (isOrig) {
                        dropLocation = null;
                    }
                },
                hitOut: function() {
                    view.unrenderDrag();
                    mouseFollower.show();
                    dropLocation = null;
                },
                hitDone: function() {
                    enableCursor();
                },
                interactionEnd: function(ev) {
                    delete seg.component;
                    mouseFollower.stop(!dropLocation, function() {
                        if (isDragging) {
                            view.unrenderDrag();
                            _this.segDragStop(seg, ev);
                        }
                        if (dropLocation) {
                            view.reportSegDrop(seg, dropLocation, _this.largeUnit, el, ev);
                        } else {
                            view.showEvent(event);
                        }
                    });
                    _this.segDragListener = null;
                }
            });
            return dragListener;
        },
        buildSegSelectListener: function(seg) {
            var _this = this;
            var view = this.view;
            var event = seg.event;
            if (this.segDragListener) {
                return this.segDragListener;
            }
            var dragListener = this.segDragListener = new DragListener({
                dragStart: function(ev) {
                    if (dragListener.isTouch && !view.isEventSelected(event)) {
                        view.selectEvent(event);
                    }
                },
                interactionEnd: function(ev) {
                    _this.segDragListener = null;
                }
            });
            return dragListener;
        },
        segDragStart: function(seg, ev) {
            this.isDraggingSeg = true;
            this.view.publiclyTrigger('eventDragStart', seg.el[0], seg.event, ev, {});
        },
        segDragStop: function(seg, ev) {
            this.isDraggingSeg = false;
            this.view.publiclyTrigger('eventDragStop', seg.el[0], seg.event, ev, {});
        },
        computeEventDrop: function(startSpan, endSpan, event) {
            var calendar = this.view.calendar;
            var dragStart = startSpan.start;
            var dragEnd = endSpan.start;
            var delta;
            var dropLocation;
            if (dragStart.hasTime() === dragEnd.hasTime()) {
                delta = this.diffDates(dragEnd, dragStart);
                if (event.allDay && durationHasTime(delta)) {
                    dropLocation = {
                        start: event.start.clone(),
                        end: calendar.getEventEnd(event),
                        allDay: false
                    };
                    calendar.normalizeEventTimes(dropLocation);
                } else {
                    dropLocation = pluckEventDateProps(event);
                }
                dropLocation.start.add(delta);
                if (dropLocation.end) {
                    dropLocation.end.add(delta);
                }
            } else {
                dropLocation = {
                    start: dragEnd.clone(),
                    end: null,
                    allDay: !dragEnd.hasTime()
                };
            }
            return dropLocation;
        },
        applyDragOpacity: function(els) {
            var opacity = this.view.opt('dragOpacity');
            if (opacity != null) {
                els.css('opacity', opacity);
            }
        },
        externalDragStart: function(ev, ui) {
            var view = this.view;
            var el;
            var accept;
            if (view.opt('droppable')) {
                el = $((ui ? ui.item : null) || ev.target);
                accept = view.opt('dropAccept');
                if ($.isFunction(accept) ? accept.call(el[0], el) : el.is(accept)) {
                    if (!this.isDraggingExternal) {
                        this.listenToExternalDrag(el, ev, ui);
                    }
                }
            }
        },
        listenToExternalDrag: function(el, ev, ui) {
            var _this = this;
            var view = this.view;
            var meta = getDraggedElMeta(el);
            var dropLocation;
            var dragListener = _this.externalDragListener = new HitDragListener(this, {
                interactionStart: function() {
                    _this.isDraggingExternal = true;
                },
                hitOver: function(hit) {
                    var isAllowed = true;
                    var hitSpan = hit.component.getSafeHitSpan(hit);
                    if (hitSpan) {
                        dropLocation = _this.computeExternalDrop(hitSpan, meta);
                        isAllowed = dropLocation && _this.isExternalLocationAllowed(dropLocation, meta.eventProps);
                    } else {
                        isAllowed = false;
                    }
                    if (!isAllowed) {
                        dropLocation = null;
                        disableCursor();
                    }
                    if (dropLocation) {
                        _this.renderDrag(dropLocation);
                    }
                },
                hitOut: function() {
                    dropLocation = null;
                },
                hitDone: function() {
                    enableCursor();
                    _this.unrenderDrag();
                },
                interactionEnd: function(ev) {
                    if (dropLocation) {
                        view.reportExternalDrop(meta, dropLocation, el, ev, ui);
                    }
                    _this.isDraggingExternal = false;
                    _this.externalDragListener = null;
                }
            });
            dragListener.startDrag(ev);
        },
        computeExternalDrop: function(span, meta) {
            var calendar = this.view.calendar;
            var dropLocation = {
                start: calendar.applyTimezone(span.start),
                end: null
            };
            if (meta.startTime && !dropLocation.start.hasTime()) {
                dropLocation.start.time(meta.startTime);
            }
            if (meta.duration) {
                dropLocation.end = dropLocation.start.clone().add(meta.duration);
            }
            return dropLocation;
        },
        renderDrag: function(dropLocation, seg) {},
        unrenderDrag: function() {},
        buildSegResizeListener: function(seg, isStart) {
            var _this = this;
            var view = this.view;
            var calendar = view.calendar;
            var el = seg.el;
            var event = seg.event;
            var eventEnd = calendar.getEventEnd(event);
            var isDragging;
            var resizeLocation;
            var dragListener = this.segResizeListener = new HitDragListener(this, {
                scroll: view.opt('dragScroll'),
                subjectEl: el,
                interactionStart: function() {
                    isDragging = false;
                },
                dragStart: function(ev) {
                    isDragging = true;
                    _this.handleSegMouseout(seg, ev);
                    _this.segResizeStart(seg, ev);
                },
                hitOver: function(hit, isOrig, origHit) {
                    var isAllowed = true;
                    var origHitSpan = _this.getSafeHitSpan(origHit);
                    var hitSpan = _this.getSafeHitSpan(hit);
                    if (origHitSpan && hitSpan) {
                        resizeLocation = isStart ? _this.computeEventStartResize(origHitSpan, hitSpan, event) : _this.computeEventEndResize(origHitSpan, hitSpan, event);
                        isAllowed = resizeLocation && _this.isEventLocationAllowed(resizeLocation, event);
                    } else {
                        isAllowed = false;
                    }
                    if (!isAllowed) {
                        resizeLocation = null;
                        disableCursor();
                    } else {
                        if (resizeLocation.start.isSame(event.start.clone().stripZone()) && resizeLocation.end.isSame(eventEnd.clone().stripZone())) {
                            resizeLocation = null;
                        }
                    }
                    if (resizeLocation) {
                        view.hideEvent(event);
                        _this.renderEventResize(resizeLocation, seg);
                    }
                },
                hitOut: function() {
                    resizeLocation = null;
                    view.showEvent(event);
                },
                hitDone: function() {
                    _this.unrenderEventResize();
                    enableCursor();
                },
                interactionEnd: function(ev) {
                    if (isDragging) {
                        _this.segResizeStop(seg, ev);
                    }
                    if (resizeLocation) {
                        view.reportSegResize(seg, resizeLocation, _this.largeUnit, el, ev);
                    } else {
                        view.showEvent(event);
                    }
                    _this.segResizeListener = null;
                }
            });
            return dragListener;
        },
        segResizeStart: function(seg, ev) {
            this.isResizingSeg = true;
            this.view.publiclyTrigger('eventResizeStart', seg.el[0], seg.event, ev, {});
        },
        segResizeStop: function(seg, ev) {
            this.isResizingSeg = false;
            this.view.publiclyTrigger('eventResizeStop', seg.el[0], seg.event, ev, {});
        },
        computeEventStartResize: function(startSpan, endSpan, event) {
            return this.computeEventResize('start', startSpan, endSpan, event);
        },
        computeEventEndResize: function(startSpan, endSpan, event) {
            return this.computeEventResize('end', startSpan, endSpan, event);
        },
        computeEventResize: function(type, startSpan, endSpan, event) {
            var calendar = this.view.calendar;
            var delta = this.diffDates(endSpan[type], startSpan[type]);
            var resizeLocation;
            var defaultDuration;
            resizeLocation = {
                start: event.start.clone(),
                end: calendar.getEventEnd(event),
                allDay: event.allDay
            };
            if (resizeLocation.allDay && durationHasTime(delta)) {
                resizeLocation.allDay = false;
                calendar.normalizeEventTimes(resizeLocation);
            }
            resizeLocation[type].add(delta);
            if (!resizeLocation.start.isBefore(resizeLocation.end)) {
                defaultDuration = this.minResizeDuration || (event.allDay ? calendar.defaultAllDayEventDuration : calendar.defaultTimedEventDuration);
                if (type == 'start') {
                    resizeLocation.start = resizeLocation.end.clone().subtract(defaultDuration);
                } else {
                    resizeLocation.end = resizeLocation.start.clone().add(defaultDuration);
                }
            }
            return resizeLocation;
        },
        renderEventResize: function(range, seg) {},
        unrenderEventResize: function() {},
        getEventTimeText: function(range, formatStr, displayEnd) {
            if (formatStr == null) {
                formatStr = this.eventTimeFormat;
            }
            if (displayEnd == null) {
                displayEnd = this.displayEventEnd;
            }
            if (this.displayEventTime && range.start.hasTime()) {
                if (displayEnd && range.end) {
                    return this.view.formatRange(range, formatStr);
                } else {
                    return range.start.format(formatStr);
                }
            }
            return '';
        },
        getSegClasses: function(seg, isDraggable, isResizable) {
            var view = this.view;
            var classes = ['fc-event', seg.isStart ? 'fc-start' : 'fc-not-start', seg.isEnd ? 'fc-end' : 'fc-not-end'].concat(this.getSegCustomClasses(seg));
            if (isDraggable) {
                classes.push('fc-draggable');
            }
            if (isResizable) {
                classes.push('fc-resizable');
            }
            if (view.isEventSelected(seg.event)) {
                classes.push('fc-selected');
            }
            return classes;
        },
        getSegCustomClasses: function(seg) {
            var event = seg.event;
            return [].concat(event.className, event.source ? event.source.className : []);
        },
        getSegSkinCss: function(seg) {
            return {
                'background-color': this.getSegBackgroundColor(seg),
                'border-color': this.getSegBorderColor(seg),
                color: this.getSegTextColor(seg)
            };
        },
        getSegBackgroundColor: function(seg) {
            return seg.event.backgroundColor || seg.event.color || this.getSegDefaultBackgroundColor(seg);
        },
        getSegDefaultBackgroundColor: function(seg) {
            var source = seg.event.source || {};
            return source.backgroundColor || source.color || this.view.opt('eventBackgroundColor') || this.view.opt('eventColor');
        },
        getSegBorderColor: function(seg) {
            return seg.event.borderColor || seg.event.color || this.getSegDefaultBorderColor(seg);
        },
        getSegDefaultBorderColor: function(seg) {
            var source = seg.event.source || {};
            return source.borderColor || source.color || this.view.opt('eventBorderColor') || this.view.opt('eventColor');
        },
        getSegTextColor: function(seg) {
            return seg.event.textColor || this.getSegDefaultTextColor(seg);
        },
        getSegDefaultTextColor: function(seg) {
            var source = seg.event.source || {};
            return source.textColor || this.view.opt('eventTextColor');
        },
        isEventLocationAllowed: function(eventLocation, event) {
            if (this.isEventLocationInRange(eventLocation)) {
                var calendar = this.view.calendar;
                var eventSpans = this.eventToSpans(eventLocation);
                var i;
                if (eventSpans.length) {
                    for (i = 0; i < eventSpans.length; i++) {
                        if (!calendar.isEventSpanAllowed(eventSpans[i], event)) {
                            return false;
                        }
                    }
                    return true;
                }
            }
            return false;
        },
        isExternalLocationAllowed: function(eventLocation, metaProps) {
            if (this.isEventLocationInRange(eventLocation)) {
                var calendar = this.view.calendar;
                var eventSpans = this.eventToSpans(eventLocation);
                var i;
                if (eventSpans.length) {
                    for (i = 0; i < eventSpans.length; i++) {
                        if (!calendar.isExternalSpanAllowed(eventSpans[i], eventLocation, metaProps)) {
                            return false;
                        }
                    }
                    return true;
                }
            }
            return false;
        },
        isEventLocationInRange: function(eventLocation) {
            return isRangeWithinRange(this.eventToRawRange(eventLocation), this.view.validRange);
        },
        eventToSegs: function(event) {
            return this.eventsToSegs([event]);
        },
        eventToSpans: function(event) {
            var eventRange = this.eventToRange(event);
            if (eventRange) {
                return this.eventRangeToSpans(eventRange, event);
            } else {
                return [];
            }
        },
        eventsToSegs: function(allEvents, segSliceFunc) {
            var _this = this;
            var eventsById = groupEventsById(allEvents);
            var segs = [];
            $.each(eventsById, function(id, events) {
                var visibleEvents = [];
                var eventRanges = [];
                var eventRange;
                var i;
                for (i = 0; i < events.length; i++) {
                    eventRange = _this.eventToRange(events[i]);
                    if (eventRange) {
                        eventRanges.push(eventRange);
                        visibleEvents.push(events[i]);
                    }
                }
                if (isInverseBgEvent(events[0])) {
                    eventRanges = _this.invertRanges(eventRanges);
                    for (i = 0; i < eventRanges.length; i++) {
                        segs.push.apply(segs, _this.eventRangeToSegs(eventRanges[i], events[0], segSliceFunc));
                    }
                } else {
                    for (i = 0; i < eventRanges.length; i++) {
                        segs.push.apply(segs, _this.eventRangeToSegs(eventRanges[i], visibleEvents[i], segSliceFunc));
                    }
                }
            });
            return segs;
        },
        eventToRange: function(event) {
            return this.refineRawEventRange(this.eventToRawRange(event));
        },
        refineRawEventRange: function(rawRange) {
            var view = this.view;
            var calendar = view.calendar;
            var range = intersectRanges(rawRange, view.activeRange);
            if (range) {
                calendar.localizeMoment(range.start);
                calendar.localizeMoment(range.end);
                return range;
            }
        },
        eventToRawRange: function(event) {
            var calendar = this.view.calendar;
            var start = event.start.clone().stripZone();
            var end = (event.end ? event.end.clone() : calendar.getDefaultEventEnd(event.allDay != null ? event.allDay : !event.start.hasTime(), event.start)).stripZone();
            return {
                start: start,
                end: end
            };
        },
        eventRangeToSegs: function(eventRange, event, segSliceFunc) {
            var eventSpans = this.eventRangeToSpans(eventRange, event);
            var segs = [];
            var i;
            for (i = 0; i < eventSpans.length; i++) {
                segs.push.apply(segs, this.eventSpanToSegs(eventSpans[i], event, segSliceFunc));
            }
            return segs;
        },
        eventRangeToSpans: function(eventRange, event) {
            return [$.extend({}, eventRange)];
        },
        eventSpanToSegs: function(eventSpan, event, segSliceFunc) {
            var segs = segSliceFunc ? segSliceFunc(eventSpan) : this.spanToSegs(eventSpan);
            var i, seg;
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                if (!eventSpan.isStart) {
                    seg.isStart = false;
                }
                if (!eventSpan.isEnd) {
                    seg.isEnd = false;
                }
                seg.event = event;
                seg.eventStartMS = +eventSpan.start;
                seg.eventDurationMS = eventSpan.end - eventSpan.start;
            }
            return segs;
        },
        invertRanges: function(ranges) {
            var view = this.view;
            var viewStart = view.activeRange.start.clone();
            var viewEnd = view.activeRange.end.clone();
            var inverseRanges = [];
            var start = viewStart;
            var i, range;
            ranges.sort(compareRanges);
            for (i = 0; i < ranges.length; i++) {
                range = ranges[i];
                if (range.start > start) {
                    inverseRanges.push({
                        start: start,
                        end: range.start
                    });
                }
                if (range.end > start) {
                    start = range.end;
                }
            }
            if (start < viewEnd) {
                inverseRanges.push({
                    start: start,
                    end: viewEnd
                });
            }
            return inverseRanges;
        },
        sortEventSegs: function(segs) {
            segs.sort(proxy(this, 'compareEventSegs'));
        },
        compareEventSegs: function(seg1, seg2) {
            return seg1.eventStartMS - seg2.eventStartMS || seg2.eventDurationMS - seg1.eventDurationMS || seg2.event.allDay - seg1.event.allDay || compareByFieldSpecs(seg1.event, seg2.event, this.view.eventOrderSpecs);
        }
    });
    function pluckEventDateProps(event) {
        return {
            start: event.start.clone(),
            end: event.end ? event.end.clone() : null,
            allDay: event.allDay
        };
    }
    FC.pluckEventDateProps = pluckEventDateProps;
    function isBgEvent(event) {
        var rendering = getEventRendering(event);
        return rendering === 'background' || rendering === 'inverse-background';
    }
    FC.isBgEvent = isBgEvent;
    function isInverseBgEvent(event) {
        return getEventRendering(event) === 'inverse-background';
    }
    function getEventRendering(event) {
        return firstDefined((event.source || {}).rendering, event.rendering);
    }
    function groupEventsById(events) {
        var eventsById = {};
        var i, event;
        for (i = 0; i < events.length; i++) {
            event = events[i];
            (eventsById[event._id] || (eventsById[event._id] = [])).push(event);
        }
        return eventsById;
    }
    function compareRanges(range1, range2) {
        return range1.start - range2.start;
    }
    FC.dataAttrPrefix = '';
    function getDraggedElMeta(el) {
        var prefix = FC.dataAttrPrefix;
        var eventProps;
        var startTime;
        var duration;
        var stick;
        if (prefix) {
            prefix += '-';
        }
        eventProps = el.data(prefix + 'event') || null;
        if (eventProps) {
            if (typeof eventProps === 'object') {
                eventProps = $.extend({}, eventProps);
            } else {
                eventProps = {};
            }
            startTime = eventProps.start;
            if (startTime == null) {
                startTime = eventProps.time;
            }
            duration = eventProps.duration;
            stick = eventProps.stick;
            delete eventProps.start;
            delete eventProps.time;
            delete eventProps.duration;
            delete eventProps.stick;
        }
        if (startTime == null) {
            startTime = el.data(prefix + 'start');
        }
        if (startTime == null) {
            startTime = el.data(prefix + 'time');
        }
        if (duration == null) {
            duration = el.data(prefix + 'duration');
        }
        if (stick == null) {
            stick = el.data(prefix + 'stick');
        }
        startTime = startTime != null ? moment.duration(startTime) : null;
        duration = duration != null ? moment.duration(duration) : null;
        stick = Boolean(stick);
        return {
            eventProps: eventProps,
            startTime: startTime,
            duration: duration,
            stick: stick
        };
    };;
    var DayTableMixin = FC.DayTableMixin = {
        breakOnWeeks: false,
        dayDates: null,
        dayIndices: null,
        daysPerRow: null,
        rowCnt: null,
        colCnt: null,
        colHeadFormat: null,
        updateDayTable: function() {
            var view = this.view;
            var date = this.start.clone();
            var dayIndex = -1;
            var dayIndices = [];
            var dayDates = [];
            var daysPerRow;
            var firstDay;
            var rowCnt;
            while (date.isBefore(this.end)) {
                if (view.isHiddenDay(date)) {
                    dayIndices.push(dayIndex + 0.5);
                } else {
                    dayIndex++;
                    dayIndices.push(dayIndex);
                    dayDates.push(date.clone());
                }
                date.add(1, 'days');
            }
            if (this.breakOnWeeks) {
                firstDay = dayDates[0].day();
                for (daysPerRow = 1; daysPerRow < dayDates.length; daysPerRow++) {
                    if (dayDates[daysPerRow].day() == firstDay) {
                        break;
                    }
                }
                rowCnt = Math.ceil(dayDates.length / daysPerRow);
            } else {
                rowCnt = 1;
                daysPerRow = dayDates.length;
            }
            this.dayDates = dayDates;
            this.dayIndices = dayIndices;
            this.daysPerRow = daysPerRow;
            this.rowCnt = rowCnt;
            this.updateDayTableCols();
        },
        updateDayTableCols: function() {
            this.colCnt = this.computeColCnt();
            this.colHeadFormat = this.view.opt('columnFormat') || this.computeColHeadFormat();
        },
        computeColCnt: function() {
            return this.daysPerRow;
        },
        getCellDate: function(row, col) {
            return this.dayDates[this.getCellDayIndex(row, col)].clone();
        },
        getCellRange: function(row, col) {
            var start = this.getCellDate(row, col);
            var end = start.clone().add(1, 'days');
            return {
                start: start,
                end: end
            };
        },
        getCellDayIndex: function(row, col) {
            return row * this.daysPerRow + this.getColDayIndex(col);
        },
        getColDayIndex: function(col) {
            if (this.isRTL) {
                return this.colCnt - 1 - col;
            } else {
                return col;
            }
        },
        getDateDayIndex: function(date) {
            var dayIndices = this.dayIndices;
            var dayOffset = date.diff(this.start, 'days');
            if (dayOffset < 0) {
                return dayIndices[0] - 1;
            } else if (dayOffset >= dayIndices.length) {
                return dayIndices[dayIndices.length - 1] + 1;
            } else {
                return dayIndices[dayOffset];
            }
        },
        computeColHeadFormat: function() {
            if (this.rowCnt > 1 || this.colCnt > 10) {
                return 'ddd';
            } else if (this.colCnt > 1) {
                return this.view.opt('dayOfMonthFormat');
            } else {
                return 'dddd';
            }
        },
        sliceRangeByRow: function(range) {
            var daysPerRow = this.daysPerRow;
            var normalRange = this.view.computeDayRange(range);
            var rangeFirst = this.getDateDayIndex(normalRange.start);
            var rangeLast = this.getDateDayIndex(normalRange.end.clone().subtract(1, 'days'));
            var segs = [];
            var row;
            var rowFirst, rowLast;
            var segFirst, segLast;
            for (row = 0; row < this.rowCnt; row++) {
                rowFirst = row * daysPerRow;
                rowLast = rowFirst + daysPerRow - 1;
                segFirst = Math.max(rangeFirst, rowFirst);
                segLast = Math.min(rangeLast, rowLast);
                segFirst = Math.ceil(segFirst);
                segLast = Math.floor(segLast);
                if (segFirst <= segLast) {
                    segs.push({
                        row: row,
                        firstRowDayIndex: segFirst - rowFirst,
                        lastRowDayIndex: segLast - rowFirst,
                        isStart: segFirst === rangeFirst,
                        isEnd: segLast === rangeLast
                    });
                }
            }
            return segs;
        },
        sliceRangeByDay: function(range) {
            var daysPerRow = this.daysPerRow;
            var normalRange = this.view.computeDayRange(range);
            var rangeFirst = this.getDateDayIndex(normalRange.start);
            var rangeLast = this.getDateDayIndex(normalRange.end.clone().subtract(1, 'days'));
            var segs = [];
            var row;
            var rowFirst, rowLast;
            var i;
            var segFirst, segLast;
            for (row = 0; row < this.rowCnt; row++) {
                rowFirst = row * daysPerRow;
                rowLast = rowFirst + daysPerRow - 1;
                for (i = rowFirst; i <= rowLast; i++) {
                    segFirst = Math.max(rangeFirst, i);
                    segLast = Math.min(rangeLast, i);
                    segFirst = Math.ceil(segFirst);
                    segLast = Math.floor(segLast);
                    if (segFirst <= segLast) {
                        segs.push({
                            row: row,
                            firstRowDayIndex: segFirst - rowFirst,
                            lastRowDayIndex: segLast - rowFirst,
                            isStart: segFirst === rangeFirst,
                            isEnd: segLast === rangeLast
                        });
                    }
                }
            }
            return segs;
        },
        renderHeadHtml: function() {
            var view = this.view;
            return '' + '<div class="fc-row ' + view.widgetHeaderClass + '">' + '<table>' + '<thead>' + this.renderHeadTrHtml() + '</thead>' + '</table>' + '</div>';
        },
        renderHeadIntroHtml: function() {
            return this.renderIntroHtml();
        },
        renderHeadTrHtml: function() {
            return '' + '<tr>' + (this.isRTL ? '' : this.renderHeadIntroHtml()) + this.renderHeadDateCellsHtml() + (this.isRTL ? this.renderHeadIntroHtml() : '') + '</tr>';
        },
        renderHeadDateCellsHtml: function() {
            var htmls = [];
            var col, date;
            for (col = 0; col < this.colCnt; col++) {
                date = this.getCellDate(0, col);
                htmls.push(this.renderHeadDateCellHtml(date));
            }
            return htmls.join('');
        },
        renderHeadDateCellHtml: function(date, colspan, otherAttrs) {
            var view = this.view;
            var isDateValid = isDateWithinRange(date, view.activeRange);
            var classNames = ['fc-day-header', view.widgetHeaderClass];
            var innerHtml = htmlEscape(date.format(this.colHeadFormat));
            if (this.rowCnt === 1) {
                classNames = classNames.concat(this.getDayClasses(date, true));
            } else {
                classNames.push('fc-' + dayIDs[date.day()]);
            }
            return '' + '<th class="' + classNames.join(' ') + '"' + ((isDateValid && this.rowCnt) === 1 ? ' data-date="' + date.format('YYYY-MM-DD') + '"' : '') + (colspan > 1 ? ' colspan="' + colspan + '"' : '') + (otherAttrs ? ' ' + otherAttrs : '') + '>' + (isDateValid ? view.buildGotoAnchorHtml({
                date: date,
                forceOff: this.rowCnt > 1 || this.colCnt === 1
            }, innerHtml) : innerHtml) + '</th>';
        },
        renderBgTrHtml: function(row) {
            return '' + '<tr>' + (this.isRTL ? '' : this.renderBgIntroHtml(row)) + this.renderBgCellsHtml(row) + (this.isRTL ? this.renderBgIntroHtml(row) : '') + '</tr>';
        },
        renderBgIntroHtml: function(row) {
            return this.renderIntroHtml();
        },
        renderBgCellsHtml: function(row) {
            var htmls = [];
            var col, date;
            for (col = 0; col < this.colCnt; col++) {
                date = this.getCellDate(row, col);
                htmls.push(this.renderBgCellHtml(date));
            }
            return htmls.join('');
        },
        renderBgCellHtml: function(date, otherAttrs) {
            var view = this.view;
            var isDateValid = isDateWithinRange(date, view.activeRange);
            var classes = this.getDayClasses(date);
            classes.unshift('fc-day', view.widgetContentClass);
            return '<td class="' + classes.join(' ') + '"' + (isDateValid ? ' data-date="' + date.format('YYYY-MM-DD') + '"' : '') + (otherAttrs ? ' ' + otherAttrs : '') + '></td>';
        },
        renderIntroHtml: function() {},
        bookendCells: function(trEl) {
            var introHtml = this.renderIntroHtml();
            if (introHtml) {
                if (this.isRTL) {
                    trEl.append(introHtml);
                } else {
                    trEl.prepend(introHtml);
                }
            }
        }
    };;;
    var DayGrid = FC.DayGrid = Grid.extend(DayTableMixin, {
        numbersVisible: false,
        bottomCoordPadding: 0,
        rowEls: null,
        cellEls: null,
        helperEls: null,
        rowCoordCache: null,
        colCoordCache: null,
        renderDates: function(isRigid) {
            var view = this.view;
            var rowCnt = this.rowCnt;
            var colCnt = this.colCnt;
            var html = '';
            var row;
            var col;
            for (row = 0; row < rowCnt; row++) {
                html += this.renderDayRowHtml(row, isRigid);
            }
            this.el.html(html);
            this.rowEls = this.el.find('.fc-row');
            this.cellEls = this.el.find('.fc-day, .fc-disabled-day');
            this.rowCoordCache = new CoordCache({
                els: this.rowEls,
                isVertical: true
            });
            this.colCoordCache = new CoordCache({
                els: this.cellEls.slice(0, this.colCnt),
                isHorizontal: true
            });
            for (row = 0; row < rowCnt; row++) {
                for (col = 0; col < colCnt; col++) {
                    view.publiclyTrigger('dayRender', null, this.getCellDate(row, col), this.getCellEl(row, col));
                }
            }
        },
        unrenderDates: function() {
            this.removeSegPopover();
        },
        renderBusinessHours: function() {
            var segs = this.buildBusinessHourSegs(true);
            this.renderFill('businessHours', segs, 'bgevent');
        },
        unrenderBusinessHours: function() {
            this.unrenderFill('businessHours');
        },
        renderDayRowHtml: function(row, isRigid) {
            var view = this.view;
            var classes = ['fc-row', 'fc-week', view.widgetContentClass];
            if (isRigid) {
                classes.push('fc-rigid');
            }
            return '' + '<div class="' + classes.join(' ') + '">' + '<div class="fc-bg">' + '<table>' + this.renderBgTrHtml(row) + '</table>' + '</div>' + '<div class="fc-content-skeleton">' + '<table>' + (this.numbersVisible ? '<thead>' + this.renderNumberTrHtml(row) + '</thead>' : '') + '</table>' + '</div>' + '</div>';
        },
        renderNumberTrHtml: function(row) {
            return '' + '<tr>' + (this.isRTL ? '' : this.renderNumberIntroHtml(row)) + this.renderNumberCellsHtml(row) + (this.isRTL ? this.renderNumberIntroHtml(row) : '') + '</tr>';
        },
        renderNumberIntroHtml: function(row) {
            return this.renderIntroHtml();
        },
        renderNumberCellsHtml: function(row) {
            var htmls = [];
            var col, date;
            for (col = 0; col < this.colCnt; col++) {
                date = this.getCellDate(row, col);
                htmls.push(this.renderNumberCellHtml(date));
            }
            return htmls.join('');
        },
        renderNumberCellHtml: function(date) {
            var view = this.view;
            var html = '';
            var isDateValid = isDateWithinRange(date, view.activeRange);
            var isDayNumberVisible = view.dayNumbersVisible && isDateValid;
            var classes;
            var weekCalcFirstDoW;
            if (!isDayNumberVisible && !view.cellWeekNumbersVisible) {
                return '<td/>';
            }
            classes = this.getDayClasses(date);
            classes.unshift('fc-day-top');
            if (view.cellWeekNumbersVisible) {
                if (date._locale._fullCalendar_weekCalc === 'ISO') {
                    weekCalcFirstDoW = 1;
                } else {
                    weekCalcFirstDoW = date._locale.firstDayOfWeek();
                }
            }
            html += '<td class="' + classes.join(' ') + '"' + (isDateValid ? ' data-date="' + date.format() + '"' : '') + '>';
            if (view.cellWeekNumbersVisible && (date.day() == weekCalcFirstDoW)) {
                html += view.buildGotoAnchorHtml({
                    date: date,
                    type: 'week'
                }, {
                    'class': 'fc-week-number'
                }, date.format('w'));
            }
            if (isDayNumberVisible) {
                html += view.buildGotoAnchorHtml(date, {
                    'class': 'fc-day-number'
                }, date.date());
            }
            html += '</td>';
            return html;
        },
        computeEventTimeFormat: function() {
            return this.view.opt('extraSmallTimeFormat');
        },
        computeDisplayEventEnd: function() {
            return this.colCnt == 1;
        },
        rangeUpdated: function() {
            this.updateDayTable();
        },
        spanToSegs: function(span) {
            var segs = this.sliceRangeByRow(span);
            var i, seg;
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                if (this.isRTL) {
                    seg.leftCol = this.daysPerRow - 1 - seg.lastRowDayIndex;
                    seg.rightCol = this.daysPerRow - 1 - seg.firstRowDayIndex;
                } else {
                    seg.leftCol = seg.firstRowDayIndex;
                    seg.rightCol = seg.lastRowDayIndex;
                }
            }
            return segs;
        },
        prepareHits: function() {
            this.colCoordCache.build();
            this.rowCoordCache.build();
            this.rowCoordCache.bottoms[this.rowCnt - 1] += this.bottomCoordPadding;
        },
        releaseHits: function() {
            this.colCoordCache.clear();
            this.rowCoordCache.clear();
        },
        queryHit: function(leftOffset, topOffset) {
            if (this.colCoordCache.isLeftInBounds(leftOffset) && this.rowCoordCache.isTopInBounds(topOffset)) {
                var col = this.colCoordCache.getHorizontalIndex(leftOffset);
                var row = this.rowCoordCache.getVerticalIndex(topOffset);
                if (row != null && col != null) {
                    return this.getCellHit(row, col);
                }
            }
        },
        getHitSpan: function(hit) {
            return this.getCellRange(hit.row, hit.col);
        },
        getHitEl: function(hit) {
            return this.getCellEl(hit.row, hit.col);
        },
        getCellHit: function(row, col) {
            return {
                row: row,
                col: col,
                component: this,
                left: this.colCoordCache.getLeftOffset(col),
                right: this.colCoordCache.getRightOffset(col),
                top: this.rowCoordCache.getTopOffset(row),
                bottom: this.rowCoordCache.getBottomOffset(row)
            };
        },
        getCellEl: function(row, col) {
            return this.cellEls.eq(row * this.colCnt + col);
        },
        renderDrag: function(eventLocation, seg) {
            var eventSpans = this.eventToSpans(eventLocation);
            var i;
            for (i = 0; i < eventSpans.length; i++) {
                this.renderHighlight(eventSpans[i]);
            }
            if (seg && seg.component !== this) {
                return this.renderEventLocationHelper(eventLocation, seg);
            }
        },
        unrenderDrag: function() {
            this.unrenderHighlight();
            this.unrenderHelper();
        },
        renderEventResize: function(eventLocation, seg) {
            var eventSpans = this.eventToSpans(eventLocation);
            var i;
            for (i = 0; i < eventSpans.length; i++) {
                this.renderHighlight(eventSpans[i]);
            }
            return this.renderEventLocationHelper(eventLocation, seg);
        },
        unrenderEventResize: function() {
            this.unrenderHighlight();
            this.unrenderHelper();
        },
        renderHelper: function(event, sourceSeg) {
            var helperNodes = [];
            var segs = this.eventToSegs(event);
            var rowStructs;
            segs = this.renderFgSegEls(segs);
            rowStructs = this.renderSegRows(segs);
            this.rowEls.each(function(row, rowNode) {
                var rowEl = $(rowNode);
                var skeletonEl = $('<div class="fc-helper-skeleton"><table/></div>');
                var skeletonTop;
                if (sourceSeg && sourceSeg.row === row) {
                    skeletonTop = sourceSeg.el.position().top;
                } else {
                    skeletonTop = rowEl.find('.fc-content-skeleton tbody').position().top;
                }
                skeletonEl.css('top', skeletonTop).find('table').append(rowStructs[row].tbodyEl);
                rowEl.append(skeletonEl);
                helperNodes.push(skeletonEl[0]);
            });
            return (this.helperEls = $(helperNodes));
        },
        unrenderHelper: function() {
            if (this.helperEls) {
                this.helperEls.remove();
                this.helperEls = null;
            }
        },
        fillSegTag: 'td',
        renderFill: function(type, segs, className) {
            var nodes = [];
            var i, seg;
            var skeletonEl;
            segs = this.renderFillSegEls(type, segs);
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                skeletonEl = this.renderFillRow(type, seg, className);
                this.rowEls.eq(seg.row).append(skeletonEl);
                nodes.push(skeletonEl[0]);
            }
            this.elsByFill[type] = $(nodes);
            return segs;
        },
        renderFillRow: function(type, seg, className) {
            var colCnt = this.colCnt;
            var startCol = seg.leftCol;
            var endCol = seg.rightCol + 1;
            var skeletonEl;
            var trEl;
            className = className || type.toLowerCase();
            skeletonEl = $('<div class="fc-' + className + '-skeleton">' + '<table><tr/></table>' + '</div>');
            trEl = skeletonEl.find('tr');
            if (startCol > 0) {
                trEl.append('<td colspan="' + startCol + '"/>');
            }
            trEl.append(seg.el.attr('colspan', endCol - startCol));
            if (endCol < colCnt) {
                trEl.append('<td colspan="' + (colCnt - endCol) + '"/>');
            }
            this.bookendCells(trEl);
            return skeletonEl;
        }
    });;;
    DayGrid.mixin({
        rowStructs: null,
        unrenderEvents: function() {
            this.removeSegPopover();
            Grid.prototype.unrenderEvents.apply(this, arguments);
        },
        getEventSegs: function() {
            return Grid.prototype.getEventSegs.call(this).concat(this.popoverSegs || []);
        },
        renderBgSegs: function(segs) {
            var allDaySegs = $.grep(segs, function(seg) {
                return seg.event.allDay;
            });
            return Grid.prototype.renderBgSegs.call(this, allDaySegs);
        },
        renderFgSegs: function(segs) {
            var rowStructs;
            segs = this.renderFgSegEls(segs);
            rowStructs = this.rowStructs = this.renderSegRows(segs);
            this.rowEls.each(function(i, rowNode) {
                $(rowNode).find('.fc-content-skeleton > table').append(rowStructs[i].tbodyEl);
            });
            return segs;
        },
        unrenderFgSegs: function() {
            var rowStructs = this.rowStructs || [];
            var rowStruct;
            while ((rowStruct = rowStructs.pop())) {
                rowStruct.tbodyEl.remove();
            }
            this.rowStructs = null;
        },
        renderSegRows: function(segs) {
            var rowStructs = [];
            var segRows;
            var row;
            segRows = this.groupSegRows(segs);
            for (row = 0; row < segRows.length; row++) {
                rowStructs.push(this.renderSegRow(row, segRows[row]));
            }
            return rowStructs;
        },
        fgSegHtml: function(seg, disableResizing) {
            var view = this.view;
            var event = seg.event;
            var isDraggable = view.isEventDraggable(event);
            var isResizableFromStart = !disableResizing && event.allDay && seg.isStart && view.isEventResizableFromStart(event);
            var isResizableFromEnd = !disableResizing && event.allDay && seg.isEnd && view.isEventResizableFromEnd(event);
            var classes = this.getSegClasses(seg, isDraggable, isResizableFromStart || isResizableFromEnd);
            var skinCss = cssToStr(this.getSegSkinCss(seg));
            var timeHtml = '';
            var timeText;
            var titleHtml;
            classes.unshift('fc-day-grid-event', 'fc-h-event');
            if (seg.isStart) {
                timeText = this.getEventTimeText(event);
                if (timeText) {
                    timeHtml = '<span class="fc-time">' + htmlEscape(timeText) + '</span>';
                }
            }
            titleHtml = '<span class="fc-title">' + (htmlEscape(event.title || '') || '&nbsp;') + '</span>';
            return '<a class="' + classes.join(' ') + '"' + (event.url ? ' href="' + htmlEscape(event.url) + '"' : '') + (skinCss ? ' style="' + skinCss + '"' : '') + '>' + '<div class="fc-content">' + (this.isRTL ? titleHtml + ' ' + timeHtml : timeHtml + ' ' + titleHtml) + '</div>' + (isResizableFromStart ? '<div class="fc-resizer fc-start-resizer" />' : '') + (isResizableFromEnd ? '<div class="fc-resizer fc-end-resizer" />' : '') + '</a>';
        },
        renderSegRow: function(row, rowSegs) {
            var colCnt = this.colCnt;
            var segLevels = this.buildSegLevels(rowSegs);
            var levelCnt = Math.max(1, segLevels.length);
            var tbody = $('<tbody/>');
            var segMatrix = [];
            var cellMatrix = [];
            var loneCellMatrix = [];
            var i, levelSegs;
            var col;
            var tr;
            var j, seg;
            var td;
            function emptyCellsUntil(endCol) {
                while (col < endCol) {
                    td = (loneCellMatrix[i - 1] || [])[col];
                    if (td) {
                        td.attr('rowspan', parseInt(td.attr('rowspan') || 1, 10) + 1);
                    } else {
                        td = $('<td/>');
                        tr.append(td);
                    }
                    cellMatrix[i][col] = td;
                    loneCellMatrix[i][col] = td;
                    col++;
                }
            }
            for (i = 0; i < levelCnt; i++) {
                levelSegs = segLevels[i];
                col = 0;
                tr = $('<tr/>');
                segMatrix.push([]);
                cellMatrix.push([]);
                loneCellMatrix.push([]);
                if (levelSegs) {
                    for (j = 0; j < levelSegs.length; j++) {
                        seg = levelSegs[j];
                        emptyCellsUntil(seg.leftCol);
                        td = $('<td class="fc-event-container"/>').append(seg.el);
                        if (seg.leftCol != seg.rightCol) {
                            td.attr('colspan', seg.rightCol - seg.leftCol + 1);
                        } else {
                            loneCellMatrix[i][col] = td;
                        }
                        while (col <= seg.rightCol) {
                            cellMatrix[i][col] = td;
                            segMatrix[i][col] = seg;
                            col++;
                        }
                        tr.append(td);
                    }
                }
                emptyCellsUntil(colCnt);
                this.bookendCells(tr);
                tbody.append(tr);
            }
            return {
                row: row,
                tbodyEl: tbody,
                cellMatrix: cellMatrix,
                segMatrix: segMatrix,
                segLevels: segLevels,
                segs: rowSegs
            };
        },
        buildSegLevels: function(segs) {
            var levels = [];
            var i, seg;
            var j;
            this.sortEventSegs(segs);
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                for (j = 0; j < levels.length; j++) {
                    if (!isDaySegCollision(seg, levels[j])) {
                        break;
                    }
                }
                seg.level = j;
                (levels[j] || (levels[j] = [])).push(seg);
            }
            for (j = 0; j < levels.length; j++) {
                levels[j].sort(compareDaySegCols);
            }
            return levels;
        },
        groupSegRows: function(segs) {
            var segRows = [];
            var i;
            for (i = 0; i < this.rowCnt; i++) {
                segRows.push([]);
            }
            for (i = 0; i < segs.length; i++) {
                segRows[segs[i].row].push(segs[i]);
            }
            return segRows;
        }
    });
    function isDaySegCollision(seg, otherSegs) {
        var i, otherSeg;
        for (i = 0; i < otherSegs.length; i++) {
            otherSeg = otherSegs[i];
            if (otherSeg.leftCol <= seg.rightCol && otherSeg.rightCol >= seg.leftCol) {
                return true;
            }
        }
        return false;
    }
    function compareDaySegCols(a, b) {
        return a.leftCol - b.leftCol;
    };;
    DayGrid.mixin({
        segPopover: null,
        popoverSegs: null,
        removeSegPopover: function() {
            if (this.segPopover) {
                this.segPopover.hide();
            }
        },
        limitRows: function(levelLimit) {
            var rowStructs = this.rowStructs || [];
            var row;
            var rowLevelLimit;
            for (row = 0; row < rowStructs.length; row++) {
                this.unlimitRow(row);
                if (!levelLimit) {
                    rowLevelLimit = false;
                } else if (typeof levelLimit === 'number') {
                    rowLevelLimit = levelLimit;
                } else {
                    rowLevelLimit = this.computeRowLevelLimit(row);
                }
                if (rowLevelLimit !== false) {
                    this.limitRow(row, rowLevelLimit);
                }
            }
        },
        computeRowLevelLimit: function(row) {
            var rowEl = this.rowEls.eq(row);
            var rowHeight = rowEl.height();
            var trEls = this.rowStructs[row].tbodyEl.children();
            var i, trEl;
            var trHeight;
            function iterInnerHeights(i, childNode) {
                trHeight = Math.max(trHeight, $(childNode).outerHeight());
            }
            for (i = 0; i < trEls.length; i++) {
                trEl = trEls.eq(i).removeClass('fc-limited');
                trHeight = 0;
                trEl.find('> td > :first-child').each(iterInnerHeights);
                if (trEl.position().top + trHeight > rowHeight) {
                    return i;
                }
            }
            return false;
        },
        limitRow: function(row, levelLimit) {
            var _this = this;
            var rowStruct = this.rowStructs[row];
            var moreNodes = [];
            var col = 0;
            var levelSegs;
            var cellMatrix;
            var limitedNodes;
            var i, seg;
            var segsBelow;
            var totalSegsBelow;
            var colSegsBelow;
            var td, rowspan;
            var segMoreNodes;
            var j;
            var moreTd, moreWrap, moreLink;
            function emptyCellsUntil(endCol) {
                while (col < endCol) {
                    segsBelow = _this.getCellSegs(row, col, levelLimit);
                    if (segsBelow.length) {
                        td = cellMatrix[levelLimit - 1][col];
                        moreLink = _this.renderMoreLink(row, col, segsBelow);
                        moreWrap = $('<div/>').append(moreLink);
                        td.append(moreWrap);
                        moreNodes.push(moreWrap[0]);
                    }
                    col++;
                }
            }
            if (levelLimit && levelLimit < rowStruct.segLevels.length) {
                levelSegs = rowStruct.segLevels[levelLimit - 1];
                cellMatrix = rowStruct.cellMatrix;
                limitedNodes = rowStruct.tbodyEl.children().slice(levelLimit).addClass('fc-limited').get();
                for (i = 0; i < levelSegs.length; i++) {
                    seg = levelSegs[i];
                    emptyCellsUntil(seg.leftCol);
                    colSegsBelow = [];
                    totalSegsBelow = 0;
                    while (col <= seg.rightCol) {
                        segsBelow = this.getCellSegs(row, col, levelLimit);
                        colSegsBelow.push(segsBelow);
                        totalSegsBelow += segsBelow.length;
                        col++;
                    }
                    if (totalSegsBelow) {
                        td = cellMatrix[levelLimit - 1][seg.leftCol];
                        rowspan = td.attr('rowspan') || 1;
                        segMoreNodes = [];
                        for (j = 0; j < colSegsBelow.length; j++) {
                            moreTd = $('<td class="fc-more-cell"/>').attr('rowspan', rowspan);
                            segsBelow = colSegsBelow[j];
                            moreLink = this.renderMoreLink(row, seg.leftCol + j, [seg].concat(segsBelow));
                            moreWrap = $('<div/>').append(moreLink);
                            moreTd.append(moreWrap);
                            segMoreNodes.push(moreTd[0]);
                            moreNodes.push(moreTd[0]);
                        }
                        td.addClass('fc-limited').after($(segMoreNodes));
                        limitedNodes.push(td[0]);
                    }
                }
                emptyCellsUntil(this.colCnt);
                rowStruct.moreEls = $(moreNodes);
                rowStruct.limitedEls = $(limitedNodes);
            }
        },
        unlimitRow: function(row) {
            var rowStruct = this.rowStructs[row];
            if (rowStruct.moreEls) {
                rowStruct.moreEls.remove();
                rowStruct.moreEls = null;
            }
            if (rowStruct.limitedEls) {
                rowStruct.limitedEls.removeClass('fc-limited');
                rowStruct.limitedEls = null;
            }
        },
        renderMoreLink: function(row, col, hiddenSegs) {
            var _this = this;
            var view = this.view;
            return $('<a class="fc-more"/>').text(this.getMoreLinkText(hiddenSegs.length)).on('click', function(ev) {
                var clickOption = view.opt('eventLimitClick');
                var date = _this.getCellDate(row, col);
                var moreEl = $(this);
                var dayEl = _this.getCellEl(row, col);
                var allSegs = _this.getCellSegs(row, col);
                var reslicedAllSegs = _this.resliceDaySegs(allSegs, date);
                var reslicedHiddenSegs = _this.resliceDaySegs(hiddenSegs, date);
                if (typeof clickOption === 'function') {
                    clickOption = view.publiclyTrigger('eventLimitClick', null, {
                        date: date,
                        dayEl: dayEl,
                        moreEl: moreEl,
                        segs: reslicedAllSegs,
                        hiddenSegs: reslicedHiddenSegs
                    }, ev);
                }
                if (clickOption === 'popover') {
                    _this.showSegPopover(row, col, moreEl, reslicedAllSegs);
                } else if (typeof clickOption === 'string') {
                    view.calendar.zoomTo(date, clickOption);
                }
            });
        },
        showSegPopover: function(row, col, moreLink, segs) {
            var _this = this;
            var view = this.view;
            var moreWrap = moreLink.parent();
            var topEl;
            var options;
            if (this.rowCnt == 1) {
                topEl = view.el;
            } else {
                topEl = this.rowEls.eq(row);
            }
            options = {
                className: 'fc-more-popover',
                content: this.renderSegPopoverContent(row, col, segs),
                parentEl: this.view.el,
                top: topEl.offset().top,
                autoHide: true,
                viewportConstrain: view.opt('popoverViewportConstrain'),
                hide: function() {
                    if (_this.popoverSegs) {
                        var seg;
                        for (var i = 0; i < _this.popoverSegs.length; ++i) {
                            seg = _this.popoverSegs[i];
                            view.publiclyTrigger('eventDestroy', seg.event, seg.event, seg.el);
                        }
                    }
                    _this.segPopover.removeElement();
                    _this.segPopover = null;
                    _this.popoverSegs = null;
                }
            };
            if (this.isRTL) {
                options.right = moreWrap.offset().left + moreWrap.outerWidth() + 1;
            } else {
                options.left = moreWrap.offset().left - 1;
            }
            this.segPopover = new Popover(options);
            this.segPopover.show();
            this.bindSegHandlersToEl(this.segPopover.el);
        },
        renderSegPopoverContent: function(row, col, segs) {
            var view = this.view;
            var isTheme = view.opt('theme');
            var title = this.getCellDate(row, col).format(view.opt('dayPopoverFormat'));
            var content = $('<div class="fc-header ' + view.widgetHeaderClass + '">' + '<span class="fc-close ' + (isTheme ? 'ui-icon ui-icon-closethick' : 'fc-icon fc-icon-x') + '"></span>' + '<span class="fc-title">' + htmlEscape(title) + '</span>' + '<div class="fc-clear"/>' + '</div>' + '<div class="fc-body ' + view.widgetContentClass + '">' + '<div class="fc-event-container"></div>' + '</div>');
            var segContainer = content.find('.fc-event-container');
            var i;
            segs = this.renderFgSegEls(segs, true);
            this.popoverSegs = segs;
            for (i = 0; i < segs.length; i++) {
                this.hitsNeeded();
                segs[i].hit = this.getCellHit(row, col);
                this.hitsNotNeeded();
                segContainer.append(segs[i].el);
            }
            return content;
        },
        resliceDaySegs: function(segs, dayDate) {
            var events = $.map(segs, function(seg) {
                return seg.event;
            });
            var dayStart = dayDate.clone();
            var dayEnd = dayStart.clone().add(1, 'days');
            var dayRange = {
                start: dayStart,
                end: dayEnd
            };
            segs = this.eventsToSegs(events, function(range) {
                var seg = intersectRanges(range, dayRange);
                return seg ? [seg] : [];
            });
            this.sortEventSegs(segs);
            return segs;
        },
        getMoreLinkText: function(num) {
            var opt = this.view.opt('eventLimitText');
            if (typeof opt === 'function') {
                return opt(num);
            } else {
                return '+' + num + ' ' + opt;
            }
        },
        getCellSegs: function(row, col, startLevel) {
            var segMatrix = this.rowStructs[row].segMatrix;
            var level = startLevel || 0;
            var segs = [];
            var seg;
            while (level < segMatrix.length) {
                seg = segMatrix[level][col];
                if (seg) {
                    segs.push(seg);
                }
                level++;
            }
            return segs;
        }
    });;;
    var TimeGrid = FC.TimeGrid = Grid.extend(DayTableMixin, {
        slotDuration: null,
        snapDuration: null,
        snapsPerSlot: null,
        labelFormat: null,
        labelInterval: null,
        colEls: null,
        slatContainerEl: null,
        slatEls: null,
        nowIndicatorEls: null,
        colCoordCache: null,
        slatCoordCache: null,
        constructor: function() {
            Grid.apply(this, arguments);
            this.processOptions();
        },
        renderDates: function() {
            this.el.html(this.renderHtml());
            this.colEls = this.el.find('.fc-day, .fc-disabled-day');
            this.slatContainerEl = this.el.find('.fc-slats');
            this.slatEls = this.slatContainerEl.find('tr');
            this.colCoordCache = new CoordCache({
                els: this.colEls,
                isHorizontal: true
            });
            this.slatCoordCache = new CoordCache({
                els: this.slatEls,
                isVertical: true
            });
            this.renderContentSkeleton();
        },
        renderHtml: function() {
            return '' + '<div class="fc-bg">' + '<table>' + this.renderBgTrHtml(0) + '</table>' + '</div>' + '<div class="fc-slats">' + '<table>' + this.renderSlatRowHtml() + '</table>' + '</div>';
        },
        renderSlatRowHtml: function() {
            var view = this.view;
            var isRTL = this.isRTL;
            var html = '';
            var slotTime = moment.duration(+this.view.minTime);
            var slotDate;
            var isLabeled;
            var axisHtml;
            while (slotTime < this.view.maxTime) {
                slotDate = this.start.clone().time(slotTime);
                isLabeled = isInt(divideDurationByDuration(slotTime, this.labelInterval));
                axisHtml = '<td class="fc-axis fc-time ' + view.widgetContentClass + '" ' + view.axisStyleAttr() + '>' + (isLabeled ? '<span>' + htmlEscape(slotDate.format(this.labelFormat)) + '</span>' : '') + '</td>';
                html += '<tr data-time="' + slotDate.format('HH:mm:ss') + '"' + (isLabeled ? '' : ' class="fc-minor"') + '>' + (!isRTL ? axisHtml : '') + '<td class="' + view.widgetContentClass + '"/>' + (isRTL ? axisHtml : '') + "</tr>";
                slotTime.add(this.slotDuration);
            }
            return html;
        },
        processOptions: function() {
            var view = this.view;
            var slotDuration = view.opt('slotDuration');
            var snapDuration = view.opt('snapDuration');
            var input;
            slotDuration = moment.duration(slotDuration);
            snapDuration = snapDuration ? moment.duration(snapDuration) : slotDuration;
            this.slotDuration = slotDuration;
            this.snapDuration = snapDuration;
            this.snapsPerSlot = slotDuration / snapDuration;
            this.minResizeDuration = snapDuration;
            input = view.opt('slotLabelFormat');
            if ($.isArray(input)) {
                input = input[input.length - 1];
            }
            this.labelFormat = input || view.opt('smallTimeFormat');
            input = view.opt('slotLabelInterval');
            this.labelInterval = input ? moment.duration(input) : this.computeLabelInterval(slotDuration);
        },
        computeLabelInterval: function(slotDuration) {
            var i;
            var labelInterval;
            var slotsPerLabel;
            for (i = AGENDA_STOCK_SUB_DURATIONS.length - 1; i >= 0; i--) {
                labelInterval = moment.duration(AGENDA_STOCK_SUB_DURATIONS[i]);
                slotsPerLabel = divideDurationByDuration(labelInterval, slotDuration);
                if (isInt(slotsPerLabel) && slotsPerLabel > 1) {
                    return labelInterval;
                }
            }
            return moment.duration(slotDuration);
        },
        computeEventTimeFormat: function() {
            return this.view.opt('noMeridiemTimeFormat');
        },
        computeDisplayEventEnd: function() {
            return true;
        },
        prepareHits: function() {
            this.colCoordCache.build();
            this.slatCoordCache.build();
        },
        releaseHits: function() {
            this.colCoordCache.clear();
        },
        queryHit: function(leftOffset, topOffset) {
            var snapsPerSlot = this.snapsPerSlot;
            var colCoordCache = this.colCoordCache;
            var slatCoordCache = this.slatCoordCache;
            if (colCoordCache.isLeftInBounds(leftOffset) && slatCoordCache.isTopInBounds(topOffset)) {
                var colIndex = colCoordCache.getHorizontalIndex(leftOffset);
                var slatIndex = slatCoordCache.getVerticalIndex(topOffset);
                if (colIndex != null && slatIndex != null) {
                    var slatTop = slatCoordCache.getTopOffset(slatIndex);
                    var slatHeight = slatCoordCache.getHeight(slatIndex);
                    var partial = (topOffset - slatTop) / slatHeight;
                    var localSnapIndex = Math.floor(partial * snapsPerSlot);
                    var snapIndex = slatIndex * snapsPerSlot + localSnapIndex;
                    var snapTop = slatTop + (localSnapIndex / snapsPerSlot) * slatHeight;
                    var snapBottom = slatTop + ((localSnapIndex + 1) / snapsPerSlot) * slatHeight;
                    return {
                        col: colIndex,
                        snap: snapIndex,
                        component: this,
                        left: colCoordCache.getLeftOffset(colIndex),
                        right: colCoordCache.getRightOffset(colIndex),
                        top: snapTop,
                        bottom: snapBottom
                    };
                }
            }
        },
        getHitSpan: function(hit) {
            var start = this.getCellDate(0, hit.col);
            var time = this.computeSnapTime(hit.snap);
            var end;
            start.time(time);
            end = start.clone().add(this.snapDuration);
            return {
                start: start,
                end: end
            };
        },
        getHitEl: function(hit) {
            return this.colEls.eq(hit.col);
        },
        rangeUpdated: function() {
            this.updateDayTable();
        },
        computeSnapTime: function(snapIndex) {
            return moment.duration(this.view.minTime + this.snapDuration * snapIndex);
        },
        spanToSegs: function(span) {
            var segs = this.sliceRangeByTimes(span);
            var i;
            for (i = 0; i < segs.length; i++) {
                if (this.isRTL) {
                    segs[i].col = this.daysPerRow - 1 - segs[i].dayIndex;
                } else {
                    segs[i].col = segs[i].dayIndex;
                }
            }
            return segs;
        },
        sliceRangeByTimes: function(range) {
            var segs = [];
            var seg;
            var dayIndex;
            var dayDate;
            var dayRange;
            for (dayIndex = 0; dayIndex < this.daysPerRow; dayIndex++) {
                dayDate = this.dayDates[dayIndex].clone().time(0);
                dayRange = {
                    start: dayDate.clone().add(this.view.minTime),
                    end: dayDate.clone().add(this.view.maxTime)
                };
                seg = intersectRanges(range, dayRange);
                if (seg) {
                    seg.dayIndex = dayIndex;
                    segs.push(seg);
                }
            }
            return segs;
        },
        updateSize: function(isResize) {
            this.slatCoordCache.build();
            if (isResize) {
                this.updateSegVerticals([].concat(this.fgSegs || [], this.bgSegs || [], this.businessSegs || []));
            }
        },
        getTotalSlatHeight: function() {
            return this.slatContainerEl.outerHeight();
        },
        computeDateTop: function(date, startOfDayDate) {
            return this.computeTimeTop(moment.duration(date - startOfDayDate.clone().stripTime()));
        },
        computeTimeTop: function(time) {
            var len = this.slatEls.length;
            var slatCoverage = (time - this.view.minTime) / this.slotDuration;
            var slatIndex;
            var slatRemainder;
            slatCoverage = Math.max(0, slatCoverage);
            slatCoverage = Math.min(len, slatCoverage);
            slatIndex = Math.floor(slatCoverage);
            slatIndex = Math.min(slatIndex, len - 1);
            slatRemainder = slatCoverage - slatIndex;
            return this.slatCoordCache.getTopPosition(slatIndex) + this.slatCoordCache.getHeight(slatIndex) * slatRemainder;
        },
        renderDrag: function(eventLocation, seg) {
            var eventSpans;
            var i;
            if (seg) {
                return this.renderEventLocationHelper(eventLocation, seg);
            } else {
                eventSpans = this.eventToSpans(eventLocation);
                for (i = 0; i < eventSpans.length; i++) {
                    this.renderHighlight(eventSpans[i]);
                }
            }
        },
        unrenderDrag: function() {
            this.unrenderHelper();
            this.unrenderHighlight();
        },
        renderEventResize: function(eventLocation, seg) {
            return this.renderEventLocationHelper(eventLocation, seg);
        },
        unrenderEventResize: function() {
            this.unrenderHelper();
        },
        renderHelper: function(event, sourceSeg) {
            return this.renderHelperSegs(this.eventToSegs(event), sourceSeg);
        },
        unrenderHelper: function() {
            this.unrenderHelperSegs();
        },
        renderBusinessHours: function() {
            this.renderBusinessSegs(this.buildBusinessHourSegs());
        },
        unrenderBusinessHours: function() {
            this.unrenderBusinessSegs();
        },
        getNowIndicatorUnit: function() {
            return 'minute';
        },
        renderNowIndicator: function(date) {
            var segs = this.spanToSegs({
                start: date,
                end: date
            });
            var top = this.computeDateTop(date, date);
            var nodes = [];
            var i;
            for (i = 0; i < segs.length; i++) {
                nodes.push($('<div class="fc-now-indicator fc-now-indicator-line"></div>').css('top', top).appendTo(this.colContainerEls.eq(segs[i].col))[0]);
            }
            if (segs.length > 0) {
                nodes.push($('<div class="fc-now-indicator fc-now-indicator-arrow"></div>').css('top', top).appendTo(this.el.find('.fc-content-skeleton'))[0]);
            }
            this.nowIndicatorEls = $(nodes);
        },
        unrenderNowIndicator: function() {
            if (this.nowIndicatorEls) {
                this.nowIndicatorEls.remove();
                this.nowIndicatorEls = null;
            }
        },
        renderSelection: function(span) {
            if (this.view.opt('selectHelper')) {
                this.renderEventLocationHelper(span);
            } else {
                this.renderHighlight(span);
            }
        },
        unrenderSelection: function() {
            this.unrenderHelper();
            this.unrenderHighlight();
        },
        renderHighlight: function(span) {
            this.renderHighlightSegs(this.spanToSegs(span));
        },
        unrenderHighlight: function() {
            this.unrenderHighlightSegs();
        }
    });;;
    TimeGrid.mixin({
        colContainerEls: null,
        fgContainerEls: null,
        bgContainerEls: null,
        helperContainerEls: null,
        highlightContainerEls: null,
        businessContainerEls: null,
        fgSegs: null,
        bgSegs: null,
        helperSegs: null,
        highlightSegs: null,
        businessSegs: null,
        renderContentSkeleton: function() {
            var cellHtml = '';
            var i;
            var skeletonEl;
            for (i = 0; i < this.colCnt; i++) {
                cellHtml += '<td>' + '<div class="fc-content-col">' + '<div class="fc-event-container fc-helper-container"></div>' + '<div class="fc-event-container"></div>' + '<div class="fc-highlight-container"></div>' + '<div class="fc-bgevent-container"></div>' + '<div class="fc-business-container"></div>' + '</div>' + '</td>';
            }
            skeletonEl = $('<div class="fc-content-skeleton">' + '<table>' + '<tr>' + cellHtml + '</tr>' + '</table>' + '</div>');
            this.colContainerEls = skeletonEl.find('.fc-content-col');
            this.helperContainerEls = skeletonEl.find('.fc-helper-container');
            this.fgContainerEls = skeletonEl.find('.fc-event-container:not(.fc-helper-container)');
            this.bgContainerEls = skeletonEl.find('.fc-bgevent-container');
            this.highlightContainerEls = skeletonEl.find('.fc-highlight-container');
            this.businessContainerEls = skeletonEl.find('.fc-business-container');
            this.bookendCells(skeletonEl.find('tr'));
            this.el.append(skeletonEl);
        },
        renderFgSegs: function(segs) {
            segs = this.renderFgSegsIntoContainers(segs, this.fgContainerEls);
            this.fgSegs = segs;
            return segs;
        },
        unrenderFgSegs: function() {
            this.unrenderNamedSegs('fgSegs');
        },
        renderHelperSegs: function(segs, sourceSeg) {
            var helperEls = [];
            var i, seg;
            var sourceEl;
            segs = this.renderFgSegsIntoContainers(segs, this.helperContainerEls);
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                if (sourceSeg && sourceSeg.col === seg.col) {
                    sourceEl = sourceSeg.el;
                    seg.el.css({
                        left: sourceEl.css('left'),
                        right: sourceEl.css('right'),
                        'margin-left': sourceEl.css('margin-left'),
                        'margin-right': sourceEl.css('margin-right')
                    });
                }
                helperEls.push(seg.el[0]);
            }
            this.helperSegs = segs;
            return $(helperEls);
        },
        unrenderHelperSegs: function() {
            this.unrenderNamedSegs('helperSegs');
        },
        renderBgSegs: function(segs) {
            segs = this.renderFillSegEls('bgEvent', segs);
            this.updateSegVerticals(segs);
            this.attachSegsByCol(this.groupSegsByCol(segs), this.bgContainerEls);
            this.bgSegs = segs;
            return segs;
        },
        unrenderBgSegs: function() {
            this.unrenderNamedSegs('bgSegs');
        },
        renderHighlightSegs: function(segs) {
            segs = this.renderFillSegEls('highlight', segs);
            this.updateSegVerticals(segs);
            this.attachSegsByCol(this.groupSegsByCol(segs), this.highlightContainerEls);
            this.highlightSegs = segs;
        },
        unrenderHighlightSegs: function() {
            this.unrenderNamedSegs('highlightSegs');
        },
        renderBusinessSegs: function(segs) {
            segs = this.renderFillSegEls('businessHours', segs);
            this.updateSegVerticals(segs);
            this.attachSegsByCol(this.groupSegsByCol(segs), this.businessContainerEls);
            this.businessSegs = segs;
        },
        unrenderBusinessSegs: function() {
            this.unrenderNamedSegs('businessSegs');
        },
        groupSegsByCol: function(segs) {
            var segsByCol = [];
            var i;
            for (i = 0; i < this.colCnt; i++) {
                segsByCol.push([]);
            }
            for (i = 0; i < segs.length; i++) {
                segsByCol[segs[i].col].push(segs[i]);
            }
            return segsByCol;
        },
        attachSegsByCol: function(segsByCol, containerEls) {
            var col;
            var segs;
            var i;
            for (col = 0; col < this.colCnt; col++) {
                segs = segsByCol[col];
                for (i = 0; i < segs.length; i++) {
                    containerEls.eq(col).append(segs[i].el);
                }
            }
        },
        unrenderNamedSegs: function(propName) {
            var segs = this[propName];
            var i;
            if (segs) {
                for (i = 0; i < segs.length; i++) {
                    segs[i].el.remove();
                }
                this[propName] = null;
            }
        },
        renderFgSegsIntoContainers: function(segs, containerEls) {
            var segsByCol;
            var col;
            segs = this.renderFgSegEls(segs);
            segsByCol = this.groupSegsByCol(segs);
            for (col = 0; col < this.colCnt; col++) {
                this.updateFgSegCoords(segsByCol[col]);
            }
            this.attachSegsByCol(segsByCol, containerEls);
            return segs;
        },
        fgSegHtml: function(seg, disableResizing) {
            var view = this.view;
            var event = seg.event;
            var isDraggable = view.isEventDraggable(event);
            var isResizableFromStart = !disableResizing && seg.isStart && view.isEventResizableFromStart(event);
            var isResizableFromEnd = !disableResizing && seg.isEnd && view.isEventResizableFromEnd(event);
            var classes = this.getSegClasses(seg, isDraggable, isResizableFromStart || isResizableFromEnd);
            var skinCss = cssToStr(this.getSegSkinCss(seg));
            var timeText;
            var fullTimeText;
            var startTimeText;
            classes.unshift('fc-time-grid-event', 'fc-v-event');
            if (view.isMultiDayEvent(event)) {
                if (seg.isStart || seg.isEnd) {
                    timeText = this.getEventTimeText(seg);
                    fullTimeText = this.getEventTimeText(seg, 'LT');
                    startTimeText = this.getEventTimeText(seg, null, false);
                }
            } else {
                timeText = this.getEventTimeText(event);
                fullTimeText = this.getEventTimeText(event, 'LT');
                startTimeText = this.getEventTimeText(event, null, false);
            }
            return '<a class="' + classes.join(' ') + '"' + (event.url ? ' href="' + htmlEscape(event.url) + '"' : '') + (skinCss ? ' style="' + skinCss + '"' : '') + '>' + '<div class="fc-content">' + (timeText ? '<div class="fc-time"' + ' data-start="' + htmlEscape(startTimeText) + '"' + ' data-full="' + htmlEscape(fullTimeText) + '"' + '>' + '<span>' + htmlEscape(timeText) + '</span>' + '</div>' : '') + (event.title ? '<div class="fc-title">' + htmlEscape(event.title) + '</div>' : '') + '</div>' + '<div class="fc-bg"/>' + (isResizableFromEnd ? '<div class="fc-resizer fc-end-resizer" />' : '') + '</a>';
        },
        updateSegVerticals: function(segs) {
            this.computeSegVerticals(segs);
            this.assignSegVerticals(segs);
        },
        computeSegVerticals: function(segs) {
            var i, seg;
            var dayDate;
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                dayDate = this.dayDates[seg.dayIndex];
                seg.top = this.computeDateTop(seg.start, dayDate);
                seg.bottom = this.computeDateTop(seg.end, dayDate);
            }
        },
        assignSegVerticals: function(segs) {
            var i, seg;
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                seg.el.css(this.generateSegVerticalCss(seg));
            }
        },
        generateSegVerticalCss: function(seg) {
            return {
                top: seg.top,
                bottom: -seg.bottom
            };
        },
        updateFgSegCoords: function(segs) {
            this.computeSegVerticals(segs);
            this.computeFgSegHorizontals(segs);
            this.assignSegVerticals(segs);
            this.assignFgSegHorizontals(segs);
        },
        computeFgSegHorizontals: function(segs) {
            var levels;
            var level0;
            var i;
            this.sortEventSegs(segs);
            levels = buildSlotSegLevels(segs);
            computeForwardSlotSegs(levels);
            if ((level0 = levels[0])) {
                for (i = 0; i < level0.length; i++) {
                    computeSlotSegPressures(level0[i]);
                }
                for (i = 0; i < level0.length; i++) {
                    this.computeFgSegForwardBack(level0[i], 0, 0);
                }
            }
        },
        computeFgSegForwardBack: function(seg, seriesBackwardPressure, seriesBackwardCoord) {
            var forwardSegs = seg.forwardSegs;
            var i;
            if (seg.forwardCoord === undefined) {
                if (!forwardSegs.length) {
                    seg.forwardCoord = 1;
                } else {
                    this.sortForwardSegs(forwardSegs);
                    this.computeFgSegForwardBack(forwardSegs[0], seriesBackwardPressure + 1, seriesBackwardCoord);
                    seg.forwardCoord = forwardSegs[0].backwardCoord;
                }
                seg.backwardCoord = seg.forwardCoord - (seg.forwardCoord - seriesBackwardCoord) / (seriesBackwardPressure + 1);
                for (i = 0; i < forwardSegs.length; i++) {
                    this.computeFgSegForwardBack(forwardSegs[i], 0, seg.forwardCoord);
                }
            }
        },
        sortForwardSegs: function(forwardSegs) {
            forwardSegs.sort(proxy(this, 'compareForwardSegs'));
        },
        compareForwardSegs: function(seg1, seg2) {
            return seg2.forwardPressure - seg1.forwardPressure || (seg1.backwardCoord || 0) - (seg2.backwardCoord || 0) || this.compareEventSegs(seg1, seg2);
        },
        assignFgSegHorizontals: function(segs) {
            var i, seg;
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                seg.el.css(this.generateFgSegHorizontalCss(seg));
                if (seg.bottom - seg.top < 30) {
                    seg.el.addClass('fc-short');
                }
            }
        },
        generateFgSegHorizontalCss: function(seg) {
            var shouldOverlap = this.view.opt('slotEventOverlap');
            var backwardCoord = seg.backwardCoord;
            var forwardCoord = seg.forwardCoord;
            var props = this.generateSegVerticalCss(seg);
            var left;
            var right;
            if (shouldOverlap) {
                forwardCoord = Math.min(1, backwardCoord + (forwardCoord - backwardCoord) * 2);
            }
            if (this.isRTL) {
                left = 1 - forwardCoord;
                right = backwardCoord;
            } else {
                left = backwardCoord;
                right = 1 - forwardCoord;
            }
            props.zIndex = seg.level + 1;
            props.left = left * 100 + '%';
            props.right = right * 100 + '%';
            if (shouldOverlap && seg.forwardPressure) {
                props[this.isRTL ? 'marginLeft' : 'marginRight'] = 10 * 2;
            }
            return props;
        }
    });
    function buildSlotSegLevels(segs) {
        var levels = [];
        var i, seg;
        var j;
        for (i = 0; i < segs.length; i++) {
            seg = segs[i];
            for (j = 0; j < levels.length; j++) {
                if (!computeSlotSegCollisions(seg, levels[j]).length) {
                    break;
                }
            }
            seg.level = j;
            (levels[j] || (levels[j] = [])).push(seg);
        }
        return levels;
    }
    function computeForwardSlotSegs(levels) {
        var i, level;
        var j, seg;
        var k;
        for (i = 0; i < levels.length; i++) {
            level = levels[i];
            for (j = 0; j < level.length; j++) {
                seg = level[j];
                seg.forwardSegs = [];
                for (k = i + 1; k < levels.length; k++) {
                    computeSlotSegCollisions(seg, levels[k], seg.forwardSegs);
                }
            }
        }
    }
    function computeSlotSegPressures(seg) {
        var forwardSegs = seg.forwardSegs;
        var forwardPressure = 0;
        var i, forwardSeg;
        if (seg.forwardPressure === undefined) {
            for (i = 0; i < forwardSegs.length; i++) {
                forwardSeg = forwardSegs[i];
                computeSlotSegPressures(forwardSeg);
                forwardPressure = Math.max(forwardPressure, 1 + forwardSeg.forwardPressure);
            }
            seg.forwardPressure = forwardPressure;
        }
    }
    function computeSlotSegCollisions(seg, otherSegs, results) {
        results = results || [];
        for (var i = 0; i < otherSegs.length; i++) {
            if (isSlotSegCollision(seg, otherSegs[i])) {
                results.push(otherSegs[i]);
            }
        }
        return results;
    }
    function isSlotSegCollision(seg1, seg2) {
        return seg1.bottom > seg2.top && seg1.top < seg2.bottom;
    };;
    var View = FC.View = Model.extend({
        type: null,
        name: null,
        title: null,
        calendar: null,
        viewSpec: null,
        options: null,
        el: null,
        renderQueue: null,
        batchRenderDepth: 0,
        isDatesRendered: false,
        isEventsRendered: false,
        isBaseRendered: false,
        queuedScroll: null,
        isRTL: false,
        isSelected: false,
        selectedEvent: null,
        eventOrderSpecs: null,
        widgetHeaderClass: null,
        widgetContentClass: null,
        highlightStateClass: null,
        nextDayThreshold: null,
        isHiddenDayHash: null,
        isNowIndicatorRendered: null,
        initialNowDate: null,
        initialNowQueriedMs: null,
        nowIndicatorTimeoutID: null,
        nowIndicatorIntervalID: null,
        constructor: function(calendar, viewSpec) {
            Model.prototype.constructor.call(this);
            this.calendar = calendar;
            this.viewSpec = viewSpec;
            this.type = viewSpec.type;
            this.options = viewSpec.options;
            this.name = this.type;
            this.nextDayThreshold = moment.duration(this.opt('nextDayThreshold'));
            this.initThemingProps();
            this.initHiddenDays();
            this.isRTL = this.opt('isRTL');
            this.eventOrderSpecs = parseFieldSpecs(this.opt('eventOrder'));
            this.renderQueue = this.buildRenderQueue();
            this.initAutoBatchRender();
            this.initialize();
        },
        buildRenderQueue: function() {
            var _this = this;
            var renderQueue = new RenderQueue({
                event: this.opt('eventRenderWait')
            });
            renderQueue.on('start', function() {
                _this.freezeHeight();
                _this.addScroll(_this.queryScroll());
            });
            renderQueue.on('stop', function() {
                _this.thawHeight();
                _this.popScroll();
            });
            return renderQueue;
        },
        initAutoBatchRender: function() {
            var _this = this;
            this.on('before:change', function() {
                _this.startBatchRender();
            });
            this.on('change', function() {
                _this.stopBatchRender();
            });
        },
        startBatchRender: function() {
            if (!(this.batchRenderDepth++)) {
                this.renderQueue.pause();
            }
        },
        stopBatchRender: function() {
            if (!(--this.batchRenderDepth)) {
                this.renderQueue.resume();
            }
        },
        initialize: function() {},
        opt: function(name) {
            return this.options[name];
        },
        publiclyTrigger: function(name, thisObj) {
            var calendar = this.calendar;
            return calendar.publiclyTrigger.apply(calendar, [name, thisObj || this].concat(Array.prototype.slice.call(arguments, 2), [this]));
        },
        updateTitle: function() {
            this.title = this.computeTitle();
            this.calendar.setToolbarsTitle(this.title);
        },
        computeTitle: function() {
            var range;
            if (/^(year|month)$/.test(this.currentRangeUnit)) {
                range = this.currentRange;
            } else {
                range = this.activeRange;
            }
            return this.formatRange({
                start: this.calendar.applyTimezone(range.start),
                end: this.calendar.applyTimezone(range.end)
            }, this.opt('titleFormat') || this.computeTitleFormat(), this.opt('titleRangeSeparator'));
        },
        computeTitleFormat: function() {
            if (this.currentRangeUnit == 'year') {
                return 'YYYY';
            } else if (this.currentRangeUnit == 'month') {
                return this.opt('monthYearFormat');
            } else if (this.currentRangeAs('days') > 1) {
                return 'll';
            } else {
                return 'LL';
            }
        },
        formatRange: function(range, formatStr, separator) {
            var end = range.end;
            if (!end.hasTime()) {
                end = end.clone().subtract(1);
            }
            return formatRange(range.start, end, formatStr, separator, this.opt('isRTL'));
        },
        getAllDayHtml: function() {
            return this.opt('allDayHtml') || htmlEscape(this.opt('allDayText'));
        },
        buildGotoAnchorHtml: function(gotoOptions, attrs, innerHtml) {
            var date, type, forceOff;
            var finalOptions;
            if ($.isPlainObject(gotoOptions)) {
                date = gotoOptions.date;
                type = gotoOptions.type;
                forceOff = gotoOptions.forceOff;
            } else {
                date = gotoOptions;
            }
            date = FC.moment(date);
            finalOptions = {
                date: date.format('YYYY-MM-DD'),
                type: type || 'day'
            };
            if (typeof attrs === 'string') {
                innerHtml = attrs;
                attrs = null;
            }
            attrs = attrs ? ' ' + attrsToStr(attrs) : '';
            innerHtml = innerHtml || '';
            if (!forceOff && this.opt('navLinks')) {
                return '<a' + attrs + ' data-goto="' + htmlEscape(JSON.stringify(finalOptions)) + '">' + innerHtml + '</a>';
            } else {
                return '<span' + attrs + '>' + innerHtml + '</span>';
            }
        },
        setElement: function(el) {
            this.el = el;
            this.bindGlobalHandlers();
            this.bindBaseRenderHandlers();
            this.renderSkeleton();
        },
        removeElement: function() {
            this.unsetDate();
            this.unrenderSkeleton();
            this.unbindGlobalHandlers();
            this.unbindBaseRenderHandlers();
            this.el.remove();
        },
        renderSkeleton: function() {},
        unrenderSkeleton: function() {},
        setDate: function(date) {
            var currentDateProfile = this.get('dateProfile');
            var newDateProfile = this.buildDateProfile(date, null, true);
            if (!currentDateProfile || !isRangesEqual(currentDateProfile.activeRange, newDateProfile.activeRange)) {
                this.set('dateProfile', newDateProfile);
            }
            return newDateProfile.date;
        },
        unsetDate: function() {
            this.unset('dateProfile');
        },
        requestDateRender: function(dateProfile) {
            var _this = this;
            this.renderQueue.queue(function() {
                _this.executeDateRender(dateProfile);
            }, 'date', 'init');
        },
        requestDateUnrender: function() {
            var _this = this;
            this.renderQueue.queue(function() {
                _this.executeDateUnrender();
            }, 'date', 'destroy');
        },
        fetchInitialEvents: function(dateProfile) {
            return this.calendar.requestEvents(dateProfile.activeRange.start, dateProfile.activeRange.end);
        },
        bindEventChanges: function() {
            this.listenTo(this.calendar, 'eventsReset', this.resetEvents);
        },
        unbindEventChanges: function() {
            this.stopListeningTo(this.calendar, 'eventsReset');
        },
        setEvents: function(events) {
            this.set('currentEvents', events);
            this.set('hasEvents', true);
        },
        unsetEvents: function() {
            this.unset('currentEvents');
            this.unset('hasEvents');
        },
        resetEvents: function(events) {
            this.startBatchRender();
            this.unsetEvents();
            this.setEvents(events);
            this.stopBatchRender();
        },
        requestEventsRender: function(events) {
            var _this = this;
            this.renderQueue.queue(function() {
                _this.executeEventsRender(events);
            }, 'event', 'init');
        },
        requestEventsUnrender: function() {
            var _this = this;
            this.renderQueue.queue(function() {
                _this.executeEventsUnrender();
            }, 'event', 'destroy');
        },
        executeDateRender: function(dateProfile, skipScroll) {
            this.setDateProfileForRendering(dateProfile);
            this.updateTitle();
            this.calendar.updateToolbarButtons();
            if (this.render) {
                this.render();
            }
            this.renderDates();
            this.updateSize();
            this.renderBusinessHours();
            this.startNowIndicator();
            if (!skipScroll) {
                this.addScroll(this.computeInitialDateScroll());
            }
            this.isDatesRendered = true;
            this.trigger('datesRendered');
        },
        executeDateUnrender: function() {
            this.unselect();
            this.stopNowIndicator();
            this.trigger('before:datesUnrendered');
            this.unrenderBusinessHours();
            this.unrenderDates();
            if (this.destroy) {
                this.destroy();
            }
            this.isDatesRendered = false;
        },
        renderDates: function() {},
        unrenderDates: function() {},
        bindBaseRenderHandlers: function() {
            var _this = this;
            this.on('datesRendered.baseHandler', function() {
                _this.onBaseRender();
            });
            this.on('before:datesUnrendered.baseHandler', function() {
                _this.onBeforeBaseUnrender();
            });
        },
        unbindBaseRenderHandlers: function() {
            this.off('.baseHandler');
        },
        onBaseRender: function() {
            this.applyScreenState();
            this.publiclyTrigger('viewRender', this, this, this.el);
        },
        onBeforeBaseUnrender: function() {
            this.applyScreenState();
            this.publiclyTrigger('viewDestroy', this, this, this.el);
        },
        bindGlobalHandlers: function() {
            this.listenTo(GlobalEmitter.get(), {
                touchstart: this.processUnselect,
                mousedown: this.handleDocumentMousedown
            });
        },
        unbindGlobalHandlers: function() {
            this.stopListeningTo(GlobalEmitter.get());
        },
        initThemingProps: function() {
            var tm = this.opt('theme') ? 'ui' : 'fc';
            this.widgetHeaderClass = tm + '-widget-header';
            this.widgetContentClass = tm + '-widget-content';
            this.highlightStateClass = tm + '-state-highlight';
        },
        renderBusinessHours: function() {},
        unrenderBusinessHours: function() {},
        startNowIndicator: function() {
            var _this = this;
            var unit;
            var update;
            var delay;
            if (this.opt('nowIndicator')) {
                unit = this.getNowIndicatorUnit();
                if (unit) {
                    update = proxy(this, 'updateNowIndicator');
                    this.initialNowDate = this.calendar.getNow();
                    this.initialNowQueriedMs = +new Date();
                    this.renderNowIndicator(this.initialNowDate);
                    this.isNowIndicatorRendered = true;
                    delay = this.initialNowDate.clone().startOf(unit).add(1, unit) - this.initialNowDate;
                    this.nowIndicatorTimeoutID = setTimeout(function() {
                        _this.nowIndicatorTimeoutID = null;
                        update();
                        delay = +moment.duration(1, unit);
                        delay = Math.max(100, delay);
                        _this.nowIndicatorIntervalID = setInterval(update, delay);
                    }, delay);
                }
            }
        },
        updateNowIndicator: function() {
            if (this.isNowIndicatorRendered) {
                this.unrenderNowIndicator();
                this.renderNowIndicator(this.initialNowDate.clone().add(new Date() - this.initialNowQueriedMs));
            }
        },
        stopNowIndicator: function() {
            if (this.isNowIndicatorRendered) {
                if (this.nowIndicatorTimeoutID) {
                    clearTimeout(this.nowIndicatorTimeoutID);
                    this.nowIndicatorTimeoutID = null;
                }
                if (this.nowIndicatorIntervalID) {
                    clearTimeout(this.nowIndicatorIntervalID);
                    this.nowIndicatorIntervalID = null;
                }
                this.unrenderNowIndicator();
                this.isNowIndicatorRendered = false;
            }
        },
        getNowIndicatorUnit: function() {},
        renderNowIndicator: function(date) {},
        unrenderNowIndicator: function() {},
        updateSize: function(isResize) {
            var scroll;
            if (isResize) {
                scroll = this.queryScroll();
            }
            this.updateHeight(isResize);
            this.updateWidth(isResize);
            this.updateNowIndicator();
            if (isResize) {
                this.applyScroll(scroll);
            }
        },
        updateWidth: function(isResize) {},
        updateHeight: function(isResize) {
            var calendar = this.calendar;
            this.setHeight(calendar.getSuggestedViewHeight(), calendar.isHeightAuto());
        },
        setHeight: function(height, isAuto) {},
        addForcedScroll: function(scroll) {
            this.addScroll($.extend(scroll, {
                isForced: true
            }));
        },
        addScroll: function(scroll) {
            var queuedScroll = this.queuedScroll || (this.queuedScroll = {});
            if (!queuedScroll.isForced) {
                $.extend(queuedScroll, scroll);
            }
        },
        popScroll: function() {
            this.applyQueuedScroll();
            this.queuedScroll = null;
        },
        applyQueuedScroll: function() {
            if (this.queuedScroll) {
                this.applyScroll(this.queuedScroll);
            }
        },
        queryScroll: function() {
            var scroll = {};
            if (this.isDatesRendered) {
                $.extend(scroll, this.queryDateScroll());
            }
            return scroll;
        },
        applyScroll: function(scroll) {
            if (this.isDatesRendered) {
                this.applyDateScroll(scroll);
            }
        },
        computeInitialDateScroll: function() {
            return {};
        },
        queryDateScroll: function() {
            return {};
        },
        applyDateScroll: function(scroll) {;
        },
        freezeHeight: function() {
            this.calendar.freezeContentHeight();
        },
        thawHeight: function() {
            this.calendar.thawContentHeight();
        },
        executeEventsRender: function(events) {
            this.renderEvents(events);
            this.isEventsRendered = true;
            this.onEventsRender();
        },
        executeEventsUnrender: function() {
            this.onBeforeEventsUnrender();
            if (this.destroyEvents) {
                this.destroyEvents();
            }
            this.unrenderEvents();
            this.isEventsRendered = false;
        },
        onEventsRender: function() {
            this.applyScreenState();
            this.renderedEventSegEach(function(seg) {
                this.publiclyTrigger('eventAfterRender', seg.event, seg.event, seg.el);
            });
            this.publiclyTrigger('eventAfterAllRender');
        },
        onBeforeEventsUnrender: function() {
            this.applyScreenState();
            this.renderedEventSegEach(function(seg) {
                this.publiclyTrigger('eventDestroy', seg.event, seg.event, seg.el);
            });
        },
        applyScreenState: function() {
            this.thawHeight();
            this.freezeHeight();
            this.applyQueuedScroll();
        },
        renderEvents: function(events) {},
        unrenderEvents: function() {},
        resolveEventEl: function(event, el) {
            var custom = this.publiclyTrigger('eventRender', event, event, el);
            if (custom === false) {
                el = null;
            } else if (custom && custom !== true) {
                el = $(custom);
            }
            return el;
        },
        showEvent: function(event) {
            this.renderedEventSegEach(function(seg) {
                seg.el.css('visibility', '');
            }, event);
        },
        hideEvent: function(event) {
            this.renderedEventSegEach(function(seg) {
                seg.el.css('visibility', 'hidden');
            }, event);
        },
        renderedEventSegEach: function(func, event) {
            var segs = this.getEventSegs();
            var i;
            for (i = 0; i < segs.length; i++) {
                if (!event || segs[i].event._id === event._id) {
                    if (segs[i].el) {
                        func.call(this, segs[i]);
                    }
                }
            }
        },
        getEventSegs: function() {
            return [];
        },
        isEventDraggable: function(event) {
            return this.isEventStartEditable(event);
        },
        isEventStartEditable: function(event) {
            return firstDefined(event.startEditable, (event.source || {}).startEditable, this.opt('eventStartEditable'), this.isEventGenerallyEditable(event));
        },
        isEventGenerallyEditable: function(event) {
            return firstDefined(event.editable, (event.source || {}).editable, this.opt('editable'));
        },
        reportSegDrop: function(seg, dropLocation, largeUnit, el, ev) {
            var calendar = this.calendar;
            var mutateResult = calendar.mutateSeg(seg, dropLocation, largeUnit);
            var undoFunc = function() {
                mutateResult.undo();
                calendar.reportEventChange();
            };
            this.triggerEventDrop(seg.event, mutateResult.dateDelta, undoFunc, el, ev);
            calendar.reportEventChange();
        },
        triggerEventDrop: function(event, dateDelta, undoFunc, el, ev) {
            this.publiclyTrigger('eventDrop', el[0], event, dateDelta, undoFunc, ev, {});
        },
        reportExternalDrop: function(meta, dropLocation, el, ev, ui) {
            var eventProps = meta.eventProps;
            var eventInput;
            var event;
            if (eventProps) {
                eventInput = $.extend({}, eventProps, dropLocation);
                event = this.calendar.renderEvent(eventInput, meta.stick)[0];
            }
            this.triggerExternalDrop(event, dropLocation, el, ev, ui);
        },
        triggerExternalDrop: function(event, dropLocation, el, ev, ui) {
            this.publiclyTrigger('drop', el[0], dropLocation.start, ev, ui);
            if (event) {
                this.publiclyTrigger('eventReceive', null, event);
            }
        },
        renderDrag: function(dropLocation, seg) {},
        unrenderDrag: function() {},
        isEventResizableFromStart: function(event) {
            return this.opt('eventResizableFromStart') && this.isEventResizable(event);
        },
        isEventResizableFromEnd: function(event) {
            return this.isEventResizable(event);
        },
        isEventResizable: function(event) {
            var source = event.source || {};
            return firstDefined(event.durationEditable, source.durationEditable, this.opt('eventDurationEditable'), event.editable, source.editable, this.opt('editable'));
        },
        reportSegResize: function(seg, resizeLocation, largeUnit, el, ev) {
            var calendar = this.calendar;
            var mutateResult = calendar.mutateSeg(seg, resizeLocation, largeUnit);
            var undoFunc = function() {
                mutateResult.undo();
                calendar.reportEventChange();
            };
            this.triggerEventResize(seg.event, mutateResult.durationDelta, undoFunc, el, ev);
            calendar.reportEventChange();
        },
        triggerEventResize: function(event, durationDelta, undoFunc, el, ev) {
            this.publiclyTrigger('eventResize', el[0], event, durationDelta, undoFunc, ev, {});
        },
        select: function(span, ev) {
            this.unselect(ev);
            this.renderSelection(span);
            this.reportSelection(span, ev);
        },
        renderSelection: function(span) {},
        reportSelection: function(span, ev) {
            this.isSelected = true;
            this.triggerSelect(span, ev);
        },
        triggerSelect: function(span, ev) {
            this.publiclyTrigger('select', null, this.calendar.applyTimezone(span.start), this.calendar.applyTimezone(span.end), ev);
        },
        unselect: function(ev) {
            if (this.isSelected) {
                this.isSelected = false;
                if (this.destroySelection) {
                    this.destroySelection();
                }
                this.unrenderSelection();
                this.publiclyTrigger('unselect', null, ev);
            }
        },
        unrenderSelection: function() {},
        selectEvent: function(event) {
            if (!this.selectedEvent || this.selectedEvent !== event) {
                this.unselectEvent();
                this.renderedEventSegEach(function(seg) {
                    seg.el.addClass('fc-selected');
                }, event);
                this.selectedEvent = event;
            }
        },
        unselectEvent: function() {
            if (this.selectedEvent) {
                this.renderedEventSegEach(function(seg) {
                    seg.el.removeClass('fc-selected');
                }, this.selectedEvent);
                this.selectedEvent = null;
            }
        },
        isEventSelected: function(event) {
            return this.selectedEvent && this.selectedEvent._id === event._id;
        },
        handleDocumentMousedown: function(ev) {
            if (isPrimaryMouseButton(ev)) {
                this.processUnselect(ev);
            }
        },
        processUnselect: function(ev) {
            this.processRangeUnselect(ev);
            this.processEventUnselect(ev);
        },
        processRangeUnselect: function(ev) {
            var ignore;
            if (this.isSelected && this.opt('unselectAuto')) {
                ignore = this.opt('unselectCancel');
                if (!ignore || !$(ev.target).closest(ignore).length) {
                    this.unselect(ev);
                }
            }
        },
        processEventUnselect: function(ev) {
            if (this.selectedEvent) {
                if (!$(ev.target).closest('.fc-selected').length) {
                    this.unselectEvent();
                }
            }
        },
        triggerDayClick: function(span, dayEl, ev) {
            this.publiclyTrigger('dayClick', dayEl, this.calendar.applyTimezone(span.start), ev);
        },
        computeDayRange: function(range) {
            var startDay = range.start.clone().stripTime();
            var end = range.end;
            var endDay = null;
            var endTimeMS;
            if (end) {
                endDay = end.clone().stripTime();
                endTimeMS = +end.time();
                if (endTimeMS && endTimeMS >= this.nextDayThreshold) {
                    endDay.add(1, 'days');
                }
            }
            if (!end || endDay <= startDay) {
                endDay = startDay.clone().add(1, 'days');
            }
            return {
                start: startDay,
                end: endDay
            };
        },
        isMultiDayEvent: function(event) {
            var range = this.computeDayRange(event);
            return range.end.diff(range.start, 'days') > 1;
        }
    });
    View.watch('displayingDates', ['dateProfile'], function(deps) {
        this.requestDateRender(deps.dateProfile);
    }, function() {
        this.requestDateUnrender();
    });
    View.watch('initialEvents', ['dateProfile'], function(deps) {
        return this.fetchInitialEvents(deps.dateProfile);
    });
    View.watch('bindingEvents', ['initialEvents'], function(deps) {
        this.setEvents(deps.initialEvents);
        this.bindEventChanges();
    }, function() {
        this.unbindEventChanges();
        this.unsetEvents();
    });
    View.watch('displayingEvents', ['displayingDates', 'hasEvents'], function() {
        this.requestEventsRender(this.get('currentEvents'));
    }, function() {
        this.requestEventsUnrender();
    });;;
    View.mixin({
        currentRange: null,
        currentRangeUnit: null,
        renderRange: null,
        activeRange: null,
        validRange: null,
        dateIncrement: null,
        minTime: null,
        maxTime: null,
        usesMinMaxTime: false,
        start: null,
        end: null,
        intervalStart: null,
        intervalEnd: null,
        setDateProfileForRendering: function(dateProfile) {
            this.currentRange = dateProfile.currentRange;
            this.currentRangeUnit = dateProfile.currentRangeUnit;
            this.renderRange = dateProfile.renderRange;
            this.activeRange = dateProfile.activeRange;
            this.validRange = dateProfile.validRange;
            this.dateIncrement = dateProfile.dateIncrement;
            this.minTime = dateProfile.minTime;
            this.maxTime = dateProfile.maxTime;
            this.start = dateProfile.activeRange.start;
            this.end = dateProfile.activeRange.end;
            this.intervalStart = dateProfile.currentRange.start;
            this.intervalEnd = dateProfile.currentRange.end;
        },
        buildPrevDateProfile: function(date) {
            var prevDate = date.clone().startOf(this.currentRangeUnit).subtract(this.dateIncrement);
            return this.buildDateProfile(prevDate, -1);
        },
        buildNextDateProfile: function(date) {
            var nextDate = date.clone().startOf(this.currentRangeUnit).add(this.dateIncrement);
            return this.buildDateProfile(nextDate, 1);
        },
        buildDateProfile: function(date, direction, forceToValid) {
            var validRange = this.buildValidRange();
            var minTime = null;
            var maxTime = null;
            var currentInfo;
            var renderRange;
            var activeRange;
            var isValid;
            if (forceToValid) {
                date = constrainDate(date, validRange);
            }
            currentInfo = this.buildCurrentRangeInfo(date, direction);
            renderRange = this.buildRenderRange(currentInfo.range, currentInfo.unit);
            activeRange = cloneRange(renderRange);
            if (!this.opt('showNonCurrentDates')) {
                activeRange = constrainRange(activeRange, currentInfo.range);
            }
            minTime = moment.duration(this.opt('minTime'));
            maxTime = moment.duration(this.opt('maxTime'));
            this.adjustActiveRange(activeRange, minTime, maxTime);
            activeRange = constrainRange(activeRange, validRange);
            date = constrainDate(date, activeRange);
            isValid = doRangesIntersect(currentInfo.range, validRange);
            return {
                validRange: validRange,
                currentRange: currentInfo.range,
                currentRangeUnit: currentInfo.unit,
                activeRange: activeRange,
                renderRange: renderRange,
                minTime: minTime,
                maxTime: maxTime,
                isValid: isValid,
                date: date,
                dateIncrement: this.buildDateIncrement(currentInfo.duration)
            };
        },
        buildValidRange: function() {
            return this.getRangeOption('validRange', this.calendar.getNow()) || {};
        },
        buildCurrentRangeInfo: function(date, direction) {
            var duration = null;
            var unit = null;
            var range = null;
            var dayCount;
            if (this.viewSpec.duration) {
                duration = this.viewSpec.duration;
                unit = this.viewSpec.durationUnit;
                range = this.buildRangeFromDuration(date, direction, duration, unit);
            } else if ((dayCount = this.opt('dayCount'))) {
                unit = 'day';
                range = this.buildRangeFromDayCount(date, direction, dayCount);
            } else if ((range = this.buildCustomVisibleRange(date))) {
                unit = computeGreatestUnit(range.start, range.end);
            } else {
                duration = this.getFallbackDuration();
                unit = computeGreatestUnit(duration);
                range = this.buildRangeFromDuration(date, direction, duration, unit);
            }
            this.normalizeCurrentRange(range, unit);
            return {
                duration: duration,
                unit: unit,
                range: range
            };
        },
        getFallbackDuration: function() {
            return moment.duration({
                days: 1
            });
        },
        normalizeCurrentRange: function(range, unit) {
            if (/^(year|month|week|day)$/.test(unit)) {
                range.start.stripTime();
                range.end.stripTime();
            } else {
                if (!range.start.hasTime()) {
                    range.start.time(0);
                }
                if (!range.end.hasTime()) {
                    range.end.time(0);
                }
            }
        },
        adjustActiveRange: function(range, minTime, maxTime) {
            var hasSpecialTimes = false;
            if (this.usesMinMaxTime) {
                if (minTime < 0) {
                    range.start.time(0).add(minTime);
                    hasSpecialTimes = true;
                }
                if (maxTime > 24 * 60 * 60 * 1000) {
                    range.end.time(maxTime - (24 * 60 * 60 * 1000));
                    hasSpecialTimes = true;
                }
                if (hasSpecialTimes) {
                    if (!range.start.hasTime()) {
                        range.start.time(0);
                    }
                    if (!range.end.hasTime()) {
                        range.end.time(0);
                    }
                }
            }
        },
        buildRangeFromDuration: function(date, direction, duration, unit) {
            var alignment = this.opt('dateAlignment');
            var start = date.clone();
            var end;
            var dateIncrementInput;
            var dateIncrementDuration;
            if (duration.as('days') <= 1) {
                if (this.isHiddenDay(start)) {
                    start = this.skipHiddenDays(start, direction);
                    start.startOf('day');
                }
            }
            if (!alignment) {
                dateIncrementInput = this.opt('dateIncrement');
                if (dateIncrementInput) {
                    dateIncrementDuration = moment.duration(dateIncrementInput);
                    if (dateIncrementDuration < duration) {
                        alignment = computeDurationGreatestUnit(dateIncrementDuration, dateIncrementInput);
                    } else {
                        alignment = unit;
                    }
                } else {
                    alignment = unit;
                }
            }
            start.startOf(alignment);
            end = start.clone().add(duration);
            return {
                start: start,
                end: end
            };
        },
        buildRangeFromDayCount: function(date, direction, dayCount) {
            var customAlignment = this.opt('dateAlignment');
            var runningCount = 0;
            var start = date.clone();
            var end;
            if (customAlignment) {
                start.startOf(customAlignment);
            }
            start.startOf('day');
            start = this.skipHiddenDays(start, direction);
            end = start.clone();
            do {
                end.add(1, 'day');
                if (!this.isHiddenDay(end)) {
                    runningCount++;
                }
            } while (runningCount < dayCount);
            return {
                start: start,
                end: end
            };
        },
        buildCustomVisibleRange: function(date) {
            var visibleRange = this.getRangeOption('visibleRange', this.calendar.moment(date));
            if (visibleRange && (!visibleRange.start || !visibleRange.end)) {
                return null;
            }
            return visibleRange;
        },
        buildRenderRange: function(currentRange, currentRangeUnit) {
            return this.trimHiddenDays(currentRange);
        },
        buildDateIncrement: function(fallback) {
            var dateIncrementInput = this.opt('dateIncrement');
            var customAlignment;
            if (dateIncrementInput) {
                return moment.duration(dateIncrementInput);
            } else if ((customAlignment = this.opt('dateAlignment'))) {
                return moment.duration(1, customAlignment);
            } else if (fallback) {
                return fallback;
            } else {
                return moment.duration({
                    days: 1
                });
            }
        },
        trimHiddenDays: function(inputRange) {
            return {
                start: this.skipHiddenDays(inputRange.start),
                end: this.skipHiddenDays(inputRange.end, -1, true)
            };
        },
        currentRangeAs: function(unit) {
            var currentRange = this.currentRange;
            return currentRange.end.diff(currentRange.start, unit, true);
        },
        getRangeOption: function(name) {
            var val = this.opt(name);
            if (typeof val === 'function') {
                val = val.apply(null, Array.prototype.slice.call(arguments, 1));
            }
            if (val) {
                return this.calendar.parseRange(val);
            }
        },
        initHiddenDays: function() {
            var hiddenDays = this.opt('hiddenDays') || [];
            var isHiddenDayHash = [];
            var dayCnt = 0;
            var i;
            if (this.opt('weekends') === false) {
                hiddenDays.push(0, 6);
            }
            for (i = 0; i < 7; i++) {
                if (!(isHiddenDayHash[i] = $.inArray(i, hiddenDays) !== -1)) {
                    dayCnt++;
                }
            }
            if (!dayCnt) {
                throw 'invalid hiddenDays';
            }
            this.isHiddenDayHash = isHiddenDayHash;
        },
        isHiddenDay: function(day) {
            if (moment.isMoment(day)) {
                day = day.day();
            }
            return this.isHiddenDayHash[day];
        },
        skipHiddenDays: function(date, inc, isExclusive) {
            var out = date.clone();
            inc = inc || 1;
            while (this.isHiddenDayHash[(out.day() + (isExclusive ? inc : 0) + 7) % 7]) {
                out.add(inc, 'days');
            }
            return out;
        }
    });;;
    var Scroller = FC.Scroller = Class.extend({
        el: null,
        scrollEl: null,
        overflowX: null,
        overflowY: null,
        constructor: function(options) {
            options = options || {};
            this.overflowX = options.overflowX || options.overflow || 'auto';
            this.overflowY = options.overflowY || options.overflow || 'auto';
        },
        render: function() {
            this.el = this.renderEl();
            this.applyOverflow();
        },
        renderEl: function() {
            return (this.scrollEl = $('<div class="fc-scroller"></div>'));
        },
        clear: function() {
            this.setHeight('auto');
            this.applyOverflow();
        },
        destroy: function() {
            this.el.remove();
        },
        applyOverflow: function() {
            this.scrollEl.css({
                'overflow-x': this.overflowX,
                'overflow-y': this.overflowY
            });
        },
        lockOverflow: function(scrollbarWidths) {
            var overflowX = this.overflowX;
            var overflowY = this.overflowY;
            scrollbarWidths = scrollbarWidths || this.getScrollbarWidths();
            if (overflowX === 'auto') {
                overflowX = (scrollbarWidths.top || scrollbarWidths.bottom || this.scrollEl[0].scrollWidth - 1 > this.scrollEl[0].clientWidth) ? 'scroll' : 'hidden';
            }
            if (overflowY === 'auto') {
                overflowY = (scrollbarWidths.left || scrollbarWidths.right || this.scrollEl[0].scrollHeight - 1 > this.scrollEl[0].clientHeight) ? 'scroll' : 'hidden';
            }
            this.scrollEl.css({
                'overflow-x': overflowX,
                'overflow-y': overflowY
            });
        },
        setHeight: function(height) {
            this.scrollEl.height(height);
        },
        getScrollTop: function() {
            return this.scrollEl.scrollTop();
        },
        setScrollTop: function(top) {
            this.scrollEl.scrollTop(top);
        },
        getClientWidth: function() {
            return this.scrollEl[0].clientWidth;
        },
        getClientHeight: function() {
            return this.scrollEl[0].clientHeight;
        },
        getScrollbarWidths: function() {
            return getScrollbarWidths(this.scrollEl);
        }
    });;;
    function Iterator(items) {
        this.items = items || [];
    }
    Iterator.prototype.proxyCall = function(methodName) {
        var args = Array.prototype.slice.call(arguments, 1);
        var results = [];
        this.items.forEach(function(item) {
            results.push(item[methodName].apply(item, args));
        });
        return results;
    };;;
    function Toolbar(calendar, toolbarOptions) {
        var t = this;
        t.setToolbarOptions = setToolbarOptions;
        t.render = render;
        t.removeElement = removeElement;
        t.updateTitle = updateTitle;
        t.activateButton = activateButton;
        t.deactivateButton = deactivateButton;
        t.disableButton = disableButton;
        t.enableButton = enableButton;
        t.getViewsWithButtons = getViewsWithButtons;
        t.el = null;
        var el;
        var viewsWithButtons = [];
        var tm;
        function setToolbarOptions(newToolbarOptions) {
            toolbarOptions = newToolbarOptions;
        }
        function render() {
            var sections = toolbarOptions.layout;
            tm = calendar.opt('theme') ? 'ui' : 'fc';
            if (sections) {
                if (!el) {
                    el = this.el = $("<div class='fc-toolbar " + toolbarOptions.extraClasses + "'/>");
                } else {
                    el.empty();
                }
                el.append(renderSection('left')).append(renderSection('right')).append(renderSection('center')).append('<div class="fc-clear"/>');
            } else {
                removeElement();
            }
        }
        function removeElement() {
            if (el) {
                el.remove();
                el = t.el = null;
            }
        }
        function renderSection(position) {
            var sectionEl = $('<div class="fc-' + position + '"/>');
            var buttonStr = toolbarOptions.layout[position];
            var calendarCustomButtons = calendar.opt('customButtons') || {};
            var calendarButtonText = calendar.opt('buttonText') || {};
            if (buttonStr) {
                $.each(buttonStr.split(' '), function(i) {
                    var groupChildren = $();
                    var isOnlyButtons = true;
                    var groupEl;
                    $.each(this.split(','), function(j, buttonName) {
                        var customButtonProps;
                        var viewSpec;
                        var buttonClick;
                        var overrideText;
                        var defaultText;
                        var themeIcon;
                        var normalIcon;
                        var innerHtml;
                        var classes;
                        var button;
                        if (buttonName == 'title') {
                            groupChildren = groupChildren.add($('<h2>&nbsp;</h2>'));
                            isOnlyButtons = false;
                        } else {
                            if ((customButtonProps = calendarCustomButtons[buttonName])) {
                                buttonClick = function(ev) {
                                    if (customButtonProps.click) {
                                        customButtonProps.click.call(button[0], ev);
                                    }
                                };
                                overrideText = '';
                                defaultText = customButtonProps.text;
                            } else if ((viewSpec = calendar.getViewSpec(buttonName))) {
                                buttonClick = function() {
                                    calendar.changeView(buttonName);
                                };
                                viewsWithButtons.push(buttonName);
                                overrideText = viewSpec.buttonTextOverride;
                                defaultText = viewSpec.buttonTextDefault;
                            } else if (calendar[buttonName]) {
                                buttonClick = function() {
                                    calendar[buttonName]();
                                };
                                overrideText = (calendar.overrides.buttonText || {})[buttonName];
                                defaultText = calendarButtonText[buttonName];
                            }
                            if (buttonClick) {
                                themeIcon = customButtonProps ? customButtonProps.themeIcon : calendar.opt('themeButtonIcons')[buttonName];
                                normalIcon = customButtonProps ? customButtonProps.icon : calendar.opt('buttonIcons')[buttonName];
                                if (overrideText) {
                                    innerHtml = htmlEscape(overrideText);
                                } else if (themeIcon && calendar.opt('theme')) {
                                    innerHtml = "<span class='ui-icon ui-icon-" + themeIcon + "'></span>";
                                } else if (normalIcon && !calendar.opt('theme')) {
                                    innerHtml = "<span class='fc-icon fc-icon-" + normalIcon + "'></span>";
                                } else {
                                    innerHtml = htmlEscape(defaultText);
                                }
                                classes = ['fc-' + buttonName + '-button', tm + '-button', tm + '-state-default'];
                                button = $('<button type="button" class="' + classes.join(' ') + '">' + innerHtml + '</button>').click(function(ev) {
                                    if (!button.hasClass(tm + '-state-disabled')) {
                                        buttonClick(ev);
                                        if (button.hasClass(tm + '-state-active') || button.hasClass(tm + '-state-disabled')) {
                                            button.removeClass(tm + '-state-hover');
                                        }
                                    }
                                }).mousedown(function() {
                                    button.not('.' + tm + '-state-active').not('.' + tm + '-state-disabled').addClass(tm + '-state-down');
                                }).mouseup(function() {
                                    button.removeClass(tm + '-state-down');
                                }).hover(function() {
                                    button.not('.' + tm + '-state-active').not('.' + tm + '-state-disabled').addClass(tm + '-state-hover');
                                }, function() {
                                    button.removeClass(tm + '-state-hover').removeClass(tm + '-state-down');
                                });
                                groupChildren = groupChildren.add(button);
                            }
                        }
                    });
                    if (isOnlyButtons) {
                        groupChildren.first().addClass(tm + '-corner-left').end().last().addClass(tm + '-corner-right').end();
                    }
                    if (groupChildren.length > 1) {
                        groupEl = $('<div/>');
                        if (isOnlyButtons) {
                            groupEl.addClass('fc-button-group');
                        }
                        groupEl.append(groupChildren);
                        sectionEl.append(groupEl);
                    } else {
                        sectionEl.append(groupChildren);
                    }
                });
            }
            return sectionEl;
        }
        function updateTitle(text) {
            if (el) {
                el.find('h2').text(text);
            }
        }
        function activateButton(buttonName) {
            if (el) {
                el.find('.fc-' + buttonName + '-button').addClass(tm + '-state-active');
            }
        }
        function deactivateButton(buttonName) {
            if (el) {
                el.find('.fc-' + buttonName + '-button').removeClass(tm + '-state-active');
            }
        }
        function disableButton(buttonName) {
            if (el) {
                el.find('.fc-' + buttonName + '-button').prop('disabled', true).addClass(tm + '-state-disabled');
            }
        }
        function enableButton(buttonName) {
            if (el) {
                el.find('.fc-' + buttonName + '-button').prop('disabled', false).removeClass(tm + '-state-disabled');
            }
        }
        function getViewsWithButtons() {
            return viewsWithButtons;
        }
    };;
    var Calendar = FC.Calendar = Class.extend(EmitterMixin, {
        view: null,
        viewsByType: null,
        currentDate: null,
        loadingLevel: 0,
        constructor: function(el, overrides) {
            GlobalEmitter.needed();
            this.el = el;
            this.viewsByType = {};
            this.viewSpecCache = {};
            this.initOptionsInternals(overrides);
            this.initMomentInternals();
            this.initCurrentDate();
            EventManager.call(this);
            this.initialize();
        },
        initialize: function() {},
        getCalendar: function() {
            return this;
        },
        getView: function() {
            return this.view;
        },
        publiclyTrigger: function(name, thisObj) {
            var args = Array.prototype.slice.call(arguments, 2);
            var optHandler = this.opt(name);
            thisObj = thisObj || this.el[0];
            this.triggerWith(name, thisObj, args);
            if (optHandler) {
                return optHandler.apply(thisObj, args);
            }
        },
        instantiateView: function(viewType) {
            var spec = this.getViewSpec(viewType);
            return new spec['class'](this, spec);
        },
        isValidViewType: function(viewType) {
            return Boolean(this.getViewSpec(viewType));
        },
        changeView: function(viewName, dateOrRange) {
            if (dateOrRange) {
                if (dateOrRange.start && dateOrRange.end) {
                    this.recordOptionOverrides({
                        visibleRange: dateOrRange
                    });
                } else {
                    this.currentDate = this.moment(dateOrRange).stripZone();
                }
            }
            this.renderView(viewName);
        },
        zoomTo: function(newDate, viewType) {
            var spec;
            viewType = viewType || 'day';
            spec = this.getViewSpec(viewType) || this.getUnitViewSpec(viewType);
            this.currentDate = newDate.clone();
            this.renderView(spec ? spec.type : null);
        },
        initCurrentDate: function() {
            var defaultDateInput = this.opt('defaultDate');
            if (defaultDateInput != null) {
                this.currentDate = this.moment(defaultDateInput).stripZone();
            } else {
                this.currentDate = this.getNow();
            }
        },
        prev: function() {
            var prevInfo = this.view.buildPrevDateProfile(this.currentDate);
            if (prevInfo.isValid) {
                this.currentDate = prevInfo.date;
                this.renderView();
            }
        },
        next: function() {
            var nextInfo = this.view.buildNextDateProfile(this.currentDate);
            if (nextInfo.isValid) {
                this.currentDate = nextInfo.date;
                this.renderView();
            }
        },
        prevYear: function() {
            this.currentDate.add(-1, 'years');
            this.renderView();
        },
        nextYear: function() {
            this.currentDate.add(1, 'years');
            this.renderView();
        },
        today: function() {
            this.currentDate = this.getNow();
            this.renderView();
        },
        gotoDate: function(zonedDateInput) {
            this.currentDate = this.moment(zonedDateInput).stripZone();
            this.renderView();
        },
        incrementDate: function(delta) {
            this.currentDate.add(moment.duration(delta));
            this.renderView();
        },
        getDate: function() {
            return this.applyTimezone(this.currentDate);
        },
        pushLoading: function() {
            if (!(this.loadingLevel++)) {
                this.publiclyTrigger('loading', null, true, this.view);
            }
        },
        popLoading: function() {
            if (!(--this.loadingLevel)) {
                this.publiclyTrigger('loading', null, false, this.view);
            }
        },
        select: function(zonedStartInput, zonedEndInput) {
            this.view.select(this.buildSelectSpan.apply(this, arguments));
        },
        unselect: function() {
            if (this.view) {
                this.view.unselect();
            }
        },
        buildSelectSpan: function(zonedStartInput, zonedEndInput) {
            var start = this.moment(zonedStartInput).stripZone();
            var end;
            if (zonedEndInput) {
                end = this.moment(zonedEndInput).stripZone();
            } else if (start.hasTime()) {
                end = start.clone().add(this.defaultTimedEventDuration);
            } else {
                end = start.clone().add(this.defaultAllDayEventDuration);
            }
            return {
                start: start,
                end: end
            };
        },
        parseRange: function(rangeInput) {
            var start = null;
            var end = null;
            if (rangeInput.start) {
                start = this.moment(rangeInput.start).stripZone();
            }
            if (rangeInput.end) {
                end = this.moment(rangeInput.end).stripZone();
            }
            if (!start && !end) {
                return null;
            }
            if (start && end && end.isBefore(start)) {
                return null;
            }
            return {
                start: start,
                end: end
            };
        },
        rerenderEvents: function() {
            if (this.elementVisible()) {
                this.reportEventChange();
            }
        }
    });;;
    Calendar.mixin({
        dirDefaults: null,
        localeDefaults: null,
        overrides: null,
        dynamicOverrides: null,
        optionsModel: null,
        initOptionsInternals: function(overrides) {
            this.overrides = $.extend({}, overrides);
            this.dynamicOverrides = {};
            this.optionsModel = new Model();
            this.populateOptionsHash();
        },
        option: function(name, value) {
            var newOptionHash;
            if (typeof name === 'string') {
                if (value === undefined) {
                    return this.optionsModel.get(name);
                } else {
                    newOptionHash = {};
                    newOptionHash[name] = value;
                    this.setOptions(newOptionHash);
                }
            } else if (typeof name === 'object') {
                this.setOptions(name);
            }
        },
        opt: function(name) {
            return this.optionsModel.get(name);
        },
        setOptions: function(newOptionHash) {
            var optionCnt = 0;
            var optionName;
            this.recordOptionOverrides(newOptionHash);
            for (optionName in newOptionHash) {
                optionCnt++;
            }
            if (optionCnt === 1) {
                if (optionName === 'height' || optionName === 'contentHeight' || optionName === 'aspectRatio') {
                    this.updateSize(true);
                    return;
                } else if (optionName === 'defaultDate') {
                    return;
                } else if (optionName === 'businessHours') {
                    if (this.view) {
                        this.view.unrenderBusinessHours();
                        this.view.renderBusinessHours();
                    }
                    return;
                } else if (optionName === 'timezone') {
                    this.rezoneArrayEventSources();
                    this.refetchEvents();
                    return;
                }
            }
            this.renderHeader();
            this.renderFooter();
            this.viewsByType = {};
            this.reinitView();
        },
        populateOptionsHash: function() {
            var locale, localeDefaults;
            var isRTL, dirDefaults;
            var rawOptions;
            locale = firstDefined(this.dynamicOverrides.locale, this.overrides.locale);
            localeDefaults = localeOptionHash[locale];
            if (!localeDefaults) {
                locale = Calendar.defaults.locale;
                localeDefaults = localeOptionHash[locale] || {};
            }
            isRTL = firstDefined(this.dynamicOverrides.isRTL, this.overrides.isRTL, localeDefaults.isRTL, Calendar.defaults.isRTL);
            dirDefaults = isRTL ? Calendar.rtlDefaults : {};
            this.dirDefaults = dirDefaults;
            this.localeDefaults = localeDefaults;
            rawOptions = mergeOptions([Calendar.defaults, dirDefaults, localeDefaults, this.overrides, this.dynamicOverrides]);
            populateInstanceComputableOptions(rawOptions);
            this.optionsModel.reset(rawOptions);
        },
        recordOptionOverrides: function(newOptionHash) {
            var optionName;
            for (optionName in newOptionHash) {
                this.dynamicOverrides[optionName] = newOptionHash[optionName];
            }
            this.viewSpecCache = {};
            this.populateOptionsHash();
        }
    });;;
    Calendar.mixin({
        defaultAllDayEventDuration: null,
        defaultTimedEventDuration: null,
        localeData: null,
        initMomentInternals: function() {
            var _this = this;
            this.defaultAllDayEventDuration = moment.duration(this.opt('defaultAllDayEventDuration'));
            this.defaultTimedEventDuration = moment.duration(this.opt('defaultTimedEventDuration'));
            this.optionsModel.watch('buildingMomentLocale', ['?locale', '?monthNames', '?monthNamesShort', '?dayNames', '?dayNamesShort', '?firstDay', '?weekNumberCalculation'], function(opts) {
                var weekNumberCalculation = opts.weekNumberCalculation;
                var firstDay = opts.firstDay;
                var _week;
                if (weekNumberCalculation === 'iso') {
                    weekNumberCalculation = 'ISO';
                }
                var localeData = createObject(getMomentLocaleData(opts.locale));
                if (opts.monthNames) {
                    localeData._months = opts.monthNames;
                }
                if (opts.monthNamesShort) {
                    localeData._monthsShort = opts.monthNamesShort;
                }
                if (opts.dayNames) {
                    localeData._weekdays = opts.dayNames;
                }
                if (opts.dayNamesShort) {
                    localeData._weekdaysShort = opts.dayNamesShort;
                }
                if (firstDay == null && weekNumberCalculation === 'ISO') {
                    firstDay = 1;
                }
                if (firstDay != null) {
                    _week = createObject(localeData._week);
                    _week.dow = firstDay;
                    localeData._week = _week;
                }
                if (weekNumberCalculation === 'ISO' || weekNumberCalculation === 'local' || typeof weekNumberCalculation === 'function') {
                    localeData._fullCalendar_weekCalc = weekNumberCalculation;
                }
                _this.localeData = localeData;
                if (_this.currentDate) {
                    _this.localizeMoment(_this.currentDate);
                }
            });
        },
        moment: function() {
            var mom;
            if (this.opt('timezone') === 'local') {
                mom = FC.moment.apply(null, arguments);
                if (mom.hasTime()) {
                    mom.local();
                }
            } else if (this.opt('timezone') === 'UTC') {
                mom = FC.moment.utc.apply(null, arguments);
            } else {
                mom = FC.moment.parseZone.apply(null, arguments);
            }
            this.localizeMoment(mom);
            return mom;
        },
        localizeMoment: function(mom) {
            mom._locale = this.localeData;
        },
        getIsAmbigTimezone: function() {
            return this.opt('timezone') !== 'local' && this.opt('timezone') !== 'UTC';
        },
        applyTimezone: function(date) {
            if (!date.hasTime()) {
                return date.clone();
            }
            var zonedDate = this.moment(date.toArray());
            var timeAdjust = date.time() - zonedDate.time();
            var adjustedZonedDate;
            if (timeAdjust) {
                adjustedZonedDate = zonedDate.clone().add(timeAdjust);
                if (date.time() - adjustedZonedDate.time() === 0) {
                    zonedDate = adjustedZonedDate;
                }
            }
            return zonedDate;
        },
        getNow: function() {
            var now = this.opt('now');
            if (typeof now === 'function') {
                now = now();
            }
            return this.moment(now).stripZone();
        },
        humanizeDuration: function(duration) {
            return duration.locale(this.opt('locale')).humanize();
        },
        getEventEnd: function(event) {
            if (event.end) {
                return event.end.clone();
            } else {
                return this.getDefaultEventEnd(event.allDay, event.start);
            }
        },
        getDefaultEventEnd: function(allDay, zonedStart) {
            var end = zonedStart.clone();
            if (allDay) {
                end.stripTime().add(this.defaultAllDayEventDuration);
            } else {
                end.add(this.defaultTimedEventDuration);
            }
            if (this.getIsAmbigTimezone()) {
                end.stripZone();
            }
            return end;
        }
    });;;
    Calendar.mixin({
        viewSpecCache: null,
        getViewSpec: function(viewType) {
            var cache = this.viewSpecCache;
            return cache[viewType] || (cache[viewType] = this.buildViewSpec(viewType));
        },
        getUnitViewSpec: function(unit) {
            var viewTypes;
            var i;
            var spec;
            if ($.inArray(unit, unitsDesc) != -1) {
                viewTypes = this.header.getViewsWithButtons();
                $.each(FC.views, function(viewType) {
                    viewTypes.push(viewType);
                });
                for (i = 0; i < viewTypes.length; i++) {
                    spec = this.getViewSpec(viewTypes[i]);
                    if (spec) {
                        if (spec.singleUnit == unit) {
                            return spec;
                        }
                    }
                }
            }
        },
        buildViewSpec: function(requestedViewType) {
            var viewOverrides = this.overrides.views || {};
            var specChain = [];
            var defaultsChain = [];
            var overridesChain = [];
            var viewType = requestedViewType;
            var spec;
            var overrides;
            var durationInput;
            var duration;
            var unit;
            while (viewType) {
                spec = fcViews[viewType];
                overrides = viewOverrides[viewType];
                viewType = null;
                if (typeof spec === 'function') {
                    spec = {
                        'class': spec
                    };
                }
                if (spec) {
                    specChain.unshift(spec);
                    defaultsChain.unshift(spec.defaults || {});
                    durationInput = durationInput || spec.duration;
                    viewType = viewType || spec.type;
                }
                if (overrides) {
                    overridesChain.unshift(overrides);
                    durationInput = durationInput || overrides.duration;
                    viewType = viewType || overrides.type;
                }
            }
            spec = mergeProps(specChain);
            spec.type = requestedViewType;
            if (!spec['class']) {
                return false;
            }
            durationInput = durationInput || this.dynamicOverrides.duration || this.overrides.duration;
            if (durationInput) {
                duration = moment.duration(durationInput);
                if (duration.valueOf()) {
                    unit = computeDurationGreatestUnit(duration, durationInput);
                    spec.duration = duration;
                    spec.durationUnit = unit;
                    if (duration.as(unit) === 1) {
                        spec.singleUnit = unit;
                        overridesChain.unshift(viewOverrides[unit] || {});
                    }
                }
            }
            spec.defaults = mergeOptions(defaultsChain);
            spec.overrides = mergeOptions(overridesChain);
            this.buildViewSpecOptions(spec);
            this.buildViewSpecButtonText(spec, requestedViewType);
            return spec;
        },
        buildViewSpecOptions: function(spec) {
            spec.options = mergeOptions([Calendar.defaults, spec.defaults, this.dirDefaults, this.localeDefaults, this.overrides, spec.overrides, this.dynamicOverrides]);
            populateInstanceComputableOptions(spec.options);
        },
        buildViewSpecButtonText: function(spec, requestedViewType) {
            function queryButtonText(options) {
                var buttonText = options.buttonText || {};
                return buttonText[requestedViewType] || (spec.buttonTextKey ? buttonText[spec.buttonTextKey] : null) || (spec.singleUnit ? buttonText[spec.singleUnit] : null);
            }
            spec.buttonTextOverride = queryButtonText(this.dynamicOverrides) || queryButtonText(this.overrides) || spec.overrides.buttonText;
            spec.buttonTextDefault = queryButtonText(this.localeDefaults) || queryButtonText(this.dirDefaults) || spec.defaults.buttonText || queryButtonText(Calendar.defaults) || (spec.duration ? this.humanizeDuration(spec.duration) : null) || requestedViewType;
        }
    });;;
    Calendar.mixin({
        el: null,
        contentEl: null,
        suggestedViewHeight: null,
        windowResizeProxy: null,
        ignoreWindowResize: 0,
        render: function() {
            if (!this.contentEl) {
                this.initialRender();
            } else if (this.elementVisible()) {
                this.calcSize();
                this.renderView();
            }
        },
        initialRender: function() {
            var _this = this;
            var el = this.el;
            el.addClass('fc');
            el.on('click.fc', 'a[data-goto]', function(ev) {
                var anchorEl = $(this);
                var gotoOptions = anchorEl.data('goto');
                var date = _this.moment(gotoOptions.date);
                var viewType = gotoOptions.type;
                var customAction = _this.view.opt('navLink' + capitaliseFirstLetter(viewType) + 'Click');
                if (typeof customAction === 'function') {
                    customAction(date, ev);
                } else {
                    if (typeof customAction === 'string') {
                        viewType = customAction;
                    }
                    _this.zoomTo(date, viewType);
                }
            });
            this.optionsModel.watch('applyingThemeClasses', ['?theme'], function(opts) {
                el.toggleClass('ui-widget', opts.theme);
                el.toggleClass('fc-unthemed', !opts.theme);
            });
            this.optionsModel.watch('applyingDirClasses', ['?isRTL', '?locale'], function(opts) {
                el.toggleClass('fc-ltr', !opts.isRTL);
                el.toggleClass('fc-rtl', opts.isRTL);
            });
            this.contentEl = $("<div class='fc-view-container'/>").prependTo(el);
            this.initToolbars();
            this.renderHeader();
            this.renderFooter();
            this.renderView(this.opt('defaultView'));
            if (this.opt('handleWindowResize')) {
                $(window).resize(this.windowResizeProxy = debounce(this.windowResize.bind(this), this.opt('windowResizeDelay')));
            }
        },
        destroy: function() {
            if (this.view) {
                this.view.removeElement();
            }
            this.toolbarsManager.proxyCall('removeElement');
            this.contentEl.remove();
            this.el.removeClass('fc fc-ltr fc-rtl fc-unthemed ui-widget');
            this.el.off('.fc');
            if (this.windowResizeProxy) {
                $(window).unbind('resize', this.windowResizeProxy);
                this.windowResizeProxy = null;
            }
            GlobalEmitter.unneeded();
        },
        elementVisible: function() {
            return this.el.is(':visible');
        },
        renderView: function(viewType, forcedScroll) {
            this.ignoreWindowResize++;
            var needsClearView = this.view && viewType && this.view.type !== viewType;
            if (needsClearView) {
                this.freezeContentHeight();
                this.clearView();
            }
            if (!this.view && viewType) {
                this.view = this.viewsByType[viewType] || (this.viewsByType[viewType] = this.instantiateView(viewType));
                this.view.setElement($("<div class='fc-view fc-" + viewType + "-view' />").appendTo(this.contentEl));
                this.toolbarsManager.proxyCall('activateButton', viewType);
            }
            if (this.view) {
                if (forcedScroll) {
                    this.view.addForcedScroll(forcedScroll);
                }
                if (this.elementVisible()) {
                    this.currentDate = this.view.setDate(this.currentDate);
                }
            }
            if (needsClearView) {
                this.thawContentHeight();
            }
            this.ignoreWindowResize--;
        },
        clearView: function() {
            this.toolbarsManager.proxyCall('deactivateButton', this.view.type);
            this.view.removeElement();
            this.view = null;
        },
        reinitView: function() {
            this.ignoreWindowResize++;
            this.freezeContentHeight();
            var viewType = this.view.type;
            var scrollState = this.view.queryScroll();
            this.clearView();
            this.calcSize();
            this.renderView(viewType, scrollState);
            this.thawContentHeight();
            this.ignoreWindowResize--;
        },
        getSuggestedViewHeight: function() {
            if (this.suggestedViewHeight === null) {
                this.calcSize();
            }
            return this.suggestedViewHeight;
        },
        isHeightAuto: function() {
            return this.opt('contentHeight') === 'auto' || this.opt('height') === 'auto';
        },
        updateSize: function(shouldRecalc) {
            if (this.elementVisible()) {
                if (shouldRecalc) {
                    this._calcSize();
                }
                this.ignoreWindowResize++;
                this.view.updateSize(true);
                this.ignoreWindowResize--;
                return true;
            }
        },
        calcSize: function() {
            if (this.elementVisible()) {
                this._calcSize();
            }
        },
        _calcSize: function() {
            var contentHeightInput = this.opt('contentHeight');
            var heightInput = this.opt('height');
            if (typeof contentHeightInput === 'number') {
                this.suggestedViewHeight = contentHeightInput;
            } else if (typeof contentHeightInput === 'function') {
                this.suggestedViewHeight = contentHeightInput();
            } else if (typeof heightInput === 'number') {
                this.suggestedViewHeight = heightInput - this.queryToolbarsHeight();
            } else if (typeof heightInput === 'function') {
                this.suggestedViewHeight = heightInput() - this.queryToolbarsHeight();
            } else if (heightInput === 'parent') {
                this.suggestedViewHeight = this.el.parent().height() - this.queryToolbarsHeight();
            } else {
                this.suggestedViewHeight = Math.round(this.contentEl.width() / Math.max(this.opt('aspectRatio'), .5));
            }
        },
        windowResize: function(ev) {
            if (!this.ignoreWindowResize && ev.target === window && this.view.renderRange) {
                if (this.updateSize(true)) {
                    this.view.publiclyTrigger('windowResize', this.el[0]);
                }
            }
        },
        freezeContentHeight: function() {
            this.contentEl.css({
                width: '100%',
                height: this.contentEl.height(),
                overflow: 'hidden'
            });
        },
        thawContentHeight: function() {
            this.contentEl.css({
                width: '',
                height: '',
                overflow: ''
            });
        }
    });;;
    Calendar.mixin({
        header: null,
        footer: null,
        toolbarsManager: null,
        initToolbars: function() {
            this.header = new Toolbar(this, this.computeHeaderOptions());
            this.footer = new Toolbar(this, this.computeFooterOptions());
            this.toolbarsManager = new Iterator([this.header, this.footer]);
        },
        computeHeaderOptions: function() {
            return {
                extraClasses: 'fc-header-toolbar',
                layout: this.opt('header')
            };
        },
        computeFooterOptions: function() {
            return {
                extraClasses: 'fc-footer-toolbar',
                layout: this.opt('footer')
            };
        },
        renderHeader: function() {
            var header = this.header;
            header.setToolbarOptions(this.computeHeaderOptions());
            header.render();
            if (header.el) {
                this.el.prepend(header.el);
            }
        },
        renderFooter: function() {
            var footer = this.footer;
            footer.setToolbarOptions(this.computeFooterOptions());
            footer.render();
            if (footer.el) {
                this.el.append(footer.el);
            }
        },
        setToolbarsTitle: function(title) {
            this.toolbarsManager.proxyCall('updateTitle', title);
        },
        updateToolbarButtons: function() {
            var now = this.getNow();
            var view = this.view;
            var todayInfo = view.buildDateProfile(now);
            var prevInfo = view.buildPrevDateProfile(this.currentDate);
            var nextInfo = view.buildNextDateProfile(this.currentDate);
            this.toolbarsManager.proxyCall((todayInfo.isValid && !isDateWithinRange(now, view.currentRange)) ? 'enableButton' : 'disableButton', 'today');
            this.toolbarsManager.proxyCall(prevInfo.isValid ? 'enableButton' : 'disableButton', 'prev');
            this.toolbarsManager.proxyCall(nextInfo.isValid ? 'enableButton' : 'disableButton', 'next');
        },
        queryToolbarsHeight: function() {
            return this.toolbarsManager.items.reduce(function(accumulator, toolbar) {
                var toolbarHeight = toolbar.el ? toolbar.el.outerHeight(true) : 0;
                return accumulator + toolbarHeight;
            }, 0);
        }
    });;;
    Calendar.defaults = {
        titleRangeSeparator: ' \u2013 ',
        monthYearFormat: 'MMMM YYYY',
        defaultTimedEventDuration: '02:00:00',
        defaultAllDayEventDuration: {
            days: 1
        },
        forceEventDuration: false,
        nextDayThreshold: '09:00:00',
        defaultView: 'month',
        aspectRatio: 1.35,
        header: {
            left: 'title',
            center: '',
            right: 'today prev,next'
        },
        weekends: true,
        weekNumbers: false,
        weekNumberTitle: 'W',
        weekNumberCalculation: 'local',
        scrollTime: '06:00:00',
        minTime: '00:00:00',
        maxTime: '24:00:00',
        showNonCurrentDates: true,
        lazyFetching: true,
        startParam: 'start',
        endParam: 'end',
        timezoneParam: 'timezone',
        timezone: false,
        isRTL: false,
        buttonText: {
            prev: "prev",
            next: "next",
            prevYear: "prev year",
            nextYear: "next year",
            year: 'year',
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },
        buttonIcons: {
            prev: 'left-single-arrow',
            next: 'right-single-arrow',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow'
        },
        allDayText: 'all-day',
        theme: false,
        themeButtonIcons: {
            prev: 'circle-triangle-w',
            next: 'circle-triangle-e',
            prevYear: 'seek-prev',
            nextYear: 'seek-next'
        },
        dragOpacity: .75,
        dragRevertDuration: 500,
        dragScroll: true,
        unselectAuto: true,
        dropAccept: '*',
        eventOrder: 'title',
        eventLimit: false,
        eventLimitText: 'more',
        eventLimitClick: 'popover',
        dayPopoverFormat: 'LL',
        handleWindowResize: true,
        windowResizeDelay: 100,
        longPressDelay: 1000
    };
    Calendar.englishDefaults = {
        dayPopoverFormat: 'dddd, MMMM D'
    };
    Calendar.rtlDefaults = {
        header: {
            left: 'next,prev today',
            center: '',
            right: 'title'
        },
        buttonIcons: {
            prev: 'right-single-arrow',
            next: 'left-single-arrow',
            prevYear: 'right-double-arrow',
            nextYear: 'left-double-arrow'
        },
        themeButtonIcons: {
            prev: 'circle-triangle-e',
            next: 'circle-triangle-w',
            nextYear: 'seek-prev',
            prevYear: 'seek-next'
        }
    };;;
    var localeOptionHash = FC.locales = {};
    FC.datepickerLocale = function(localeCode, dpLocaleCode, dpOptions) {
        var fcOptions = localeOptionHash[localeCode] || (localeOptionHash[localeCode] = {});
        fcOptions.isRTL = dpOptions.isRTL;
        fcOptions.weekNumberTitle = dpOptions.weekHeader;
        $.each(dpComputableOptions, function(name, func) {
            fcOptions[name] = func(dpOptions);
        });
        if ($.datepicker) {
            $.datepicker.regional[dpLocaleCode] = $.datepicker.regional[localeCode] = dpOptions;
            $.datepicker.regional.en = $.datepicker.regional[''];
            $.datepicker.setDefaults(dpOptions);
        }
    };
    FC.locale = function(localeCode, newFcOptions) {
        var fcOptions;
        var momOptions;
        fcOptions = localeOptionHash[localeCode] || (localeOptionHash[localeCode] = {});
        if (newFcOptions) {
            fcOptions = localeOptionHash[localeCode] = mergeOptions([fcOptions, newFcOptions]);
        }
        momOptions = getMomentLocaleData(localeCode);
        $.each(momComputableOptions, function(name, func) {
            if (fcOptions[name] == null) {
                fcOptions[name] = func(momOptions, fcOptions);
            }
        });
        Calendar.defaults.locale = localeCode;
    };
    var dpComputableOptions = {
        buttonText: function(dpOptions) {
            return {
                prev: stripHtmlEntities(dpOptions.prevText),
                next: stripHtmlEntities(dpOptions.nextText),
                today: stripHtmlEntities(dpOptions.currentText)
            };
        },
        monthYearFormat: function(dpOptions) {
            return dpOptions.showMonthAfterYear ? 'YYYY[' + dpOptions.yearSuffix + '] MMMM' : 'MMMM YYYY[' + dpOptions.yearSuffix + ']';
        }
    };
    var momComputableOptions = {
        dayOfMonthFormat: function(momOptions, fcOptions) {
            var format = momOptions.longDateFormat('l');
            format = format.replace(/^Y+[^\w\s]*|[^\w\s]*Y+$/g, '');
            if (fcOptions.isRTL) {
                format += ' ddd';
            } else {
                format = 'ddd ' + format;
            }
            return format;
        },
        mediumTimeFormat: function(momOptions) {
            return momOptions.longDateFormat('LT').replace(/\s*a$/i, 'a');
        },
        smallTimeFormat: function(momOptions) {
            return momOptions.longDateFormat('LT').replace(':mm', '(:mm)').replace(/(\Wmm)$/, '($1)').replace(/\s*a$/i, 'a');
        },
        extraSmallTimeFormat: function(momOptions) {
            return momOptions.longDateFormat('LT').replace(':mm', '(:mm)').replace(/(\Wmm)$/, '($1)').replace(/\s*a$/i, 't');
        },
        hourFormat: function(momOptions) {
            return momOptions.longDateFormat('LT').replace(':mm', '').replace(/(\Wmm)$/, '').replace(/\s*a$/i, 'a');
        },
        noMeridiemTimeFormat: function(momOptions) {
            return momOptions.longDateFormat('LT').replace(/\s*a$/i, '');
        }
    };
    var instanceComputableOptions = {
        smallDayDateFormat: function(options) {
            return options.isRTL ? 'D dd' : 'dd D';
        },
        weekFormat: function(options) {
            return options.isRTL ? 'w[ ' + options.weekNumberTitle + ']' : '[' + options.weekNumberTitle + ' ]w';
        },
        smallWeekFormat: function(options) {
            return options.isRTL ? 'w[' + options.weekNumberTitle + ']' : '[' + options.weekNumberTitle + ']w';
        }
    };
    function populateInstanceComputableOptions(options) {
        $.each(instanceComputableOptions, function(name, func) {
            if (options[name] == null) {
                options[name] = func(options);
            }
        });
    }
    function getMomentLocaleData(localeCode) {
        return moment.localeData(localeCode) || moment.localeData('en');
    }
    FC.locale('en', Calendar.englishDefaults);;;
    FC.sourceNormalizers = [];
    FC.sourceFetchers = [];
    var ajaxDefaults = {
        dataType: 'json',
        cache: false
    };
    var eventGUID = 1;
    function EventManager() {
        var t = this;
        t.requestEvents = requestEvents;
        t.reportEventChange = reportEventChange;
        t.isFetchNeeded = isFetchNeeded;
        t.fetchEvents = fetchEvents;
        t.fetchEventSources = fetchEventSources;
        t.refetchEvents = refetchEvents;
        t.refetchEventSources = refetchEventSources;
        t.getEventSources = getEventSources;
        t.getEventSourceById = getEventSourceById;
        t.addEventSource = addEventSource;
        t.removeEventSource = removeEventSource;
        t.removeEventSources = removeEventSources;
        t.updateEvent = updateEvent;
        t.updateEvents = updateEvents;
        t.renderEvent = renderEvent;
        t.renderEvents = renderEvents;
        t.removeEvents = removeEvents;
        t.clientEvents = clientEvents;
        t.mutateEvent = mutateEvent;
        t.normalizeEventDates = normalizeEventDates;
        t.normalizeEventTimes = normalizeEventTimes;
        var stickySource = {
            events: []
        };
        var sources = [stickySource];
        var rangeStart, rangeEnd;
        var pendingSourceCnt = 0;
        var cache = [];
        var prunedCache;
        $.each((t.opt('events') ? [t.opt('events')] : []).concat(t.opt('eventSources') || []), function(i, sourceInput) {
            var source = buildEventSource(sourceInput);
            if (source) {
                sources.push(source);
            }
        });
        function requestEvents(start, end) {
            if (!t.opt('lazyFetching') || isFetchNeeded(start, end)) {
                return fetchEvents(start, end);
            } else {
                return Promise.resolve(prunedCache);
            }
        }
        function reportEventChange() {
            prunedCache = filterEventsWithinRange(cache);
            t.trigger('eventsReset', prunedCache);
        }
        function filterEventsWithinRange(events) {
            var filteredEvents = [];
            var i, event;
            for (i = 0; i < events.length; i++) {
                event = events[i];
                if (event.start.clone().stripZone() < rangeEnd && t.getEventEnd(event).stripZone() > rangeStart) {
                    filteredEvents.push(event);
                }
            }
            return filteredEvents;
        }
        t.getEventCache = function() {
            return cache;
        };
        function isFetchNeeded(start, end) {
            return !rangeStart || start < rangeStart || end > rangeEnd;
        }
        function fetchEvents(start, end) {
            rangeStart = start;
            rangeEnd = end;
            return refetchEvents();
        }
        function refetchEvents() {
            return fetchEventSources(sources, 'reset');
        }
        function refetchEventSources(matchInputs) {
            return fetchEventSources(getEventSourcesByMatchArray(matchInputs));
        }
        function fetchEventSources(specificSources, specialFetchType) {
            var i, source;
            if (specialFetchType === 'reset') {
                cache = [];
            } else if (specialFetchType !== 'add') {
                cache = excludeEventsBySources(cache, specificSources);
            }
            for (i = 0; i < specificSources.length; i++) {
                source = specificSources[i];
                if (source._status !== 'pending') {
                    pendingSourceCnt++;
                }
                source._fetchId = (source._fetchId || 0) + 1;
                source._status = 'pending';
            }
            for (i = 0; i < specificSources.length; i++) {
                source = specificSources[i];
                tryFetchEventSource(source, source._fetchId);
            }
            if (pendingSourceCnt) {
                return Promise.construct(function(resolve) {
                    t.one('eventsReceived', resolve);
                });
            } else {
                return Promise.resolve(prunedCache);
            }
        }
        function tryFetchEventSource(source, fetchId) {
            _fetchEventSource(source, function(eventInputs) {
                var isArraySource = $.isArray(source.events);
                var i, eventInput;
                var abstractEvent;
                if (fetchId === source._fetchId && source._status !== 'rejected') {
                    source._status = 'resolved';
                    if (eventInputs) {
                        for (i = 0; i < eventInputs.length; i++) {
                            eventInput = eventInputs[i];
                            if (isArraySource) {
                                abstractEvent = eventInput;
                            } else {
                                abstractEvent = buildEventFromInput(eventInput, source);
                            }
                            if (abstractEvent) {
                                cache.push.apply(cache, expandEvent(abstractEvent));
                            }
                        }
                    }
                    decrementPendingSourceCnt();
                }
            });
        }
        function rejectEventSource(source) {
            var wasPending = source._status === 'pending';
            source._status = 'rejected';
            if (wasPending) {
                decrementPendingSourceCnt();
            }
        }
        function decrementPendingSourceCnt() {
            pendingSourceCnt--;
            if (!pendingSourceCnt) {
                reportEventChange(cache);
                t.trigger('eventsReceived', prunedCache);
            }
        }
        function _fetchEventSource(source, callback) {
            var i;
            var fetchers = FC.sourceFetchers;
            var res;
            for (i = 0; i < fetchers.length; i++) {
                res = fetchers[i].call(t, source, rangeStart.clone(), rangeEnd.clone(), t.opt('timezone'), callback);
                if (res === true) {
                    return;
                } else if (typeof res == 'object') {
                    _fetchEventSource(res, callback);
                    return;
                }
            }
            var events = source.events;
            if (events) {
                if ($.isFunction(events)) {
                    t.pushLoading();
                    events.call(t, rangeStart.clone(), rangeEnd.clone(), t.opt('timezone'), function(events) {
                        callback(events);
                        t.popLoading();
                    });
                } else if ($.isArray(events)) {
                    callback(events);
                } else {
                    callback();
                }
            } else {
                var url = source.url;
                if (url) {
                    var success = source.success;
                    var error = source.error;
                    var complete = source.complete;
                    var customData;
                    if ($.isFunction(source.data)) {
                        customData = source.data();
                    } else {
                        customData = source.data;
                    }
                    var data = $.extend({}, customData || {});
                    var startParam = firstDefined(source.startParam, t.opt('startParam'));
                    var endParam = firstDefined(source.endParam, t.opt('endParam'));
                    var timezoneParam = firstDefined(source.timezoneParam, t.opt('timezoneParam'));
                    if (startParam) {
                        data[startParam] = rangeStart.format();
                    }
                    if (endParam) {
                        data[endParam] = rangeEnd.format();
                    }
                    if (t.opt('timezone') && t.opt('timezone') != 'local') {
                        data[timezoneParam] = t.opt('timezone');
                    }
                    t.pushLoading();
                    $.ajax($.extend({}, ajaxDefaults, source, {
                        data: data,
                        success: function(events) {
                            events = events || [];
                            var res = applyAll(success, this, arguments);
                            if ($.isArray(res)) {
                                events = res;
                            }
                            callback(events);
                        },
                        error: function() {
                            applyAll(error, this, arguments);
                            callback();
                        },
                        complete: function() {
                            applyAll(complete, this, arguments);
                            t.popLoading();
                        }
                    }));
                } else {
                    callback();
                }
            }
        }
        function addEventSource(sourceInput) {
            var source = buildEventSource(sourceInput);
            if (source) {
                sources.push(source);
                fetchEventSources([source], 'add');
            }
        }
        function buildEventSource(sourceInput) {
            var normalizers = FC.sourceNormalizers;
            var source;
            var i;
            if ($.isFunction(sourceInput) || $.isArray(sourceInput)) {
                source = {
                    events: sourceInput
                };
            } else if (typeof sourceInput === 'string') {
                source = {
                    url: sourceInput
                };
            } else if (typeof sourceInput === 'object') {
                source = $.extend({}, sourceInput);
            }
            if (source) {
                if (source.className) {
                    if (typeof source.className === 'string') {
                        source.className = source.className.split(/\s+/);
                    }
                } else {
                    source.className = [];
                }
                if ($.isArray(source.events)) {
                    source.origArray = source.events;
                    source.events = $.map(source.events, function(eventInput) {
                        return buildEventFromInput(eventInput, source);
                    });
                }
                for (i = 0; i < normalizers.length; i++) {
                    normalizers[i].call(t, source);
                }
                return source;
            }
        }
        function removeEventSource(matchInput) {
            removeSpecificEventSources(getEventSourcesByMatch(matchInput));
        }
        function removeEventSources(matchInputs) {
            if (matchInputs == null) {
                removeSpecificEventSources(sources, true);
            } else {
                removeSpecificEventSources(getEventSourcesByMatchArray(matchInputs));
            }
        }
        function removeSpecificEventSources(targetSources, isAll) {
            var i;
            for (i = 0; i < targetSources.length; i++) {
                rejectEventSource(targetSources[i]);
            }
            if (isAll) {
                sources = [];
                cache = [];
            } else {
                sources = $.grep(sources, function(source) {
                    for (i = 0; i < targetSources.length; i++) {
                        if (source === targetSources[i]) {
                            return false;
                        }
                    }
                    return true;
                });
                cache = excludeEventsBySources(cache, targetSources);
            }
            reportEventChange();
        }
        function getEventSources() {
            return sources.slice(1);
        }
        function getEventSourceById(id) {
            return $.grep(sources, function(source) {
                return source.id && source.id === id;
            })[0];
        }
        function getEventSourcesByMatchArray(matchInputs) {
            if (!matchInputs) {
                matchInputs = [];
            } else if (!$.isArray(matchInputs)) {
                matchInputs = [matchInputs];
            }
            var matchingSources = [];
            var i;
            for (i = 0; i < matchInputs.length; i++) {
                matchingSources.push.apply(matchingSources, getEventSourcesByMatch(matchInputs[i]));
            }
            return matchingSources;
        }
        function getEventSourcesByMatch(matchInput) {
            var i, source;
            for (i = 0; i < sources.length; i++) {
                source = sources[i];
                if (source === matchInput) {
                    return [source];
                }
            }
            source = getEventSourceById(matchInput);
            if (source) {
                return [source];
            }
            return $.grep(sources, function(source) {
                return isSourcesEquivalent(matchInput, source);
            });
        }
        function isSourcesEquivalent(source1, source2) {
            return source1 && source2 && getSourcePrimitive(source1) == getSourcePrimitive(source2);
        }
        function getSourcePrimitive(source) {
            return ((typeof source === 'object') ? (source.origArray || source.googleCalendarId || source.url || source.events) : null) || source;
        }
        function excludeEventsBySources(specificEvents, specificSources) {
            return $.grep(specificEvents, function(event) {
                for (var i = 0; i < specificSources.length; i++) {
                    if (event.source === specificSources[i]) {
                        return false;
                    }
                }
                return true;
            });
        }
        function updateEvent(event) {
            updateEvents([event]);
        }
        function updateEvents(events) {
            var i, event;
            for (i = 0; i < events.length; i++) {
                event = events[i];
                event.start = t.moment(event.start);
                if (event.end) {
                    event.end = t.moment(event.end);
                } else {
                    event.end = null;
                }
                mutateEvent(event, getMiscEventProps(event));
            }
            reportEventChange();
        }
        function getMiscEventProps(event) {
            var props = {};
            $.each(event, function(name, val) {
                if (isMiscEventPropName(name)) {
                    if (val !== undefined && isAtomic(val)) {
                        props[name] = val;
                    }
                }
            });
            return props;
        }
        function isMiscEventPropName(name) {
            return !/^_|^(id|allDay|start|end)$/.test(name);
        }
        function renderEvent(eventInput, stick) {
            return renderEvents([eventInput], stick);
        }
        function renderEvents(eventInputs, stick) {
            var renderedEvents = [];
            var renderableEvents;
            var abstractEvent;
            var i, j, event;
            for (i = 0; i < eventInputs.length; i++) {
                abstractEvent = buildEventFromInput(eventInputs[i]);
                if (abstractEvent) {
                    renderableEvents = expandEvent(abstractEvent);
                    for (j = 0; j < renderableEvents.length; j++) {
                        event = renderableEvents[j];
                        if (!event.source) {
                            if (stick) {
                                stickySource.events.push(event);
                                event.source = stickySource;
                            }
                            cache.push(event);
                        }
                    }
                    renderedEvents = renderedEvents.concat(renderableEvents);
                }
            }
            if (renderedEvents.length) {
                reportEventChange();
            }
            return renderedEvents;
        }
        function removeEvents(filter) {
            var eventID;
            var i;
            if (filter == null) {
                filter = function() {
                    return true;
                };
            } else if (!$.isFunction(filter)) {
                eventID = filter + '';
                filter = function(event) {
                    return event._id == eventID;
                };
            }
            cache = $.grep(cache, filter, true);
            for (i = 0; i < sources.length; i++) {
                if ($.isArray(sources[i].events)) {
                    sources[i].events = $.grep(sources[i].events, filter, true);
                }
            }
            reportEventChange();
        }
        function clientEvents(filter) {
            if ($.isFunction(filter)) {
                return $.grep(cache, filter);
            } else if (filter != null) {
                filter += '';
                return $.grep(cache, function(e) {
                    return e._id == filter;
                });
            }
            return cache;
        }
        t.rezoneArrayEventSources = function() {
            var i;
            var events;
            var j;
            for (i = 0; i < sources.length; i++) {
                events = sources[i].events;
                if ($.isArray(events)) {
                    for (j = 0; j < events.length; j++) {
                        rezoneEventDates(events[j]);
                    }
                }
            }
        };
        function rezoneEventDates(event) {
            event.start = t.moment(event.start);
            if (event.end) {
                event.end = t.moment(event.end);
            }
            backupEventDates(event);
        }
        function buildEventFromInput(input, source) {
            var calendarEventDataTransform = t.opt('eventDataTransform');
            var out = {};
            var start, end;
            var allDay;
            if (calendarEventDataTransform) {
                input = calendarEventDataTransform(input);
            }
            if (source && source.eventDataTransform) {
                input = source.eventDataTransform(input);
            }
            $.extend(out, input);
            if (source) {
                out.source = source;
            }
            out._id = input._id || (input.id === undefined ? '_fc' + eventGUID++ : input.id + '');
            if (input.className) {
                if (typeof input.className == 'string') {
                    out.className = input.className.split(/\s+/);
                } else {
                    out.className = input.className;
                }
            } else {
                out.className = [];
            }
            start = input.start || input.date;
            end = input.end;
            if (isTimeString(start)) {
                start = moment.duration(start);
            }
            if (isTimeString(end)) {
                end = moment.duration(end);
            }
            if (input.dow || moment.isDuration(start) || moment.isDuration(end)) {
                out.start = start ? moment.duration(start) : null;
                out.end = end ? moment.duration(end) : null;
                out._recurring = true;
            } else {
                if (start) {
                    start = t.moment(start);
                    if (!start.isValid()) {
                        return false;
                    }
                }
                if (end) {
                    end = t.moment(end);
                    if (!end.isValid()) {
                        end = null;
                    }
                }
                allDay = input.allDay;
                if (allDay === undefined) {
                    allDay = firstDefined(source ? source.allDayDefault : undefined, t.opt('allDayDefault'));
                }
                assignDatesToEvent(start, end, allDay, out);
            }
            t.normalizeEvent(out);
            return out;
        }
        t.buildEventFromInput = buildEventFromInput;
        function assignDatesToEvent(start, end, allDay, event) {
            event.start = start;
            event.end = end;
            event.allDay = allDay;
            normalizeEventDates(event);
            backupEventDates(event);
        }
        function normalizeEventDates(eventProps) {
            normalizeEventTimes(eventProps);
            if (eventProps.end && !eventProps.end.isAfter(eventProps.start)) {
                eventProps.end = null;
            }
            if (!eventProps.end) {
                if (t.opt('forceEventDuration')) {
                    eventProps.end = t.getDefaultEventEnd(eventProps.allDay, eventProps.start);
                } else {
                    eventProps.end = null;
                }
            }
        }
        function normalizeEventTimes(eventProps) {
            if (eventProps.allDay == null) {
                eventProps.allDay = !(eventProps.start.hasTime() || (eventProps.end && eventProps.end.hasTime()));
            }
            if (eventProps.allDay) {
                eventProps.start.stripTime();
                if (eventProps.end) {
                    eventProps.end.stripTime();
                }
            } else {
                if (!eventProps.start.hasTime()) {
                    eventProps.start = t.applyTimezone(eventProps.start.time(0));
                }
                if (eventProps.end && !eventProps.end.hasTime()) {
                    eventProps.end = t.applyTimezone(eventProps.end.time(0));
                }
            }
        }
        function expandEvent(abstractEvent, _rangeStart, _rangeEnd) {
            var events = [];
            var dowHash;
            var dow;
            var i;
            var date;
            var startTime, endTime;
            var start, end;
            var event;
            _rangeStart = _rangeStart || rangeStart;
            _rangeEnd = _rangeEnd || rangeEnd;
            if (abstractEvent) {
                if (abstractEvent._recurring) {
                    if ((dow = abstractEvent.dow)) {
                        dowHash = {};
                        for (i = 0; i < dow.length; i++) {
                            dowHash[dow[i]] = true;
                        }
                    }
                    date = _rangeStart.clone().stripTime();
                    while (date.isBefore(_rangeEnd)) {
                        if (!dowHash || dowHash[date.day()]) {
                            startTime = abstractEvent.start;
                            endTime = abstractEvent.end;
                            start = date.clone();
                            end = null;
                            if (startTime) {
                                start = start.time(startTime);
                            }
                            if (endTime) {
                                end = date.clone().time(endTime);
                            }
                            event = $.extend({}, abstractEvent);
                            assignDatesToEvent(start, end, !startTime && !endTime, event);
                            events.push(event);
                        }
                        date.add(1, 'days');
                    }
                } else {
                    events.push(abstractEvent);
                }
            }
            return events;
        }
        t.expandEvent = expandEvent;
        function mutateEvent(event, newProps, largeUnit) {
            var miscProps = {};
            var oldProps;
            var clearEnd;
            var startDelta;
            var endDelta;
            var durationDelta;
            var undoFunc;
            function diffDates(date1, date0) {
                if (largeUnit) {
                    return diffByUnit(date1, date0, largeUnit);
                } else if (newProps.allDay) {
                    return diffDay(date1, date0);
                } else {
                    return diffDayTime(date1, date0);
                }
            }
            newProps = newProps || {};
            if (!newProps.start) {
                newProps.start = event.start.clone();
            }
            if (newProps.end === undefined) {
                newProps.end = event.end ? event.end.clone() : null;
            }
            if (newProps.allDay == null) {
                newProps.allDay = event.allDay;
            }
            normalizeEventDates(newProps);
            oldProps = {
                start: event._start.clone(),
                end: event._end ? event._end.clone() : t.getDefaultEventEnd(event._allDay, event._start),
                allDay: newProps.allDay
            };
            normalizeEventDates(oldProps);
            clearEnd = event._end !== null && newProps.end === null;
            startDelta = diffDates(newProps.start, oldProps.start);
            if (newProps.end) {
                endDelta = diffDates(newProps.end, oldProps.end);
                durationDelta = endDelta.subtract(startDelta);
            } else {
                durationDelta = null;
            }
            $.each(newProps, function(name, val) {
                if (isMiscEventPropName(name)) {
                    if (val !== undefined) {
                        miscProps[name] = val;
                    }
                }
            });
            undoFunc = mutateEvents(clientEvents(event._id), clearEnd, newProps.allDay, startDelta, durationDelta, miscProps);
            return {
                dateDelta: startDelta,
                durationDelta: durationDelta,
                undo: undoFunc
            };
        }
        function mutateEvents(events, clearEnd, allDay, dateDelta, durationDelta, miscProps) {
            var isAmbigTimezone = t.getIsAmbigTimezone();
            var undoFunctions = [];
            if (dateDelta && !dateDelta.valueOf()) {
                dateDelta = null;
            }
            if (durationDelta && !durationDelta.valueOf()) {
                durationDelta = null;
            }
            $.each(events, function(i, event) {
                var oldProps;
                var newProps;
                oldProps = {
                    start: event.start.clone(),
                    end: event.end ? event.end.clone() : null,
                    allDay: event.allDay
                };
                $.each(miscProps, function(name) {
                    oldProps[name] = event[name];
                });
                newProps = {
                    start: event._start,
                    end: event._end,
                    allDay: allDay
                };
                normalizeEventDates(newProps);
                if (clearEnd) {
                    newProps.end = null;
                } else if (durationDelta && !newProps.end) {
                    newProps.end = t.getDefaultEventEnd(newProps.allDay, newProps.start);
                }
                if (dateDelta) {
                    newProps.start.add(dateDelta);
                    if (newProps.end) {
                        newProps.end.add(dateDelta);
                    }
                }
                if (durationDelta) {
                    newProps.end.add(durationDelta);
                }
                if (isAmbigTimezone && !newProps.allDay && (dateDelta || durationDelta)) {
                    newProps.start.stripZone();
                    if (newProps.end) {
                        newProps.end.stripZone();
                    }
                }
                $.extend(event, miscProps, newProps);
                backupEventDates(event);
                undoFunctions.push(function() {
                    $.extend(event, oldProps);
                    backupEventDates(event);
                });
            });
            return function() {
                for (var i = 0; i < undoFunctions.length; i++) {
                    undoFunctions[i]();
                }
            };
        }
    }
    Calendar.prototype.mutateSeg = function(seg, newProps) {
        return this.mutateEvent(seg.event, newProps);
    };
    Calendar.prototype.normalizeEvent = function(event) {};
    Calendar.prototype.spanContainsSpan = function(outerSpan, innerSpan) {
        var eventStart = outerSpan.start.clone().stripZone();
        var eventEnd = this.getEventEnd(outerSpan).stripZone();
        return innerSpan.start >= eventStart && innerSpan.end <= eventEnd;
    };
    Calendar.prototype.getPeerEvents = function(span, event) {
        var cache = this.getEventCache();
        var peerEvents = [];
        var i, otherEvent;
        for (i = 0; i < cache.length; i++) {
            otherEvent = cache[i];
            if (!event || event._id !== otherEvent._id) {
                peerEvents.push(otherEvent);
            }
        }
        return peerEvents;
    };
    function backupEventDates(event) {
        event._allDay = event.allDay;
        event._start = event.start.clone();
        event._end = event.end ? event.end.clone() : null;
    }
    Calendar.prototype.isEventSpanAllowed = function(span, event) {
        var source = event.source || {};
        var eventAllowFunc = this.opt('eventAllow');
        var constraint = firstDefined(event.constraint, source.constraint, this.opt('eventConstraint'));
        var overlap = firstDefined(event.overlap, source.overlap, this.opt('eventOverlap'));
        return this.isSpanAllowed(span, constraint, overlap, event) && (!eventAllowFunc || eventAllowFunc(span, event) !== false);
    };
    Calendar.prototype.isExternalSpanAllowed = function(eventSpan, eventLocation, eventProps) {
        var eventInput;
        var event;
        if (eventProps) {
            eventInput = $.extend({}, eventProps, eventLocation);
            event = this.expandEvent(this.buildEventFromInput(eventInput))[0];
        }
        if (event) {
            return this.isEventSpanAllowed(eventSpan, event);
        } else {
            return this.isSelectionSpanAllowed(eventSpan);
        }
    };
    Calendar.prototype.isSelectionSpanAllowed = function(span) {
        var selectAllowFunc = this.opt('selectAllow');
        return this.isSpanAllowed(span, this.opt('selectConstraint'), this.opt('selectOverlap')) && (!selectAllowFunc || selectAllowFunc(span) !== false);
    };
    Calendar.prototype.isSpanAllowed = function(span, constraint, overlap, event) {
        var constraintEvents;
        var anyContainment;
        var peerEvents;
        var i, peerEvent;
        var peerOverlap;
        if (constraint != null) {
            constraintEvents = this.constraintToEvents(constraint);
            if (constraintEvents) {
                anyContainment = false;
                for (i = 0; i < constraintEvents.length; i++) {
                    if (this.spanContainsSpan(constraintEvents[i], span)) {
                        anyContainment = true;
                        break;
                    }
                }
                if (!anyContainment) {
                    return false;
                }
            }
        }
        peerEvents = this.getPeerEvents(span, event);
        for (i = 0; i < peerEvents.length; i++) {
            peerEvent = peerEvents[i];
            if (this.eventIntersectsRange(peerEvent, span)) {
                if (overlap === false) {
                    return false;
                } else if (typeof overlap === 'function' && !overlap(peerEvent, event)) {
                    return false;
                }
                if (event) {
                    peerOverlap = firstDefined(peerEvent.overlap, (peerEvent.source || {}).overlap);
                    if (peerOverlap === false) {
                        return false;
                    }
                    if (typeof peerOverlap === 'function' && !peerOverlap(event, peerEvent)) {
                        return false;
                    }
                }
            }
        }
        return true;
    };
    Calendar.prototype.constraintToEvents = function(constraintInput) {
        if (constraintInput === 'businessHours') {
            return this.getCurrentBusinessHourEvents();
        }
        if (typeof constraintInput === 'object') {
            if (constraintInput.start != null) {
                return this.expandEvent(this.buildEventFromInput(constraintInput));
            } else {
                return null;
            }
        }
        return this.clientEvents(constraintInput);
    };
    Calendar.prototype.eventIntersectsRange = function(event, range) {
        var eventStart = event.start.clone().stripZone();
        var eventEnd = this.getEventEnd(event).stripZone();
        return range.start < eventEnd && range.end > eventStart;
    };
    var BUSINESS_HOUR_EVENT_DEFAULTS = {
        id: '_fcBusinessHours',
        start: '09:00',
        end: '17:00',
        dow: [1, 2, 3, 4, 5],
        rendering: 'inverse-background'
    };
    Calendar.prototype.getCurrentBusinessHourEvents = function(wholeDay) {
        return this.computeBusinessHourEvents(wholeDay, this.opt('businessHours'));
    };
    Calendar.prototype.computeBusinessHourEvents = function(wholeDay, input) {
        if (input === true) {
            return this.expandBusinessHourEvents(wholeDay, [{}]);
        } else if ($.isPlainObject(input)) {
            return this.expandBusinessHourEvents(wholeDay, [input]);
        } else if ($.isArray(input)) {
            return this.expandBusinessHourEvents(wholeDay, input, true);
        } else {
            return [];
        }
    };
    Calendar.prototype.expandBusinessHourEvents = function(wholeDay, inputs, ignoreNoDow) {
        var view = this.getView();
        var events = [];
        var i, input;
        for (i = 0; i < inputs.length; i++) {
            input = inputs[i];
            if (ignoreNoDow && !input.dow) {
                continue;
            }
            input = $.extend({}, BUSINESS_HOUR_EVENT_DEFAULTS, input);
            if (wholeDay) {
                input.start = null;
                input.end = null;
            }
            events.push.apply(events, this.expandEvent(this.buildEventFromInput(input), view.activeRange.start, view.activeRange.end));
        }
        return events;
    };;;
    var BasicView = FC.BasicView = View.extend({
        scroller: null,
        dayGridClass: DayGrid,
        dayGrid: null,
        dayNumbersVisible: false,
        colWeekNumbersVisible: false,
        cellWeekNumbersVisible: false,
        weekNumberWidth: null,
        headContainerEl: null,
        headRowEl: null,
        initialize: function() {
            this.dayGrid = this.instantiateDayGrid();
            this.scroller = new Scroller({
                overflowX: 'hidden',
                overflowY: 'auto'
            });
        },
        instantiateDayGrid: function() {
            var subclass = this.dayGridClass.extend(basicDayGridMethods);
            return new subclass(this);
        },
        buildRenderRange: function(currentRange, currentRangeUnit) {
            var renderRange = View.prototype.buildRenderRange.apply(this, arguments);
            if (/^(year|month)$/.test(currentRangeUnit)) {
                renderRange.start.startOf('week');
                if (renderRange.end.weekday()) {
                    renderRange.end.add(1, 'week').startOf('week');
                }
            }
            return this.trimHiddenDays(renderRange);
        },
        renderDates: function() {
            this.dayGrid.breakOnWeeks = /year|month|week/.test(this.currentRangeUnit);
            this.dayGrid.setRange(this.renderRange);
            this.dayNumbersVisible = this.dayGrid.rowCnt > 1;
            if (this.opt('weekNumbers')) {
                if (this.opt('weekNumbersWithinDays')) {
                    this.cellWeekNumbersVisible = true;
                    this.colWeekNumbersVisible = false;
                } else {
                    this.cellWeekNumbersVisible = false;
                    this.colWeekNumbersVisible = true;
                };
            }
            this.dayGrid.numbersVisible = this.dayNumbersVisible || this.cellWeekNumbersVisible || this.colWeekNumbersVisible;
            this.el.addClass('fc-basic-view').html(this.renderSkeletonHtml());
            this.renderHead();
            this.scroller.render();
            var dayGridContainerEl = this.scroller.el.addClass('fc-day-grid-container');
            var dayGridEl = $('<div class="fc-day-grid" />').appendTo(dayGridContainerEl);
            this.el.find('.fc-body > tr > td').append(dayGridContainerEl);
            this.dayGrid.setElement(dayGridEl);
            this.dayGrid.renderDates(this.hasRigidRows());
        },
        renderHead: function() {
            this.headContainerEl = this.el.find('.fc-head-container').html(this.dayGrid.renderHeadHtml());
            this.headRowEl = this.headContainerEl.find('.fc-row');
        },
        unrenderDates: function() {
            this.dayGrid.unrenderDates();
            this.dayGrid.removeElement();
            this.scroller.destroy();
        },
        renderBusinessHours: function() {
            this.dayGrid.renderBusinessHours();
        },
        unrenderBusinessHours: function() {
            this.dayGrid.unrenderBusinessHours();
        },
        renderSkeletonHtml: function() {
            return '' + '<table>' + '<thead class="fc-head">' + '<tr>' + '<td class="fc-head-container ' + this.widgetHeaderClass + '"></td>' + '</tr>' + '</thead>' + '<tbody class="fc-body">' + '<tr>' + '<td class="' + this.widgetContentClass + '"></td>' + '</tr>' + '</tbody>' + '</table>';
        },
        weekNumberStyleAttr: function() {
            if (this.weekNumberWidth !== null) {
                return 'style="width:' + this.weekNumberWidth + 'px"';
            }
            return '';
        },
        hasRigidRows: function() {
            var eventLimit = this.opt('eventLimit');
            return eventLimit && typeof eventLimit !== 'number';
        },
        updateWidth: function() {
            if (this.colWeekNumbersVisible) {
                this.weekNumberWidth = matchCellWidths(this.el.find('.fc-week-number'));
            }
        },
        setHeight: function(totalHeight, isAuto) {
            var eventLimit = this.opt('eventLimit');
            var scrollerHeight;
            var scrollbarWidths;
            this.scroller.clear();
            uncompensateScroll(this.headRowEl);
            this.dayGrid.removeSegPopover();
            if (eventLimit && typeof eventLimit === 'number') {
                this.dayGrid.limitRows(eventLimit);
            }
            scrollerHeight = this.computeScrollerHeight(totalHeight);
            this.setGridHeight(scrollerHeight, isAuto);
            if (eventLimit && typeof eventLimit !== 'number') {
                this.dayGrid.limitRows(eventLimit);
            }
            if (!isAuto) {
                this.scroller.setHeight(scrollerHeight);
                scrollbarWidths = this.scroller.getScrollbarWidths();
                if (scrollbarWidths.left || scrollbarWidths.right) {
                    compensateScroll(this.headRowEl, scrollbarWidths);
                    scrollerHeight = this.computeScrollerHeight(totalHeight);
                    this.scroller.setHeight(scrollerHeight);
                }
                this.scroller.lockOverflow(scrollbarWidths);
            }
        },
        computeScrollerHeight: function(totalHeight) {
            return totalHeight - subtractInnerElHeight(this.el, this.scroller.el);
        },
        setGridHeight: function(height, isAuto) {
            if (isAuto) {
                undistributeHeight(this.dayGrid.rowEls);
            } else {
                distributeHeight(this.dayGrid.rowEls, height, true);
            }
        },
        computeInitialDateScroll: function() {
            return {
                top: 0
            };
        },
        queryDateScroll: function() {
            return {
                top: this.scroller.getScrollTop()
            };
        },
        applyDateScroll: function(scroll) {
            if (scroll.top !== undefined) {
                this.scroller.setScrollTop(scroll.top);
            }
        },
        hitsNeeded: function() {
            this.dayGrid.hitsNeeded();
        },
        hitsNotNeeded: function() {
            this.dayGrid.hitsNotNeeded();
        },
        prepareHits: function() {
            this.dayGrid.prepareHits();
        },
        releaseHits: function() {
            this.dayGrid.releaseHits();
        },
        queryHit: function(left, top) {
            return this.dayGrid.queryHit(left, top);
        },
        getHitSpan: function(hit) {
            return this.dayGrid.getHitSpan(hit);
        },
        getHitEl: function(hit) {
            return this.dayGrid.getHitEl(hit);
        },
        renderEvents: function(events) {
            this.dayGrid.renderEvents(events);
            this.updateHeight();
        },
        getEventSegs: function() {
            return this.dayGrid.getEventSegs();
        },
        unrenderEvents: function() {
            this.dayGrid.unrenderEvents();
        },
        renderDrag: function(dropLocation, seg) {
            return this.dayGrid.renderDrag(dropLocation, seg);
        },
        unrenderDrag: function() {
            this.dayGrid.unrenderDrag();
        },
        renderSelection: function(span) {
            this.dayGrid.renderSelection(span);
        },
        unrenderSelection: function() {
            this.dayGrid.unrenderSelection();
        }
    });
    var basicDayGridMethods = {
        renderHeadIntroHtml: function() {
            var view = this.view;
            if (view.colWeekNumbersVisible) {
                return '' + '<th class="fc-week-number ' + view.widgetHeaderClass + '" ' + view.weekNumberStyleAttr() + '>' + '<span>' + htmlEscape(view.opt('weekNumberTitle')) + '</span>' + '</th>';
            }
            return '';
        },
        renderNumberIntroHtml: function(row) {
            var view = this.view;
            var weekStart = this.getCellDate(row, 0);
            if (view.colWeekNumbersVisible) {
                return '' + '<td class="fc-week-number" ' + view.weekNumberStyleAttr() + '>' + view.buildGotoAnchorHtml({
                    date: weekStart,
                    type: 'week',
                    forceOff: this.colCnt === 1
                }, weekStart.format('w')) + '</td>';
            }
            return '';
        },
        renderBgIntroHtml: function() {
            var view = this.view;
            if (view.colWeekNumbersVisible) {
                return '<td class="fc-week-number ' + view.widgetContentClass + '" ' + view.weekNumberStyleAttr() + '></td>';
            }
            return '';
        },
        renderIntroHtml: function() {
            var view = this.view;
            if (view.colWeekNumbersVisible) {
                return '<td class="fc-week-number" ' + view.weekNumberStyleAttr() + '></td>';
            }
            return '';
        }
    };;;
    var MonthView = FC.MonthView = BasicView.extend({
        buildRenderRange: function() {
            var renderRange = BasicView.prototype.buildRenderRange.apply(this, arguments);
            var rowCnt;
            if (this.isFixedWeeks()) {
                rowCnt = Math.ceil(renderRange.end.diff(renderRange.start, 'weeks', true));
                renderRange.end.add(6 - rowCnt, 'weeks');
            }
            return renderRange;
        },
        setGridHeight: function(height, isAuto) {
            if (isAuto) {
                height *= this.rowCnt / 6;
            }
            distributeHeight(this.dayGrid.rowEls, height, !isAuto);
        },
        isFixedWeeks: function() {
            return this.opt('fixedWeekCount');
        }
    });;;
    fcViews.basic = {
        'class': BasicView
    };
    fcViews.basicDay = {
        type: 'basic',
        duration: {
            days: 1
        }
    };
    fcViews.basicWeek = {
        type: 'basic',
        duration: {
            weeks: 1
        }
    };
    fcViews.month = {
        'class': MonthView,
        duration: {
            months: 1
        },
        defaults: {
            fixedWeekCount: true
        }
    };;;
    var AgendaView = FC.AgendaView = View.extend({
        scroller: null,
        timeGridClass: TimeGrid,
        timeGrid: null,
        dayGridClass: DayGrid,
        dayGrid: null,
        axisWidth: null,
        headContainerEl: null,
        noScrollRowEls: null,
        bottomRuleEl: null,
        usesMinMaxTime: true,
        initialize: function() {
            this.timeGrid = this.instantiateTimeGrid();
            if (this.opt('allDaySlot')) {
                this.dayGrid = this.instantiateDayGrid();
            }
            this.scroller = new Scroller({
                overflowX: 'hidden',
                overflowY: 'auto'
            });
        },
        instantiateTimeGrid: function() {
            var subclass = this.timeGridClass.extend(agendaTimeGridMethods);
            return new subclass(this);
        },
        instantiateDayGrid: function() {
            var subclass = this.dayGridClass.extend(agendaDayGridMethods);
            return new subclass(this);
        },
        renderDates: function() {
            this.timeGrid.setRange(this.renderRange);
            if (this.dayGrid) {
                this.dayGrid.setRange(this.renderRange);
            }
            this.el.addClass('fc-agenda-view').html(this.renderSkeletonHtml());
            this.renderHead();
            this.scroller.render();
            var timeGridWrapEl = this.scroller.el.addClass('fc-time-grid-container');
            var timeGridEl = $('<div class="fc-time-grid" />').appendTo(timeGridWrapEl);
            this.el.find('.fc-body > tr > td').append(timeGridWrapEl);
            this.timeGrid.setElement(timeGridEl);
            this.timeGrid.renderDates();
            this.bottomRuleEl = $('<hr class="fc-divider ' + this.widgetHeaderClass + '"/>').appendTo(this.timeGrid.el);
            if (this.dayGrid) {
                this.dayGrid.setElement(this.el.find('.fc-day-grid'));
                this.dayGrid.renderDates();
                this.dayGrid.bottomCoordPadding = this.dayGrid.el.next('hr').outerHeight();
            }
            this.noScrollRowEls = this.el.find('.fc-row:not(.fc-scroller *)');
        },
        renderHead: function() {
            this.headContainerEl = this.el.find('.fc-head-container').html(this.timeGrid.renderHeadHtml());
        },
        unrenderDates: function() {
            this.timeGrid.unrenderDates();
            this.timeGrid.removeElement();
            if (this.dayGrid) {
                this.dayGrid.unrenderDates();
                this.dayGrid.removeElement();
            }
            this.scroller.destroy();
        },
        renderSkeletonHtml: function() {
            return '' + '<table>' + '<thead class="fc-head">' + '<tr>' + '<td class="fc-head-container ' + this.widgetHeaderClass + '"></td>' + '</tr>' + '</thead>' + '<tbody class="fc-body">' + '<tr>' + '<td class="' + this.widgetContentClass + '">' + (this.dayGrid ? '<div class="fc-day-grid"/>' + '<hr class="fc-divider ' + this.widgetHeaderClass + '"/>' : '') + '</td>' + '</tr>' + '</tbody>' + '</table>';
        },
        axisStyleAttr: function() {
            if (this.axisWidth !== null) {
                return 'style="width:' + this.axisWidth + 'px"';
            }
            return '';
        },
        renderBusinessHours: function() {
            this.timeGrid.renderBusinessHours();
            if (this.dayGrid) {
                this.dayGrid.renderBusinessHours();
            }
        },
        unrenderBusinessHours: function() {
            this.timeGrid.unrenderBusinessHours();
            if (this.dayGrid) {
                this.dayGrid.unrenderBusinessHours();
            }
        },
        getNowIndicatorUnit: function() {
            return this.timeGrid.getNowIndicatorUnit();
        },
        renderNowIndicator: function(date) {
            this.timeGrid.renderNowIndicator(date);
        },
        unrenderNowIndicator: function() {
            this.timeGrid.unrenderNowIndicator();
        },
        updateSize: function(isResize) {
            this.timeGrid.updateSize(isResize);
            View.prototype.updateSize.call(this, isResize);
        },
        updateWidth: function() {
            this.axisWidth = matchCellWidths(this.el.find('.fc-axis'));
        },
        setHeight: function(totalHeight, isAuto) {
            var eventLimit;
            var scrollerHeight;
            var scrollbarWidths;
            this.bottomRuleEl.hide();
            this.scroller.clear();
            uncompensateScroll(this.noScrollRowEls);
            if (this.dayGrid) {
                this.dayGrid.removeSegPopover();
                eventLimit = this.opt('eventLimit');
                if (eventLimit && typeof eventLimit !== 'number') {
                    eventLimit = AGENDA_ALL_DAY_EVENT_LIMIT;
                }
                if (eventLimit) {
                    this.dayGrid.limitRows(eventLimit);
                }
            }
            if (!isAuto) {
                scrollerHeight = this.computeScrollerHeight(totalHeight);
                this.scroller.setHeight(scrollerHeight);
                scrollbarWidths = this.scroller.getScrollbarWidths();
                if (scrollbarWidths.left || scrollbarWidths.right) {
                    compensateScroll(this.noScrollRowEls, scrollbarWidths);
                    scrollerHeight = this.computeScrollerHeight(totalHeight);
                    this.scroller.setHeight(scrollerHeight);
                }
                this.scroller.lockOverflow(scrollbarWidths);
                if (this.timeGrid.getTotalSlatHeight() < scrollerHeight) {
                    this.bottomRuleEl.show();
                }
            }
        },
        computeScrollerHeight: function(totalHeight) {
            return totalHeight - subtractInnerElHeight(this.el, this.scroller.el);
        },
        computeInitialDateScroll: function() {
            var scrollTime = moment.duration(this.opt('scrollTime'));
            var top = this.timeGrid.computeTimeTop(scrollTime);
            top = Math.ceil(top);
            if (top) {
                top++;
            }
            return {
                top: top
            };
        },
        queryDateScroll: function() {
            return {
                top: this.scroller.getScrollTop()
            };
        },
        applyDateScroll: function(scroll) {
            if (scroll.top !== undefined) {
                this.scroller.setScrollTop(scroll.top);
            }
        },
        hitsNeeded: function() {
            this.timeGrid.hitsNeeded();
            if (this.dayGrid) {
                this.dayGrid.hitsNeeded();
            }
        },
        hitsNotNeeded: function() {
            this.timeGrid.hitsNotNeeded();
            if (this.dayGrid) {
                this.dayGrid.hitsNotNeeded();
            }
        },
        prepareHits: function() {
            this.timeGrid.prepareHits();
            if (this.dayGrid) {
                this.dayGrid.prepareHits();
            }
        },
        releaseHits: function() {
            this.timeGrid.releaseHits();
            if (this.dayGrid) {
                this.dayGrid.releaseHits();
            }
        },
        queryHit: function(left, top) {
            var hit = this.timeGrid.queryHit(left, top);
            if (!hit && this.dayGrid) {
                hit = this.dayGrid.queryHit(left, top);
            }
            return hit;
        },
        getHitSpan: function(hit) {
            return hit.component.getHitSpan(hit);
        },
        getHitEl: function(hit) {
            return hit.component.getHitEl(hit);
        },
        renderEvents: function(events) {
            var dayEvents = [];
            var timedEvents = [];
            var daySegs = [];
            var timedSegs;
            var i;
            for (i = 0; i < events.length; i++) {
                if (events[i].allDay) {
                    dayEvents.push(events[i]);
                } else {
                    timedEvents.push(events[i]);
                }
            }
            timedSegs = this.timeGrid.renderEvents(timedEvents);
            if (this.dayGrid) {
                daySegs = this.dayGrid.renderEvents(dayEvents);
            }
            this.updateHeight();
        },
        getEventSegs: function() {
            return this.timeGrid.getEventSegs().concat(this.dayGrid ? this.dayGrid.getEventSegs() : []);
        },
        unrenderEvents: function() {
            this.timeGrid.unrenderEvents();
            if (this.dayGrid) {
                this.dayGrid.unrenderEvents();
            }
        },
        renderDrag: function(dropLocation, seg) {
            if (dropLocation.start.hasTime()) {
                return this.timeGrid.renderDrag(dropLocation, seg);
            } else if (this.dayGrid) {
                return this.dayGrid.renderDrag(dropLocation, seg);
            }
        },
        unrenderDrag: function() {
            this.timeGrid.unrenderDrag();
            if (this.dayGrid) {
                this.dayGrid.unrenderDrag();
            }
        },
        renderSelection: function(span) {
            if (span.start.hasTime() || span.end.hasTime()) {
                this.timeGrid.renderSelection(span);
            } else if (this.dayGrid) {
                this.dayGrid.renderSelection(span);
            }
        },
        unrenderSelection: function() {
            this.timeGrid.unrenderSelection();
            if (this.dayGrid) {
                this.dayGrid.unrenderSelection();
            }
        }
    });
    var agendaTimeGridMethods = {
        renderHeadIntroHtml: function() {
            var view = this.view;
            var weekText;
            if (view.opt('weekNumbers')) {
                weekText = this.start.format(view.opt('smallWeekFormat'));
                return '' + '<th class="fc-axis fc-week-number ' + view.widgetHeaderClass + '" ' + view.axisStyleAttr() + '>' + view.buildGotoAnchorHtml({
                    date: this.start,
                    type: 'week',
                    forceOff: this.colCnt > 1
                }, htmlEscape(weekText)) + '</th>';
            } else {
                return '<th class="fc-axis ' + view.widgetHeaderClass + '" ' + view.axisStyleAttr() + '></th>';
            }
        },
        renderBgIntroHtml: function() {
            var view = this.view;
            return '<td class="fc-axis ' + view.widgetContentClass + '" ' + view.axisStyleAttr() + '></td>';
        },
        renderIntroHtml: function() {
            var view = this.view;
            return '<td class="fc-axis" ' + view.axisStyleAttr() + '></td>';
        }
    };
    var agendaDayGridMethods = {
        renderBgIntroHtml: function() {
            var view = this.view;
            return '' + '<td class="fc-axis ' + view.widgetContentClass + '" ' + view.axisStyleAttr() + '>' + '<span>' + view.getAllDayHtml() + '</span>' + '</td>';
        },
        renderIntroHtml: function() {
            var view = this.view;
            return '<td class="fc-axis" ' + view.axisStyleAttr() + '></td>';
        }
    };;;
    var AGENDA_ALL_DAY_EVENT_LIMIT = 5;
    var AGENDA_STOCK_SUB_DURATIONS = [{
        hours: 1
    }, {
        minutes: 30
    }, {
        minutes: 15
    }, {
        seconds: 30
    }, {
        seconds: 15
    }];
    fcViews.agenda = {
        'class': AgendaView,
        defaults: {
            allDaySlot: true,
            slotDuration: '00:30:00',
            slotEventOverlap: true
        }
    };
    fcViews.agendaDay = {
        type: 'agenda',
        duration: {
            days: 1
        }
    };
    fcViews.agendaWeek = {
        type: 'agenda',
        duration: {
            weeks: 1
        }
    };;;
    var ListView = View.extend({
        grid: null,
        scroller: null,
        initialize: function() {
            this.grid = new ListViewGrid(this);
            this.scroller = new Scroller({
                overflowX: 'hidden',
                overflowY: 'auto'
            });
        },
        renderSkeleton: function() {
            this.el.addClass('fc-list-view ' + this.widgetContentClass);
            this.scroller.render();
            this.scroller.el.appendTo(this.el);
            this.grid.setElement(this.scroller.scrollEl);
        },
        unrenderSkeleton: function() {
            this.scroller.destroy();
        },
        setHeight: function(totalHeight, isAuto) {
            this.scroller.setHeight(this.computeScrollerHeight(totalHeight));
        },
        computeScrollerHeight: function(totalHeight) {
            return totalHeight - subtractInnerElHeight(this.el, this.scroller.el);
        },
        renderDates: function() {
            this.grid.setRange(this.renderRange);
        },
        renderEvents: function(events) {
            this.grid.renderEvents(events);
        },
        unrenderEvents: function() {
            this.grid.unrenderEvents();
        },
        isEventResizable: function(event) {
            return false;
        },
        isEventDraggable: function(event) {
            return false;
        }
    });
    var ListViewGrid = Grid.extend({
        segSelector: '.fc-list-item',
        hasDayInteractions: false,
        spanToSegs: function(span) {
            var view = this.view;
            var dayStart = view.renderRange.start.clone().time(0);
            var dayIndex = 0;
            var seg;
            var segs = [];
            while (dayStart < view.renderRange.end) {
                seg = intersectRanges(span, {
                    start: dayStart,
                    end: dayStart.clone().add(1, 'day')
                });
                if (seg) {
                    seg.dayIndex = dayIndex;
                    segs.push(seg);
                }
                dayStart.add(1, 'day');
                dayIndex++;
                if (seg && !seg.isEnd && span.end.hasTime() && span.end < dayStart.clone().add(this.view.nextDayThreshold)) {
                    seg.end = span.end.clone();
                    seg.isEnd = true;
                    break;
                }
            }
            return segs;
        },
        computeEventTimeFormat: function() {
            return this.view.opt('mediumTimeFormat');
        },
        handleSegClick: function(seg, ev) {
            var url;
            Grid.prototype.handleSegClick.apply(this, arguments);
            if (!$(ev.target).closest('a[href]').length) {
                url = seg.event.url;
                if (url && !ev.isDefaultPrevented()) {
                    window.location.href = url;
                }
            }
        },
        renderFgSegs: function(segs) {
            segs = this.renderFgSegEls(segs);
            if (!segs.length) {
                this.renderEmptyMessage();
            } else {
                this.renderSegList(segs);
            }
            return segs;
        },
        renderEmptyMessage: function() {
            this.el.html('<div class="fc-list-empty-wrap2">' + '<div class="fc-list-empty-wrap1">' + '<div class="fc-list-empty">' + htmlEscape(this.view.opt('noEventsMessage')) + '</div>' + '</div>' + '</div>');
        },
        renderSegList: function(allSegs) {
            var segsByDay = this.groupSegsByDay(allSegs);
            var dayIndex;
            var daySegs;
            var i;
            var tableEl = $('<table class="fc-list-table"><tbody/></table>');
            var tbodyEl = tableEl.find('tbody');
            for (dayIndex = 0; dayIndex < segsByDay.length; dayIndex++) {
                daySegs = segsByDay[dayIndex];
                if (daySegs) {
                    tbodyEl.append(this.dayHeaderHtml(this.view.renderRange.start.clone().add(dayIndex, 'days')));
                    this.sortEventSegs(daySegs);
                    for (i = 0; i < daySegs.length; i++) {
                        tbodyEl.append(daySegs[i].el);
                    }
                }
            }
            this.el.empty().append(tableEl);
        },
        groupSegsByDay: function(segs) {
            var segsByDay = [];
            var i, seg;
            for (i = 0; i < segs.length; i++) {
                seg = segs[i];
                (segsByDay[seg.dayIndex] || (segsByDay[seg.dayIndex] = [])).push(seg);
            }
            return segsByDay;
        },
        dayHeaderHtml: function(dayDate) {
            var view = this.view;
            var mainFormat = view.opt('listDayFormat');
            var altFormat = view.opt('listDayAltFormat');
            return '<tr class="fc-list-heading" data-date="' + dayDate.format('YYYY-MM-DD') + '">' + '<td class="' + view.widgetHeaderClass + '" colspan="3">' + (mainFormat ? view.buildGotoAnchorHtml(dayDate, {
                'class': 'fc-list-heading-main'
            }, htmlEscape(dayDate.format(mainFormat))) : '') + (altFormat ? view.buildGotoAnchorHtml(dayDate, {
                'class': 'fc-list-heading-alt'
            }, htmlEscape(dayDate.format(altFormat))) : '') + '</td>' + '</tr>';
        },
        fgSegHtml: function(seg) {
            var view = this.view;
            var classes = ['fc-list-item'].concat(this.getSegCustomClasses(seg));
            var bgColor = this.getSegBackgroundColor(seg);
            var event = seg.event;
            var url = event.url;
            var timeHtml;
            if (event.allDay) {
                timeHtml = view.getAllDayHtml();
            } else if (view.isMultiDayEvent(event)) {
                if (seg.isStart || seg.isEnd) {
                    timeHtml = htmlEscape(this.getEventTimeText(seg));
                } else {
                    timeHtml = view.getAllDayHtml();
                }
            } else {
                timeHtml = htmlEscape(this.getEventTimeText(event));
            }
            if (url) {
                classes.push('fc-has-url');
            }
            return '<tr class="' + classes.join(' ') + '">' + (this.displayEventTime ? '<td class="fc-list-item-time ' + view.widgetContentClass + '">' + (timeHtml || '') + '</td>' : '') + '<td class="fc-list-item-marker ' + view.widgetContentClass + '">' + '<span class="fc-event-dot"' + (bgColor ? ' style="background-color:' + bgColor + '"' : '') + '></span>' + '</td>' + '<td class="fc-list-item-title ' + view.widgetContentClass + '">' + '<a' + (url ? ' href="' + htmlEscape(url) + '"' : '') + '>' + htmlEscape(seg.event.title || '') + '</a>' + '</td>' + '</tr>';
        }
    });;;
    fcViews.list = {
        'class': ListView,
        buttonTextKey: 'list',
        defaults: {
            buttonText: 'list',
            listDayFormat: 'LL',
            noEventsMessage: 'No events to display'
        }
    };
    fcViews.listDay = {
        type: 'list',
        duration: {
            days: 1
        },
        defaults: {
            listDayFormat: 'dddd'
        }
    };
    fcViews.listWeek = {
        type: 'list',
        duration: {
            weeks: 1
        },
        defaults: {
            listDayFormat: 'dddd',
            listDayAltFormat: 'LL'
        }
    };
    fcViews.listMonth = {
        type: 'list',
        duration: {
            month: 1
        },
        defaults: {
            listDayAltFormat: 'dddd'
        }
    };
    fcViews.listYear = {
        type: 'list',
        duration: {
            year: 1
        },
        defaults: {
            listDayAltFormat: 'dddd'
        }
    };;;
    return FC;
});

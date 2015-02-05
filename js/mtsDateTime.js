var YgDateTime = function () {
    this.target = null;     // object (jQuery)
    this.section = "";      // date, month, time, datetime
    this.session = false;

    this.objDateTime = null; // object (jQuery)
    this.now = new Date();

    this.year = "";
    this.month = "";
    this.day = "";
    this.noon = "";
    this.hour = "";
    this.minute = "";
    this.second = "";

    this.calDateWidth = 24;
};

// this.section별 날짜 확인
// 2012.08.06 / 2012.8.6 / 2012-08-06 / 2012-8-6 / 20120806
YgDateTime.prototype.InitDate = function () {
    var val = this.target.val();
    var tmp;

    if (val.length > 0) {
        val = val.replace(/-/g, ".");
        if (val.indexOf(".") > 0) {
            this.year = val.substring(0, val.indexOf("."));
            if (this.year.length == 4 && isNaN(this.year) == false) {
                tmp = val.substring(val.indexOf(".") + 1, val.length);

                if (tmp.indexOf(".") > 0) {
                    this.month = tmp.substring(0, tmp.indexOf("."));
                    if (isNaN(this.month) == false && (this.month >= 1 && this.month <= 12)) {
                        tmp = tmp.substring(tmp.indexOf(".") + 1, tmp.length);

                        if (tmp.length > 0) {
                            tmp = tmp.length > 2 ? tmp.substring(0, tmp.indexOf(" ")) : tmp;
                            this.day = tmp;
                            if (isNaN(this.day) == true || this.day < 1 || this.day > 31) {
                                this.day = "";
                            };
                        };
                    } else {
                        this.month = "";
                    };
                } else {
                    if (tmp.length > 0) {
                        this.month = tmp;
                        if (isNaN(this.month) == false && (this.month >= 1 && this.month <= 12)) {
                            this.month = eval(this.month) < 10 ? "0" + eval(this.month) : this.month;
                        } else {
                            this.month = "";
                        };
                    };
                };
            } else {
                this.year = "";
            };
        } else {
            switch (val.length) {
                case 4:
                    this.year = isNaN(val) == false ? val : "";
                    break;

                case 6:
                    this.year = isNaN(val.substring(0, 4)) == false ? val.substring(0, 4) : "";
                    this.month = isNaN(val.substring(4, 6)) == false ? val.substring(4, 6) : "";
                    break;

                case 8:
                    this.year = isNaN(val.substring(0, 4)) == false ? val.substring(0, 4) : "";
                    this.month = isNaN(val.substring(4, 6)) == false ? val.substring(4, 6) : "";
                    this.day = isNaN(val.substring(6, 8)) == false ? val.substring(6, 8) : "";
                    break;

                default:
                    if (val.length > 8) {
                        this.year = isNaN(val.substring(0, 4)) == false ? val.substring(0, 4) : "";
                        this.month = isNaN(val.substring(4, 6)) == false ? val.substring(4, 6) : "";
                        this.day = isNaN(val.substring(6, 8)) == false ? val.substring(6, 8) : "";
                    };
            };
        };
    };

    var chkDate = new Date(this.year, this.month - 1, this.day);
    if (isNaN(chkDate) == true) {
        this.year = "";
        this.month = "";
        this.day = "";
    };

    this.year = this.year == "" ? this.now.getFullYear() : this.year;
    this.month = this.month == "" ? this.now.getMonth() + 1 : this.month;
    this.day = this.day == "" ? this.now.getDate() : this.day;

    this.month = eval(this.month) < 10 ? "0" + eval(this.month) : this.month;
    this.day = eval(this.day) < 10 ? "0" + eval(this.day) : this.day;

    //alert(this.year + "-" + this.month + "-" + this.day);
};

// this.section별 시간 확인
// pm 01:45:23 / 13:45:23
YgDateTime.prototype.InitTime = function () {
    var val = this.target.val().toLowerCase();
    var tmp;

    if (val.length > 0) {
        val = val.length > 12 ? val.substring(val.indexOf(" ") + 1, val.length) : val;

        this.noon = val.indexOf("am") >= 0 ? "am" : val.indexOf("오전") >= 0 ? "am" : val.indexOf("pm") >= 0 ? "pm" : val.indexOf("오후") >= 0 ? "pm" : "";
        tmp = $.trim(val.replace("am", "").replace("오전", "").replace("pm", "").replace("오후", ""));

        if (tmp.indexOf(":") > 0) {
            this.hour = tmp.substring(0, tmp.indexOf(":"));
            if (isNaN(this.hour) == false) {
                this.hour = this.noon == "pm" && this.hour < 12 ? eval(this.hour) + 12 : this.hour;

                tmp = tmp.substring(tmp.indexOf(":") + 1, tmp.length);
                if (tmp.indexOf(":") > 0) {
                    this.minute = tmp.substring(0, tmp.indexOf(":"));
                    if (isNaN(this.minute) == false && (this.minute >= 0 && this.minute <= 59)) {
                        tmp = tmp.substring(tmp.indexOf(":") + 1, tmp.length);

                        if (tmp.length > 0) {
                            tmp = tmp.length > 2 ? tmp.substring(0, tmp.indexOf(" ")) : tmp;
                            this.second = tmp;
                            if (isNaN(this.second) == true || this.second < 0 || this.second > 59) {
                                this.second = "";
                            };
                        };
                    } else {
                        this.minute = "";
                    };
                } else {
                    if (tmp.length > 0) {
                        this.minute = tmp;
                        if (isNaN(this.minute) == false && (this.minute >= 0 && this.minute <= 59)) {
                            this.minute = eval(this.minute) < 10 ? "0" + eval(this.minute) : this.minute;
                        } else {
                            this.minute = "";
                        };
                    };
                };
            } else {
                this.hour = "";
            };
        };
    };

    if (this.hour == "" || this.minute == "" || this.second == "") {
        this.noon = "";
        this.hour = eval(this.now.getHours()) < 10 ? "0" + this.now.getHours() : this.now.getHours();
        this.minute = eval(this.now.getMinutes()) < 10 ? "0" + this.now.getMinutes() : this.now.getMinutes();
        this.second = eval(this.now.getSeconds()) < 10 ? "0" + this.now.getSeconds() : this.now.getSeconds();
    };

    //alert(this.hour + ":" + this.minute + ":" + this.second);
};

// this.target 의 Type(this.section) 확인 후 Object 출력
YgDateTime.prototype.Load = function () {
    if (this.target != null) {
        this.section = this.target.attr("type").toLowerCase();

        $("#ygDialogue").remove();

        this.objDateTime = $("<div>");
        this.objDateTime.attr("id", "ygDialogue");
        this.objDateTime.css("z-index", "555");

        switch (this.section) {
            case "date":
                if (!this.session) {
                    this.InitDate();
                };
                this.Calendar();
                break;

            case "month":
                if (!this.session) {
                    this.InitDate();
                };
                this.Month();
                break;

            case "time":
                if (!this.session) {
                    this.InitTime();
                };
                this.Time();
                break;

            case "datetime":
                if (!this.session) {
                    this.InitDate();
                    this.InitTime();
                };
                this.Calendar();
                this.Time();
                break;

            default:
                this.section = "";
        };

        if (this.section == "") {
            this.objDateTime = null;
        } else {
            this.Control();
        };

        this.target.parent().append(this.objDateTime);
        this.objDateTime.css("top", (this.target.position().top + this.target.height() + 10) + "px");
        this.objDateTime.css("left", this.target.position().left + "px");
    };
    this.session = false;
};

// 달력 출력
YgDateTime.prototype.Calendar = function () {
    var _self = this;
    var divCalendar, divHeader, ulDays;
    var btnPrevYear, btnPrevMonth, btnNextMonth, btnNextYear;

    divCalendar = $("<div>");
    divCalendar.addClass("calendar");

    divHeader = $("<div>");
    divHeader.addClass("header");

    ulDays = $("<ul>");

    btnPrevYear = $("<button>");
    btnPrevYear.attr("type", "button");
    btnPrevYear.addClass("prevYear");
    btnPrevYear.attr("title", "Previous Year");
    btnPrevYear.text("이전해");
    btnPrevYear.click(function () {
        _self.year--;
        var chkDate = new Date(_self.year, _self.month-1, _self.day);
        if (chkDate == false || (chkDate.getMonth() + 1) != _self.month) {
            _self.day = "01";
        };
        _self.session = true;
        _self.Load();
    });
    divHeader.append(btnPrevYear);

    btnPrevMonth = $("<button>");
    btnPrevMonth.attr("type", "button");
    btnPrevMonth.addClass("prevMonth");
    btnPrevMonth.attr("title", "Previous Month");
    btnPrevMonth.text("이전달");
    btnPrevMonth.click(function () {
        _self.month--;
        if (_self.month <= 0) {
            _self.year--;
            _self.month = 12;
        };
        _self.month = _self.month < 10 ? "0" + _self.month : _self.month;
        var chkDate = new Date(_self.year, _self.month-1, _self.day);
        if (chkDate == false || (chkDate.getMonth() + 1) != _self.month) {
            _self.day = "01";
        };
        _self.session = true;
        _self.Load();
    });
    divHeader.append(btnPrevMonth);

    divHeader.append($("<span>").text(this.year + "." + this.month));

    btnNextMonth = $("<button>");
    btnNextMonth.attr("type", "button");
    btnNextMonth.addClass("nextMonth");
    btnNextMonth.attr("title", "Next Month");
    btnNextMonth.text("다음달");
    btnNextMonth.click(function () {
        _self.month++;
        if (_self.month > 12) {
            _self.year++;
            _self.month = 1;
        };
        _self.month = _self.month < 10 ? "0" + _self.month : _self.month;
        var chkDate = new Date(_self.year, _self.month-1, _self.day);
        if (chkDate == false || (chkDate.getMonth() + 1) != _self.month) {
            _self.day = "01";
        };
        _self.session = true;
        _self.Load();
    });
    divHeader.append(btnNextMonth);

    btnNextYear = $("<button>");
    btnNextYear.attr("type", "button");
    btnNextYear.addClass("nextYear");
    btnNextYear.attr("title", "Next Year");
    btnNextYear.text("다음해");
    btnNextYear.click(function () {
        _self.year++;
        var chkDate = new Date(_self.year, _self.month-1, _self.day);
        if (chkDate == false || (chkDate.getMonth() + 1) != _self.month) {
            _self.day = "01";
        };
        _self.session = true;
        _self.Load();
    });
    divHeader.append(btnNextYear);

    divCalendar.append(divHeader);

    var chkCnt, chkDate, _self;
    var arrLi = new Array();
    var arrA = new Array();
    for (chkCnt = 1; chkCnt < 32; chkCnt++) {
        chkCnt = chkCnt < 10 ? "0" + chkCnt : chkCnt;
        chkDate = new Date(this.year, this.month - 1, chkCnt);
        if (chkDate && eval(this.month) == (chkDate.getMonth() + 1)) {
            chkCnt = eval(chkCnt);

            arrLi[chkCnt] = $("<li>");
            if (chkDate.getDay() == 0) {
                arrLi[chkCnt].addClass("sunday");
            };
            if (eval(this.now.getFullYear()) == eval(this.year) && eval(this.now.getMonth() + 1) == eval(this.month) && eval(this.now.getDate()) == chkCnt) {
                arrLi[chkCnt].addClass("today");
            };
            if (chkCnt == 1) {
                arrLi[chkCnt].css("margin-left", (chkDate.getDay() * this.calDateWidth) + "px");
            };

            arrA[chkCnt] = $("<a>");
            arrA[chkCnt].attr("title", chkCnt + "일");
            arrA[chkCnt].attr("href", "javascript:;");
            arrA[chkCnt].text(chkCnt);
            if (this.day == chkCnt) {
                arrA[chkCnt].addClass("selected");
            };
            arrA[chkCnt].click(function () {
                $("#ygDialogue > div.calendar > ul > li > a.selected").removeClass("selected");
                $(this).addClass("selected");
                _self.day = $("#ygDialogue > div.calendar > ul > li > a.selected").text();
                _self.day = eval(_self.day) < 10 ? "0" + _self.day : _self.day;
            });
            arrLi[chkCnt].append(arrA[chkCnt]);

            ulDays.append(arrLi[chkCnt]);
        } else {
            break;
        };
        chkDate = null;
    };

    divCalendar.append(ulDays);

    this.objDateTime.append(divCalendar);
};

// 월선택 출력
YgDateTime.prototype.Month = function () {
    var _self;
    var divMonth;
    var selYear, selMonth;
    var tmpCnt, tmp, tmpHour;

    _self = this;

    divMonth = $("<div>");
    divMonth.addClass("selectMonth");

    selYear = $("<select>");
    selYear.addClass("year");
    selYear.attr("title", "Select Year");
    for (tmpCnt = 1920; tmpCnt <= 2050; tmpCnt++) {
        tmp = "<option value=\"" + tmpCnt + "\"";
        if (this.year == tmpCnt) {
            tmp += " selected=\"selected\"";
        };
        tmp += ">" + tmpCnt + "</option>";
        selYear.append(tmp);
    };
    selYear.bind("change", function () {
        _self.year = $(this).val();
    });
    divMonth.append(selYear);
    divMonth.append(" <span>년</span>");

    selMonth = $("<select>");
    selMonth.addClass("month");
    selMonth.attr("title", "Select Month");
    for (tmpCnt = 1; tmpCnt <= 12; tmpCnt++) {
        tmp = "<option value=\"" + tmpCnt + "\"";
        if (this.month == tmpCnt) {
            tmp += " selected=\"selected\"";
        };
        tmp += ">" + tmpCnt + "</option>";
        selMonth.append(tmp);
    };
    selMonth.bind("change", function () {
        _self.month = $(this).val() < 10 ? "0" + $(this).val() : $(this).val();
    });
    divMonth.append(selMonth);
    divMonth.append(" <span>월</span>");

    this.objDateTime.append(divMonth);

};

// 시간선택 출력
YgDateTime.prototype.Time = function () {
    var _self;
    var divTime;
    var divNoon, rdoAm, rdoPm, lblAm, lblPm;
    var selHour, selMinute, selSecond;

    _self = this;

    divTime = $("<div>");
    divTime.addClass("selectTime");
    if (this.section == "datetime") {
        divTime.addClass("dateTime");
    };

    divNoon = $("<div>");
    divNoon.addClass("noon");

    rdoAm = $("<input>");
    rdoAm.attr("type", "radio");
    rdoAm.attr("name", "selectNoon");
    rdoAm.attr("id", "selectNoon_AM");
    rdoAm.attr("title", "AM");
    rdoAm.val("AM");
    if (this.hour < 12) {
        rdoAm.attr("checked", "checked");
    };
    rdoAm.bind("click", function () {
        _self.hour = selHour.val();
    });
    divNoon.append(rdoAm);

    lblAm = $("<label>");
    lblAm.attr("for", "selectNoon_AM");
    lblAm.text("오전");
    divNoon.append(lblAm);

    rdoPm = $("<input>");
    rdoPm.attr("type", "radio");
    rdoPm.attr("name", "selectNoon");
    rdoPm.attr("id", "selectNoon_PM");
    rdoPm.attr("title", "PM");
    rdoPm.val("PM");
    rdoPm.bind("click", function () {
        _self.hour = eval(selHour.val()) + 12;
    });
    if (this.hour >= 12) {
        rdoPm.attr("checked", "checked");
    };
    divNoon.append(rdoPm);

    lblPm = $("<label>");
    lblPm.attr("for", "selectNoon_PM");
    lblPm.text("오후");
    divNoon.append(lblPm);

    divTime.append(divNoon);


    var tmpCnt, tmp, tmpHour;
    tmpHour = this.hour >= 12 ? this.hour - 12 : this.hour;

    selHour = $("<select>");
    selHour.addClass("hour");
    selHour.attr("title", "Select Hour");
    for (tmpCnt = 0; tmpCnt < 12; tmpCnt++) {
        tmpCnt = tmpCnt < 10 ? "0" + tmpCnt : tmpCnt;
        tmp = "<option value=\"" + tmpCnt + "\"";
        if (tmpHour == eval(tmpCnt)) {
            tmp += " selected=\"selected\""
        };
        tmp += ">" + tmpCnt + "</option>";
        selHour.append(tmp);

        tmpCnt = eval(tmpCnt);
    };
    selHour.bind("change", function () {
        var tmpNoon = rdoPm.attr("checked") == "checked" ? tmpNoon = 12 : tmpNoon = 0;
        _self.hour = (eval($(this).val()) + tmpNoon) < 10 ? "0" + (eval($(this).val()) + tmpNoon) : (eval($(this).val()) + tmpNoon);
    });

    divTime.append(selHour);
    divTime.append($("<span>").text(" : "));

    selMinute = $("<select>");
    selMinute.addClass("minute");
    selMinute.attr("title", "Select Minute");
    for (tmpCnt = 0; tmpCnt < 60; tmpCnt++) {
        tmpCnt = tmpCnt < 10 ? "0" + tmpCnt : tmpCnt;
        tmp = "<option value=\"" + tmpCnt + "\"";
        if (this.minute == eval(tmpCnt)) {
            tmp += " selected=\"selected\""
        };
        tmp += ">" + tmpCnt + "</option>";
        selMinute.append(tmp);

        tmpCnt = eval(tmpCnt);
    };
    selMinute.bind("change", function () {
        _self.minute = $(this).val() < 10 ? "0" + $(this).val() : $(this).val();
    });
    divTime.append(selMinute);
    divTime.append($("<span>").text(" : "));

    selSecond = $("<select>");
    selSecond.addClass("second");
    selSecond.attr("title", "Select Second");
    for (tmpCnt = 0; tmpCnt < 60; tmpCnt++) {
        tmpCnt = tmpCnt < 10 ? "0" + tmpCnt : tmpCnt;
        tmp = "<option value=\"" + tmpCnt + "\"";
        if (this.second == eval(tmpCnt)) {
            tmp += " selected=\"selected\""
        };
        tmp += ">" + tmpCnt + "</option>";
        selSecond.append(tmp);

        tmpCnt = eval(tmpCnt);
    };
    selSecond.bind("change", function () {
        _self.second = $(this).val() < 10 ? "0" + $(this).val() : $(this).val();
    });
    divTime.append(selSecond);

    this.objDateTime.append(divTime);
};


// Buttons 출력
YgDateTime.prototype.Control = function () {
    var divControl, _self, value;
    var btnChoice, btnClear, btnClose;
    _self = this;

    divControl = $("<div>");
    divControl.addClass("control");

    btnChoice = $("<button>");
    btnChoice.attr("type", "button");
    btnChoice.addClass("ygBtnChoice");
    btnChoice.attr("title", "Choice");
    btnChoice.text("선택");
    btnChoice.click(function () {
        value = "";
        switch (_self.section) {
            case "date":
                value = _self.year + "-" + _self.month + "-" + _self.day;
                break;

            case "month":
                value = _self.year + "-" + _self.month;
                break;

            case "time":
                value += _self.hour + ":" + _self.minute + ":" + _self.second;
                break;

            case "datetime":
                value = _self.year + "-" + _self.month + "-" + _self.day;
                value += " ";
                value += _self.hour + ":" + _self.minute + ":" + _self.second;
                break;
        };

        _self.target.val(value);
        _self.target.blur();
        _self.objDateTime.remove();
    });
    divControl.append(btnChoice);

    btnClear = $("<button>");
    btnClear.attr("type", "button");
    btnClear.addClass("ygBtnClear");
    btnClear.attr("title", "Clear");
    btnClear.text("지우기");
    btnClear.click(function () {
        _self.target.val("");
        _self.target.blur();
    });
    divControl.append(btnClear);

    btnClose = $("<button>");
    btnClose.attr("type", "button");
    btnClose.addClass("ygBtnClose");
    btnClose.attr("title", "Close");
    btnClose.text("닫기");
    btnClose.click(function () {
        _self.objDateTime.remove();
    });
    divControl.append(btnClose);

    this.objDateTime.append(divControl);
};
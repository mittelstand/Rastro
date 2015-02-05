var ygFormDefaultRoot = "/";
var ygFormScriptRoot = ygFormDefaultRoot + "scripts/";
var ygFormStypeRoot = ygFormDefaultRoot + "style/";





var ygFormModernizrPath = ygFormScriptRoot + "modernizr.js";
var ygFormDateTimePath = ygFormScriptRoot + "ygDateTime.js";
var ygFormColorPath = ygFormScriptRoot + "ygColor.js";
var ygFormStylePath = ygFormStypeRoot + "ygForm.css";

$("head").append("<script type=\"text/javascript\" src=\"" + ygFormModernizrPath + "\"></script>");
$("head").append("<script type=\"text/javascript\" src=\"" + ygFormDateTimePath + "\"></script>");
$("head").append("<script type=\"text/javascript\" src=\"" + ygFormColorPath + "\"></script>");
$("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\"" + ygFormStylePath + "\">");


var ygFormDefaultLoad = function() {
    // Place Holder
    if (!Modernizr.input.placeholder) {
        $(":input").each(function () {
            var objTarget = null;
            // type이 password 일 때 TEXT로 보이도록 (IE9)
            if ($(this).attr("type") == "password") {
                objTarget = $(this).attr("id") ? document.getElementById($(this).attr("id")) : document.getElementsByName($(this).attr("name"))[0];

                /*
                objTarget.setAttribute("type", "text");
                $(this).focus(function () {
                objTarget.setAttribute("type", "password");
                });
                */
            };

            // 기본값
            if ($(this).val() == "") {;
                $(this).val($(this).attr("placeholder"));
                $(this).addClass("emptyValue");
            };

            // Focus On 일 때 Place Holder 확인
            $(this).focus(function () {
                if (($(this).val() == $(this).attr("placeholder"))) {
                    $(this).val("");
                    $(this).removeClass("emptyValue");
                };
            });

            // Focus Out 일 때 Place Holder 확인
            $(this).blur(function () {
                if (($(this).val() == "")) {
                    /*
                    if ($(this).attr("type") == "password") {
                    objTarget.setAttribute("type", "text");
                    };
                    */

                    $(this).val($(this).attr("placeholder"));
                    $(this).addClass("emptyValue");
                };
            });
        });
    };

    // Auto Focus
    if (!Modernizr.input.autofocus) {
        $(":input[autofocus='autofocus']").focus();
    };

    // Date
    if (!Modernizr.inputtypes.date) {
        $("input[type='date']").attr("readonly", "readonly");
    };
    if (!Modernizr.inputtypes.date) {
        $("input[type='month']").attr("readonly", "readonly");
    };
    if (!Modernizr.inputtypes.date) {
        $("input[type='time']").attr("readonly", "readonly");
    };
    if (!Modernizr.inputtypes.date) {
        $("input[type='datetime']").attr("readonly", "readonly");
    };
    // Color
    if (!Modernizr.inputtypes.date) {
        $("input[type='color']").attr("readonly", "readonly");
    };
};

var ygFormLoad = function() {
    var YgSelectDateTime = function () {
        var ydt = new YgDateTime();
        ydt.target = $(this);
        ydt.Load();
    };
    var YgSelectColor = function () {
        var ygc = new YgColor();
        ygc.target = $(this);
        ygc.Load();
    };

    ygFormDefaultLoad();
    _formSubmitReturn = true;
    $("form").submit(function () {
        var _self = $(this);
		var _formId = $(this).attr("id") == undefined ? "-1" : $(this).attr("id");;
		var _formClass = $(this).attr("class") == undefined ? "-1" : $(this).attr("class");
        var _return = true;
        // Required
        $(":input[required='required']").each(function () {
            if ($(this).parents("form").attr("id") == _formId || $(this).parents("form").attr("class") == _formClass) {
                if ($(this).parents("form").attr("id") == _self.attr("id") || $(this).parents("form").attr("class") == _self.attr("class")) {
                    switch ($(this).attr("type")) {
                        case "radio":
                            if ($(this).attr("name")) {
                                if ($(":input[name='" + $(this).attr("name") + "']:checked").length <= 0) {
                                    alert($(this).attr("title"));
                                    $(this).focus();
                                    _return = false;
                                    return false;
                                };
                            };
                            break;

                        case "checkbox":
                            if ($.trim($(this).attr("checked")) == false) {
                                alert($(this).attr("title"));
                                $(this).focus();
                                _return = false;
                                return false;
                            };
                            break;

                        default:
                            if ($.trim($(this).val()) == "" || $(this).val() == $(this).attr("placeholder")) {
                                alert($(this).attr("title"));
                                $(this).focus();
                                _return = false;
                                return false;
                            };
                    };
                };
            };
        });

        // Email
        if (_return) {
            $(":input[type='email']").each(function () {
                if ($(this).parents("form").attr("id") || $(this).parents("form").attr("class")) {
                    if ($(this).parents("form").attr("id") == _self.attr("id") || $(this).parents("form").attr("class") == _self.attr("class")) {
                        if ($.trim($(this).val()).length && $(this).val() != $(this).attr("placeholder")) {
                            if ($(this).val().indexOf("@") < 1) {
                                alert("email을 정확히 작성해주세요");
                                $(this).focus();
                                _return = false;
                                return false;
                            };

                            if ($(this).val().length <= $(this).val().indexOf("@") + 1) {
                                alert("email을 정확히 작성해주세요");
                                $(this).focus();
                                _return = false;
                                return false;
                            };
                        };
                    };
                };
            });
        };

        // URL
        if (_return) {
            $(":input[type='url']").each(function () {
                if ($(this).parents("form").attr("id") || $(this).parents("form").attr("class")) {
                    if ($(this).parents("form").attr("id") == _self.attr("id") || $(this).parents("form").attr("class") == _self.attr("class")) {
                        if ($.trim($(this).val()).length && $(this).val() != $(this).attr("placeholder")) {
                            if ($(this).val().indexOf("://") < 1) {
                                alert("URL을 정확히 작성해주세요");
                                $(this).focus();
                                _return = false;
                                return false;
                            };
                        };
                    };
                };
            });
        };

        // RANGE
        if (_return) {
            $(":input[type='range']").each(function () {
                if ($(this).parents("form").attr("id") || $(this).parents("form").attr("class")) {
                    if ($(this).parents("form").attr("id") == _self.attr("id") || $(this).parents("form").attr("class") == _self.attr("class")) {
                        if ($.trim($(this).val()).length && $(this).val() != $(this).attr("placeholder")) {
                            var _min = $(this).attr("min") ? isNaN($(this).attr("min")) ? 0 : $(this).attr("min") : 0;
                            var _max = $(this).attr("max") ? isNaN($(this).attr("max")) ? 100 : $(this).attr("max") : 100;
                            var _step = $(this).attr("step") ? isNaN($(this).attr("step")) ? 1 : $(this).attr("step") : 1;

                            if (isNaN($(this).val())) {
                                alert("항목을 정확히 작성해주세요");
                                $(this).focus();
                                _return = false;
                                return false;
                            };

                            if (eval($(this).val()) < _min || eval($(this).val()) > _max) {
                                alert("항목을 정확히 작성해주세요 (" + _min + " ~ " + _max + ")");
                                $(this).focus();
                                _return = false;
                                return false;
                            };

                            if (eval($(this).val()) % _step != 0 && eval($(this).val()) != _min && eval($(this).val()) != _max) {
                                alert("항목을 정확히 작성해주세요 (" + _step + "의 배수)");
                                $(this).focus();
                                _return = false;
                                return false;
                            };
                        };
                    };
                };
            });
        };

        // NUMBER
        if (_return) {
            $(":input[type='number']").each(function () {
                if ($(this).parents("form").attr("id") || $(this).parents("form").attr("class")) {
                    if ($(this).parents("form").attr("id") == _self.attr("id") || $(this).parents("form").attr("class") == _self.attr("class")) {
                        if ($.trim($(this).val()).length && $(this).val() != $(this).attr("placeholder")) {
                            var _min = $(this).attr("min");
                            var _max = $(this).attr("max");
                            var _step = $(this).attr("step");
                            var _msg = "";

                            if (!isNaN(_min) && !isNaN(_max)) {
                                _msg = " (" + _min + " ~ " + _max + ")";
                            } else {
                                if (!isNaN(_min)) {
                                    _msg = " (" + _min + "보다 큰 수)";
                                };

                                if (!isNaN(_max)) {
                                    _msg = " (" + _min + "보다 작은 수)";
                                };
                            };

                            if (isNaN($(this).val())) {
                                alert("항목을 정확히 작성해주세요");
                                $(this).focus();
                                _return = false;
                                return false;
                            };

                            if (_min && !isNaN(_min) && eval($(this).val()) < _min) {
                                alert("항목을 정확히 작성해주세요" + _msg);
                                $(this).focus();
                                _return = false;
                                return false;
                            };

                            if (_max && !isNaN(_max) && eval($(this).val()) > _max) {
                                alert("항목을 정확히 작성해주세요" + _msg);
                                $(this).focus();
                                _return = false;
                                return false;
                            };

                            if (_step && !isNaN(_step) && eval($(this).val()) % _step != 0 && eval($(this).val()) != _min && eval($(this).val()) != _max) {
                                alert("항목을 정확히 작성해주세요 (" + _step + "의 배수)");
                                $(this).focus();
                                _return = false;
                                return false;
                            };
                        };
                    };
                };
            });
        };

        if (_return) {
            $(":input").each(function () {
                if ($(this).val() == $(this).attr("placeholder")) {
                    $(this).val("");
                };
            });
        };

        _formSubmitReturn = _return;
        return _return;
    });

    var _tmpNum = "";
    // Number
    if (!Modernizr.inputtypes.range) {
        $(":input[type='range']").bind("keypress", function () {
            if (((event.keyCode < 48) || (57 < event.keyCode)) && (event.keyCode != 45) && (event.keyCode != 46)) {
                event.returnValue = false;
            };

            if ($(this).val().length) {
                if (!isNaN($(this).val())) {
                    _tmpNum = $(this).val();
                };
            } else {
                _tmpNum = "";
            };
        });
        $(":input[type='range']").bind("change", function () {
            if ($(this).val().length) {
                if (isNaN($(this).val())) {
                    $(this).val(_tmpNum);
                };
            };
        });
    };

    // Number
    if (!Modernizr.inputtypes.number) {
        $(":input[type='number']").bind("keypress", function () {
            if (((event.keyCode < 48) || (57 < event.keyCode)) && (event.keyCode != 45) && (event.keyCode != 46)) {
                event.returnValue = false;
            };

            if ($(this).val().length) {
                if (!isNaN($(this).val())) {
                    _tmpNum = $(this).val();
                };
            } else {
                _tmpNum = "";
            };
        });
        $(":input[type='number']").bind("change", function () {
            if ($(this).val().length) {
                if (isNaN($(this).val())) {
                    $(this).val(_tmpNum);
                };
            };
        });
    };

    // Date
    if (!Modernizr.inputtypes.date) {
        $(":input[type='date']").focus(YgSelectDateTime);
    };

    // Month
    if (!Modernizr.inputtypes.month) {
        $(":input[type='month']").focus(YgSelectDateTime);
    };

    // Time
    if (!Modernizr.inputtypes.time) {
        $(":input[type='time']").focus(YgSelectDateTime);
    };

    // DateTime
    if (!Modernizr.inputtypes.datetime) {
        $(":input[type='datetime']").focus(YgSelectDateTime);
    };

    // Color
    if (!Modernizr.inputtypes.color) {
        $(":input[type='color']").focus(YgSelectColor);
    };
};

$(window).ready(function () {
    ygFormLoad();
});
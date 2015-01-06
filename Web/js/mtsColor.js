var YgColor = function () {
    this.target = null;     // object (jQuery)
    this.objDialogue = null; // object (jQuery)
    this.color = "";

    this.arrColor = Array("00", "40", "80", "D0", "FF");
};

// 기존 입력값 확인
// #FFFFFF / FFFFFF / #FFF / FFF
YgColor.prototype.Init = function () {
    var val = this.target.val();
    var tmp;

    this.color = "";

    if (val.length > 0) {
        val = val.toUpperCase();
        val = val.length == 7 && val.indexOf("#") >= 0 ? val.replace("#", "") : val;

        if (val.length == 3) {
            tmp = val;
            val = tmp.substring(0, 1) + tmp.substring(0, 1);
            val += tmp.substring(1, 2) + tmp.substring(1, 2);
            val += tmp.substring(2, 3) + tmp.substring(2, 3);
        };

        if (val.length == 6) {
            this.color = val;
        };
    };

    if (this.color.length != 6) {
        this.color = "FFFFFF";
    };
    //alert(this.color);
};

// this.target 확인 후 Object 출력
YgColor.prototype.Load = function () {
    if (this.target != null) {
        $("#ygDialogue").remove();

        this.objDialogue = $("<div>");
        this.objDialogue.attr("id", "ygDialogue");
        this.objDialogue.css("z-index", "555");

        this.Init();
        this.Color();
        this.Control();

        this.target.parent().append(this.objDialogue);
        this.objDialogue.css("top", (this.target.position().top + this.target.height() + 7) + "px");
        this.objDialogue.css("left", this.target.position().left + "px");
    };
    this.session = false;
};

// 컬러표 출력
YgColor.prototype.Color = function () {
    var _self = this;
    var divHeader, ulColor, divColor;
    var inputColor;
    var tmpCnt, tmpCntR, tmpCntG, tmpCntB;
    var arrLi = new Array();

    divHeader = $("<div>");
    divHeader.addClass("header");
    divHeader.append($("<span>").text("#" + this.color));
    this.objDialogue.append(divHeader);

    ulColor = $("<ul>");
    ulColor.addClass("selectColor");
    tmpCnt = 0;
    for (tmpCntR = 0; tmpCntR < this.arrColor.length; tmpCntR++) {
        for (tmpCntG = 0; tmpCntG < this.arrColor.length; tmpCntG++) {
            for (tmpCntB = 0; tmpCntB < this.arrColor.length; tmpCntB++) {
                arrLi[tmpCnt] = $("<li>");
                arrLi[tmpCnt].css("background", "#" + this.arrColor[tmpCntR] + this.arrColor[tmpCntG] + this.arrColor[tmpCntB]);
                arrLi[tmpCnt].click(function () {
                    _self.color = _self.Rgb2Hex(this.style.backgroundColor);
                    inputColor.val(_self.color);
                    divHeader.children("span").text("#" + _self.color);
                    divColor.css("background", "#" + _self.color);
                });

                ulColor.append(arrLi[tmpCnt]);
                tmpCnt++;
            };
        };
    };
    this.objDialogue.append(ulColor);

    divColor = $("<div>");
    divColor.addClass("inputColor");
    divColor.append($("<span>").text("# "));

    inputColor = $("<input>");
    inputColor.addClass("inputColor");
    inputColor.attr("type", "text");
    inputColor.attr("size", "6");
    inputColor.attr("maxlength", "6");
    inputColor.attr("title", "컬러를 입력해주세요");
    inputColor.val(this.color);
    inputColor.bind("keyup", function () {
        _self.CheckInput($(this));
        _self.color = $(this).val().toUpperCase();
        divHeader.children("span").text("#" + _self.color);
        divColor.css("background", "#" + _self.color);
    });
    inputColor.bind("change", function () {
        _self.CheckInput($(this));
        _self.color = $(this).val().toUpperCase();
        divHeader.children("span").text("#" + _self.color);
        divColor.css("background", "#" + _self.color);
    });
    inputColor.bind("click", function () {
        _self.CheckInput($(this));
        _self.color = $(this).val().toUpperCase();
        divHeader.children("span").text("#" + _self.color);
        divColor.css("background", "#" + _self.color);
    });
    divColor.append(inputColor);
    this.objDialogue.append(divColor);
};

// Buttons 출력
YgColor.prototype.Control = function () {
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
        _self.target.val("#" + _self.color);
        _self.objDialogue.remove();
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
        _self.objDialogue.remove();
    });
    divControl.append(btnClose);

    this.objDialogue.append(divControl);
};

// Input 값 확인
YgColor.prototype.CheckInput = function (obj) {
    var chkTmp = "0123456789ABCDEF";
    var tmpCnt, tmp, tmpValue;
    tmp = "";
    tmpValue = obj.val().toUpperCase();
    if (tmpValue.length) {
        for (tmpCnt = 0; tmpCnt < tmpValue.length; tmpCnt++) {
            if (chkTmp.indexOf(tmpValue.substring(tmpCnt, tmpCnt + 1)) >= 0) {
                tmp += tmpValue.substring(tmpCnt, tmpCnt + 1);
            };
        };
    };
    if (tmpValue != tmp) {
        obj.val(tmp);
    };
};

// RGB 컽러형식을 HEX형식으로
YgColor.prototype.Rgb2Hex = function(rgb) {
    var arrRgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    if (arrRgb == null) {
        return rgb.replace("#", "");
    } else {
        rgb = ("0" + parseInt(arrRgb[1], 10).toString(16)).slice(-2) +
                  ("0" + parseInt(arrRgb[2], 10).toString(16)).slice(-2) +
                  ("0" + parseInt(arrRgb[3], 10).toString(16)).slice(-2);
        return rgb.toUpperCase();
    };
};
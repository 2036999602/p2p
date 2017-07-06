(function($) {
    var curID = 0;//
    $.fn.extend({
        capsLockTip : function(options) {
            options = $.extend({}, $.CapsLockTip.defaults, options);
            return this.each(function() {
                new $.CapsLockTip($(this),options);
            });
        }
    });
    $.CapsLockTip = function(input,options) {
        // 设置当前实例的配置参数。
        var _this = this;
        var width=options.width;// 设置自动完成框的宽度
        width = width < $(input).width()?$(input).width():width;
        var $input = $(input).attr("curCapsLockId", curID++);
        var $div = $("#autocapsLock" + $input.attr("curCapsLockId")).length != 0 ? $("#autocapsLock"
                + $input.attr("curCapsLockId"))
                : $("<div/>").attr("id",
                        "autocapsLock" + $input.attr("curCapsLockId")).css({
                    "padding-top" : "3px",
                    position : "absolute",
                    "z-index" : "99999",
                }).css("width",width)
                .css("left", $input.offset().left + 3 +"px")
                .css("top", $input.offset().top + $input.offsetHeight + 536 + "px")
                .appendTo("body").text(options.text).hide();
        if(!$div.attr("class")&&options.styleClass){
            $div.addClass(options.styleClass);
        }else{
            $div.css({color : "#ffa902",
                "font-size" : "12px"

            });
        }
        $input.bind("keypress", function(_event) {
            var e = _event || window.event;
            var kc = e.keyCode || e.which;// 按键的keyCode
            var isShift = e.shiftKey || (kc == 16) || false;// shift键是否按住
            $.fn.capsLockTip.capsLockActived = false;
            if ((kc >= 65 && kc <= 90 && !isShift)
                    || (kc >= 97 && kc <= 122 && isShift))
                $.fn.capsLockTip.capsLockActived = true;
            _this.showTips($.fn.capsLockTip.capsLockActived);
        });
        $input.bind("keydown",function(_event) {
            var e = _event || window.event;
            var kc = e.keyCode || e.which;
            if (kc == 20&& null != $.fn.capsLockTip.capsLockActived) {
                $.fn.capsLockTip.capsLockActived = !$.fn.capsLockTip.capsLockActived;
                _this.showTips($.fn.capsLockTip.capsLockActived);
                }
        });
        $input.bind("focus", function(_event) {
            if (null != $.fn.capsLockTip.capsLockActived)
                _this.showTips($.fn.capsLockTip.capsLockActived);
        });
        $input.bind("blur", function(_event) {
            _this.showTips(false);
        });
        //Show or hide the Caps Lock prompt.
        this.showTips = function(display) {
            if (display) {
                $div.show();
            } else {
                $div.hide();
            }
        };
        // Caps Lock key state
        $.fn.capsLockTip.capsLockActived = null;
    };
    $.CapsLockTip.defaults = {
            styleClass:"",//提示框样式class名称
            width:120,//提示框宽度
            text:"大写键已锁定!"//错误提示信息
    };
})(jQuery);
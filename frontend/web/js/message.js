// 2017年5月10日14:50:52
var requireConfig={
    paths  : {
        jquery:'thirdLib/jqueryjs/jquery-1.12.4.min',
        tab:'module/jquery.tab',
        highcharts:'module/highcharts',
        lightbox:'module/jquery.lightbox',
        pages:'module/jquery.pages',
        superslide:'module/jquery.superslide',
        sideshare:'module/jquery.sideshare.min',
        hDialog:'module/jquery.hDialog',
        questiontest:'module/jquery.questiontest',
    },

    shim  : {
        tab: {
           deps : ["jquery"]
        },
        highcharts: {
           deps : ["jquery"]
        },
        lightbox: {
           deps : ["jquery"]
        },
        pages: {
           deps : ["jquery"]
        },
        superslide: {
           deps : ["jquery"]
        },
        sideshare : {
            deps :["jquery"]
        },
        hDialog: {
           deps : ["jquery"]
        },
        questiontest: {
           deps : ["jquery"]
        }
    }
}
requirejs.config(requireConfig);


require(["jquery","tab","highcharts","lightbox","pages","superslide","sideshare","hDialog","questiontest"],
  function($){
    //页面顶部 我的账户下拉效果
        $(".user").mouseover(function(){
                $("#header_user").css("display","block");
                $(".header_title i").addClass("icon_arrow2");
            });
            $(".user").mouseleave(function(){
                $("#header_user").css("display","none")
                $(".header_title i").removeClass("icon_arrow2");
        })
    //侧边栏分享
        $('#asid_share').hhShare({
          cenBox     : 'asid_share_box',  //里边的小层
          icon       : 'adid_icon',
          addClass   : 'red_bag',
          titleClass : 'asid_title',
          triangle   : 'asid_share_triangle', //鼠标划过显示图层，边上的小三角
          showBox    : 'asid_sha_layer' //鼠标划过显示图层
        });
    //侧边栏 问券调查弹窗
        $("#counterBtn").hDialog({
          title: '问券调查',          //弹框标题
          box: '#questionnaire_wrap',  //弹框默认选择器
          boxBg: '#ffffff',           //弹框默认背景颜色
          modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
          closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
          width: 920,                 //弹框默认宽度
          height: 522,                //弹框默认高度
          positions: 'center',        //弹框位置(默认center：居中，top：顶部居中，left：顶部居左，bottom：底部居右)
          effect: 'zoomOut',          //弹框关闭效果(结合animate.css里的动画，默认：zoomOut)
          hideTime: 0,            //弹框定时关闭(默认0:不自动关闭，以毫秒为单位)
          resetForm: true,            //是否清空表单(默认true：清空，false：不清空)
          modalHide: false,            //是否点击遮罩背景关闭弹框(默认true：关闭，false：不可关闭)
          isOverlay: true,            //是否显示遮罩背景(默认true：显示，false：不显示)
          closeHide: true,            //是否隐藏关闭按钮(默认true：不隐藏，false：隐藏)
          escHide: true,              //是否支持ESC关闭弹框(默认true：关闭，false：不可关闭)
          autoShow: false,            //是否页面加载完成后自动弹出(默认false点击弹出，true：自动弹出)
          types: 1,                   //弹框类型(默认：1正常弹框，2：iframe框架)
          // beforeShow: function(){
          //       alert('确定支付么？')
          // },   //显示前的回调方法
          // afterHide: function(){
          //       alert("确定提交么？")}
          //     // 隐藏后的回调方法
        });
    //年度选项卡
        $('.tab_mouseover').Tabs({
        timeout:200
         });
    //年度选项卡
        $('.position_tab').Tabs({
        timeout:200
         });
    //运营报表-投资趋势
        $('#invest_chair').highcharts({
            title: {
            text: '投资趋势',
            x: -20
             },
            subtitle: {
                text: '数据来源: cmbank.com',
                x: -20
            },
            xAxis: {
                categories: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
            },
            yAxis: {
                title: {
                    text: '每月投资额度(万元/月)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '万元/月'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '投资趋势',
                data: [345.0, 330, 341, 351, 361, 564, 523, 597, 525, 547, 656, 687]
            }]
        });
    //运营报表-注册人数
        $('#register_chair').highcharts({
            title: {
            text: '贷款余额',
            x: -20
            },
            subtitle: {
                text: '数据来源: cmbank.com',
                x: -20
            },
            xAxis: {
                categories: ['一月', '二月', '三月', '四月']
            },
            yAxis: {
                title: {
                    text: '每月贷款余额(万元/月)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '万元/月'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '贷款余额',
                data: [545.0, 530, 541, 651, 661]
            }]

        });
    //公司简介-楼层跳转
        var oNav = $('#LoutiNav');//导航壳
        var aNav = oNav.find('li');//导航
        var aDiv = $('.company_wrap .intro_floor');//楼层
        var oTop = $('#goTop');
    //公司简介-回到顶部
        $(window).scroll(function(){
                 var winH = $(window).height();//可视窗口高度
                 var iTop = $(window).scrollTop();//鼠标滚动的距离

                 if(iTop>=$('#LoutiNav').height()){
                    oNav.fadeIn();
                    oTop.fadeIn();
                 //鼠标滑动式改变
                 aDiv.each(function(){
                    if(winH+iTop - $(this).offset().top>winH/2){
                        aNav.removeClass('active');
                        aNav.eq($(this).index()).addClass('active');
                    }
                 })
                 }else{
                    oNav.fadeOut();
                    oTop.fadeOut();
                 }
        })
    //点击top回到顶部
        oTop.click(function(){
            $('body,html').animate({"scrollTop":0},500)
        })
    //点击回到当前楼层
        aNav.click(function(){
            var t = aDiv.eq($(this).index()).offset().top;
            $('body,html').animate({"scrollTop":t},500);
            $(this).addClass('active').siblings().removeClass('active');
        });

    //图片橱窗放大预览
        $('#lightbox').lightbox({
          ifChange: true
        });
    //联合担保-公司荣誉证书轮播
        $(".picScroll").slide({ mainCell:".dlList" ,vis:4,effect:"left",autoPage:true, });
    //联合担保-公司荣誉证书轮播-箭头离开时隐藏
        $(".picScroll").hover(
          function(){
                $(this).find(".prev,.next").stop(true, true).fadeTo("show", 3)
            },
          function(){
                $(this).find(".prev,.next").fadeOut()
        });

});


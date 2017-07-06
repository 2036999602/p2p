// 2017年5月3日13:43:37
var requireConfig={
    paths  : {
        jquery:'thirdLib/jqueryjs/jquery-1.12.4.min',
        validform:'module/jquery.Validform',
        tab:'module/jquery.tab',
        pages:'module/jquery.pages',
        highcharts:'module/highcharts',
        hDialog:'module/jquery.hDialog',
        datepicker:'module/jquery.datepicker',
        sortTable:'module/jquery.tablesorter.min',
        tableCheckbox:'module/jquery.tableCheckbox',
    },

    shim  : {
        validform : {
            deps : ["jquery"]
        },
        tab: {
           deps : ["jquery"]
        },
        pages: {
           deps : ["jquery"]
        },
        highcharts: {
           deps : ["jquery"]
        },
        hDialog: {
           deps : ["jquery"]
        },
        datepicker: {
           deps : ["jquery"]
        },
        sortTable: {
           deps : ["jquery"]
        },
        tableCheckbox: {
           deps : ["jquery"]
        },
    }
}
requirejs.config(requireConfig);

require(["jquery","tab","datepicker","hDialog","highcharts","validform","pages","sortTable","tableCheckbox"],
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
      //我的投资 企业贷定向标
         $('.tab_mouseover').Tabs({
          event:'click',
          timeout:200

           });
      //借款表格选项卡
         $('.borrow_form').Tabs({
          event:'click',
          timeout:200

           });
      //好友邀请 表格选项卡
         $('.statistic_box').Tabs({
          event:'click',
          timeout:200
           });
      //优惠券选项卡
         $('.discount_wrap').Tabs({

          timeout:200

           });
      //投资记录 企业贷 投资中项目
         $(".IR_invest").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 企业贷 持有中项目
         $(".IR_hold").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 企业贷 持有中项目-合同详情
         $(".invest_contract").createPage({
            pageCount:4,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 企业贷 已结清项目
         $(".IR_tally").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 企业贷 逾期项目
         $(".IR_delay").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 企业贷 流标项目
         $(".IR_pass").createPage({
            pageCount:3,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 定向标 投资中项目
         $(".IRD_invest").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 定向标 持有中项目
         $(".IRD_hold").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 定向标 已结清项目
         $(".IRD_tally").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 定向标 逾期项目
         $(".IRD_delay").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 定向标 流标项目
         $(".IRD_pass").createPage({
            pageCount:3,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 个人贷 投资中项目
         $(".IRG_invest").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 个人贷 持有中项目
         $(".IRG_hold").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 个人贷 已结清项目
         $(".IRG_tally").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 个人贷 逾期项目
         $(".IRG_delay").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //投资记录 个人贷 流标项目
         $(".IRG_pass").createPage({
            pageCount:3,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //借款记录 进行中的借款
         $(".BR_ongoing").createPage({
            pageCount:4,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //借款记录 逾期的借款
         $(".BR_outdata").createPage({
            pageCount:6,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //借款记录 已完成的借款
         $(".BR_complete").createPage({
            pageCount:5,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //资金流水资金记录
         $(".funds_flows").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //我的消息 消息记录
         $(".validnews_page").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //自动投标
         $(".funds_automatic").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //红包优惠券 未兑现
         $(".HB_no_usedcard").createPage({
            pageCount:4,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //红包优惠券 已使用
         $(".HB_usedcard").createPage({
            pageCount:2,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //红包优惠券 已过期
         $(".HB_outdata_card").createPage({
            pageCount:3,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //理财券优惠券 未兑现
         $(".LCQ_no_usedcard").createPage({
            pageCount:4,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //理财券优惠券 已使用
         $(".LCQ_usedcard").createPage({
            pageCount:2,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //理财券优惠券 已过期
         $(".LCQ_outdata_card").createPage({
            pageCount:3,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //加息券优惠券 未兑现
         $(".JXQ_no_usedcard").createPage({
            pageCount:4,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //加息券优惠券 已使用
         $(".JXQ_usedcard").createPage({
            pageCount:2,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //加息券优惠券 已过期
         $(".JXQ_outdata_card").createPage({
            pageCount:3,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //好友邀请 奖励详情
         $(".reward_pages").createPage({
            pageCount:4,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //好友邀请 奖励详情
         $(".static_pages").createPage({
            pageCount:4,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
          });
      //我的资产
         $('#account_chair').highcharts({
            title: {
            text: '我的资产',
            x: -20
            },
            subtitle: {
                text: '数据来源: cmbank.com',
                x: -20
            },
            xAxis: {
                categories: ['1月', '2月', '3月', '4月', '5月','6月','7月','8月','9月','10月','11月','12月']
            },
            yAxis: {
                title: {
                    text: '每月收益(元/月)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '元/月'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '每月收益',
                data: [345.0, 330, 341, 351, 361, 564, 523, 597, 525, 547, 656, 687]
            }]
          });
      //企业贷 投资记录条件选项卡
         $('.invest_tabWrap .QY_filterWrap').find('dd').click(function(){
            $('.QY_filterWrap').find('dd').attr('class','');
            $('.QY_filterWrap').find('form').css('display','none');
            $(this).attr('class','filter_active ');
            $('.QY_filterWrap').find('form').eq( $(this).index()-1 ).css('display','block');
        });
      //定向标 投资记录条件选项卡
         $('.invest_tabWrap .DX_filterWrap').find('dd').click(function(){
            $('.DX_filterWrap').find('dd').attr('class','');
            $('.DX_filterWrap').find('form').css('display','none');
            $(this).attr('class','filter_active ');
            $('.DX_filterWrap').find('form').eq( $(this).index()-1 ).css('display','block');
        });
      //个人贷 投资记录条件选项卡
         $('.invest_tabWrap .GR_filterWrap').find('dd').click(function(){
            $('.GR_filterWrap').find('dd').attr('class','');
            $('.GR_filterWrap').find('form').css('display','none');
            $(this).attr('class','filter_active ');
            $('.GR_filterWrap').find('form').eq( $(this).index()-1 ).css('display','block');
        });
      //我的借款 条件选项卡
         $('.account_box .funds_wrap .time_limits').find('dd').click(function(){
            $('.time_limits').find('dd').attr('class','');
            $(this).attr('class','filter_active ');
        });
         $('.account_box .funds_wrap .time_status').find('dd').click(function(){
            $('.time_status').find('dd').attr('class','');
            $(this).attr('class','filter_active ');
        });
      //借款记录日期选项卡
         $('.borrow_limits .time_lists').find('dd').click(function(){
            $('.time_lists').find('dd').attr('class','');
            $(this).attr('class','filter_active ');
        });
      //红包优惠券 优惠券选项卡
         $('.discount_wrap .hongbao_card dd').find('span').click(function(){
            $('.hongbao_card dd').find('span').attr('class','');
            $(this).attr('class','check_on ');
        });
         $('.discount_wrap .hongbao_card dl').find('dd').click(function(){
            $('.discount_wrap .hongbao_card').find('.acc_cardlist').css('display','none');
            $('.discount_wrap .hongbao_card').find('.acc_cardlist').eq( $(this).index()).css('display','block');
        });
      //理财券优惠券 优惠券选项卡
         $('.discount_wrap .licai_card dd').find('span').click(function(){
            $('.licai_card dd').find('span').attr('class','');
            $(this).attr('class','check_on ');
        });
         $('.discount_wrap .licai_card dl').find('dd').click(function(){
            $('.discount_wrap .licai_card').find('.acc_cardlist').css('display','none');
            $('.discount_wrap .licai_card').find('.acc_cardlist').eq( $(this).index()).css('display','block');
        });
      //理财券优惠券 优惠券选项卡
         $('.discount_wrap .jiaxi_card dd').find('span').click(function(){
            $('.jiaxi_card dd').find('span').attr('class','');
            $(this).attr('class','check_on ');
        });
         $('.discount_wrap .jiaxi_card dl').find('dd').click(function(){
            $('.discount_wrap .jiaxi_card').find('.acc_cardlist').css('display','none');
            $('.discount_wrap .jiaxi_card').find('.acc_cardlist').eq( $(this).index()).css('display','block');
        });
      //投资记录查看详情弹窗
         $(".invest_detail").hDialog({
              title: '',          //弹框标题
              box: '#invest_detailWrap',  //弹框默认选择器
              boxBg: '#ffffff',           //弹框默认背景颜色
              modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
              closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
              width: 1000,                 //弹框默认宽度
              height: 640,                //弹框默认高度
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
      //邀请好友 分享详情弹窗
         $(".income_btn").hDialog({
            title: '',          //弹框标题
            box: '#link_share',          //弹框默认选择器
            boxBg: '#ffffff',           //弹框默认背景颜色
            modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
            closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
            width: 320,                 //弹框默认宽度
            height: 200,                //弹框默认高度
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
      //我的借款-审核中的借款-查看合同
         $(".contract_btn").hDialog({
              title: '',          //弹框标题
              box: '#borrow_contactWrap',  //弹框默认选择器
              boxBg: '#ffffff',           //弹框默认背景颜色
              modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
              closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
              width: 920,                 //弹框默认宽度
              height: 722,                //弹框默认高度
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
      //投资 操作按钮 弹窗
         $('.invest_filterWrap .invest_exit').click(function(){
              $('#invest_exitEnsurebg').css('display','block');
              $('#invest_exitWrap').css('display','block');
         });
      //自动投标 操作按钮 弹窗
         $('.account_box .automatic_exit').click(function(){
              $('#invest_exitEnsurebg').css('display','block');
              $('#invest_exitWrap').css('display','block');
         });
      //借款 还款操作 按钮弹窗
         $('.borrow_form .borrow_exit').click(function(){
              $('#borrow_exitEnsurebg').css('display','block');
              $('#borrow_detailWrap').css('display','block');
         });
      //借款还款 分期详情 按钮弹窗
         $('.borrow_formWrap .borrow_repay').click(function(){
              $('#borrow_detailWrap').css('display','block');
              $('#borrow_exitEnsurebg').css('display','block');
         });
      //借款还款 分期支付 弹窗
         $('#borrow_detailWrap .borrow_paymentBtn').click(function(){
              $('#borrow_exitEnsureWrap').css('display','block');
              $('#borrow_exitEnsurebg').css('display','block');
         });
      //借款还款 充值界面 对话框
         $('.borrow_form .borrow_exit').click(function(){
              $('#borrow_exitEnsurebg').css('display','block');
              $('#borrow_detailWrap').css('display','block');
         });
      //投资 继续持有按钮 退出弹窗
         $('#invest_exitWrap .buttonLast').click(function(){
              $('#HOverlay').css('display','none');
              $('#invest_exitWrap').css('display','none');
              $('#invest_exitEnsurebg').css('display','none');
         });
      //借款完成 分期还款 完成按钮退出弹窗
         $('#borrow_detailWrap .borrow_finishlBtn').click(function(){
              $('#borrow_exitEnsurebg').css('display','none');
              $('#borrow_detailWrap').css('display','none');
         });
      //借款完成 分期还款 关闭按钮退出弹窗
         $('#borrow_detailWrap .borrow_closeBtn').click(function(){
              $('#borrow_exitEnsurebg').css('display','none');
              $('#borrow_detailWrap').css('display','none');
         });
      //借款完成 分期充值完成 退出弹窗
         $('#borrow_exitEnsureWrap .borrow_ensureBtn').click(function(){
              $('#borrow_exitEnsureWrap').css('display','none');
         });
      //借款完成 分期充值完成 关闭按钮弹窗
         $('#borrow_exitEnsureWrap .borrow_closeBtn').click(function(){
              $('#borrow_exitEnsureWrap').css('display','none');
         });
      //投资确定退出 按钮关闭当前对话，打开新的对话弹窗
         $('#invest_exitWrap .IR_ensure_btn').click(function(){
              $('#HOverlay').css('display','none');
              $('#invest_exitWrap').css('display','none');
              $('#invest_exitEnsureWrap').css('display','block');
              $('#invest_exitEnsurebg').css('display','block');
         });
      //投资申请确定 按钮退出弹窗
         $('#invest_exitEnsureWrap .IR_ensureBtn').click(function(){
              $('#HOverlay').css('display','none');
              $('#invest_exitEnsurebg').css('display','none');
              $('#invest_exitEnsureWrap').css('display','none');
         });
      //自动投标 继续持有按钮 退出弹窗
         $('#invest_exitWrap .borrow_closeBtn').click(function(){
              $('#HOverlay').css('display','none');
              $('#invest_exitWrap').css('display','none');
              $('#invest_exitEnsurebg').css('display','none');
         });
      //自动投标 退出持有提示 关闭按钮弹窗
         $('#invest_exitEnsureWrap .borrow_closeBtn').click(function(){
              $('#invest_exitEnsureWrap').css('display','none');
              $('#invest_exitEnsurebg').css('display','none');
         });
      //资金流水-日期选择
        $('#funds_data1').fdatepicker({
            format: 'yyyy-mm-dd',
          });
          $('#funds_data2').fdatepicker({
            format: 'yyyy-mm-dd',
          });
          //借款记录-日期选择
          $('#dpd1').fdatepicker({
            format: 'yyyy-mm-dd',
          });
          $('#dpd2').fdatepicker({
            format: 'yyyy-mm-dd',
          });
      // 我的消息 最新消息时间排序
        $("#validnews_table").tableCheck();

        $("#validnews_table").tablesorter(
          {
              // pass the headers argument and assing a object
            headers: {
                // assign the secound column (we start counting zero)
                0: {
                    // disable it by setting the property sorter to false
                    sorter: false
                },
                // assign the third column (we start counting zero)
                1: {
                    // disable it by setting the property sorter to false
                    sorter: false
                },
                2: {
                    // disable it by setting the property sorter to false
                    sorter: false
                }
            }
          });
      //身份证明 我的银行卡 验证码表格验证
          $("#validcard_form").Validform({
                  tiptype:3,
                  selector:"select,input",
             });
      //身份证明表格验证
          $(".verifi_form1").Validform({
                  tiptype:3,
                  selector:"select,input",
                   datatype:{
                    "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
                    }

             });

})







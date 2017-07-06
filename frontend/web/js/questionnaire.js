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
        sortTable:'module/jquery.tablesorter',
        tableCheckbox:'module/jquery.tableCheckbox',
        questiontest:'module/jquery.questiontest',
    },

    shim  : {
        validform : {
            deps : ["jquery"]
        },
        tab: {
           deps : ["jquery"]
        },
        hDialog: {
           deps : ["jquery"]
        },
        questiontest: {
           deps : ["jquery"]
        },
    }
}
requirejs.config(requireConfig);

require(["jquery","tab","hDialog","validform","questiontest"],
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
        //手机号码修改 切换初始化
          $("#validphone_form .form_next").click(function(){
            $(".form2_wrap").show();
            $(".form1_wrap").hide();
            $(".form3_wrap").hide();
          });
          $("#validphone_form .form_next2").click(function(){
            $(".form3_wrap").show();
            $(".form1_wrap").hide();
            $(".form2_wrap").hide();
          });
          $("#validphone_form #valid_endbtn").click(function(){
            $("#valid_bg").hide();
            $(".validphone_wrap").hide();
            $(".form1_wrap").hide();
            $(".form2_wrap").hide();
            $(".form3_wrap").hide();
          });
          $(".validphone_wrap .validphone_close").click(function(){
            $("#valid_bg").hide();
            $(".validphone_wrap").hide();
          });
         //问卷调查-查看详情弹窗
         $(".question_btn").hDialog({

              title: '风险承受能力评估',          //弹框标题
              box: '#questionnaire_wrap',  //弹框默认选择器
              boxBg: '#ffffff',           //弹框默认背景颜色
              modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
              closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
              width: 860,                 //弹框默认宽度
              height: 480,                //弹框默认高度
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
          //身份证明 修改手机 验证码表格验证
          $("#validphone_form").Validform({
                  tiptype:3,
                  selector:"select,input",
                   datatype:{
                    "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
                    }
             });
          //身份证明 邮箱验证 验证码表格验证
          $("#vaildemail_form").Validform({
                  tiptype:3,
                  selector:"select,input",

             });
          //身份证明 邮箱验证 验证码表格验证
          $("#validquestion_form").Validform({
                  tiptype:3,
                  selector:"select,input",
                   datatype:{
                    "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
                    }

             });
          //身份证明 修改密码 验证码表格验证
          $("#validcode_form").Validform({
                  tiptype:3,
                  selector:"select,input",
             });
          //身份验证 邮箱绑定 查看详情弹窗
         $(".validwrap .vaildemail_btn").hDialog({
              title: '邮箱绑定',          //弹框标题
              box: '#validemail_wrap',               //弹框默认选择器
              boxBg: '#ffffff',           //弹框默认背景颜色
              modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
              closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
              width: 420,                 //弹框默认宽度
              height: 332,                //弹框默认高度
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
          //身份验证 安全问题 查看详情弹窗
         $(".validwrap .validquertion_btn").hDialog({
              title: '安全问题',          //弹框标题
              box: '#validquertion_wrap',               //弹框默认选择器
              boxBg: '#ffffff',           //弹框默认背景颜色
              modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
              closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
              width: 550,                 //弹框默认宽度
              height: 414,                //弹框默认高度
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
         //身份验证 修改密码 查看详情弹窗
         $(".validwrap .vaildcode_btn").hDialog({
              title: '修改密码',          //弹框标题
              box: '#validcode_wrap',               //弹框默认选择器
              boxBg: '#ffffff',           //弹框默认背景颜色
              modalBg: 'rgba(0,0,0,0.5)', //遮罩默认背景颜色
              closeBg: '#ff8634',         //弹框关闭按钮默认背景颜色
              width: 550,                 //弹框默认宽度
              height: 405,                //弹框默认高度
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


          //身份验证 修改手机对话框
          $(".validwrap .vaildphone_btn").click(function(){
            $("#valid_bg").show();
            $(".validphone_wrap").show();
            $(".form1_wrap").show();
            $(".form2_wrap").hide();
            $(".form3_wrap").hide();
          });
          //手机号码修改 切换初始化
          $("#validphone_form .form_next").click(function(){
            $(".form2_wrap").show();
            $(".form1_wrap").hide();
            $(".form3_wrap").hide();
          });
          $("#validphone_form .form_next2").click(function(){
            $(".form3_wrap").show();
            $(".form1_wrap").hide();
            $(".form2_wrap").hide();
          });
          $("#validphone_form #valid_endbtn").click(function(){
            $("#valid_bg").hide();
            $(".validphone_wrap").hide();
            $(".form1_wrap").hide();
            $(".form2_wrap").hide();
            $(".form3_wrap").hide();
          });
          $(".validphone_wrap .validphone_close").click(function(){
            $("#valid_bg").hide();
            $(".validphone_wrap").hide();
          });
})







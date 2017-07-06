// 2017年4月15日22:08:21
var requireConfig={
    paths  : {
        jquery: "thirdLib/jqueryjs/jquery-1.12.4.min",
        superslide:'module/jquery.superslide',
        Navactive:'module/jquery.active',
        capsLockTip:'module/jquery.capsLockTip',
        validform:'module/jquery.Validform',
        sideshare:'module/jquery.sideshare.min',
        hDialog:'module/jquery.hDialog',
        questiontest:'module/jquery.questiontest'
    },
    shim  : {
        superslide : {
            deps : ["jquery"]
        },
        capsLockTip: {
           deps : ["jquery"]
        },
        validform : {
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

require(["jquery","Navactive","superslide","validform","capsLockTip","sideshare","hDialog","questiontest"],
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
    //首页banner轮播
    $(".fullSlide").slide({
            titCell: ".hd ul",
            mainCell: ".bd ul",
            effect: "fold",
            autoPlay: true,
            autoPage: true,
            trigger: "mouseover",
            mouseOverStop:"true",
            startFun: function(i) {
                var curLi = jQuery(".fullSlide .bd li").eq(i);
                if ( !! curLi.attr("_src")) {
                    curLi.css("background-image", curLi.attr("_src")).removeAttr("_src")
                }
            }
    });
    //banner箭头显示隐藏
    $(".fullSlide").hover(
      function(){
            $(this).find(".prev,.next").stop(true, true).fadeTo("show", 1)
        },
      function(){
            $(this).find(".prev,.next").fadeOut()
    });
    //滚动公告
    $(".message_info").slide({
      mainCell:".top_navList1",
      autoPlay:true,
      effect:"topLoop",interTime:4500 });
     //登陆界面
        $(".loadForm").Validform({
                tiptype:3,
                selector:"select,input",
                 datatype:{
                  "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
                  }
        });
    //注册界面
    $(".registerForm").Validform({
            tiptype:3,
            selector:"select,input",
             datatype:{
              "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
              }
    });
    //忘记密码界面
    $(".getCodeForm").Validform({
            tiptype:3,
            selector:"select,input",
             datatype:{
              "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
              }
    });
/*
    //注册界面输入框失去焦点
        $(":text,:password").each(function(){
          $(":text,:password").focus(function(){
            $(this).css('background-color','#fff').next('div').text('');
          });
        });
*/
    //注册界面推荐码
    $(".recommend").click(function(){

          $("#exclusive_re").slideToggle(400).css("display","block");
          if ($("#referal").attr("leng") != "s") {
          $("#referal").attr("leng", "s").css({ "transform": "rotate(90deg)"})
          } else {
             $("#referal").attr("leng", "").css({ "transform": "rotate(0deg)"});
           }
    })
    //登陆页面-大小写提示
    $("#load_key").capsLockTip({width:"100px",styleClass:"load_captips"});
    //注册页面-大小写提示
    $("#userpassword").capsLockTip({width:"120px",styleClass:"register_captips"});
    $("#userpassword2").capsLockTip({width:"100px",styleClass:"register_captips2"});
    //找回密码页面-大小写提示
    $("#getpassword").capsLockTip({width:"120px",styleClass:"getCode_captips"});
    $("#getpassword2").capsLockTip({width:"100px",styleClass:"getCode_captips2"});


});








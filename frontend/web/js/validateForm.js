// 2017年5月3日13:43:37
var requireConfig={
    paths  : {
        jquery:'thirdLib/jqueryjs/jquery-1.12.4.min',
        validform:'module/jquery.Validform',
        tab:'module/jquery.tab',
        pages:'module/jquery.pages',
        datepicker:'module/jquery.datepicker',
        Navactive:'module/jquery.active',
        Area:'module/jquery.area',
        sideshare:'module/jquery.sideshare.min',
        hDialog:'module/jquery.hDialog',
        questiontest:'module/jquery.questiontest',

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
        datepicker: {
           deps : ["jquery"]
        },
        Area: {
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

require(["jquery","Navactive","tab","validform","pages","datepicker","Area","sideshare","hDialog","questiontest"],
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
      //表格验证选项卡
        $('.tab_mouseover').Tabs({

          timeout:200

        });
      //翻页
        $(".pageDiv").createPage({
            pageCount:9,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
        });
      //高端投资主页 翻页
        $(".main_investPages ").createPage({
            pageCount:6,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
        });
      //债权转让主页 翻页
        $(".creditor_pages ").createPage({
            pageCount:7,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
        });
      //私募股权主页 翻页
        $(".stock_pages ").createPage({
            pageCount:7,//总页数
            current:1,//当前页
            turndown:'true',//是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
            backFn:function(p){
                console.log(p);
            }
        });
      //主页面遮罩效果
        $(".pro_info").hover(function(){
          // $(this).find(".hover_wrap").css("display","block");
          // },function(){
          //   $(this).find(".hover_wrap").css("display","none");
          $(this).find(".hover_wrap").fadeIn(300);
          },function(){
            $(this).find(".hover_wrap").fadeOut(20);
        })
      //投资输入栏获得焦点
        $(".num_limit").focus(function(){
            $(".num_limit").removeClass("errorC","checkedN");
            $(".limit_text").css("display","none");
            $(".at_buyButton").removeClass("button_disable").attr("disabled", false);
        });
      //投资输入栏失去焦点
        $(".num_limit").blur(function(){
            reg=/^[1-9]\d*00$/;
            if( $(".num_limit").val()=="")
            {
              $(".num_limit").addClass("errorC");
              $(".limit_text").html("输入金额不能为空!");
              $(".limit_text").css("display","block");
              $(".at_buyButton").addClass("button_disable").attr("disabled", true);
            }
                else if(!reg.test($(".num_limit").val()))
                {
                  $(".num_limit").addClass("errorC");
                    $(".limit_text").html("输入金额有误，请输入整倍数！");
                    $(".limit_text").css("display","block");
                    $(".at_buyButton").addClass("button_disable").attr("disabled", true);
                }
                else
                {
                  $(".num_limit").addClass("checkedN");
                  $(".limit_text").css("display","none");
                }
        });
      //债权转让表格验证
        $(".registerform").Validform({
                tiptype:2,
                selector:"select,input",
                 datatype:{
                  "*6-20": /^[^\s]{6,20}$/,
                  "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
                  }
        });
      //私募股权表格验证
        $(".private_reg").Validform({
                tiptype:3,
                selector:"select,input",
                 datatype:{
                  "z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
                  }
        });

      //企业贷-表单申请 成立时间日期选择
        $('#establishData').fdatepicker({
            format: 'yyyy-mm-dd',
        });
      //项目详情-选项卡
        $('.item_form').find('li').click(function(){
            $('.item_form').find('li').attr('class','');
            $('.items_company_bottom').find('li').find('div').attr('class','');
            $(this).attr('class','form_liFilt');
            $(this).find('div').attr('class','items_arrow2');
            $('.items_company_bottom').find('.forms_wrap').css('display','none');
            $('.items_company_bottom').find('.forms_wrap').eq( $(this).index() ).css({display:'table', width:"100%"});
        });
      //投资页面-tab选项卡
        $('#item_list').find('li').click(function(){

            $('#item_list').find('li').attr('class','');
            $('#item_list').find('li').find('div').attr('class','');
            $('.item_box').find('.items_wrap').css('display','none');

            $(this).attr('class','items_active ');
            $(this).find('div').attr('class','items_arrow');

            $('.item_box').find('.items_wrap').eq( $(this).index() ).css('display','block');

        });

});





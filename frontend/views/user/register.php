<?php
use frontend\assets\AppAsset;

AppAsset::addCss($this, 'css/register.css');
AppAsset::addCss($this, 'css/validForm.css');
AppAsset::addCss($this, 'css/validForm_system.css');
?>
<!-- S==当前位置 -->
<div class="head_location">
    <dl class="header_infos">
        <dt>当前位置 :&nbsp;</dt>
        <dd><a href="<?= \yii\helpers\Url::to(['/']) ?>">首页 >&nbsp;&nbsp;</a> </dd>
        <dd><a href="<?= \yii\helpers\Url::to(['user/register']) ?>">新用户注册 &nbsp;&nbsp;</a></dd>
    </dl>
</div>
<!-- E==当前位置 -->

<div class="registor_content">
    <div class="register_top">
        <span>新用户注册</span>
        <div class="register_top_r">
            <p class="old_count">已有账户？</p>
            <a href="<?= \yii\helpers\Url::to(['user/login']) ?>" >登录</a>
        </div>
    </div>
    <form action="" class="registerForm" method="post">
        <div class="register_box">
            <div>
<!--                <input type="text" maxlength="11" placeholder="请输入您的手机号码" name="tel" class="inputxt" datatype="m" tip="请输入用户名" nullmsg="用户名不能为空" errormsg="请输入正确的格式的手机号码" />-->
                <input type="text" maxlength="11" placeholder="请输入您的手机号码" name="mobile" class="inputxt" " />
                <div class="Validform_checktip"></div>
            </div>
            <div class="check_pic_box">
                <input type="text" placeholder="请输入图片验证码" class="checkpic_input">
                <a href="javascript:void(0)" class="check_pic">
                    <img  alt="验证图片" class="check_img" src="<?= \yii\helpers\Url::to(['user/code']) ?>">

                </a>
                <a href="">
                    <button type="button" class="check_change" onclick="this.src='/user/code?c='+Math.random()">看不清楚？换一张</button>
                </a>
            </div>
            <div class="mes_box">
                <input type="text" placeholder="请输入短信验证码" id="message_receice">
                <input type="submit" value="获取短信验证" id="message_receive" >
            </div>
            <div>
<!--                <input  placeholder="请输入您要设置的密码" maxlength="18" type="passward" value="" name="password_hash" id="userpassword" class="inputxt" datatype="*6-18" nullmsg="请设置密码！" errormsg="密码范围在6~18位之间！" onpaste="return false" ondragenter="return false" oncontextmenu="return false;" ime-mode="disabled" onkeydown="return NoSapceInput(event);"/>-->
                <input  placeholder="请输入您要设置的密码" maxlength="18" type="passward" value="" name="password_hash" id="userpassword" class="inputxt" "/>
                <div class="Validform_checktip"></div>
            </div>
            <div>
                <input placeholder="请确认您的密码" maxlength="18" type="passward" value="" name="re_password" />
                <div class="Validform_checktip"></div>
            </div>
        </div>
        <div class="recommend">
            <p><i id="referal" class="fa-angle-right"></i>推荐码</p>
            <s>《选填》</s>
        </div>
        <div id="exclusive_re">
            <input type="text" placeholder="专属推荐码（选填）"/>
        </div>
        <button type="submit" class="agree_btn" >同意协议并注册</button>
        <div class="agree_deal">
            <span>注册即视为同意 </span>
            <a href="#">《中商行协议》</a>
        </div>
    </form>
</div>
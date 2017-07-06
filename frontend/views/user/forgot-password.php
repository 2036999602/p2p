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
        <dd><a href="../index.html">首页 >&nbsp;&nbsp;</a> </dd>
        <dd><a href="getBackCode.html">找回密码 &nbsp;&nbsp;</a></dd>
    </dl>
</div>
<!-- E==当前位置 -->
<div class="getBackCode_box">
    <div class="getBackCode_top">
        <p>找回密码</p>
    </div>
    <form action="" class="getCodeForm">
        <div class="input_box">
            <div>
                <input type="text" maxlength="11" placeholder="请输入您的手机号码" name="tel" class="inputxt" datatype="m" tip="请输入用户名" nullmsg="用户名不能为空" errormsg="请输入正确的格式的手机号码" />
                <div class="Validform_checktip"></div>
            </div>
            <div>
                <input type="text" placeholder="请输入短信验证码" class="message_input">
                <input type="submit" value="获取短信验证" class="message_btn" >
            </div>
            <div>
                <input  placeholder="请输入您要设置的密码" maxlength="18" type="passward" value="" name="getpassword" id="getpassword" class="inputxt" datatype="*6-18" nullmsg="请设置密码！" errormsg="密码范围在6~18位之间！" onpaste="return false" ondragenter="return false" oncontextmenu="return false;" ime-mode="disabled" onkeydown="return NoSapceInput(event);"/>
                <div class="Validform_checktip"></div>
            </div>
            <div>
                <input placeholder="请确认您的密码" maxlength="18" type="passward" value="" name="getpassword2" id="getpassword2" class="inputxt" datatype="*" recheck="getpassword" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！" onpaste="return false" ondragenter="return false" oncontextmenu="return false;" ime-mode="disabled" onkeydown="return NoSapceInput(event);"/>
                <div class="Validform_checktip"></div>
            </div>
        </div>
        <a href="#" class="upload_btn">提交</a>
    </form>
</div>

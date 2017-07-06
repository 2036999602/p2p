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
        <dd><a href="<?= \yii\helpers\Url::to(['/']) ?>">首页 >&nbsp;&nbsp;</a></dd>
        <dd><a href="<?= \yii\helpers\Url::to(['/user/login']) ?>">登陆 &nbsp;&nbsp;</a></dd>
    </dl>
</div>
<!-- E==当前位置 -->
<div class="content_wrap">
    <div class="load_wrap">
        <div class="load_box">
            <p class="load_top">账户登陆</p>
            <form action="" class="loadForm">
                <table>
                    <tr>
                        <td><input type="text" maxlength="11" value="" id="load_account" name="tel" class="inputxt"
                                   datatype="m" tip="请输入用户名" nullmsg="用户名不能为空" errormsg="请输入正确的格式的手机号码"
                                   onkeydown="return NoSapceInput(event);"/></td>
                        <td>
                            <div class="Validform_checktip"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" maxlength="18" id="load_key" errormsg="密码至少6个字符,最多18个字符！"
                                   nullmsg="密码不能为空" datatype="*6-18" class="inputxt" name="password"
                                   onkeydown="return NoSapceInput(event);" onpaste="return false"
                                   ondragenter="return false" oncontextmenu="return false;" style="ime-mode:disabled"/>
                        </td>
                        <td>
                            <div class="Validform_checktip"></div>
                        </td>
                    </tr>
                </table>
                <div class="load_bottom">
                    <a href="<?= \yii\helpers\Url::to(['user/forgot-password']) ?>" target="_blank">忘记密码</a>
                    <input id="autologin" type="checkbox" tabindex="2">
                    <label for="">记住密码</label></br>
                    <p class="register_info">新朋友，<a href="<?= \yii\helpers\Url::to(['user/register']) ?>">免费注册</a></p>
                    <button type="submit">登陆</button>
                </div>
            </form>
        </div>
    </div>
</div>

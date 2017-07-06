<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="UTF-8">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title, '中商行-一个有态度的互联网金融服务平台') ?></title>
    <?php $this->head() ?>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="中商行|中商行官网|理财|投资|P2P理财|民间借贷|网贷|网贷平台|p2p网贷|P2P网贷平台|100%本息保障|第三方托管|资金托管">
    <meta name="description" content="公司拥有严格的风控流程以及真正的第三方资金托管-汇付天下2.0托管，全面保障借贷双方的资金安全，中商行网站所有项目均免费享受100%本息保障！"/>
</head>
<body style="background-color: #eaeaea;">
<?php $this->beginBody() ?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.(为了您的安全和获得更好的体验，请升级您的浏览器！)</p>
<![endif]-->
<!-- S==头部导航 -->
<div class="header_wrap">
    <div class="hrader_top_wrap">
        <div class="header_top_box">
            <div class="welcom_word">
                欢迎您来到中商行，投资有风险，选择需谨慎！
            </div>
            <div class="header_info">
                <ul class="header_ul">
                    <li class="header_line header_white"><a href="<?= \yii\helpers\Url::to(['user/login']) ?>">登陆</a>
                    </li>
                    <li class="header_line">|</li>
                    <li class="header_line header_white"><a href="<?= \yii\helpers\Url::to(['user/register']) ?>"
                                                            target="_blank">注册</a></li>
                    <li class="header_line">|</li>
                    <li class="header_line">帮助中心</li>
                    <li class="header_line">|</li>
                    <li class="header_line">官方微信</li>
                    <li class="header_line">|</li>
                    <li class="header_line">关注微博</li>
                </ul>
            </div>
        </div>
        <div class="header_container">
            <a href="/" class="logo"></a>
            <nav>
                <ul id="nav_bar">
                    <li><a href="/">首页</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['invest/investment']) ?>">高端投资</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['borrow/loan']) ?>">我要借款</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['creditor/creditor']) ?>">债权转让</a></li>
                    <li class="hot_wrap"><a href="<?= \yii\helpers\Url::to(['stock/private-stock']) ?>">私募股权</a><s class="hot_icon"></s></li>
                    <li><a href="<?= \yii\helpers\Url::to(['message/message-insure']) ?>">信息披露</a></li>
                </ul>
            </nav>
            <div class="user">
                <a href="#" class="header_title">
                    <div class="Myimg_box"></div>
                    <span>我的账户</span>
                    <i class="icon_arrow"></i>
                </a>
                <ul id="header_user">
                    <li><a href="html/account/acc_investRecord.html" target="_blank">我的理财</a></li>
                    <li><a href="html/account/acc_borrowRecord.html" target="_blank">我的借款</a></li>
                    <li><a href="html/account/acc_fundsFlow.html" target="_blank">资金记录</a></li>
                    <li><a href="html/account/acc_validcard.html" target="_blank">银行卡管理</a></li>
                    <li><a href="html/account/acc_ensure.html" target="_blank">账户安全</a></li>
                    <li><a href="html/account/acc_discount.html" target="_blank">我的投资券</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- E==头部导航 -->
<?= $content ?>
<!-- S==底部导航 -->
<div class="footer_weap">
    <div class="footer_top">
        <div class="bottom_left">
            <dl>
                <dt class=""><s></s>关于我们</dt>
                <dd><a href="https://www.cmbank.com/news/guwmlist/ce90AgUCCAZRBQMHBFgNUgEMVFUBBFdSA1dSWwZQUw"
                       target="_blank">关于我们</a></dd>
                <dd><a href="<?php echo $base; ?>/news/guwmlist/aba0BwUIVgEJCQZUVgBeVAxVXFdRA1JVVQQHUg1SDA"
                       target="_blank" rel="nofollow">加入我们</a></dd>
                <dd><a href="<?php echo $base; ?>/news/guwmlist/76daVQgAAgNSBlVVB1sAUVxRBlsHAAUNVF0JXAUEBQ"
                       target="_blank" rel="nofollow">联系我们</a></dd>
            </dl>
            <dl>
                <dt><s></s>安全保障</dt>
                <dd><a href="https://www.cmbank.com/security/safeguard/" target="_blank">项目风险</a></dd>
                <dd><a href="https://www.cmbank.com/security/safeguard/" target="_blank">资金安全</a></dd>
                <dd><a href="https://www.cmbank.com/security/safeguard/" target="_blank">技术保障</a></dd>
            </dl>
            <dl>
                <dt><s></s>帮助中心</dt>
                <dd><a href="<?php echo $base; ?>/news/guwmintro/4243UlVRAgEHBlIJVABQBl0BDgYGCVQCB1cEAFVSVAQ"
                       target="_blank" rel="nofollow">新手指引</a></dd>
                <dd><a href="<?php echo $base; ?>/product" target="_blank" rel="nofollow">产品介绍</a></dd>
                <dd><a href="<?php echo $base; ?>/news/guwmlist/f64fBgJRUQBTAlIJUVcHC1taBQNWAQJXAAEEUVAADQ"
                       target="_blank" rel="nofollow">法律法规</a></dd>
            </dl>
        </div>
        <div class="bottom_middle">
            <div class="middle_box">
                <dl>
                    <dt><s></s></dt>
                    <dd>关注我们的微信</dd>
                </dl>
                <dl>
                    <dt><s></s></dt>
                    <dd>关注我们的微信</dd>
                </dl>
            </div>
        </div>
        <div class="bottom_right">
            <p>
                客服热线（人工9：00-18：00）
            </p>
            <span>4009-668-781</span>
        </div>
    </div>
    <div class="footer_bottom">
        <ul>
            <li>友情链接：</li>
            <li><a href="http://www.focus.cn/" target="_blank">搜狐焦点</a></li>
            <li><a href="http://money.sohu.com/" target="_blank" rel="nofollow">搜狐理财</a></li>
            <li><a href="http://www.wangdaizhijia.com/" target="_blank" rel="nofollow">网贷之家</a></li>
            <li><a href="http://www.p2peye.com/" target="_blank" rel="nofollow">网贷天眼</a></li>
            <li><a href="http://www.p2pquan.net/" target="_blank" rel="nofollow">P2P网贷圈</a></li>
            <li><a href="http://www.76676.com/" target="_blank">76676</a></li>
            <li><a href="http://www.wangdaisky.com/portal.php" target="_blank">网贷门户</a></li>
            <li><a href="http://www.wangdaitiandi.com/" target="_blank">网贷天地</a></li>
            <li><a href="http://www.wdlm.cn/" target="_blank">网贷联盟网</a></li>
            <li><a href="http://www.wangdaidp.com/" target="_blank">网贷点评网</a></li>
        </ul>
        <div class="bottom_pic_link">
            <ul>
                <li class="bottom_pic_link1">
                    <a href="http://sz.ebs.org.cn" class="bottom_pic_a1"
                       target='_blank'>
                    </a>
                </li>
                <li class="bottom_pic_link2">
                    <a href="http://www.itrust.org.cn/Home/Index/itrust_certifi?wm=1326705713" target='_blank'
                       class="bottom_pic_a2">
                    </a>
                </li>
                <li class="bottom_pic_link3">
                    <a href="https://credit.cecdc.com/CX20150505007663010006.html" target='_blank'
                       class="bottom_pic_a3">

                    </a>
                </li>
                <li class="bottom_pic_link4">
                    <a href="https://ss.knet.cn/verifyseal.dll?sn=e16090644030064637dqva000000&ct=df&a=1&pa=0.9940364500507712"
                       target='_blank' class="bottom_pic_a4">

                    </a>
                </li>
                <li class="bottom_pic_link5">
                    <a href="https://www.anquan.org" target='_blank' class="bottom_pic_a5">

                    </a>
                </li>
                <li class="bottom_pic_link6">
                    <a href="http://si.trustutn.org/info?sn=480160905000514810729" target='_blank'
                       class="bottom_pic_a6">

                    </a>
                </li>
            </ul>
        </div>
        <div class="copyright">
                <span>
                     版权所有 深圳前海中商行互联网金融服务有限公司 Copyright © 2014-2017 cmbank.com, All Rights Reserved 粤ICP备15001480号-2
               </span>
        </div>
    </div>
</div>
<!-- E==底部导航 -->
<!-- S==侧边栏 -->
<div class="asid_share" id="asid_share">
    <div class="asid_share_box pr">
        <a href="html/counter.html"><img alt="理财计算" title="理财计算器" class="adid_icon"
                                         src="imgs/sideshare/icon_say.png"></a>
    </div>
    <div class="asid_share_box pr">
        <a href="javascript:void(0);" id="counterBtn"><img alt="问券调查" title="问券调查" class="adid_icon"
                                                           src="imgs/sideshare/icon_help.png"></a>
    </div>
    <div class="asid_share_box pr">
        <a href="javascript:void(0);"><img alt="扫二维码" title="扫二维码" class="adid_icon"
                                           src="imgs/sideshare/icon_sweep.png"></a>
        <div class="asid_share_triangle" style="display:none;">
            <em class="border_sj">&#9670;</em>
            <span class="con_sj">&#9670;</span>
        </div>
        <div class="asid_sha_layer" style="display:none;">
            <p class="sweep_img"><img src="imgs/sideshare/weixin.jpg"></p>
            <p class="pb6"><b>扫一扫二维码图案，添加官方微信</b></p>
        </div>
    </div>
    <div class="asid_share_box pr" style="display:none;">
        <a href="#"><img alt="返回顶部" title="返回顶部" class="adid_icon" src="imgs/sideshare/icon_back.png"></a>
    </div>
</div>
<!-- E==侧边栏 -->
<!-- S==问券调查 -->
<div id="questionnaire_wrap">
    <div class="questionnaire_box">
        <!-- S==问题 -->
        <div class="main">
            <div class="warp">
                <div class="issue" id="issue">
                    <div class="cnt">
                        <h3>1、您的投资出现何种程度的波动时，您会呈现明显的焦虑？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is0" value="1"/>本金无损失，但收益未达预期</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is0" value="2"/>出现轻微本金损失</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is0" value="3"/>本金10%以内的损失</label>
                            </li>
                        </ul>
                    </div>
                    <div class="cnt">
                        <h3>2、你投资60天之后，价格下跌20%，假设所有基本情况不变，你会怎么做？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is1" value="1"/>为避免更大的担忧，把它抛掉再试试其他的</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is1" value="2"/>什么都不做，静等收入投资</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is1" value="3"/>再买入，这正是投资的好机会，同时也是便宜的投资</label>
                            </li>
                        </ul>
                    </div>
                    <div class="cnt">
                        <h3>3、当你进行一项投资时，你怎么看待保证本金安全和赚取高收益这两个目标？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="1"/>保证本金安全最重要</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="2"/>保证本金安全比较重要</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="3"/>保证本金安全最重要</label>
                            </li>
                        </ul>
                    </div>
                    <div class="cnt">
                        <h3>4、以下投资供你选择，您会选择哪一种？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="1"/>稳赚5%</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="2"/>2-5年</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="3"/>5年以上</label>
                            </li>
                        </ul>
                    </div>
                    <div class="cnt">
                        <h3>5、如果您购买一款理财产品，您可以接受的最长的期限是多久？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="1"/>1年之内</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="2"/>2-5年</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="3"/>5年以上</label>
                            </li>
                        </ul>
                    </div>
                    <div class="cnt">
                        <h3>6、在您每年的家庭收入中，可用于金融投资（储蓄存款除外）的比例为？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="1"/>小于10%</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="2"/>10%至50%</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="3"/>大于50%</label>
                            </li>
                        </ul>
                    </div>
                    <div class="cnt">
                        <h3>7、您投资的目的是？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="1"/>在保本的情况下，追求一定的收入</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="2"/>在承担小部分损失的情况下，追求一定程度的收益</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="3"/>在承担较大损失的情况下，追求较大的收益</label>
                            </li>
                        </ul>
                    </div>
                    <div class="cnt">
                        <h3>8、您的家庭年收入折合人民币为（家庭收入状况影响您的风险承受能力）？</h3>
                        <ul>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="1"/>10万元以下</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="2"/>10—50万元</label>
                            </li>
                            <li><span>&nbsp;</span>
                                <label>
                                    <input type="radio" name="is2" value="3"/>50万元以上</label>
                            </li>
                        </ul>
                    </div>
                    <div class="result" id="result">提交</div>
                </div>
                <div class="ctrl">
                    <div class="btns">
                        <span title="上一题" class="prev" id="prev">上一题</span>
                        <span title="下一题" class="next" id="next">下一题</span>
                    </div>
                    <div class="prog" id="prog">
                        <div class="ptip" id="tips"><span></span></div>
                        <div class="ress" id="ress"></div>
                    </div>
                </div>
                <div class="war" id="war"></div>
            </div>
            <div class="info">
                <p>本问卷根据国家相关法规要求，旨在了解您对风险的承受意愿及能力，以帮助您控制投资风险</p>
            </div>
        </div>
        <!-- E==问题 -->
    </div>
</div>
<!-- E==底部导航 -->
<script type="text/javascript" src='../js/thirdLib/requirejs/require.js'  data-main='../js/mainFrame'  charset="utf-8"></script>

<!-- E==问券调查 -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
